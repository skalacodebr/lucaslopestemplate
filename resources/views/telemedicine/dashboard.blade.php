@extends('layouts.app')

@section('title', 'Dashboard - Telemedicina')

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
                        Bem-vindo ao seu painel de telemedicina
                    </p>
                </div>
                <div class="flex items-center space-x-4">
                    <button @click="loadConsultations()" class="bg-gray-100 hover:bg-gray-200 text-gray-900 font-medium py-2 px-4 rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total_consultations'] ?? 0 }}</p>
                        <p class="text-sm text-gray-600 mt-1">Consultas Hoje</p>
                    </div>
                    <div class="text-blue-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-sm font-medium mt-2 text-green-600">
                    +12% desde ontem
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['active_patients'] ?? 0 }}</p>
                        <p class="text-sm text-gray-600 mt-1">Pacientes Ativos</p>
                    </div>
                    <div class="text-green-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-sm font-medium mt-2 text-green-600">
                    +3 novos hoje
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">R$ {{ number_format($stats['total_revenue'] ?? 0, 2, ',', '.') }}</p>
                        <p class="text-sm text-gray-600 mt-1">Receita do Mês</p>
                    </div>
                    <div class="text-purple-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-sm font-medium mt-2 text-green-600">
                    +18% vs mês anterior
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['satisfaction_rate'] ?? 0, 1) }}%</p>
                        <p class="text-sm text-gray-600 mt-1">Satisfação</p>
                    </div>
                    <div class="text-yellow-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-sm font-medium mt-2 text-green-600">
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
                </div>
            </div>
        </div>

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
@endsection