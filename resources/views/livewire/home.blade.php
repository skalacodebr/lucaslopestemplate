<div>
  {{-- Include custom CSS and JS --}}
  @push('styles')
    @vite(['resources/css/home.css'])
  @endpush

  @push('scripts')
    @vite(['resources/js/home.js'])
  @endpush

  {{-- Hero Section --}}
  <section class="hero-section relative overflow-hidden">
    <div class="hero-background"></div>
    <x-container>
      <div class="container mx-auto px-4 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div class="text-white z-10 relative">
            <h1 class="hero-title mb-6">
              Soluções personalizadas em<br>
              <span class="highlight-yellow">saúde e segurança do trabalho</span><br>
              para seu negócio.
            </h1>
            <p class="hero-subtitle mb-8">
              Somos uma empresa de consultoria especializada em engenharia de segurança e medicina do trabalho.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
              <button class="btn-primary" onclick="document.getElementById('contato').scrollIntoView({ behavior: 'smooth' })">
                Solicitar Orçamento
              </button>
              <button class="btn-outline" onclick="document.getElementById('servicos').scrollIntoView({ behavior: 'smooth' })">
                Nossos Serviços
              </button>
            </div>
          </div>
          <div class="hero-image-container relative z-10">
            <div class="hero-worker-image">
              <div class="hero-placeholder bg-gradient-to-br from-yellow-400 to-orange-500 p-8 rounded-lg shadow-2xl">
                <div class="text-center text-blue-900">
                  <svg class="w-24 h-24 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                  </svg>
                  <h3 class="text-2xl font-bold mb-2">Segurança</h3>
                  <p class="text-lg">em primeiro lugar</p>
                </div>
              </div>
            </div>
          </div>
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
            <h2 class="text-2xl font-bold text-blue-900 mb-4">CONHEÇA A GLOBAL SST</h2>
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
              <div class="w-full h-64 bg-blue-900 rounded-lg mb-4 flex items-center justify-center">
                <div class="text-center text-yellow-400">
                  <svg class="w-20 h-20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                  </svg>
                  <h4 class="text-xl font-bold">Nossa Equipe</h4>
                </div>
              </div>
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

      <div class="services-carousel-container relative">
        <div class="services-carousel" id="servicesCarousel">
          <div class="services-track">
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
        </div>

        {{-- Navigation Arrows --}}
        <button class="carousel-btn carousel-prev" onclick="window.homePageUtils.moveCarousel('prev')">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
        </button>
        <button class="carousel-btn carousel-next" onclick="window.homePageUtils.moveCarousel('next')">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </button>

        {{-- Dots Indicators --}}
        <div class="carousel-dots mt-8">
          <button class="dot active" onclick="window.homePageUtils.goToSlide(0)"></button>
          <button class="dot" onclick="window.homePageUtils.goToSlide(1)"></button>
          <button class="dot" onclick="window.homePageUtils.goToSlide(2)"></button>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Blue Innovation Section --}}
  <section class="blue-section py-16">
    <x-container>
      <div class="max-w-4xl mx-auto text-center">
        <h2 class="mb-6">
          <span class="highlight">Global SST</span><br>
          é segurança<br>
          & saúde<br>
          & proteção<br>
          & inovação
        </h2>
        <div class="mt-12">
          <h3 class="text-xl font-semibold mb-6">Tenha um atendimento 360°</h3>
          <div class="grid grid-cols-1 md:grid-cols-5 gap-6 text-sm">
            <div class="text-center">
              <div class="bg-yellow-400 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
              </div>
              <p><strong>Serviços Integrados</strong></p>
              <p class="text-xs mt-1">Soluções completas em um só lugar</p>
            </div>
            <div class="text-center">
              <div class="bg-yellow-400 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <p><strong>Conformidade e Segurança</strong></p>
              <p class="text-xs mt-1">Garantia de compliance total</p>
            </div>
            <div class="text-center">
              <div class="bg-yellow-400 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
              </div>
              <p><strong>Serviços Terceirizados</strong></p>
              <p class="text-xs mt-1">Gestão completa de terceiros</p>
            </div>
            <div class="text-center">
              <div class="bg-yellow-400 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <p><strong>Tempo Otimizado</strong></p>
              <p class="text-xs mt-1">Processos ágeis e eficientes</p>
            </div>
            <div class="text-center">
              <div class="bg-yellow-400 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
              </div>
              <p><strong>Cuidamos Diferentes Setores</strong></p>
              <p class="text-xs mt-1">Experiência multissetorial</p>
            </div>
          </div>
          <div class="mt-8">
            <button class="btn-primary">Fale conosco</button>
          </div>
        </div>
      </div>
    </x-container>
  </section>

  {{-- About Stats Section --}}
  <section class="about-section py-16">
    <x-container>
      <div class="text-center mb-12">
        <h2 class="text-2xl font-bold text-blue-900 mb-6">Tenha um atendimento 360°</h2>
      </div>

      <div class="about-stats max-w-4xl mx-auto">
        <div class="stat-item">
          <span class="stat-number">500+</span>
          <p class="stat-label">Empresas Atendidas</p>
        </div>
        <div class="stat-item">
          <span class="stat-number">10+</span>
          <p class="stat-label">Anos de Experiência</p>
        </div>
        <div class="stat-item">
          <span class="stat-number">1000+</span>
          <p class="stat-label">Projetos Concluídos</p>
        </div>
        <div class="stat-item">
          <span class="stat-number">24h</span>
          <p class="stat-label">Suporte Disponível</p>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Certifications & Partners Section --}}
  <section class="certifications-section py-16 bg-white">
    <x-container>
      <div class="text-center mb-12">
        <h2 class="text-2xl font-bold text-blue-900 mb-4">Certificações e Parcerias</h2>
        <p class="text-gray-600">Reconhecidos por órgãos competentes e parceiros de confiança</p>
      </div>

      <div class="certifications-grid max-w-6xl mx-auto">
        <div class="cert-item">
          <div class="cert-logo">
            <div class="cert-placeholder">
              <span class="cert-text">CREA</span>
            </div>
          </div>
          <p class="cert-name">Conselho Regional de Engenharia</p>
        </div>

        <div class="cert-item">
          <div class="cert-logo">
            <div class="cert-placeholder">
              <span class="cert-text">CFM</span>
            </div>
          </div>
          <p class="cert-name">Conselho Federal de Medicina</p>
        </div>

        <div class="cert-item">
          <div class="cert-logo">
            <div class="cert-placeholder">
              <span class="cert-text">ABNT</span>
            </div>
          </div>
          <p class="cert-name">Associação Brasileira de Normas Técnicas</p>
        </div>

        <div class="cert-item">
          <div class="cert-logo">
            <div class="cert-placeholder">
              <span class="cert-text">ISO</span>
            </div>
          </div>
          <p class="cert-name">Certificação ISO 9001</p>
        </div>

        <div class="cert-item">
          <div class="cert-logo">
            <div class="cert-placeholder">
              <span class="cert-text">MTE</span>
            </div>
          </div>
          <p class="cert-name">Ministério do Trabalho</p>
        </div>

        <div class="cert-item">
          <div class="cert-logo">
            <div class="cert-placeholder">
              <span class="cert-text">SOBES</span>
            </div>
          </div>
          <p class="cert-name">Sociedade Brasileira de Engenharia de Segurança</p>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Blog Section --}}
  @if($latestNews && $latestNews->count() > 0)
  <section class="blog-section py-16">
    <x-container>
      <div class="text-center mb-12">
        <h2 class="text-2xl font-bold text-blue-900 mb-4">Blog Global SST</h2>
        <p class="text-gray-600">Conheça nossas novidades</p>
      </div>

      <div class="blog-grid">
        @foreach($latestNews as $news)
        <article class="blog-card">
          @if($news->image)
          <div class="blog-image">
            <img src="{{ $news->image->url }}" alt="{{ $news->image->alt ?? $news->title }}" class="w-full h-full object-cover relative z-10">
          </div>
          @else
          <div class="blog-image">
            <span class="text-blue-900 font-bold relative z-10">ARTIGO</span>
          </div>
          @endif
          <div class="blog-content">
            <div class="date">{{ $news->published_at->format('d/m/Y') }}</div>
            <h3><a href="{{ $news->url }}" wire:navigate>{{ $news->title }}</a></h3>
            <a href="{{ $news->url }}" wire:navigate class="read-more">Leia mais</a>
          </div>
        </article>
        @endforeach
      </div>

      <div class="text-center mt-8">
        <button class="btn-primary">Ver mais artigos</button>
      </div>
    </x-container>
  </section>
  @endif

  {{-- FAQ Section --}}
  <section class="faq-section py-16">
    <x-container>
      <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
          <h2 class="text-2xl font-bold mb-4">FAQ</h2>
          <h3 class="text-xl font-semibold mb-6">Dúvidas frequentes</h3>
          <p class="text-white/80">
            Tire dúvidas sobre nossos serviços e como podemos ajudar sua empresa
          </p>
        </div>

        <div class="space-y-4">
          <div class="faq-item">
            <div class="faq-question">
              <span>O que é PCMSO e é obrigatório?</span>
              <div class="faq-icon text-yellow-400 font-bold text-xl">+</div>
            </div>
            <div class="faq-answer">
              O PCMSO (Programa de Controle Médico de Saúde Ocupacional) é obrigatório para todas as empresas que admitam trabalhadores como empregados. É um programa que visa preservar a saúde dos trabalhadores através de exames médicos ocupacionais.
            </div>
          </div>

          <div class="faq-item">
            <div class="faq-question">
              <span>O que é PGR?</span>
              <div class="faq-icon text-yellow-400 font-bold text-xl">+</div>
            </div>
            <div class="faq-answer">
              O PGR (Programa de Gerenciamento de Riscos) é um programa que identifica, avalia e controla os riscos presentes no ambiente de trabalho, substituindo o antigo PPRA e sendo obrigatório para empresas de qualquer porte.
            </div>
          </div>

          <div class="faq-item">
            <div class="faq-question">
              <span>Por que a empresa precisa da Licença Ambiental?</span>
              <div class="faq-icon text-yellow-400 font-bold text-xl">+</div>
            </div>
            <div class="faq-answer">
              A Licença Ambiental é obrigatória para empresas que desenvolvem atividades potencialmente poluidoras ou degradadoras do meio ambiente, garantindo o cumprimento das normas ambientais e evitando multas e sanções.
            </div>
          </div>

          <div class="faq-item">
            <div class="faq-question">
              <span>Quando devo realizar o Exame de Audometria?</span>
              <div class="faq-icon text-yellow-400 font-bold text-xl">+</div>
            </div>
            <div class="faq-answer">
              O exame de audiometria deve ser realizado na admissão, periodicamente (conforme o risco) e na demissão de trabalhadores expostos a ruído, conforme estabelecido no PCMSO e nas normas regulamentadoras.
            </div>
          </div>

          <div class="faq-item">
            <div class="faq-question">
              <span>Quando devo solicitar a Exame Demissional?</span>
              <div class="faq-icon text-yellow-400 font-bold text-xl">+</div>
            </div>
            <div class="faq-answer">
              O exame demissional deve ser solicitado até 15 dias antes do desligamento do funcionário, ou até 15 dias após se o último exame médico ocupacional foi realizado há mais de 90 dias.
            </div>
          </div>

          <div class="faq-item">
            <div class="faq-question">
              <span>Quando devo solicitar a Exame Periódico?</span>
              <div class="faq-icon text-yellow-400 font-bold text-xl">+</div>
            </div>
            <div class="faq-answer">
              Os exames periódicos devem ser realizados conforme a periodicidade estabelecida no PCMSO, variando de acordo com os riscos da função e idade do trabalhador, podendo ser anuais, semestrais ou em outras frequências específicas.
            </div>
          </div>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Contact Section --}}
  <section class="cta-section py-16" id="contato">
    <x-container>
      <div class="text-center max-w-4xl mx-auto">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
          Pronto para tornar sua empresa mais segura e produtiva?
        </h2>
        <p class="text-xl mb-8 opacity-90">
          Entre em contato conosco e solicite um orçamento personalizado
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <button class="btn-primary" onclick="window.homePageUtils.openWhatsApp()">
            💬 WhatsApp
          </button>
          <button class="btn-outline" onclick="document.getElementById('contact-form').scrollIntoView({ behavior: 'smooth' })">
            📧 Formulário de Contato
          </button>
        </div>

        <!-- Contact Form -->
        <div id="contact-form" class="mt-12 bg-white rounded-lg p-8 text-left max-w-2xl mx-auto">
          <h3 class="text-2xl font-bold text-blue-900 mb-6 text-center">Solicitar Orçamento</h3>
          <form onsubmit="event.preventDefault(); window.homePageUtils.handleContactForm(this);" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome *</label>
                <input type="text" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Empresa *</label>
                <input type="text" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">E-mail *</label>
                <input type="email" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Telefone *</label>
                <input type="tel" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
              </div>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Serviço de Interesse</label>
              <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option>Selecione um serviço</option>
                <option>Medicina do Trabalho</option>
                <option>Segurança do Trabalho</option>
                <option>Treinamentos e Palestras</option>
                <option>Perícias Médicas e de Engenharia</option>
                <option>Gestão de Terceiros</option>
                <option>Gestão de Território</option>
                <option>Consultoria Completa</option>
              </select>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1">Mensagem</label>
              <textarea rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Descreva suas necessidades..."></textarea>
            </div>
            <div class="text-center">
              <button type="submit" class="btn-primary">Enviar Solicitação</button>
            </div>
          </form>
        </div>
      </div>
    </x-container>
  </section>

  {{-- WhatsApp Floating Button --}}
  <div class="whatsapp-float" onclick="window.homePageUtils.openWhatsApp()">
    <div class="whatsapp-icon">
      <svg viewBox="0 0 24 24" fill="currentColor">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.687"/>
      </svg>
    </div>
    <span class="whatsapp-text">Fale conosco</span>
  </div>
</div>