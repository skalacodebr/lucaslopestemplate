<?php

namespace App\Livewire;

use App\Models\Consultation;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\On;

class ScheduledConsultation extends Component
{
    public ?User $selectedProfessional = null;
    public string $selectedDate = '';
    public string $selectedTime = '';
    public array $symptoms = [];
    public string $notes = '';
    public string $step = 'select_professional'; // select_professional, select_datetime, confirmation
    public array $availableSlots = [];
    public ?Consultation $consultation = null;

    public function mount()
    {
        $this->selectedDate = now()->addDay()->format('Y-m-d');
    }

    public function selectProfessional(int $professionalId)
    {
        $this->selectedProfessional = User::with('professionalProfile')
            ->whereHas('professionalProfile', function($q) {
                $q->where('specialty', '!=', 'Clínico Geral')
                  ->where('is_available', true)
                  ->where('status', 'active');
            })
            ->findOrFail($professionalId);

        $this->step = 'select_datetime';
        $this->loadAvailableSlots();
    }

    public function selectDateTime(string $date, string $time)
    {
        $this->selectedDate = $date;
        $this->selectedTime = $time;
        $this->step = 'confirmation';
    }

    public function goBack()
    {
        match($this->step) {
            'select_datetime' => $this->step = 'select_professional',
            'confirmation' => $this->step = 'select_datetime',
            default => null
        };
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

    public function scheduleConsultation()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $scheduledDateTime = Carbon::createFromFormat('Y-m-d H:i', $this->selectedDate . ' ' . $this->selectedTime);

        $this->consultation = Consultation::create([
            'patient_id' => auth()->id(),
            'professional_id' => $this->selectedProfessional->id,
            'type' => 'scheduled',
            'specialty' => $this->selectedProfessional->professionalProfile->specialty,
            'scheduled_at' => $scheduledDateTime,
            'status' => 'pending',
            'fee' => $this->selectedProfessional->professionalProfile->consultation_fee,
            'symptoms' => $this->symptoms,
            'notes' => $this->notes,
        ]);

        $this->dispatch('consultation-scheduled', ['consultationId' => $this->consultation->id]);

        return redirect()->route('consultation.call', $this->consultation->id);
    }

    public function updatedSelectedDate()
    {
        $this->loadAvailableSlots();
    }

    protected function loadAvailableSlots()
    {
        if (!$this->selectedProfessional || !$this->selectedDate) {
            return;
        }

        $date = Carbon::parse($this->selectedDate);
        $dayOfWeek = $date->format('l'); // Monday, Tuesday, etc.

        // Simular horários disponíveis baseados no dia da semana
        $baseSlots = match($dayOfWeek) {
            'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' => [
                '08:00', '08:30', '09:00', '09:30', '10:00', '10:30',
                '11:00', '11:30', '14:00', '14:30', '15:00', '15:30',
                '16:00', '16:30', '17:00', '17:30'
            ],
            'Saturday' => [
                '08:00', '08:30', '09:00', '09:30', '10:00', '10:30',
                '11:00', '11:30'
            ],
            default => []
        };

        // Remover horários já agendados
        $bookedSlots = Consultation::where('professional_id', $this->selectedProfessional->id)
            ->whereDate('scheduled_at', $date)
            ->whereIn('status', ['pending', 'confirmed', 'in_progress'])
            ->pluck('scheduled_at')
            ->map(fn($datetime) => $datetime->format('H:i'))
            ->toArray();

        $this->availableSlots = array_diff($baseSlots, $bookedSlots);

        // Remover horários passados se for hoje
        if ($date->isToday()) {
            $now = now()->format('H:i');
            $this->availableSlots = array_filter($this->availableSlots, fn($slot) => $slot > $now);
        }
    }

    public function getSpecialistProfessionalsProperty()
    {
        return User::with('professionalProfile')
            ->whereHas('professionalProfile', function($q) {
                $q->where('specialty', '!=', 'Clínico Geral')
                  ->where('is_available', true)
                  ->where('status', 'active');
            })
            ->get();
    }

    public function getFormattedSelectedDateTimeProperty()
    {
        if (!$this->selectedDate || !$this->selectedTime) {
            return '';
        }

        $date = Carbon::parse($this->selectedDate);
        return $date->format('d/m/Y') . ' às ' . $this->selectedTime;
    }

    public function render()
    {
        return view('livewire.scheduled-consultation', [
            'specialistProfessionals' => $this->specialistProfessionals,
        ])->layout('layouts.app');
    }
}
