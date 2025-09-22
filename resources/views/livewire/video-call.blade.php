@vite('resources/css/video-call.css')

<div class="video-call-container">
    <!-- Call Header -->
    <div class="call-header">
        <div class="consultation-info">
            <h2 class="consultation-title">
                @if($isPatient)
                    Consulta com {{ $consultation->professional->name }}
                @else
                    Consulta - {{ $consultation->patient->name }}
                @endif
            </h2>
            <div class="consultation-details">
                <span class="detail-item">{{ $consultation->specialty }}</span>
                <span class="detail-separator">•</span>
                <span class="detail-item">{{ $consultation->type_label }}</span>
                <span class="detail-separator">•</span>
                <span class="detail-item connection-status status-{{ $connectionStatus }}">
                    {{ ucfirst($connectionStatus) }}
                </span>
            </div>
        </div>

        <div class="call-actions">
            @if($isProfessional && $consultation->status !== 'completed')
                <button wire:click="endConsultation"
                        wire:confirm="Tem certeza que deseja finalizar a consulta?"
                        class="end-consultation-btn">
                    Finalizar Consulta
                </button>
            @endif
        </div>
    </div>

    <!-- Video Container -->
    <div class="video-container">
        @if(!$isJoined && !$isConnecting)
            <!-- Pre-call Screen -->
            <div class="pre-call-screen">
                <div class="pre-call-content">
                    <div class="camera-preview" id="local-preview">
                        <div class="preview-placeholder">
                            <svg class="camera-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            <p>Pré-visualização da câmera</p>
                        </div>
                    </div>

                    <div class="pre-call-controls">
                        <button wire:click="toggleAudio"
                                class="control-btn {{ $audioEnabled ? 'active' : 'inactive' }}">
                            <svg class="control-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($audioEnabled)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 5.586l12.828 12.828M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                                @endif
                            </svg>
                            <span>{{ $audioEnabled ? 'Microfone' : 'Sem Áudio' }}</span>
                        </button>

                        <button wire:click="toggleVideo"
                                class="control-btn {{ $videoEnabled ? 'active' : 'inactive' }}">
                            <svg class="control-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($videoEnabled)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                                @endif
                            </svg>
                            <span>{{ $videoEnabled ? 'Câmera' : 'Sem Vídeo' }}</span>
                        </button>
                    </div>

                    @if($canStart)
                        <button wire:click="joinCall" class="join-call-btn">
                            Entrar na Chamada
                        </button>
                    @else
                        <div class="waiting-message">
                            <p>Aguardando o horário da consulta...</p>
                        </div>
                    @endif
                </div>
            </div>
        @elseif($isConnecting)
            <!-- Connecting Screen -->
            <div class="connecting-screen">
                <div class="connecting-content">
                    <div class="loading-spinner"></div>
                    <h3>Conectando...</h3>
                    <p>Entrando na chamada, aguarde um momento.</p>
                </div>
            </div>
        @else
            <!-- Active Call Screen -->
            <div class="active-call">
                <!-- Remote Video -->
                <div class="remote-video-container">
                    <div id="remote-video-{{ $consultation->id }}" class="remote-video">
                        <div class="video-placeholder">
                            <div class="participant-avatar">
                                @if($isPatient)
                                    {{ substr($consultation->professional->name, 0, 1) }}
                                @else
                                    {{ substr($consultation->patient->name, 0, 1) }}
                                @endif
                            </div>
                            <p class="participant-name">
                                @if($isPatient)
                                    {{ $consultation->professional->name }}
                                @else
                                    {{ $consultation->patient->name }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Local Video (Picture-in-Picture) -->
                <div class="local-video-container">
                    <div id="local-video" class="local-video">
                        <div class="video-placeholder">
                            <div class="user-avatar">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Participants Info -->
                @if(count($participants) > 0)
                    <div class="participants-info">
                        <span class="participants-count">{{ count($participants) }} participante(s)</span>
                    </div>
                @endif
            </div>
        @endif
    </div>

    <!-- Call Controls -->
    @if($isJoined)
        <div class="call-controls">
            <button wire:click="toggleAudio"
                    class="control-btn {{ $audioEnabled ? 'active' : 'inactive' }}">
                <svg class="control-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    @if($audioEnabled)
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 5.586l12.828 12.828M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                    @endif
                </svg>
            </button>

            <button wire:click="toggleVideo"
                    class="control-btn {{ $videoEnabled ? 'active' : 'inactive' }}">
                <svg class="control-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    @if($videoEnabled)
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"/>
                    @endif
                </svg>
            </button>

            <button wire:click="leaveCall" class="control-btn leave-btn">
                <svg class="control-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
            </button>
        </div>
    @endif

    <!-- Consultation Details Panel -->
    @if($consultation->symptoms || $consultation->notes)
        <div class="consultation-details-panel">
            <h4>Informações da Consulta</h4>

            @if($consultation->symptoms && count($consultation->symptoms) > 0)
                <div class="detail-section">
                    <h5>Sintomas Relatados:</h5>
                    <div class="symptoms-list">
                        @foreach($consultation->symptoms as $symptom)
                            <span class="symptom-tag">{{ $symptom }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($consultation->notes)
                <div class="detail-section">
                    <h5>Observações:</h5>
                    <p>{{ $consultation->notes }}</p>
                </div>
            @endif
        </div>
    @endif
</div>

<script>
document.addEventListener('livewire:initialized', () => {
    let client = null;
    let localVideoTrack = null;
    let localAudioTrack = null;
    let isJoined = false;

    // Initialize Agora client
    function initializeAgora() {
        if (typeof AgoraRTC === 'undefined') {
            console.error('Agora RTC SDK not loaded');
            return;
        }

        client = AgoraRTC.createClient({mode: "rtc", codec: "vp8"});

        // Event listeners
        client.on("user-published", async (user, mediaType) => {
            await client.subscribe(user, mediaType);

            if (mediaType === "video") {
                const remoteVideoTrack = user.videoTrack;
                const remoteContainer = document.getElementById('remote-video-{{ $consultation->id }}');
                if (remoteContainer) {
                    remoteVideoTrack.play(remoteContainer);
                }
            }

            if (mediaType === "audio") {
                const remoteAudioTrack = user.audioTrack;
                remoteAudioTrack.play();
            }

            Livewire.dispatch('participant-joined');
        });

        client.on("user-unpublished", (user) => {
            Livewire.dispatch('participant-left');
        });

        client.on("connection-state-change", (curState, revState) => {
            Livewire.dispatch('connection-state-changed', curState);
        });
    }

    // Join channel
    Livewire.on('join-agora-channel', async (data) => {
        try {
            if (!client) initializeAgora();

            await client.join(data.appId, data.channelName, data.token || null, data.userId);

            // Create local tracks
            [localAudioTrack, localVideoTrack] = await AgoraRTC.createMicrophoneAndCameraTracks();

            // Play local video
            const localContainer = document.getElementById('local-video');
            if (localContainer && localVideoTrack) {
                localVideoTrack.play(localContainer);
            }

            // Publish tracks
            await client.publish([localAudioTrack, localVideoTrack]);

            isJoined = true;
            Livewire.dispatch('call-joined');
        } catch (error) {
            console.error('Failed to join channel:', error);
        }
    });

    // Leave channel
    Livewire.on('leave-agora-channel', async () => {
        if (localVideoTrack) {
            localVideoTrack.stop();
            localVideoTrack.close();
        }
        if (localAudioTrack) {
            localAudioTrack.stop();
            localAudioTrack.close();
        }

        if (client && isJoined) {
            await client.leave();
        }

        isJoined = false;
        Livewire.dispatch('call-left');
    });

    // Toggle audio
    Livewire.on('toggle-audio', (data) => {
        if (localAudioTrack) {
            localAudioTrack.setEnabled(data.enabled);
        }
    });

    // Toggle video
    Livewire.on('toggle-video', (data) => {
        if (localVideoTrack) {
            localVideoTrack.setEnabled(data.enabled);
        }
    });

    // End consultation
    Livewire.on('end-consultation', async () => {
        await Livewire.dispatch('leave-agora-channel');
    });

    // Initialize on page load
    initializeAgora();
});
</script>

<!-- Load Agora SDK -->
<script src="https://download.agora.io/sdk/release/AgoraRTC_N-4.20.2.js"></script>
