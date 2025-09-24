<div>
  {{-- Hero Section --}}
  <section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
    <x-container>
      <div class="text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Fale Conosco</h1>
        <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
          Estamos prontos para atender sua empresa com excelência
        </p>
      </div>
    </x-container>
  </section>

  {{-- Informações de Contato --}}
  <section class="py-16">
    <x-container>
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        {{-- Telefone --}}
        <div class="text-center">
          <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">Telefone</h3>
          <p class="text-gray-600 mb-2">(11) 9999-9999</p>
          <p class="text-sm text-gray-500">Segunda a Sexta: 8h às 18h</p>
        </div>

        {{-- E-mail --}}
        <div class="text-center">
          <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">E-mail</h3>
          <p class="text-gray-600 mb-2">contato@globalsst.com.br</p>
          <p class="text-sm text-gray-500">Respondemos em até 24h</p>
        </div>

        {{-- WhatsApp --}}
        <div class="text-center">
          <div class="bg-green-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.785"/>
            </svg>
          </div>
          <h3 class="text-xl font-semibold mb-2">WhatsApp</h3>
          <p class="text-gray-600 mb-2">(11) 99999-9999</p>
          <a href="https://wa.me/5511999999999" target="_blank" class="text-green-600 font-medium hover:underline">
            Conversar agora →
          </a>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Formulário de Contato --}}
  <section class="py-16 bg-gray-50">
    <x-container>
      <div class="max-w-4xl mx-auto">
        <div class="text-center mb-12">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            Solicite um Orçamento
          </h2>
          <p class="text-lg text-gray-600">
            Preencha o formulário abaixo e nossa equipe entrará em contato
          </p>
        </div>

        {{-- Mensagens de Sucesso/Erro --}}
        @if (session()->has('success'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
          </div>
        @endif

        @if (session()->has('error'))
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
          </div>
        @endif

        <form wire:submit="submit" class="bg-white rounded-lg shadow-lg p-8">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nome --}}
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                Nome Completo *
              </label>
              <input
                type="text"
                id="name"
                wire:model="name"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                placeholder="Seu nome completo"
              >
              @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            {{-- E-mail --}}
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                E-mail *
              </label>
              <input
                type="email"
                id="email"
                wire:model="email"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                placeholder="seu@email.com"
              >
              @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            {{-- Telefone --}}
            <div>
              <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                Telefone/WhatsApp *
              </label>
              <input
                type="tel"
                id="phone"
                wire:model="phone"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 @enderror"
                placeholder="(11) 99999-9999"
              >
              @error('phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            {{-- Empresa --}}
            <div>
              <label for="company" class="block text-sm font-medium text-gray-700 mb-2">
                Empresa *
              </label>
              <input
                type="text"
                id="company"
                wire:model="company"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('company') border-red-500 @enderror"
                placeholder="Nome da sua empresa"
              >
              @error('company')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            {{-- Serviço de Interesse --}}
            <div class="md:col-span-2">
              <label for="service" class="block text-sm font-medium text-gray-700 mb-2">
                Serviço de Interesse
              </label>
              <select
                id="service"
                wire:model="service"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
                <option value="">Selecione um serviço (opcional)</option>
                <option value="pcmso">PCMSO - Programa de Controle Médico</option>
                <option value="pgr">PGR - Programa de Gerenciamento de Riscos</option>
                <option value="ltcat">LTCAT - Laudo Técnico das Condições Ambientais</option>
                <option value="ppp">PPP - Perfil Profissiográfico Previdenciário</option>
                <option value="esocial">eSocial - Integração e Compliance</option>
                <option value="treinamentos">Treinamentos e Capacitação</option>
                <option value="consultoria">Consultoria Geral em SST</option>
                <option value="outros">Outros serviços</option>
              </select>
            </div>

            {{-- Assunto --}}
            <div class="md:col-span-2">
              <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                Assunto *
              </label>
              <input
                type="text"
                id="subject"
                wire:model="subject"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('subject') border-red-500 @enderror"
                placeholder="Assunto da sua mensagem"
              >
              @error('subject')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            {{-- Mensagem --}}
            <div class="md:col-span-2">
              <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                Mensagem *
              </label>
              <textarea
                id="message"
                wire:model="message"
                rows="6"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('message') border-red-500 @enderror"
                placeholder="Descreva suas necessidades, número de funcionários, segmento da empresa, etc."
              ></textarea>
              @error('message')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          {{-- Botão de Envio --}}
          <div class="mt-8 text-center">
            <button
              type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors duration-300 disabled:opacity-50"
              wire:loading.attr="disabled"
            >
              <span wire:loading.remove>Enviar Mensagem</span>
              <span wire:loading>Enviando...</span>
            </button>
          </div>

          <p class="text-center text-sm text-gray-500 mt-4">
            * Campos obrigatórios. Seus dados estão protegidos pela LGPD.
          </p>
        </form>
      </div>
    </x-container>
  </section>

  {{-- Mapa e Endereço --}}
  <section class="py-16">
    <x-container>
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
            Nossa Localização
          </h2>
          <div class="space-y-4">
            <div class="flex items-start">
              <svg class="w-6 h-6 text-blue-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <div>
                <p class="font-semibold text-gray-900">Endereço</p>
                <p class="text-gray-600">
                  Rua das Empresas, 123 - Sala 456<br>
                  Centro - São Paulo/SP<br>
                  CEP: 01234-567
                </p>
              </div>
            </div>

            <div class="flex items-start">
              <svg class="w-6 h-6 text-blue-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <div>
                <p class="font-semibold text-gray-900">Horário de Atendimento</p>
                <p class="text-gray-600">
                  Segunda a Sexta: 8h às 18h<br>
                  Sábado: 8h às 12h<br>
                  Domingo: Fechado
                </p>
              </div>
            </div>

            <div class="flex items-start">
              <svg class="w-6 h-6 text-blue-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
              </svg>
              <div>
                <p class="font-semibold text-gray-900">Atendimento 24h</p>
                <p class="text-gray-600">
                  WhatsApp para urgências<br>
                  <a href="https://wa.me/5511999999999" target="_blank" class="text-green-600 hover:underline">
                    (11) 99999-9999
                  </a>
                </p>
              </div>
            </div>
          </div>
        </div>

        {{-- Placeholder para mapa --}}
        <div class="bg-gray-200 rounded-lg h-96 flex items-center justify-center">
          <div class="text-center text-gray-500">
            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <p>Mapa do Google Maps</p>
            <p class="text-sm">Integração a ser implementada</p>
          </div>
        </div>
      </div>
    </x-container>
  </section>

  {{-- FAQ Rápido --}}
  <section class="py-16 bg-gray-50">
    <x-container>
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
          Dúvidas Frequentes
        </h2>
        <p class="text-lg text-gray-600">
          Respostas para as principais questões dos nossos clientes
        </p>
      </div>

      <div class="max-w-4xl mx-auto">
        <div x-data="{ open: null }" class="space-y-4">
          {{-- FAQ 1 --}}
          <div class="bg-white rounded-lg shadow">
            <button
              @click="open = open === 1 ? null : 1"
              class="w-full px-6 py-4 text-left font-medium text-gray-900 hover:text-blue-600 focus:outline-none flex justify-between items-center"
            >
              <span>Qual é o prazo para elaboração dos documentos de SST?</span>
              <svg class="w-5 h-5 transform transition-transform" :class="{ 'rotate-180': open === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>
            <div x-show="open === 1" x-transition class="px-6 pb-4">
              <p class="text-gray-600">
                O prazo varia conforme o serviço: PCMSO (10-15 dias), PGR (15-20 dias), LTCAT (10-15 dias).
                Prazos urgentes podem ser negociados com taxa adicional.
              </p>
            </div>
          </div>

          {{-- FAQ 2 --}}
          <div class="bg-white rounded-lg shadow">
            <button
              @click="open = open === 2 ? null : 2"
              class="w-full px-6 py-4 text-left font-medium text-gray-900 hover:text-blue-600 focus:outline-none flex justify-between items-center"
            >
              <span>Vocês atendem empresas de qual porte?</span>
              <svg class="w-5 h-5 transform transition-transform" :class="{ 'rotate-180': open === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>
            <div x-show="open === 2" x-transition class="px-6 pb-4">
              <p class="text-gray-600">
                Atendemos empresas de todos os portes, desde MEI até grandes corporações.
                Nossos serviços são adaptados para cada realidade e necessidade.
              </p>
            </div>
          </div>

          {{-- FAQ 3 --}}
          <div class="bg-white rounded-lg shadow">
            <button
              @click="open = open === 3 ? null : 3"
              class="w-full px-6 py-4 text-left font-medium text-gray-900 hover:text-blue-600 focus:outline-none flex justify-between items-center"
            >
              <span>Como funciona o suporte após a entrega dos documentos?</span>
              <svg class="w-5 h-5 transform transition-transform" :class="{ 'rotate-180': open === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
              </svg>
            </button>
            <div x-show="open === 3" x-transition class="px-6 pb-4">
              <p class="text-gray-600">
                Oferecemos suporte técnico contínuo para esclarecimento de dúvidas,
                orientações de implementação e atualizações quando necessário.
              </p>
            </div>
          </div>
        </div>
      </div>
    </x-container>
  </section>
</div>