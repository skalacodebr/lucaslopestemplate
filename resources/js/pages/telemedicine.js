/**
 * Telemedicine Dashboard JavaScript
 * Handles interactions and functionality for the telemedicine platform
 */

import Alpine from 'alpinejs';

document.addEventListener('DOMContentLoaded', function() {
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
    console.log('Telemedicine Dashboard loaded');

=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
    // Initialize Alpine.js components
    Alpine.data('telemedicineBoard', () => ({
        // Dashboard state
        activeTab: 'consultations',
        consultations: [],
        upcomingConsultations: [],
        notifications: [],

        // Loading states
        loading: false,
        videoCallActive: false,

<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        init() {
            this.loadConsultations();
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
        // Video call state
        localStream: null,
        remoteStream: null,
        peerConnection: null,

        // Agora.io integration
        agoraClient: null,
        agoraEngine: null,
        channelName: null,
        token: null,
        uid: null,

        init() {
            this.loadConsultations();
            this.initializeNotifications();
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
            this.setupEventListeners();
        },

        // Tab management
        switchTab(tab) {
            this.activeTab = tab;
            this.loadTabContent(tab);
        },

        // Consultation management
        async loadConsultations() {
            this.loading = true;
            try {
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                // Simular API call
                await new Promise(resolve => setTimeout(resolve, 1000));

                // Mock data para demonstração
                this.consultations = [
                    {
                        id: 1,
                        patient: { name: 'João Silva', age: 35 },
                        scheduled_at: '2024-01-15 14:30:00',
                        status: 'scheduled',
                        status_label: 'Agendada',
                        specialty: 'Clínico Geral',
                        fee: 150.00
                    }
                ];

=======
                const response = await fetch('/api/consultations');
                this.consultations = await response.json();
>>>>>>> Stashed changes
=======
                const response = await fetch('/api/consultations');
                this.consultations = await response.json();
>>>>>>> Stashed changes
=======
                const response = await fetch('/api/consultations');
                this.consultations = await response.json();
>>>>>>> Stashed changes
                this.filterUpcomingConsultations();
            } catch (error) {
                this.showNotification('Erro ao carregar consultas', 'error');
            } finally {
                this.loading = false;
            }
        },

        filterUpcomingConsultations() {
            const now = new Date();
            this.upcomingConsultations = this.consultations.filter(
                consultation => new Date(consultation.scheduled_at) > now
            );
        },

<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        // Notification system
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
        async startConsultation(consultationId) {
            try {
                this.loading = true;

                // Get consultation details and join token
                const response = await fetch(`/api/consultations/${consultationId}/start`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const data = await response.json();

                if (data.success) {
                    await this.initializeVideoCall(data.channel, data.token, data.uid);
                    this.showNotification('Consulta iniciada com sucesso', 'success');
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                this.showNotification(error.message || 'Erro ao iniciar consulta', 'error');
            } finally {
                this.loading = false;
            }
        },

        // Video call functionality with Agora.io
        async initializeVideoCall(channelName, token, uid) {
            try {
                // Initialize Agora engine
                this.agoraEngine = AgoraRTC.createClient({ mode: 'rtc', codec: 'vp8' });

                this.channelName = channelName;
                this.token = token;
                this.uid = uid;

                // Set up event listeners
                this.agoraEngine.on('user-published', this.handleUserPublished.bind(this));
                this.agoraEngine.on('user-unpublished', this.handleUserUnpublished.bind(this));

                // Join channel
                await this.agoraEngine.join(this.token, this.channelName, this.uid);

                // Create and publish local tracks
                const localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
                const localVideoTrack = await AgoraRTC.createCameraVideoTrack();

                this.localStream = [localAudioTrack, localVideoTrack];

                // Play local video
                localVideoTrack.play('local-video');

                // Publish local tracks
                await this.agoraEngine.publish(this.localStream);

                this.videoCallActive = true;

            } catch (error) {
                console.error('Erro ao inicializar chamada de vídeo:', error);
                this.showNotification('Erro ao conectar à chamada de vídeo', 'error');
            }
        },

        async handleUserPublished(user, mediaType) {
            await this.agoraEngine.subscribe(user, mediaType);

            if (mediaType === 'video') {
                user.videoTrack.play('remote-video');
            }

            if (mediaType === 'audio') {
                user.audioTrack.play();
            }
        },

        handleUserUnpublished(user) {
            // Handle user leaving the call
            this.showNotification('Usuário saiu da chamada', 'info');
        },

        async endCall() {
            try {
                // Stop local tracks
                if (this.localStream) {
                    this.localStream.forEach(track => {
                        track.stop();
                        track.close();
                    });
                }

                // Leave channel
                if (this.agoraEngine) {
                    await this.agoraEngine.leave();
                }

                this.videoCallActive = false;
                this.localStream = null;
                this.remoteStream = null;

                this.showNotification('Chamada encerrada', 'info');

            } catch (error) {
                console.error('Erro ao encerrar chamada:', error);
                this.showNotification('Erro ao encerrar chamada', 'error');
            }
        },

        toggleAudio() {
            if (this.localStream && this.localStream[0]) {
                const audioTrack = this.localStream[0];
                if (audioTrack.enabled) {
                    audioTrack.setEnabled(false);
                    this.showNotification('Áudio desabilitado', 'info');
                } else {
                    audioTrack.setEnabled(true);
                    this.showNotification('Áudio habilitado', 'info');
                }
            }
        },

        toggleVideo() {
            if (this.localStream && this.localStream[1]) {
                const videoTrack = this.localStream[1];
                if (videoTrack.enabled) {
                    videoTrack.setEnabled(false);
                    this.showNotification('Vídeo desabilitado', 'info');
                } else {
                    videoTrack.setEnabled(true);
                    this.showNotification('Vídeo habilitado', 'info');
                }
            }
        },

        // Notification system
        initializeNotifications() {
            // Set up real-time notifications (WebSocket or Pusher)
            if (typeof Echo !== 'undefined') {
                Echo.private(`user.${window.authUserId}`)
                    .notification((notification) => {
                        this.notifications.unshift(notification);
                        this.showNotification(notification.message, notification.type);
                    });
            }
        },

<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
        showNotification(message, type = 'info') {
            const notification = {
                id: Date.now(),
                message,
                type,
                timestamp: new Date()
            };

            this.notifications.unshift(notification);

            // Create toast element
            const toast = document.createElement('div');
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
            toast.className = `fixed top-4 right-4 bg-white border rounded-lg shadow-lg p-4 z-50 notification-${type}`;
=======
            toast.className = `notification-toast notification-${type}`;
>>>>>>> Stashed changes
=======
            toast.className = `notification-toast notification-${type}`;
>>>>>>> Stashed changes
=======
            toast.className = `notification-toast notification-${type}`;
>>>>>>> Stashed changes
            toast.innerHTML = `
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="font-medium">${message}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-3 text-gray-400 hover:text-gray-600">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            `;

            document.body.appendChild(toast);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.remove();
                }
            }, 5000);
        },

<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        // Event listeners
        setupEventListeners() {
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
        // Professional search and booking
        async searchProfessionals(specialty = null, query = null) {
            try {
                const params = new URLSearchParams();
                if (specialty) params.append('specialty', specialty);
                if (query) params.append('q', query);

                const response = await fetch(`/api/professionals/search?${params}`);
                return await response.json();
            } catch (error) {
                this.showNotification('Erro ao buscar profissionais', 'error');
                return [];
            }
        },

        async bookConsultation(professionalId, datetime) {
            try {
                const response = await fetch('/api/consultations', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        professional_id: professionalId,
                        scheduled_at: datetime
                    })
                });

                const data = await response.json();

                if (data.success) {
                    this.showNotification('Consulta agendada com sucesso', 'success');
                    this.loadConsultations();
                    return data.consultation;
                } else {
                    throw new Error(data.message);
                }
            } catch (error) {
                this.showNotification(error.message || 'Erro ao agendar consulta', 'error');
                return null;
            }
        },

        // Medical records
        async loadMedicalRecords() {
            try {
                const response = await fetch('/api/medical-records');
                return await response.json();
            } catch (error) {
                this.showNotification('Erro ao carregar prontuários', 'error');
                return [];
            }
        },

        // Chat functionality
        initializeChat() {
            // Initialize chat functionality for consultations
            if (typeof Echo !== 'undefined' && this.channelName) {
                Echo.private(`consultation.${this.channelName}`)
                    .listen('MessageSent', (e) => {
                        this.displayChatMessage(e.message);
                    });
            }
        },

        sendChatMessage(message) {
            // Send chat message during consultation
            fetch('/api/consultation/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    channel: this.channelName,
                    message: message
                })
            });
        },

        displayChatMessage(message) {
            // Display chat message in the interface
            const chatContainer = document.getElementById('chat-messages');
            if (chatContainer) {
                const messageElement = document.createElement('div');
                messageElement.className = 'chat-message';
                messageElement.innerHTML = `
                    <div class="font-medium">${message.sender_name}</div>
                    <div class="text-sm text-gray-600">${message.content}</div>
                    <div class="text-xs text-gray-400">${new Date(message.created_at).toLocaleTimeString()}</div>
                `;
                chatContainer.appendChild(messageElement);
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        },

        // Event listeners
        setupEventListeners() {
            // Handle beforeunload to clean up video calls
            window.addEventListener('beforeunload', () => {
                if (this.videoCallActive) {
                    this.endCall();
                }
            });

<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
            // Handle online/offline status
            window.addEventListener('online', () => {
                this.showNotification('Conexão reestabelecida', 'success');
            });

            window.addEventListener('offline', () => {
                this.showNotification('Conexão perdida', 'warning');
            });
        },

        // Utility methods
        loadTabContent(tab) {
            switch(tab) {
                case 'consultations':
                    this.loadConsultations();
                    break;
                case 'professionals':
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                    this.loadProfessionals();
=======
                    this.searchProfessionals();
>>>>>>> Stashed changes
=======
                    this.searchProfessionals();
>>>>>>> Stashed changes
=======
                    this.searchProfessionals();
>>>>>>> Stashed changes
                    break;
                case 'records':
                    this.loadMedicalRecords();
                    break;
            }
        },

<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        async loadProfessionals() {
            this.loading = true;
            try {
                await new Promise(resolve => setTimeout(resolve, 500));
                // Mock professionals data
            } catch (error) {
                this.showNotification('Erro ao carregar profissionais', 'error');
            } finally {
                this.loading = false;
            }
        },

        async loadMedicalRecords() {
            this.loading = true;
            try {
                await new Promise(resolve => setTimeout(resolve, 500));
                // Mock medical records data
            } catch (error) {
                this.showNotification('Erro ao carregar prontuários', 'error');
            } finally {
                this.loading = false;
            }
        },

=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
        formatDate(date) {
            return new Date(date).toLocaleDateString('pt-BR', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        },

        formatCurrency(amount) {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(amount);
        }
    }));

    // Initialize Alpine.js
    Alpine.start();
});

// Export functions for global access
window.TelemedicineApp = {
    showNotification: function(message, type) {
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        console.log(`[${type.toUpperCase()}] ${message}`);
=======
        // Global notification function
        Alpine.store('notifications').add(message, type);
>>>>>>> Stashed changes
=======
        // Global notification function
        Alpine.store('notifications').add(message, type);
>>>>>>> Stashed changes
=======
        // Global notification function
        Alpine.store('notifications').add(message, type);
>>>>>>> Stashed changes
    }
};