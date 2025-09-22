@vite('resources/css/live-queue.css')

<div class="live-queue-container">
    @if(!$inQueue)
        <!-- Formulário para entrar na fila -->
        <div class="queue-entry-form">
            <div class="header-section">
                <h2 class="section-title">Consulta com Clínico Geral</h2>
                <p class="section-description">
                    Entre na fila para uma consulta imediata com um clínico geral.
                    Assim que um médico estiver disponível, você será conectado automaticamente.
                </p>
            </div>

            <div class="queue-stats">
                <div class="stat-item">
                    <span class="stat-number">{{ $availableProfessionals }}</span>
                    <span class="stat-label">Médicos Disponíveis</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">{{ $queueSize }}</span>
                    <span class="stat-label">Pessoas na Fila</span>
                </div>
            </div>

            <form wire:submit="joinQueue" class="queue-form">
                <div class="form-group">
                    <label for="symptoms" class="form-label">Sintomas Principais</label>
                    <div class="symptoms-input">
                        <input
                            type="text"
                            id="symptom-input"
                            placeholder="Digite um sintoma e pressione Enter"
                            @keydown.enter.prevent="
                                if ($event.target.value.trim()) {
                                    $wire.addSymptom($event.target.value.trim());
                                    $event.target.value = '';
                                }
                            "
                            class="input-field"
                        >
                    </div>

                    @if(count($symptoms) > 0)
                        <div class="symptoms-list">
                            @foreach($symptoms as $index => $symptom)
                                <span class="symptom-tag">
                                    {{ $symptom }}
                                    <button
                                        type="button"
                                        wire:click="removeSymptom({{ $index }})"
                                        class="remove-symptom"
                                    >×</button>
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="notes" class="form-label">Observações Adicionais (Opcional)</label>
                    <textarea
                        wire:model="notes"
                        id="notes"
                        rows="3"
                        placeholder="Descreva brevemente como se sente ou outras informações relevantes..."
                        class="input-field"
                    ></textarea>
                </div>

                <button type="submit" class="join-queue-btn">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Entrar na Fila
                </button>

                <!-- DEBUG: Teste direto -->
                <button type="button" wire:click="joinQueue" style="background: red; color: white; padding: 10px; margin: 10px;">
                    TESTE DIRETO - Entrar na Fila
                </button>
            </form>
        </div>
    @else
        <!-- Status da fila -->
        <div class="queue-status">
            <div class="status-header">
                <div class="status-icon">
                    <svg class="animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="status-title">Você está na Fila</h2>
                <p class="status-subtitle">Aguardando um médico disponível...</p>
            </div>

            <div class="queue-info">
                <div class="info-card">
                    <div class="info-label">Sua Posição</div>
                    <div class="info-value position">{{ $position }}º</div>
                </div>

                <div class="info-card">
                    <div class="info-label">Tempo Estimado</div>
                    <div class="info-value time">{{ $estimatedWait }}</div>
                </div>

                <div class="info-card">
                    <div class="info-label">Status</div>
                    <div class="info-value status">{{ $queueEntry?->status_label }}</div>
                </div>
            </div>

            @if($queueEntry?->symptoms && count($queueEntry->symptoms) > 0)
                <div class="reported-symptoms">
                    <h4 class="symptoms-title">Sintomas Relatados:</h4>
                    <div class="symptoms-display">
                        @foreach($queueEntry->symptoms as $symptom)
                            <span class="symptom-badge">{{ $symptom }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($queueEntry?->notes)
                <div class="reported-notes">
                    <h4 class="notes-title">Observações:</h4>
                    <p class="notes-content">{{ $queueEntry->notes }}</p>
                </div>
            @endif

            <div class="queue-actions">
                <button
                    wire:click="leaveQueue"
                    wire:confirm="Tem certeza que deseja sair da fila?"
                    class="leave-queue-btn"
                >
                    Sair da Fila
                </button>
            </div>
        </div>
    @endif
</div>

<script>
    // Auto-refresh queue status every 30 seconds
    setInterval(() => {
        if (@json($inQueue)) {
            Livewire.dispatch('queue-updated');
        }
    }, 30000);

    // Listen for queue events
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('queue-joined', (event) => {
            // Show success notification
            console.log('Entrou na fila na posição:', event.position);
        });

        Livewire.on('queue-left', () => {
            // Show notification
            console.log('Saiu da fila');
        });
    });
</script>
</div>
