<div>
  {{-- Hero Section --}}
  <section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white">
    <x-container>
      <div class="py-20 text-center">
        <h1 class="text-4xl md:text-6xl font-bold mb-6">
          Sua empresa mais <span class="text-orange-400">produtiva</span> e <span class="text-green-400">segura</span>
        </h1>
        <p class="text-xl md:text-2xl mb-8 text-blue-100">
          Especialistas em Saúde e Segurança do Trabalho<br>
          <strong>Aumente sua produtividade em 2% acima do mercado</strong>
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <x-button
            size="lg"
            class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-4"
            href="#contato"
          >
            Solicitar Orçamento
          </x-button>
          <x-button
            size="lg"
            variant="outline"
            class="border-white text-white hover:bg-white hover:text-blue-900 px-8 py-4"
            href="#servicos"
          >
            Nossos Serviços
          </x-button>
          <x-button
            size="lg"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-4"
            href="{{ route('client.login') }}"
            wire:navigate
          >
            🔐 Área do Cliente
          </x-button>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Serviços Principais (Botões de Acesso Rápido) --}}
  <section class="py-16 bg-gray-50" id="servicos">
    <x-container>
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          Nossos Serviços Principais
        </h2>
        <p class="text-lg text-gray-600">
          Soluções completas em SST para manter sua empresa em conformidade
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- PCMSO --}}
        <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition-shadow">
          <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">PCMSO</h3>
          <p class="text-gray-600 mb-4">Programa de Controle Médico de Saúde Ocupacional</p>
          <a href="/servicos/pcmso" class="text-blue-600 font-medium hover:underline">Saiba mais →</a>
        </div>

        {{-- PGR --}}
        <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition-shadow">
          <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">PGR</h3>
          <p class="text-gray-600 mb-4">Programa de Gerenciamento de Riscos</p>
          <a href="/servicos/pgr" class="text-green-600 font-medium hover:underline">Saiba mais →</a>
        </div>

        {{-- LTCAT --}}
        <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition-shadow">
          <div class="bg-purple-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">LTCAT</h3>
          <p class="text-gray-600 mb-4">Laudo Técnico das Condições Ambientais do Trabalho</p>
          <a href="/servicos/ltcat" class="text-purple-600 font-medium hover:underline">Saiba mais →</a>
        </div>

        {{-- eSocial --}}
        <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition-shadow">
          <div class="bg-orange-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5 0-9-4-9-9s4-9 9-9" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">eSocial</h3>
          <p class="text-gray-600 mb-4">Integração e compliance com eSocial</p>
          <a href="/servicos/esocial" class="text-orange-600 font-medium hover:underline">Saiba mais →</a>
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