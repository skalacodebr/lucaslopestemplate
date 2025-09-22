<div>
  <!-- Hero Section -->
  <x-section background="gradient" padding="normal">
    <div class="text-center">
      <h1 class="text-5xl lg:text-7xl font-bold mb-6">
        Cases de <span class="text-secondary-300">Sucesso</span>
      </h1>
      <p class="text-xl lg:text-2xl text-primary-100 max-w-4xl mx-auto leading-relaxed">
        Projetos reais que transformaram negócios e geraram resultados excepcionais.
        Conheça como ajudamos empresas a alcançar seus objetivos através da tecnologia.
      </p>
    </div>
  </x-section>

  <!-- Filtros -->
  <x-section background="white" padding="tight">
    <div class="flex flex-wrap justify-center gap-4">
      <button class="px-6 py-2 bg-primary-600 text-white rounded-full font-medium">
        Todos
      </button>
      <button class="px-6 py-2 bg-neutral-100 text-neutral-700 rounded-full font-medium hover:bg-primary-100">
        E-commerce
      </button>
      <button class="px-6 py-2 bg-neutral-100 text-neutral-700 rounded-full font-medium hover:bg-primary-100">
        Saúde
      </button>
      <button class="px-6 py-2 bg-neutral-100 text-neutral-700 rounded-full font-medium hover:bg-primary-100">
        Fintech
      </button>
      <button class="px-6 py-2 bg-neutral-100 text-neutral-700 rounded-full font-medium hover:bg-primary-100">
        Outsourcing
      </button>
    </div>
  </x-section>

  <!-- Cases -->
  @foreach($cases as $index => $case)
    <x-section background="{{ $index % 2 === 0 ? 'white' : 'gray' }}" padding="normal">
      <div class="grid lg:grid-cols-2 gap-16 items-center">
        @if($index % 2 === 0)
          <!-- Conteúdo à esquerda, imagem à direita -->
          <div>
            <div class="mb-6">
              <x-badge variant="primary" size="sm">{{ $case['sector'] }}</x-badge>
            </div>

            <h2 class="text-3xl lg:text-4xl font-bold text-neutral-900 mb-4">
              {{ $case['title'] }}
            </h2>

            <div class="mb-8">
              <h3 class="text-lg font-semibold text-neutral-800 mb-2">Cliente</h3>
              <p class="text-primary-600 font-medium">{{ $case['client'] }}</p>
            </div>

            <div class="mb-8">
              <h3 class="text-lg font-semibold text-neutral-800 mb-2">Desafio</h3>
              <p class="text-neutral-700">{{ $case['challenge'] }}</p>
            </div>

            <div class="mb-8">
              <h3 class="text-lg font-semibold text-neutral-800 mb-2">Solução</h3>
              <p class="text-neutral-700">{{ $case['solution'] }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-8">
              <div>
                <h4 class="font-semibold text-neutral-800 mb-2">Timeline</h4>
                <p class="text-neutral-600">{{ $case['timeline'] }}</p>
              </div>
              <div>
                <h4 class="font-semibold text-neutral-800 mb-2">Tecnologias</h4>
                <div class="flex flex-wrap gap-2">
                  @foreach($case['technologies'] as $tech)
                    <x-badge variant="info" size="sm">{{ $tech }}</x-badge>
                  @endforeach
                </div>
              </div>
            </div>
          </div>

          <div class="order-first lg:order-last">
            <div class="bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl p-8 h-80 flex items-center justify-center">
              <div class="text-center text-primary-600">
                <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                </svg>
                <p class="font-medium">Dashboard Interativo</p>
              </div>
            </div>
          </div>
        @else
          <!-- Imagem à esquerda, conteúdo à direita -->
          <div>
            <div class="bg-gradient-to-br from-secondary-100 to-secondary-200 rounded-2xl p-8 h-80 flex items-center justify-center">
              <div class="text-center text-secondary-600">
                <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                </svg>
                <p class="font-medium">Sistema Integrado</p>
              </div>
            </div>
          </div>

          <div>
            <div class="mb-6">
              <x-badge variant="secondary" size="sm">{{ $case['sector'] }}</x-badge>
            </div>

            <h2 class="text-3xl lg:text-4xl font-bold text-neutral-900 mb-4">
              {{ $case['title'] }}
            </h2>

            <div class="mb-8">
              <h3 class="text-lg font-semibold text-neutral-800 mb-2">Cliente</h3>
              <p class="text-secondary-600 font-medium">{{ $case['client'] }}</p>
            </div>

            <div class="mb-8">
              <h3 class="text-lg font-semibold text-neutral-800 mb-2">Desafio</h3>
              <p class="text-neutral-700">{{ $case['challenge'] }}</p>
            </div>

            <div class="mb-8">
              <h3 class="text-lg font-semibold text-neutral-800 mb-2">Solução</h3>
              <p class="text-neutral-700">{{ $case['solution'] }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-8">
              <div>
                <h4 class="font-semibold text-neutral-800 mb-2">Timeline</h4>
                <p class="text-neutral-600">{{ $case['timeline'] }}</p>
              </div>
              <div>
                <h4 class="font-semibold text-neutral-800 mb-2">Tecnologias</h4>
                <div class="flex flex-wrap gap-2">
                  @foreach($case['technologies'] as $tech)
                    <x-badge variant="info" size="sm">{{ $tech }}</x-badge>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        @endif
      </div>

      <!-- Resultados -->
      <div class="mt-16">
        <h3 class="text-2xl font-bold text-neutral-900 mb-8 text-center">Resultados Alcançados</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          @foreach($case['results'] as $result)
            <x-card variant="bordered" class="text-center">
              <div class="text-4xl mb-4">
                @if(str_contains($result, '%'))
                  📈
                @elseif(str_contains($result, 'ROI'))
                  💰
                @elseif(str_contains($result, 'satisfação'))
                  ⭐
                @else
                  ✅
                @endif
              </div>
              <p class="font-semibold text-neutral-800">{{ $result }}</p>
            </x-card>
          @endforeach
        </div>
      </div>
    </x-section>
  @endforeach

  <!-- Depoimentos -->
  <x-section background="dark" padding="normal">
    <div class="text-center mb-16">
      <h2 class="text-4xl lg:text-5xl font-bold mb-6">O que Nossos Clientes Dizem</h2>
      <p class="text-xl text-neutral-300">
        Feedback real de quem confia na Skala Code para transformar seus negócios
      </p>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
      <x-card variant="elevated" size="lg" class="bg-neutral-800 border-neutral-700">
        <div class="text-center text-white">
          <div class="text-4xl mb-4">⭐⭐⭐⭐⭐</div>
          <blockquote class="text-lg italic mb-6">
            "A Skala Code transformou nossa operação. Em 4 meses, triplicamos nossas vendas online e melhoramos toda a experiência do cliente."
          </blockquote>
          <div class="border-t border-neutral-600 pt-4">
            <p class="font-semibold">João Silva</p>
            <p class="text-neutral-400 text-sm">CEO, TechDistribuidora</p>
          </div>
        </div>
      </x-card>

      <x-card variant="elevated" size="lg" class="bg-neutral-800 border-neutral-700">
        <div class="text-center text-white">
          <div class="text-4xl mb-4">⭐⭐⭐⭐⭐</div>
          <blockquote class="text-lg italic mb-6">
            "O sistema desenvolvido pela Skala Code revolucionou nossa gestão. Agora somos 40% mais eficientes e nossos pacientes estão mais satisfeitos."
          </blockquote>
          <div class="border-t border-neutral-600 pt-4">
            <p class="font-semibold">Dra. Maria Santos</p>
            <p class="text-neutral-400 text-sm">Diretora, Hospital São Lucas</p>
          </div>
        </div>
      </x-card>

      <x-card variant="elevated" size="lg" class="bg-neutral-800 border-neutral-700">
        <div class="text-center text-white">
          <div class="text-4xl mb-4">⭐⭐⭐⭐⭐</div>
          <blockquote class="text-lg italic mb-6">
            "Escalamos nossa fintech de 0 a 50.000 usuários com a plataforma da Skala Code. A arquitetura é sólida e o suporte excepcional."
          </blockquote>
          <div class="border-t border-neutral-600 pt-4">
            <p class="font-semibold">Carlos Oliveira</p>
            <p class="text-neutral-400 text-sm">CTO, InvestSmart</p>
          </div>
        </div>
      </x-card>
    </div>
  </x-section>

  <!-- Call to Action -->
  <x-section background="primary" padding="normal">
    <div class="text-center">
      <h2 class="text-4xl lg:text-5xl font-bold mb-6">
        Seu Próximo Case de Sucesso
      </h2>
      <p class="text-xl lg:text-2xl text-primary-100 mb-8 max-w-3xl mx-auto">
        Que tal ser o próximo case de sucesso da Skala Code?
        Vamos conversar sobre como transformar seu negócio.
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <x-cta-button
          variant="secondary"
          size="xl"
          href="/contato"
          class="bg-white text-primary-600 hover:bg-neutral-50"
        >
          Falar com Especialista
        </x-cta-button>
        <x-cta-button
          variant="outline"
          size="xl"
          href="#contato"
          class="border-white text-white hover:bg-white hover:text-primary-600"
        >
          Ver Outros Cases
        </x-cta-button>
      </div>
    </div>
  </x-section>
</div>