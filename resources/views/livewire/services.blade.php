<div>
  {{-- Hero Section --}}
  <section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
    <x-container>
      <div class="text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Nossos Serviços</h1>
        <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
          Soluções completas em Saúde e Segurança do Trabalho para sua empresa
        </p>
      </div>
    </x-container>
  </section>

  {{-- Introdução dos Serviços --}}
  <section class="py-16">
    <x-container>
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
          Por que escolher a Global SST?
        </h2>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
          Oferecemos um portfólio completo de serviços em SST, combinando expertise técnica,
          tecnologia avançada e atendimento personalizado para garantir a conformidade
          legal e o aumento da produtividade da sua empresa.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="text-center">
          <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Conformidade Legal</h3>
          <p class="text-gray-600">100% de adequação às normas regulamentadoras e legislação trabalhista</p>
        </div>

        <div class="text-center">
          <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Aumento da Produtividade</h3>
          <p class="text-gray-600">Comprovado aumento de 2% na produtividade através de ambientes mais seguros</p>
        </div>

        <div class="text-center">
          <div class="bg-orange-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Suporte Completo</h3>
          <p class="text-gray-600">Acompanhamento contínuo com equipe técnica especializada</p>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Lista de Serviços --}}
  <section class="py-16 bg-gray-50">
    <x-container>
      <div class="space-y-12">
        @foreach($services as $service)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden" id="servico-{{ $service['id'] }}">
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
            {{-- Conteúdo Principal --}}
            <div class="lg:col-span-2 p-8">
              <div class="flex items-start mb-6">
                <div class="bg-{{ $service['color'] }}-100 rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                  @if($service['icon'] === 'medical')
                    <svg class="w-6 h-6 text-{{ $service['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                  @elseif($service['icon'] === 'shield')
                    <svg class="w-6 h-6 text-{{ $service['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                  @elseif($service['icon'] === 'document')
                    <svg class="w-6 h-6 text-{{ $service['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                  @elseif($service['icon'] === 'profile')
                    <svg class="w-6 h-6 text-{{ $service['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                  @elseif($service['icon'] === 'network')
                    <svg class="w-6 h-6 text-{{ $service['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5 0-9-4-9-9s4-9 9-9" />
                    </svg>
                  @elseif($service['icon'] === 'education')
                    <svg class="w-6 h-6 text-{{ $service['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                  @endif
                </div>
                <div>
                  <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">{{ $service['title'] }}</h3>
                  <p class="text-lg text-{{ $service['color'] }}-600 font-medium mb-4">{{ $service['subtitle'] }}</p>
                </div>
              </div>

              <p class="text-gray-600 mb-6 text-lg">{{ $service['description'] }}</p>

              <h4 class="text-xl font-semibold text-gray-900 mb-4">O que inclui:</h4>
              <ul class="space-y-2 mb-6">
                @foreach($service['details'] as $detail)
                <li class="flex items-start">
                  <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                  </svg>
                  <span class="text-gray-700">{{ $detail }}</span>
                </li>
                @endforeach
              </ul>
            </div>

            {{-- Sidebar com Preço e Ações --}}
            <div class="bg-gray-50 p-8 flex flex-col justify-center">
              <div class="text-center mb-6">
                <div class="text-3xl font-bold text-{{ $service['color'] }}-600 mb-2">{{ $service['price_range'] }}</div>
                <p class="text-gray-600 text-sm">Valores podem variar conforme complexidade</p>
              </div>

              <div class="space-y-3">
                <x-button
                  class="w-full bg-{{ $service['color'] }}-600 hover:bg-{{ $service['color'] }}-700 text-white"
                  href="#contato-{{ $service['id'] }}"
                >
                  Solicitar Orçamento
                </x-button>
                <x-button
                  variant="outline"
                  class="w-full border-{{ $service['color'] }}-600 text-{{ $service['color'] }}-600 hover:bg-{{ $service['color'] }}-50"
                  href="https://wa.me/5511999999999?text=Olá! Gostaria de saber mais sobre {{ $service['title'] }}"
                  target="_blank"
                >
                  WhatsApp
                </x-button>
              </div>

              <div class="mt-6 text-center text-sm text-gray-500">
                <p>✓ Atendimento personalizado</p>
                <p>✓ Suporte técnico incluído</p>
                <p>✓ Entrega no prazo garantida</p>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </x-container>
  </section>

  {{-- Serviços Adicionais --}}
  <section class="py-16">
    <x-container>
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          Serviços Complementares
        </h2>
        <p class="text-lg text-gray-600">
          Outros serviços para completar sua gestão de SST
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
          <div class="bg-red-100 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.878-.833-2.598 0L4.268 18.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
          </div>
          <h3 class="text-lg font-semibold mb-2">Abertura de CAT</h3>
          <p class="text-gray-600 text-sm mb-4">Comunicação de Acidentes do Trabalho</p>
          <a href="/formularios/cat" class="text-red-600 font-medium hover:underline">Abrir CAT →</a>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
          <div class="bg-blue-100 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
          </div>
          <h3 class="text-lg font-semibold mb-2">Solicitação de PPP</h3>
          <p class="text-gray-600 text-sm mb-4">Perfil Profissiográfico Previdenciário</p>
          <a href="/formularios/ppp" class="text-blue-600 font-medium hover:underline">Solicitar PPP →</a>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
          <div class="bg-green-100 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
          </div>
          <h3 class="text-lg font-semibold mb-2">Plataforma EAD</h3>
          <p class="text-gray-600 text-sm mb-4">Treinamentos online certificados</p>
          <a href="https://ead.globalsst.com.br" target="_blank" class="text-green-600 font-medium hover:underline">Acessar EAD →</a>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
          <div class="bg-purple-100 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9m0 9c-5 0-9-4-9-9s4-9 9-9" />
            </svg>
          </div>
          <h3 class="text-lg font-semibold mb-2">Nova Plataforma</h3>
          <p class="text-gray-600 text-sm mb-4">Sistema de gestão integrada</p>
          <a href="https://plataforma.globalsst.com.br" target="_blank" class="text-purple-600 font-medium hover:underline">Acessar Sistema →</a>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Call to Action --}}
  <section class="py-16 bg-blue-900 text-white">
    <x-container>
      <div class="text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
          Precisa de uma solução personalizada?
        </h2>
        <p class="text-xl mb-8 text-blue-100 max-w-2xl mx-auto">
          Nossa equipe está pronta para desenvolver a solução perfeita para sua empresa.
          Entre em contato e receba uma proposta sob medida.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <x-button
            size="lg"
            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-8 py-4"
            href="https://wa.me/5511999999999"
            target="_blank"
          >
            Falar no WhatsApp
          </x-button>
          <x-button
            size="lg"
            class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-4"
            href="/contato"
          >
            Solicitar Orçamento
          </x-button>
        </div>
      </div>
    </x-container>
  </section>
</div>