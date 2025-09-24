<div>
  {{-- Hero Section --}}
  <section class="bg-gradient-to-r from-blue-900 to-blue-700 text-white py-16">
    <x-container>
      <div class="text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Solicitação de PPP</h1>
        <p class="text-xl md:text-2xl text-blue-100 max-w-3xl mx-auto">
          Perfil Profissiográfico Previdenciário
        </p>
        <div class="mt-6 inline-flex items-center bg-blue-800 px-4 py-2 rounded-lg">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span class="text-sm">Prazo de entrega: 5 a 7 dias úteis</span>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Informações sobre PPP --}}
  <section class="py-8 bg-blue-50 border-b border-blue-200">
    <x-container>
      <div class="flex items-start">
        <svg class="w-6 h-6 text-blue-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
          <h3 class="text-lg font-semibold text-blue-800 mb-2">O que é o PPP?</h3>
          <p class="text-blue-700 mb-4">
            O Perfil Profissiográfico Previdenciário é um documento histórico-laboral que deve conter
            informações sobre o trabalhador, a empresa e o ambiente de trabalho, sendo fundamental
            para comprovação de aposentadoria especial.
          </p>
          <ul class="text-blue-700 space-y-1 text-sm">
            <li>• Documento obrigatório para comprovação de aposentadoria especial</li>
            <li>• Deve ser entregue ao funcionário na rescisão</li>
            <li>• Contém histórico de exposições a agentes nocivos</li>
            <li>• Base para cálculos previdenciários</li>
          </ul>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Formulário --}}
  <section class="py-16">
    <x-container>
      <div class="max-w-6xl mx-auto">
        {{-- Mensagens --}}
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

        <form wire:submit="submit" class="space-y-8">
          {{-- Dados da Empresa --}}
          <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
              <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
              Dados da Empresa
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nome da Empresa *</label>
                <input type="text" wire:model="company_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_name') border-red-500 @enderror">
                @error('company_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">CNPJ *</label>
                <input type="text" wire:model="cnpj" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('cnpj') border-red-500 @enderror" placeholder="00.000.000/0000-00">
                @error('cnpj') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Telefone *</label>
                <input type="tel" wire:model="company_phone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_phone') border-red-500 @enderror">
                @error('company_phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">E-mail *</label>
                <input type="email" wire:model="company_email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company_email') border-red-500 @enderror">
                @error('company_email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>
            </div>
          </div>

          {{-- Dados do Funcionário --}}
          <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
              <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              Dados do Funcionário
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nome Completo *</label>
                <input type="text" wire:model="employee_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('employee_name') border-red-500 @enderror">
                @error('employee_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">CPF *</label>
                <input type="text" wire:model="cpf" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('cpf') border-red-500 @enderror" placeholder="000.000.000-00">
                @error('cpf') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Data de Nascimento *</label>
                <input type="date" wire:model="birth_date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('birth_date') border-red-500 @enderror">
                @error('birth_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cargo/Função *</label>
                <input type="text" wire:model="job_position" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('job_position') border-red-500 @enderror">
                @error('job_position') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Data de Admissão *</label>
                <input type="date" wire:model="admission_date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('admission_date') border-red-500 @enderror">
                @error('admission_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Data de Demissão</label>
                <input type="date" wire:model="dismissal_date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-500 mt-1">Deixe em branco se o funcionário ainda está ativo</p>
              </div>
            </div>
          </div>

          {{-- Dados da Solicitação --}}
          <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
              <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              Dados da Solicitação
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Motivo da Solicitação *</label>
                <select wire:model="request_reason" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('request_reason') border-red-500 @enderror">
                  <option value="">Selecione o motivo</option>
                  <option value="rescisao">Rescisão de Contrato</option>
                  <option value="aposentadoria">Aposentadoria Especial</option>
                  <option value="inss">Solicitação do INSS</option>
                  <option value="judicial">Processo Judicial</option>
                  <option value="outros">Outros motivos</option>
                </select>
                @error('request_reason') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Período Inicial *</label>
                <input type="date" wire:model="period_start" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('period_start') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Início do período que deve constar no PPP</p>
                @error('period_start') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Período Final *</label>
                <input type="date" wire:model="period_end" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('period_end') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">Fim do período que deve constar no PPP</p>
                @error('period_end') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Observações</label>
                <textarea wire:model="observations" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Informações adicionais que possam auxiliar na elaboração do PPP (mudanças de função, exposições específicas, etc.)"></textarea>
              </div>
            </div>
          </div>

          {{-- Urgência --}}
          <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
              <svg class="w-6 h-6 text-orange-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Solicitação Urgente
            </h2>

            <div class="space-y-4">
              <div>
                <label class="flex items-center">
                  <input type="checkbox" wire:model="is_urgent" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                  <span class="ml-2 text-sm text-gray-700">Esta solicitação é urgente?</span>
                </label>
                <p class="text-xs text-gray-500 mt-1">Solicitações urgentes têm taxa adicional e prazo reduzido</p>
              </div>

              @if($is_urgent)
              <div class="p-4 bg-orange-50 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">Justificativa da Urgência *</label>
                <textarea wire:model="urgency_reason" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 @error('urgency_reason') border-red-500 @enderror" placeholder="Explique o motivo da urgência (prazo judicial, agendamento no INSS, etc.)"></textarea>
                @error('urgency_reason') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror

                <div class="mt-3 p-3 bg-orange-100 rounded border border-orange-200">
                  <div class="flex items-start">
                    <svg class="w-5 h-5 text-orange-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.878-.833-2.598 0L4.268 18.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                    <div>
                      <p class="text-sm font-medium text-orange-800">Condições da Urgência:</p>
                      <ul class="text-xs text-orange-700 mt-1 space-y-1">
                        <li>• Prazo de entrega: 24 a 48 horas</li>
                        <li>• Taxa adicional: 50% sobre o valor normal</li>
                        <li>• Sujeito à disponibilidade da equipe técnica</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              @endif
            </div>
          </div>

          {{-- Preço Estimado --}}
          <div class="bg-blue-50 rounded-lg p-6 border border-blue-200">
            <h3 class="text-lg font-semibold text-blue-800 mb-3 flex items-center">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
              </svg>
              Investimento
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="text-sm text-blue-700 font-medium">PPP Normal</p>
                <p class="text-2xl font-bold text-blue-800">R$ 45,00</p>
                <p class="text-xs text-blue-600">Prazo: 5 a 7 dias úteis</p>
              </div>
              <div>
                <p class="text-sm text-orange-700 font-medium">PPP Urgente</p>
                <p class="text-2xl font-bold text-orange-800">R$ 67,50</p>
                <p class="text-xs text-orange-600">Prazo: 24 a 48 horas</p>
              </div>
            </div>
          </div>

          {{-- Botão de Envio --}}
          <div class="text-center">
            <button
              type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-12 py-4 rounded-lg text-lg transition-colors duration-300 disabled:opacity-50"
              wire:loading.attr="disabled"
            >
              <span wire:loading.remove>Solicitar PPP</span>
              <span wire:loading>Enviando...</span>
            </button>
            <p class="text-sm text-gray-500 mt-4">
              Após o envio, entraremos em contato para confirmação dos dados e pagamento.
            </p>
          </div>
        </form>
      </div>
    </x-container>
  </section>

  {{-- Informações de Pagamento e Entrega --}}
  <section class="py-16 bg-gray-50">
    <x-container>
      <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-900 text-center mb-8">Como Funciona</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="text-center">
            <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <span class="text-2xl font-bold text-blue-600">1</span>
            </div>
            <h3 class="text-lg font-semibold mb-2">Envie a Solicitação</h3>
            <p class="text-gray-600 text-sm">Preencha o formulário com os dados necessários para elaboração do PPP</p>
          </div>

          <div class="text-center">
            <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <span class="text-2xl font-bold text-blue-600">2</span>
            </div>
            <h3 class="text-lg font-semibold mb-2">Confirmação e Pagamento</h3>
            <p class="text-gray-600 text-sm">Nossa equipe confirmará os dados e enviará link para pagamento via PIX ou boleto</p>
          </div>

          <div class="text-center">
            <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
              <span class="text-2xl font-bold text-blue-600">3</span>
            </div>
            <h3 class="text-lg font-semibold mb-2">Receba o PPP</h3>
            <p class="text-gray-600 text-sm">PPP elaborado e enviado por e-mail assinado digitalmente pelo responsável técnico</p>
          </div>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Suporte --}}
  <section class="py-16">
    <x-container>
      <div class="text-center">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Precisa de Ajuda?</h2>
        <p class="text-gray-600 mb-6">Nossa equipe está disponível para esclarecer dúvidas sobre o PPP</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a
            href="https://wa.me/5511999999999?text=Preciso de ajuda com a solicitação de PPP"
            target="_blank"
            class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition-colors"
          >
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.785"/>
            </svg>
            WhatsApp
          </a>
          <a
            href="tel:11999999999"
            class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors"
          >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
            </svg>
            Ligar Agora
          </a>
        </div>
      </div>
    </x-container>
  </section>
</div>