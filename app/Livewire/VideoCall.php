<?php

namespace App\Livewire;

use App\Models\Consultation;
use App\Models\ConsultationParticipant;
use App\Services\AgoraService;
use Livewire\Component;
use Livewire\Attributes\On;

class VideoCall extends Component
{
    public Consultation $consultation;
    public string $channelName = '';
    public string $token = '';
    public string $appId = '';
    public bool $audioEnabled = true;
    public bool $videoEnabled = true;
    public bool $isJoined = false;
    public bool $isConnecting = false;
    public string $connectionStatus = 'disconnected';
    public array $participants = [];
    public ?ConsultationParticipant $currentParticipant = null;

    protected AgoraService $agoraService;

    public function boot(AgoraService $agoraService)
    {
        $this->agoraService = $agoraService;
    }

    public function mount(Consultation $consultation)
    {
        $this->consultation = $consultation;
        $this->appId = $this->agoraService->getAppId();

        // Generate or get existing channel
        if (!$this->consultation->agora_channel_name) {
            $this->channelName = $this->agoraService->createChannelName($this->consultation->id);
            $this->consultation->update(['agora_channel_name' => $this->channelName]);
        } else {
            $this->channelName = $this->consultation->agora_channel_name;
        }

        // Generate token
        $this->token = $this->agoraService->generateRtcToken(
            $this->channelName,
            auth()->id(),
            3600
        );

        // Check if user is already a participant
        $this->currentParticipant = ConsultationParticipant::where('consultation_id', $consultation->id)
            ->where('user_id', auth()->id())
            ->first();

        $this->loadParticipants();
    }

    public function joinCall()
    {
        $this->isConnecting = true;

        // Create or update participant record
        if (!$this->currentParticipant) {
            $role = auth()->user()->isProfessional() ? 'professional' : 'patient';

            $this->currentParticipant = ConsultationParticipant::create([
                'consultation_id' => $this->consultation->id,
                'user_id' => auth()->id(),
                'role' => $role,
                'audio_enabled' => $this->audioEnabled,
                'video_enabled' => $this->videoEnabled,
                'connection_status' => 'connecting',
            ]);
        } else {
            $this->currentParticipant->update([
                'connection_status' => 'connecting',
                'joined_at' => now(),
            ]);
        }

        $this->dispatch('join-agora-channel', [
            'appId' => $this->appId,
            'channelName' => $this->channelName,
            'token' => $this->token,
            'userId' => auth()->id(),
        ]);
    }

    public function leaveCall()
    {
        if ($this->currentParticipant) {
            $this->currentParticipant->leave();
        }

        $this->isJoined = false;
        $this->connectionStatus = 'disconnected';

        $this->dispatch('leave-agora-channel');
        $this->loadParticipants();
    }

    public function toggleAudio()
    {
        $this->audioEnabled = !$this->audioEnabled;

        if ($this->currentParticipant) {
            $this->currentParticipant->toggleAudio();
        }

        $this->dispatch('toggle-audio', ['enabled' => $this->audioEnabled]);
    }

    public function toggleVideo()
    {
        $this->videoEnabled = !$this->videoEnabled;

        if ($this->currentParticipant) {
            $this->currentParticipant->toggleVideo();
        }

        $this->dispatch('toggle-video', ['enabled' => $this->videoEnabled]);
    }

    #[On('call-joined')]
    public function onCallJoined()
    {
        $this->isJoined = true;
        $this->isConnecting = false;
        $this->connectionStatus = 'connected';

        if ($this->currentParticipant) {
            $this->currentParticipant->updateConnectionStatus('connected');
        }

        // Update consultation status if needed
        if ($this->consultation->status === 'pending') {
            $this->consultation->update([
                'status' => 'in_progress',
                'started_at' => now(),
            ]);
        }

        $this->loadParticipants();
    }

    #[On('call-left')]
    public function onCallLeft()
    {
        $this->isJoined = false;
        $this->connectionStatus = 'disconnected';

        if ($this->currentParticipant) {
            $this->currentParticipant->updateConnectionStatus('disconnected');
        }

        $this->loadParticipants();
    }

    #[On('connection-state-changed')]
    public function onConnectionStateChanged($state)
    {
        $this->connectionStatus = $state;

        if ($this->currentParticipant) {
            $this->currentParticipant->updateConnectionStatus($state);
        }
    }

    #[On('participant-joined')]
    public function onParticipantJoined()
    {
        $this->loadParticipants();
    }

    #[On('participant-left')]
    public function onParticipantLeft()
    {
        $this->loadParticipants();
    }

    public function endConsultation()
    {
        $this->consultation->update([
            'status' => 'completed',
            'ended_at' => now(),
        ]);

        // End call for all participants
        $this->dispatch('end-consultation');

        return redirect()->route('telemedicine.dashboard');
    }

    protected function loadParticipants()
    {
        $this->participants = ConsultationParticipant::where('consultation_id', $this->consultation->id)
            ->with('user')
            ->connected()
            ->get()
            ->toArray();
    }

    public function getCanStartProperty()
    {
        return $this->consultation->canStart();
    }

    public function getIsPatientProperty()
    {
        return auth()->user()->isPatient();
    }

    public function getIsProfessionalProperty()
    {
        return auth()->user()->isProfessional();
    }

    public function render()
    {
        return view('livewire.video-call', [
            'canStart' => $this->canStart,
            'isPatient' => $this->isPatient,
            'isProfessional' => $this->isProfessional,
        ])->layout('layouts.app');
    }
}
