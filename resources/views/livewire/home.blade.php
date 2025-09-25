<div>
  {{-- Include custom CSS and JS --}}
  @push('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
  @endpush

  @push('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
  @endpush

  {{-- Hero Section --}}
  <section class="hero-section py-20 text-white">
    <x-container>
      <div class="container mx-auto px-4 text-center">
        <h1 class="hero-title mb-6">
          Soluções personalizadas em<br>
          <span class="highlight-yellow">saúde e segurança do trabalho</span><br>
          para seu negócio.
        </h1>
        <p class="hero-subtitle max-w-2xl mx-auto">
          Somos uma empresa de consultoria especializada em engenharia de segurança e medicina do trabalho.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <button class="btn-primary" onclick="document.getElementById('contato').scrollIntoView({ behavior: 'smooth' })">
            Solicitar Orçamento
          </button>
          <button class="btn-outline" onclick="document.getElementById('servicos').scrollIntoView({ behavior: 'smooth' })">
            Nossos Serviços
          </button>
        </div>
      </div>
    </x-container>
  </section>

  {{-- About Company Section --}}
  <section class="py-16 bg-white">
    <x-container>
      <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div>
            <h2 class="text-2xl font-bold text-blue-900 mb-4">CONHEÇA A INNOVATIVA</h2>
            <h3 class="text-xl font-semibold mb-6">
              Somos uma empresa de consultoria especializada em
              <span class="text-yellow-500">engenharia de segurança e medicina do trabalho</span>
            </h3>
            <p class="text-gray-600 mb-6 leading-relaxed">
              Presente no setor há mais de 10 anos, temos o foco voltado para a prevenção de acidentes e
              doenças ocupacionais, oferecendo soluções técnicas adequadas para cada segmento, mantendo
              a segurança jurídica dos empresários e a integridade física dos colaboradores.
            </p>
            <button class="btn-primary">
              Solicitar orçamento →
            </button>
          </div>
          <div class="relative">
            <div class="bg-yellow-400 rounded-lg p-8 text-center">
              <img src="/api/placeholder/400/300" alt="Equipe Innovativa" class="w-full h-64 object-cover rounded-lg mb-4">
            </div>
          </div>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Services Section --}}
  <section class="services-section py-16" id="servicos">
    <x-container>
      <div class="text-center mb-12">
        <h2 class="text-2xl font-bold text-blue-900 mb-4">Conheça</h2>
        <h3 class="text-3xl font-bold text-blue-900 mb-6">nossos serviços</h3>
        <p class="text-gray-600 max-w-2xl mx-auto">
          Oferecemos soluções completas e personalizadas em saúde e segurança do trabalho para seu negócio.
        </p>
      </div>

      <div class="services-grid">
        {{-- Medicina do Trabalho --}}
        <div class="service-card">
          <div class="service-icon">
            <svg class="w-8 h-8 text-blue-900 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
            </svg>
          </div>
          <h3>Medicina do Trabalho</h3>
          <p>Realizamos exames ocupacionais e cuidamos da saúde dos seus colaboradores com foco na prevenção.</p>
          <a href="/servicos/medicina" class="read-more">Saiba mais</a>
        </div>

        {{-- Segurança do Trabalho --}}
        <div class="service-card">
          <div class="service-icon">
            <svg class="w-8 h-8 text-blue-900 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
          </div>
          <h3>Segurança do Trabalho</h3>
          <p>Implementamos medidas preventivas e corretivas para garantir um ambiente de trabalho seguro.</p>
          <a href="/servicos/seguranca" class="read-more">Saiba mais</a>
        </div>

        {{-- Treinamentos e palestras das NRS --}}
        <div class="service-card">
          <div class="service-icon">
            <svg class="w-8 h-8 text-blue-900 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
          </div>
          <h3>Treinamentos e palestras das NRS</h3>
          <p>Capacitamos sua equipe com treinamentos específicos conforme as normas regulamentadoras.</p>
          <a href="/servicos/treinamentos" class="read-more">Saiba mais</a>
        </div>

        {{-- Perícias médicas e de engenharia --}}
        <div class="service-card">
          <div class="service-icon">
            <svg class="w-8 h-8 text-blue-900 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
          </div>
          <h3>Perícias médicas e de engenharia</h3>
          <p>Realizamos avaliações técnicas especializadas para laudos periciais e análises forenses.</p>
          <a href="/servicos/pericias" class="read-more">Saiba mais</a>
        </div>

        {{-- Gestão de terceiros --}}
        <div class="service-card">
          <div class="service-icon">
            <svg class="w-8 h-8 text-blue-900 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
          <h3>Gestão de terceiros</h3>
          <p>Controlamos e monitoramos a documentação de segurança de empresas terceirizadas.</p>
          <a href="/servicos/gestao-terceiros" class="read-more">Saiba mais</a>
        </div>

        {{-- Gestão de território --}}
        <div class="service-card">
          <div class="service-icon">
            <svg class="w-8 h-8 text-blue-900 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
          </div>
          <h3>Gestão de território</h3>
          <p>Oferecemos soluções regionalizadas para empresas com operações distribuídas geograficamente.</p>
          <a href="/servicos/gestao-territorio" class="read-more">Saiba mais</a>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Área do Cliente - Destaque --}}
  <section class="py-16 bg-indigo-900 text-white">
    <x-container>
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
          Área do Cliente
        </h2>
        <p class="text-xl text-indigo-100 mb-8">
          Acompanhe suas solicitações, cobranças e histórico de serviços
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        {{-- Solicitações Online --}}
        <div class="text-center">
          <div class="bg-indigo-800 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Solicitações Online</h3>
          <p class="text-indigo-200">
            Faça solicitações de CAT e PPP diretamente pelo sistema
          </p>
        </div>

        {{-- Acompanhamento --}}
        <div class="text-center">
          <div class="bg-indigo-800 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Acompanhamento</h3>
          <p class="text-indigo-200">
            Visualize o status de todas as suas solicitações em tempo real
          </p>
        </div>

        {{-- Controle Financeiro --}}
        <div class="text-center">
          <div class="bg-indigo-800 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Controle Financeiro</h3>
          <p class="text-indigo-200">
            Acompanhe suas cobranças, vencimentos e histórico de pagamentos
          </p>
        </div>
      </div>

      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('client.login') }}"
           class="inline-flex items-center justify-center px-8 py-3 bg-white text-indigo-900 font-semibold rounded-lg hover:bg-indigo-50 transition-colors"
           wire:navigate>
          🔐 Acessar Área do Cliente
        </a>
        <div class="text-center sm:text-left">
          <p class="text-indigo-200 text-sm mb-1">
            Ainda não tem acesso?
          </p>
          <p class="text-indigo-100 text-sm">
            Suas credenciais são criadas automaticamente ao fazer sua primeira solicitação
          </p>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Sobre Nós (Resumo) --}}
  <section class="py-16">
    <x-container>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
            Mais de 10 anos cuidando da saúde e segurança dos seus colaboradores
          </h2>
          <p class="text-lg text-gray-600 mb-6">
            A Global SST é uma empresa especializada em consultoria e assessoria em Saúde e Segurança do Trabalho,
            oferecendo soluções completas para manter sua empresa em conformidade com as normas regulamentadoras.
          </p>
          <div class="grid grid-cols-2 gap-6 mb-6">
            <div class="text-center">
              <div class="text-3xl font-bold text-blue-600">500+</div>
              <div class="text-gray-600">Empresas Atendidas</div>
            </div>
            <div class="text-center">
              <div class="text-3xl font-bold text-green-600">10+</div>
              <div class="text-gray-600">Anos de Experiência</div>
            </div>
          </div>
          <a href="/sobre" class="inline-flex items-center text-blue-600 font-medium hover:underline">
            Conheça nossa história →
          </a>
        </div>
        <div class="bg-gray-200 rounded-lg h-64 flex items-center justify-center">
          <span class="text-gray-500">Imagem da equipe/escritório</span>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Depoimentos --}}
  <section class="py-16 bg-gray-50">
    <x-container>
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          O que nossos clientes dizem
        </h2>
        <p class="text-lg text-gray-600">
          Resultados comprovados em segurança e produtividade
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-lg p-6 shadow-lg">
          <div class="flex mb-4">
            @for($i = 0; $i < 5; $i++)
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
            @endfor
          </div>
          <p class="text-gray-600 mb-4">"A Global SST transformou nossa gestão de SST. Reduzimos acidentes em 80% e nossa produtividade aumentou significativamente."</p>
          <div class="font-semibold">João Silva</div>
          <div class="text-gray-500 text-sm">Diretor Industrial - MetalTech</div>
        </div>

        <div class="bg-white rounded-lg p-6 shadow-lg">
          <div class="flex mb-4">
            @for($i = 0; $i < 5; $i++)
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
            @endfor
          </div>
          <p class="text-gray-600 mb-4">"Excelente atendimento e conhecimento técnico. Nosso eSocial ficou 100% em conformidade."</p>
          <div class="font-semibold">Maria Santos</div>
          <div class="text-gray-500 text-sm">Gerente RH - LogiCorp</div>
        </div>

        <div class="bg-white rounded-lg p-6 shadow-lg">
          <div class="flex mb-4">
            @for($i = 0; $i < 5; $i++)
              <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
            @endfor
          </div>
          <p class="text-gray-600 mb-4">"Profissionais competentes que entregaram todos os laudos no prazo. Recomendo!"</p>
          <div class="font-semibold">Carlos Oliveira</div>
          <div class="text-gray-500 text-sm">CEO - TechSolutions</div>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Notícias/Novidades --}}
  @if($latestNews->count() > 0)
  <section class="py-16">
    <x-container>
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          Últimas Novidades
        </h2>
        <p class="text-lg text-gray-600">
          Fique por dentro das novidades em SST
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($latestNews as $news)
        <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
          @if($news->image)
          <img src="{{ $news->image->url }}" alt="{{ $news->image->alt ?? $news->title }}"
               class="w-full h-48 object-cover">
          @else
          <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
            <span class="text-gray-400">Artigo</span>
          </div>
          @endif
          <div class="p-6">
            <h3 class="text-xl font-semibold mb-2 hover:text-blue-600">
              <a href="{{ $news->url }}" wire:navigate>{{ $news->title }}</a>
            </h3>
            <p class="text-gray-600 text-sm mb-4">{{ $news->published_at->format('d/m/Y') }}</p>
            <a href="{{ $news->url }}" wire:navigate class="text-blue-600 font-medium hover:underline">
              Ler mais →
            </a>
          </div>
        </article>
        @endforeach
      </div>

      <div class="text-center mt-8">
        <a href="/blog" class="inline-flex items-center text-blue-600 font-medium hover:underline">
          Ver todas as notícias →
        </a>
      </div>
    </x-container>
  </section>
  @endif

  {{-- Call to Action Final --}}
  <section class="py-16 bg-blue-900 text-white" id="contato">
    <x-container>
      <div class="text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
          Pronto para tornar sua empresa mais segura e produtiva?
        </h2>
        <p class="text-xl mb-8 text-blue-100">
          Entre em contato conosco e solicite um orçamento personalizado
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <x-button
            size="lg"
            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-4"
            href="https://wa.me/5511999999999"
            target="_blank"
          >
            WhatsApp
          </x-button>
          <x-button
            size="lg"
            class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-4"
            href="/contato"
          >
            Formulário de Contato
          </x-button>
        </div>
      </div>
    </x-container>
  </section>
</div>