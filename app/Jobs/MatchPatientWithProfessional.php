<?php

namespace App\Jobs;

use App\Models\Consultation;
use App\Models\ConsultationQueue;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class MatchPatientWithProfessional implements ShouldQueue
{
    use Queueable;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Find patients waiting in queue for general practitioners
        $waitingPatients = ConsultationQueue::where('status', 'waiting')
            ->where('specialty', 'Clínico Geral')
            ->orderBy('joined_at')
            ->get();

        foreach ($waitingPatients as $queueEntry) {
            // Find available general practitioners
            $availableProfessional = User::whereHas('professionalProfile', function($q) {
                $q->where('specialty', 'Clínico Geral')
                  ->where('is_available', true)
                  ->where('status', 'active');
            })
            ->whereDoesntHave('professionalConsultations', function($q) {
                $q->whereIn('status', ['pending', 'in_progress', 'matched']);
            })
            ->first();

            if ($availableProfessional) {
                // Create consultation
                $consultation = Consultation::create([
                    'patient_id' => $queueEntry->patient_id,
                    'professional_id' => $availableProfessional->id,
                    'type' => 'live_queue',
                    'specialty' => 'Clínico Geral',
                    'status' => 'matched',
                    'symptoms' => $queueEntry->symptoms,
                    'notes' => $queueEntry->notes,
                    'fee' => $availableProfessional->professionalProfile->consultation_fee ?? 100,
                ]);

                // Update queue entry
                $queueEntry->update([
                    'status' => 'matched',
                    'consultation_id' => $consultation->id,
                    'matched_at' => now(),
                ]);

                Log::info('Patient matched with professional', [
                    'patient_id' => $queueEntry->patient_id,
                    'professional_id' => $availableProfessional->id,
                    'consultation_id' => $consultation->id,
                ]);

                // TODO: Send notifications to both patient and professional
                // dispatch(new SendConsultationNotification($consultation));
            }
        }
    }
}
