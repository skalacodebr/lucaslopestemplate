@extends('layouts.app')

@section('title', 'Dashboard - Telemedicina')

<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
@section('content')
<div class="min-h-screen bg-gray-50" x-data="telemedicineBoard()">
    <!-- Dashboard Header -->
    <div class="bg-white shadow-sm border-b border-gray-200 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">
                        Olá, {{ auth()->user()->full_name ?? auth()->user()->name }}
                    </h1>
                    <p class="text-gray-600">
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
@push('styles')
    @vite('resources/css/pages/telemedicine.css')
    @vite('resources/css/components/consultation-card.css')
@endpush

@push('scripts')
    @vite('resources/js/pages/telemedicine.js')
    <script src="https://download.agora.io/sdk/release/AgoraRTC_N-4.18.0.js"></script>
@endpush

@section('content')
<div class="telemedicine-dashboard" x-data="telemedicineBoard">
    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="dashboard-title">
                        Olá, {{ auth()->user()->full_name ?? auth()->user()->name }}
                    </h1>
                    <p class="dashboard-subtitle">
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
                        Bem-vindo ao seu painel de telemedicina
                    </p>
                </div>
                <div class="flex items-center space-x-4">
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                    <button @click="loadConsultations()" class="bg-gray-100 hover:bg-gray-200 text-gray-900 font-medium py-2 px-4 rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
=======
                    <button @click="loadConsultations()" class="btn-secondary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
>>>>>>> Stashed changes
=======
                    <button @click="loadConsultations()" class="btn-secondary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
>>>>>>> Stashed changes
=======
                    <button @click="loadConsultations()" class="btn-secondary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
>>>>>>> Stashed changes
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Atualizar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Stats Grid -->
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_consultations'] ?? 0 }}</p>
                        <p class="text-sm text-gray-600 mt-1">Consultas Hoje</p>
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
        <div class="stats-grid">
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="stat-value">{{ $stats['total_consultations'] ?? 0 }}</p>
                        <p class="stat-label">Consultas Hoje</p>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
                    </div>
                    <div class="text-blue-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                <div class="text-sm font-medium mt-2 text-green-600">
=======
                <div class="stat-change positive">
>>>>>>> Stashed changes
=======
                <div class="stat-change positive">
>>>>>>> Stashed changes
=======
                <div class="stat-change positive">
>>>>>>> Stashed changes
                    +12% desde ontem
                </div>
            </div>

<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['active_patients'] ?? 0 }}</p>
                        <p class="text-sm text-gray-600 mt-1">Pacientes Ativos</p>
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="stat-value">{{ $stats['active_patients'] ?? 0 }}</p>
                        <p class="stat-label">Pacientes Ativos</p>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
                    </div>
                    <div class="text-green-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                <div class="text-sm font-medium mt-2 text-green-600">
=======
                <div class="stat-change positive">
>>>>>>> Stashed changes
=======
                <div class="stat-change positive">
>>>>>>> Stashed changes
=======
                <div class="stat-change positive">
>>>>>>> Stashed changes
                    +3 novos hoje
                </div>
            </div>

<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">R$ {{ number_format($stats['total_revenue'] ?? 0, 2, ',', '.') }}</p>
                        <p class="text-sm text-gray-600 mt-1">Receita do Mês</p>
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="stat-value">R$ {{ number_format($stats['total_revenue'] ?? 0, 2, ',', '.') }}</p>
                        <p class="stat-label">Receita do Mês</p>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
                    </div>
                    <div class="text-purple-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                <div class="text-sm font-medium mt-2 text-green-600">
=======
                <div class="stat-change positive">
>>>>>>> Stashed changes
=======
                <div class="stat-change positive">
>>>>>>> Stashed changes
=======
                <div class="stat-change positive">
>>>>>>> Stashed changes
                    +18% vs mês anterior
                </div>
            </div>

<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['satisfaction_rate'] ?? 0, 1) }}%</p>
                        <p class="text-sm text-gray-600 mt-1">Satisfação</p>
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
            <div class="stat-card">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="stat-value">{{ number_format($stats['satisfaction_rate'] ?? 0, 1) }}%</p>
                        <p class="stat-label">Satisfação</p>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
                    </div>
                    <div class="text-yellow-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                </div>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
                <div class="text-sm font-medium mt-2 text-green-600">
=======
                <div class="stat-change positive">
