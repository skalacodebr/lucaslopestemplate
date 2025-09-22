<div>
  <!-- Hero Section -->
  <x-section background="gradient" padding="normal">
    <div class="text-center">
      <h1 class="text-5xl lg:text-7xl font-bold mb-6">
        Vamos <span class="text-secondary-300">Conversar</span>
      </h1>
      <p class="text-xl lg:text-2xl text-primary-100 max-w-4xl mx-auto leading-relaxed">
        Prontos para transformar seu negócio? Nossa equipe de especialistas está aqui
        para entender suas necessidades e apresentar a melhor solução.
      </p>
    </div>
  </x-section>

  @if($enviado)
    <!-- Mensagem de Sucesso -->
    <x-section background="white" padding="normal">
      <div class="max-w-2xl mx-auto text-center">
        <div class="bg-secondary-50 border border-secondary-200 rounded-2xl p-12">
          <div class="w-16 h-16 bg-secondary-600 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
            </svg>
          </div>
          <h2 class="text-3xl font-bold text-neutral-900 mb-4">Mensagem Enviada!</h2>
          <p class="text-lg text-neutral-700 mb-6">
            Recebemos sua mensagem e nossa equipe entrará em contato em até 2 horas úteis.
          </p>
          <x-cta-button
            wire:click="$set('enviado', false)"
            variant="primary"
            size="lg"
          >
            Enviar Nova Mensagem
          </x-cta-button>
        </div>
      </div>
    </x-section>
  @else
    <!-- Formulário de Contato -->
    <x-section background="white" padding="normal">
      <div class="max-w-4xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-16">
          <!-- Formulário -->
          <div>
            <h2 class="text-3xl font-bold text-neutral-900 mb-8">
              Fale com Nossa Equipe
            </h2>

            <form wire:submit.prevent="enviarContato" class="space-y-6">
              <!-- Nome -->
              <div>
                <label for="nome" class="block text-sm font-semibold text-neutral-800 mb-2">
                  Nome Completo *
                </label>
                <div class="input-floating">
                  <input
                    type="text"
                    id="nome"
                    wire:model="nome"
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-colors @error('nome') input-error @else @if($nome) input-success @endif @enderror"
                    placeholder=" "
                    required
                  >
                  <label for="nome" class="absolute top-3 left-4 text-neutral-500 transition-all pointer-events-none">Nome Completo *</label>
                </div>
                @error('nome')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
              </div>

              <!-- Email -->
              <div>
                <label for="email" class="block text-sm font-semibold text-neutral-800 mb-2">
                  Email Corporativo *
                </label>
                <input
                  type="email"
                  id="email"
                  wire:model="email"
                  class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-colors @error('email') border-red-500 @enderror"
                  placeholder="seu@empresa.com.br"
                >
                @error('email')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
              </div>

              <div class="grid grid-cols-2 gap-4">
                <!-- Empresa -->
                <div>
                  <label for="empresa" class="block text-sm font-semibold text-neutral-800 mb-2">
                    Empresa *
                  </label>
                  <input
                    type="text"
                    id="empresa"
                    wire:model="empresa"
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-colors @error('empresa') border-red-500 @enderror"
                    placeholder="Nome da empresa"
                  >
                  @error('empresa')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Telefone -->
                <div>
                  <label for="telefone" class="block text-sm font-semibold text-neutral-800 mb-2">
                    WhatsApp *
                  </label>
                  <input
                    type="tel"
                    id="telefone"
                    wire:model="telefone"
                    class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-colors @error('telefone') border-red-500 @enderror"
                    placeholder="(11) 99999-9999"
                  >
                  @error('telefone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                  @enderror
                </div>
              </div>

              <!-- Serviço -->
              <div>
                <label for="servico" class="block text-sm font-semibold text-neutral-800 mb-2">
                  Serviço de Interesse *
                </label>
                <select
                  id="servico"
                  wire:model="servico"
                  class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-colors @error('servico') border-red-500 @enderror"
                >
                  <option value="">Selecione um serviço</option>
                  <option value="outsourcing">Outsourcing de TI</option>
                  <option value="fabrica-software">Fábrica de Software</option>
                  <option value="solucoes-ia">Soluções com IA</option>
                  <option value="consultoria">Consultoria Estratégica</option>
                  <option value="outros">Outros</option>
                </select>
                @error('servico')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
              </div>

              <!-- Mensagem -->
              <div>
                <label for="mensagem" class="block text-sm font-semibold text-neutral-800 mb-2">
                  Conte sobre seu Projeto *
                </label>
                <textarea
                  id="mensagem"
                  wire:model="mensagem"
                  rows="4"
                  class="w-full px-4 py-3 border border-neutral-300 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition-colors @error('mensagem') border-red-500 @enderror"
                  placeholder="Descreva seu desafio, objetivo e como podemos ajudar..."
                ></textarea>
                @error('mensagem')
                  <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
              </div>

              <!-- Botão Submit -->
              <div class="pt-4">
                <x-cta-button
                  type="submit"
                  variant="primary"
                  size="xl"
                  class="w-full"
                >
                  Enviar Mensagem
                </x-cta-button>
                <p class="mt-3 text-sm text-neutral-600 text-center">
                  ✅ Resposta em até 2 horas úteis • 🔒 Seus dados estão protegidos
                </p>
              </div>
            </form>
          </div>

          <!-- Informações de Contato -->
          <div class="space-y-8">
            <div>
              <h2 class="text-3xl font-bold text-neutral-900 mb-8">
                Outras Formas de Contato
              </h2>
            </div>

            <!-- WhatsApp -->
            <x-card variant="bordered" size="lg">
              <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-secondary-600 rounded-lg flex items-center justify-center">
                  <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.893 3.506"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-neutral-900">WhatsApp</h3>
                  <p class="text-neutral-600">(11) 99999-9999</p>
                  <p class="text-sm text-neutral-500">Resposta imediata</p>
                </div>
              </div>
            </x-card>

            <!-- Email -->
            <x-card variant="bordered" size="lg">
              <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-primary-600 rounded-lg flex items-center justify-center">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-neutral-900">Email</h3>
                  <p class="text-neutral-600">contato@skalacode.com.br</p>
                  <p class="text-sm text-neutral-500">Resposta em até 2h úteis</p>
                </div>
              </div>
            </x-card>

            <!-- Localização -->
            <x-card variant="bordered" size="lg">
              <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-accent-600 rounded-lg flex items-center justify-center">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-neutral-900">Escritório</h3>
                  <p class="text-neutral-600">São Paulo - SP</p>
                  <p class="text-sm text-neutral-500">Atendimento remoto ou presencial</p>
                </div>
              </div>
            </x-card>

            <!-- Horário -->
            <x-card variant="flat" size="lg">
              <div class="text-center">
                <h3 class="font-semibold text-neutral-900 mb-2">Horário de Atendimento</h3>
                <p class="text-neutral-700">Segunda a Sexta: 9h às 18h</p>
                <p class="text-neutral-700">WhatsApp 24/7 para urgências</p>
              </div>
            </x-card>
          </div>
        </div>
      </div>
    </x-section>
  @endif

  <!-- FAQ Rápido -->
  <x-section background="gray" padding="normal">
    <div class="max-w-4xl mx-auto">
      <div class="text-center mb-16">
        <h2 class="text-4xl lg:text-5xl font-bold text-neutral-900 mb-6">
          Perguntas Frequentes
        </h2>
        <p class="text-xl text-neutral-600">
          Respostas rápidas para as dúvidas mais comuns
        </p>
      </div>

      <div class="grid lg:grid-cols-2 gap-8">
        <x-card variant="elevated" size="lg">
          <h3 class="font-semibold text-neutral-900 mb-3">
            Quanto tempo leva para começar um projeto?
          </h3>
          <p class="text-neutral-700">
            Após a aprovação da proposta, conseguimos começar em até 48 horas
            com profissionais já alinhados ao seu contexto.
          </p>
        </x-card>

        <x-card variant="elevated" size="lg">
          <h3 class="font-semibold text-neutral-900 mb-3">
            Como é feito o acompanhamento dos projetos?
          </h3>
          <p class="text-neutral-700">
            Reuniões semanais, dashboards em tempo real e comunicação
            direta via WhatsApp com total transparência.
          </p>
        </x-card>

        <x-card variant="elevated" size="lg">
          <h3 class="font-semibold text-neutral-900 mb-3">
            Vocês atendem empresas de que porte?
          </h3>
          <p class="text-neutral-700">
            Atendemos desde startups até grandes corporações, adaptando
            nossas soluções ao tamanho e necessidade de cada cliente.
          </p>
        </x-card>

        <x-card variant="elevated" size="lg">
          <h3 class="font-semibold text-neutral-900 mb-3">
            Qual é a garantia dos projetos?
          </h3>
          <p class="text-neutral-700">
            Oferecemos 90 dias de garantia gratuita para correções e
            suporte pós-entrega em todos os nossos projetos.
          </p>
        </div>
      </div>
    </div>
  </x-section>

  <!-- Call to Action -->
  <x-section background="primary" padding="normal">
    <div class="text-center">
      <h2 class="text-4xl lg:text-5xl font-bold mb-6">
        Não Perca Mais Tempo
      </h2>
      <p class="text-xl lg:text-2xl text-primary-100 mb-8 max-w-3xl mx-auto">
        Cada dia sem a solução certa é dinheiro perdido.
        Entre em contato agora e acelere seus resultados.
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a
          href="https://wa.me/5511999999999?text=Olá! Gostaria de falar sobre meu projeto"
          target="_blank"
          class="inline-flex items-center justify-center px-8 py-4 bg-secondary-600 hover:bg-secondary-700 text-white font-semibold rounded-lg text-xl transition-all transform hover:scale-105"
        >
          <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.893 3.506"/>
          </svg>
          Falar no WhatsApp
        </a>
        <a
          href="tel:+5511999999999"
          class="inline-flex items-center justify-center px-8 py-4 bg-white hover:bg-neutral-50 text-primary-600 font-semibold rounded-lg text-xl border-2 border-white transition-all"
        >
          Ligar Agora
        </a>
      </div>
    </div>
  </x-section>
</div>