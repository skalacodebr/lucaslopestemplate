<?php

namespace App\Livewire;

use App\Models\ConsultationQueue;
use App\Models\Consultation;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;

class LiveQueue extends Component
{
    public array $symptoms = [];
    public string $notes = '';
    public bool $inQueue = false;
    public ?ConsultationQueue $queueEntry = null;
    public int $position = 0;
    public string $estimatedWait = '';

    public function mount()
    {
        $this->checkQueueStatus();
    }

    public function joinQueue()
    {
        \Log::info('joinQueue called - auth check: ' . (auth()->check() ? 'yes' : 'no'));

        if (!auth()->check()) {
            \Log::info('User not authenticated, redirecting to login');
            return redirect('/patient-login');
        }

        \Log::info('User authenticated: ' . auth()->user()->email);

        // Verificar se já está em alguma fila
        try {
            $existingEntry = ConsultationQueue::where('patient_id', auth()->id())
                ->active()
                ->first();

            \Log::info('Existing entry check completed');

            if ($existingEntry) {
                \Log::info('Found existing entry: ' . $existingEntry->id);
                $this->queueEntry = $existingEntry;
                $this->inQueue = true;
                $this->updateQueueInfo();
                return;
            }
        } catch (\Exception $e) {
            \Log::error('Error checking existing entry: ' . $e->getMessage());
        }

        // Entrar na fila
        \Log::info('Creating new queue entry');
        try {
            $this->queueEntry = ConsultationQueue::create([
                'patient_id' => auth()->id(),
                'specialty' => 'Clínico Geral',
                'status' => 'waiting',
                'symptoms' => $this->symptoms,
                'notes' => $this->notes,
                'joined_at' => now(),
            ]);

            \Log::info('Queue entry created: ' . $this->queueEntry->id);

            $this->inQueue = true;
            $this->updateQueueInfo();
        } catch (\Exception $e) {
            \Log::error('Error creating queue entry: ' . $e->getMessage());
            return;
        }

        // Dispatch job to find matches immediately
        \App\Jobs\MatchPatientWithProfessional::dispatch();

        $this->dispatch('queue-joined', ['position' => $this->position]);
    }

    public function leaveQueue()
    {
        if ($this->queueEntry) {
            $this->queueEntry->leaveQueue('cancelled_by_patient');
            $this->resetQueueState();
            $this->dispatch('queue-left');
        }
    }

    public function addSymptom(string $symptom)
    {
        if (!in_array($symptom, $this->symptoms)) {
            $this->symptoms[] = $symptom;
        }
    }

    public function removeSymptom(int $index)
    {
        if (isset($this->symptoms[$index])) {
            unset($this->symptoms[$index]);
            $this->symptoms = array_values($this->symptoms);
        }
    }

    #[On('queue-updated')]
    public function refreshQueue()
    {
        if ($this->inQueue && $this->queueEntry) {
            $this->queueEntry->refresh();
            $this->updateQueueInfo();
        }
    }

    public function checkQueueStatus()
    {
        if (!auth()->check()) {
            return;
        }

        $this->queueEntry = ConsultationQueue::where('patient_id', auth()->id())
            ->active()
            ->first();

        if ($this->queueEntry) {
            $this->inQueue = true;
            $this->updateQueueInfo();

            // Se foi pareado, redirecionar para consulta
            if ($this->queueEntry->isMatched() || $this->queueEntry->isInConsultation()) {
                return redirect()->route('consultation.call', $this->queueEntry->consultation_id);
            }
        }
    }

    public function updateQueueInfo()
    {
        if (!$this->queueEntry) return;

        $this->queueEntry->updatePosition();
        $this->queueEntry->updateEstimatedWait();
        $this->queueEntry->refresh();

        $this->position = $this->queueEntry->position;
        $this->estimatedWait = $this->queueEntry->wait_time;
    }

    public function resetQueueState()
    {
        $this->inQueue = false;
        $this->queueEntry = null;
        $this->position = 0;
        $this->estimatedWait = '';
        $this->symptoms = [];
        $this->notes = '';
    }

    public function getAvailableProfessionalsProperty()
    {
        return User::whereHas('professionalProfile', function($q) {
            $q->where('specialty', 'Clínico Geral')
              ->where('is_available', true)
              ->where('status', 'active');
        })->count();
    }

    public function getQueueSizeProperty()
    {
        return ConsultationQueue::where('specialty', 'Clínico Geral')
            ->where('status', 'waiting')
            ->count();
    }

    public function render()
    {
        return view('livewire.live-queue', [
            'availableProfessionals' => $this->availableProfessionals,
            'queueSize' => $this->queueSize,
        ])->layout('layouts.livewire');
    }
}