>>>>>>> Stashed changes
=======
                <div class="stat-change positive">
>>>>>>> Stashed changes
=======
                <div class="stat-change positive">
>>>>>>> Stashed changes
                    +0.5% este mês
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="mb-8">
            <nav class="flex space-x-8" aria-label="Tabs">
                <button @click="switchTab('consultations')"
                        :class="{ 'border-blue-500 text-blue-600': activeTab === 'consultations', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'consultations' }"
                        class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                    Consultas
                </button>
                <button @click="switchTab('professionals')"
                        :class="{ 'border-blue-500 text-blue-600': activeTab === 'professionals', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'professionals' }"
                        class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                    Profissionais
                </button>
                <button @click="switchTab('records')"
                        :class="{ 'border-blue-500 text-blue-600': activeTab === 'records', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'records' }"
                        class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm transition-colors">
                    Prontuários
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div x-show="activeTab === 'consultations'">
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
            <div class="bg-white rounded-lg shadow mb-8">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Próximas Consultas</h3>
                </div>
                <div class="p-6">
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhuma consulta agendada</h3>
                        <p class="mt-1 text-sm text-gray-500">Comece agendando sua primeira consulta.</p>
                        <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
                            <a href="{{ route('consultation.live-queue') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Consulta Imediata
                            </a>
                            <a href="{{ route('consultation.schedule') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Agendar Especialista
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="activeTab === 'professionals'">
            <div class="bg-white rounded-lg shadow mb-8">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Profissionais Disponíveis</h3>
                </div>
                <div class="p-6">
                    @if($professionals && $professionals->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($professionals as $professional)
                                <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                                    <div class="flex items-center space-x-4">
                                        <div class="h-16 w-16 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xl">
                                            {{ substr($professional->user->profile->first_name ?? $professional->user->name, 0, 1) }}{{ substr($professional->user->profile->last_name ?? '', 0, 1) }}
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-lg font-semibold text-gray-900">
                                                {{ $professional->user->profile->full_name ?? $professional->user->name }}
                                            </h4>
                                            <p class="text-sm text-gray-600">{{ $professional->specialty }}</p>
                                            <div class="flex items-center mt-2">
                                                <div class="flex text-yellow-400 text-sm mr-1">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= floor($professional->rating))
                                                            ★
                                                        @elseif($i == ceil($professional->rating) && $professional->rating - floor($professional->rating) >= 0.5)
                                                            ★
                                                        @else
                                                            ☆
                                                        @endif
                                                    @endfor
                                                </div>
                                                <span class="text-sm text-gray-600">{{ number_format($professional->rating, 1) }} ({{ $professional->total_reviews }} avaliações)</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <p class="text-sm text-gray-700 line-clamp-2">{{ $professional->bio }}</p>
                                    </div>

                                    <div class="mt-4 flex items-center justify-between">
                                        <div>
                                            <span class="text-lg font-bold text-green-600">{{ $professional->formatted_fee }}</span>
                                            <span class="text-sm text-gray-600">/consulta</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            @if($professional->is_verified)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    ✓ Verificado
                                                </span>
                                            @endif
                                            @if($professional->is_available)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Disponível
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        @if($professional->specialty === 'Clínico Geral')
                                            <a href="{{ route('consultation.live-queue') }}" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors inline-block text-center">
                                                Entrar na Fila
                                            </a>
                                        @else
                                            <a href="{{ route('consultation.schedule') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors inline-block text-center">
                                                Agendar Consulta
                                            </a>
                                        @endif
                                    </div>

                                    <div class="mt-3 text-xs text-gray-500">
                                        <strong>Especialidades:</strong>
                                        @if($professional->subspecialties && count($professional->subspecialties) > 0)
                                            {{ implode(', ', $professional->subspecialties) }}
                                        @else
                                            {{ $professional->specialty }}
                                        @endif
                                    </div>

                                    <div class="mt-2 text-xs text-gray-500">
                                        <strong>Experiência:</strong> {{ $professional->years_experience }} anos
                                    </div>

                                    @if($professional->languages && count($professional->languages) > 0)
                                        <div class="mt-2 text-xs text-gray-500">
                                            <strong>Idiomas:</strong> {{ implode(', ', $professional->languages) }}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum profissional disponível</h3>
                            <p class="mt-1 text-sm text-gray-500">Não há profissionais verificados disponíveis no momento.</p>
                        </div>
                    @endif
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
            <div class="consultation-section">
                <div class="section-header">
                    <h3 class="section-title">Próximas Consultas</h3>
                </div>
                <div class="consultation-list">
                    <template x-for="consultation in upcomingConsultations" :key="consultation.id">
                        <div class="consultation-card">
                            <div class="consultation-card-body">
                                <div class="consultation-patient-info">
                                    <div class="consultation-patient-avatar" x-text="consultation.patient.name.charAt(0)"></div>
                                    <div class="consultation-patient-details">
                                        <h4 class="consultation-patient-name" x-text="consultation.patient.name"></h4>
                                        <p class="consultation-patient-age" x-text="`${consultation.patient.age} anos`"></p>
                                        <div class="consultation-datetime">
                                            <svg class="consultation-datetime-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span x-text="formatDate(consultation.scheduled_at)"></span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end space-y-2">
                                        <span class="consultation-status-badge"
                                              :class="consultation.status"
                                              x-text="consultation.status_label"></span>
                                        <span class="consultation-fee" x-text="formatCurrency(consultation.fee)"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="consultation-card-footer">
                                <div class="consultation-actions">
                                    <div class="consultation-actions-left">
                                        <span class="consultation-specialty" x-text="consultation.specialty"></span>
                                    </div>
                                    <div class="consultation-actions-right">
                                        <button @click="startConsultation(consultation.id)"
                                                class="consultation-action-btn primary"
                                                :disabled="consultation.status !== 'confirmed'">
                                            Iniciar Consulta
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
                </div>
            </div>
        </div>

