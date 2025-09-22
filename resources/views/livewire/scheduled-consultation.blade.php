@vite('resources/css/scheduled-consultation.css')

<div class="scheduled-consultation-container">
    <!-- Progress Steps -->
    <div class="progress-steps">
        <div class="step {{ $step === 'select_professional' ? 'active' : ($step !== 'select_professional' ? 'completed' : '') }}">
            <div class="step-number">1</div>
            <div class="step-label">Escolher Especialista</div>
        </div>
        <div class="step {{ $step === 'select_datetime' ? 'active' : ($step === 'confirmation' ? 'completed' : '') }}">
            <div class="step-number">2</div>
            <div class="step-label">Data e Horário</div>
        </div>
        <div class="step {{ $step === 'confirmation' ? 'active' : '' }}">
            <div class="step-number">3</div>
            <div class="step-label">Confirmação</div>
        </div>
    </div>

    @if($step === 'select_professional')
        <!-- Step 1: Select Professional -->
        <div class="step-content">
            <div class="step-header">
                <h2 class="step-title">Escolha um Especialista</h2>
                <p class="step-description">Selecione o profissional de saúde que você gostaria de consultar</p>
            </div>

            <div class="professionals-grid">
                @forelse($specialistProfessionals as $professional)
                    <div class="professional-card" wire:click="selectProfessional({{ $professional->id }})">
                        <div class="professional-avatar">
                            <img src="{{ $professional->professionalProfile->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($professional->name) }}"
                                 alt="{{ $professional->name }}" class="avatar-image">
                        </div>

                        <div class="professional-info">
                            <h3 class="professional-name">{{ $professional->name }}</h3>
                            <p class="professional-specialty">{{ $professional->professionalProfile->specialty }}</p>
                            <p class="professional-crm">CRM: {{ $professional->professionalProfile->crm }}</p>

                            <div class="professional-rating">
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="star {{ $i <= ($professional->professionalProfile->rating ?? 5) ? 'filled' : '' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="rating-value">({{ number_format($professional->professionalProfile->rating ?? 5, 1) }})</span>
                            </div>

                            <div class="consultation-fee">
                                <span class="fee-label">Consulta:</span>
                                <span class="fee-value">R$ {{ number_format($professional->professionalProfile->consultation_fee ?? 150, 2, ',', '.') }}</span>
                            </div>

                            @if($professional->professionalProfile->next_available_slot)
                                <div class="next-available">
                                    <span class="available-label">Próximo horário:</span>
                                    <span class="available-time">{{ $professional->professionalProfile->next_available_slot }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <h3>Nenhum especialista disponível</h3>
                        <p>Não há especialistas disponíveis no momento. Tente novamente mais tarde.</p>
                    </div>
                @endforelse
            </div>
        </div>

    @elseif($step === 'select_datetime')
        <!-- Step 2: Select Date and Time -->
        <div class="step-content">
            <div class="step-header">
                <button wire:click="goBack" class="back-button">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="back-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Voltar
                </button>

                <h2 class="step-title">Escolha Data e Horário</h2>
                <p class="step-description">
                    Consulta com <strong>{{ $selectedProfessional->name }}</strong> - {{ $selectedProfessional->professionalProfile->specialty }}
                </p>
            </div>

            <div class="datetime-selector">
                <!-- Date Selection -->
                <div class="date-section">
                    <h3 class="section-title">Selecione a Data</h3>
                    <input type="date"
                           wire:model.live="selectedDate"
                           min="{{ now()->addDay()->format('Y-m-d') }}"
                           max="{{ now()->addMonths(2)->format('Y-m-d') }}"
                           class="date-input">
                </div>

                <!-- Time Selection -->
                @if(count($availableSlots) > 0)
                    <div class="time-section">
                        <h3 class="section-title">Horários Disponíveis</h3>
                        <div class="time-slots">
                            @foreach($availableSlots as $slot)
                                <button
                                    wire:click="selectDateTime('{{ $selectedDate }}', '{{ $slot }}')"
                                    class="time-slot {{ $selectedTime === $slot ? 'selected' : '' }}"
                                >
                                    {{ $slot }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="no-slots">
                        <h3>Nenhum horário disponível</h3>
                        <p>Não há horários disponíveis para a data selecionada. Escolha outra data.</p>
                    </div>
                @endif
            </div>
        </div>

    @elseif($step === 'confirmation')
        <!-- Step 3: Confirmation -->
        <div class="step-content">
            <div class="step-header">
                <button wire:click="goBack" class="back-button">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="back-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Voltar
                </button>

                <h2 class="step-title">Confirmar Consulta</h2>
                <p class="step-description">Revise os detalhes da sua consulta antes de confirmar</p>
            </div>

            <div class="confirmation-content">
                <!-- Consultation Summary -->
                <div class="consultation-summary">
                    <h3 class="summary-title">Detalhes da Consulta</h3>

                    <div class="summary-item">
                        <span class="item-label">Profissional:</span>
                        <span class="item-value">{{ $selectedProfessional->name }}</span>
                    </div>

                    <div class="summary-item">
                        <span class="item-label">Especialidade:</span>
                        <span class="item-value">{{ $selectedProfessional->professionalProfile->specialty }}</span>
                    </div>

                    <div class="summary-item">
                        <span class="item-label">Data e Horário:</span>
                        <span class="item-value">{{ $this->formattedSelectedDateTime }}</span>
                    </div>

                    <div class="summary-item">
                        <span class="item-label">Valor:</span>
                        <span class="item-value fee">R$ {{ number_format($selectedProfessional->professionalProfile->consultation_fee ?? 150, 2, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Additional Information Form -->
                <div class="additional-info">
                    <h3 class="info-title">Informações Adicionais</h3>

                    <div class="form-group">
                        <label class="form-label">Sintomas Principais</label>
                        <div class="symptoms-input">
                            <input
                                type="text"
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
                        <label for="notes" class="form-label">Observações (Opcional)</label>
                        <textarea
                            wire:model="notes"
                            id="notes"
                            rows="3"
                            placeholder="Descreva como se sente ou outras informações que considere relevantes..."
                            class="input-field"
                        ></textarea>
                    </div>
                </div>

                <!-- Confirmation Actions -->
                <div class="confirmation-actions">
                    <button wire:click="scheduleConsultation" class="confirm-button">
                        Confirmar Consulta
                    </button>

                    <p class="payment-note">
                        * O pagamento será processado após a confirmação
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>
