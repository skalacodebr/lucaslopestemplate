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

  {{-- Blue Innovation Section --}}
  <section class="blue-section py-16">
    <x-container>
      <div class="max-w-4xl mx-auto text-center">
        <h2 class="mb-6">
          <span class="highlight">Innovativa</span><br>
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

  {{-- Blog Section --}}
  @if($latestNews && $latestNews->count() > 0)
  <section class="blog-section py-16">
    <x-container>
      <div class="text-center mb-12">
        <h2 class="text-2xl font-bold text-blue-900 mb-4">Blog Innovativa</h2>
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
</div>