<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
        <div x-show="activeTab === 'records'">
            <div class="bg-white rounded-lg shadow mb-8">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Seus Prontuários</h3>
                </div>
                <div class="p-6">
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum prontuário encontrado</h3>
                        <p class="mt-1 text-sm text-gray-500">Seus prontuários médicos aparecerão aqui.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Overlay -->
        <div x-show="loading"
=======
        <!-- Video Call Modal -->
        <div x-show="videoCallActive"
>>>>>>> Stashed changes
=======
        <!-- Video Call Modal -->
        <div x-show="videoCallActive"
>>>>>>> Stashed changes
=======
        <!-- Video Call Modal -->
        <div x-show="videoCallActive"
>>>>>>> Stashed changes
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
<<<<<<< Updated upstream
<<<<<<< Updated upstream
<<<<<<< Updated upstream
             class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-1/2 mx-auto p-5 w-96 transform -translate-y-1/2">
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
                    <p class="mt-4 text-gray-600">Carregando...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function telemedicineBoard() {
    return {
        activeTab: 'consultations',
        consultations: [],
        upcomingConsultations: [],
        notifications: [],
        loading: false,

        init() {
            this.loadConsultations();
        },

        switchTab(tab) {
            this.activeTab = tab;
        },

        async loadConsultations() {
            this.loading = true;
            try {
                // Simular carregamento
                await new Promise(resolve => setTimeout(resolve, 1000));
                this.consultations = [];
                this.upcomingConsultations = [];
            } catch (error) {
                console.error('Erro ao carregar consultas:', error);
            } finally {
                this.loading = false;
            }
        }
    }
}

window.authUserId = {{ auth()->id() }};
</script>

<meta name="csrf-token" content="{{ csrf_token() }}">
=======
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
             class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="video-call-container">
                            <div id="remote-video" class="w-full h-full bg-gray-900 rounded-lg"></div>
                            <div id="local-video" class="absolute top-4 right-4 w-32 h-24 bg-gray-800 rounded-lg"></div>

                            <div class="video-controls">
                                <button @click="toggleAudio()" class="video-control-btn">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                                    </svg>
                                </button>
                                <button @click="toggleVideo()" class="video-control-btn">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </button>
                                <button @click="endCall()" class="video-control-btn danger">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 3l1.5 1.5M3 3l1.5 1.5M3 3v18l7.5-7.5L18 21v-18L10.5 10.5"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <button class="quick-action-btn" title="Nova Consulta">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div x-show="loading"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-1/2 mx-auto p-5 w-96 transform -translate-y-1/2">
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
                <p class="mt-4 text-gray-600">Carregando...</p>
            </div>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    window.authUserId = {{ auth()->id() }};
</script>
<<<<<<< Updated upstream
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
@endsection