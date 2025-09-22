/**
 * Telemedicine Dashboard JavaScript
 * Handles interactions and functionality for the telemedicine platform
 */

import Alpine from 'alpinejs';

document.addEventListener('DOMContentLoaded', function() {
    console.log('Telemedicine Dashboard loaded');

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

        init() {
            this.loadConsultations();
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

        // Notification system
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
            toast.className = `fixed top-4 right-4 bg-white border rounded-lg shadow-lg p-4 z-50 notification-${type}`;
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

        // Event listeners
        setupEventListeners() {
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
                    this.loadProfessionals();
                    break;
                case 'records':
                    this.loadMedicalRecords();
                    break;
            }
        },

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
        console.log(`[${type.toUpperCase()}] ${message}`);
    }
};