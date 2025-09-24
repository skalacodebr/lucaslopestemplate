<div>
  {{-- Hero Section --}}
  <section class="bg-gradient-to-r from-red-900 to-red-700 text-white py-16">
    <x-container>
      <div class="text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Abertura de CAT</h1>
        <p class="text-xl md:text-2xl text-red-100 max-w-3xl mx-auto">
          Comunicação de Acidente do Trabalho
        </p>
        <div class="mt-6 inline-flex items-center bg-red-800 px-4 py-2 rounded-lg">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span class="text-sm">Prazo legal: até o 1º dia útil após o acidente</span>
        </div>
      </div>
    </x-container>
  </section>

  {{-- Informações Importantes --}}
  <section class="py-8 bg-yellow-50 border-b border-yellow-200">
    <x-container>
      <div class="flex items-start">
        <svg class="w-6 h-6 text-yellow-600 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.878-.833-2.598 0L4.268 18.5c-.77.833.192 2.5 1.732 2.5z" />
        </svg>
        <div>
          <h3 class="text-lg font-semibold text-yellow-800 mb-2">Informações Importantes sobre a CAT</h3>
          <ul class="text-yellow-700 space-y-1 text-sm">
            <li>• A CAT deve ser comunicada até o 1º dia útil após o acidente</li>
            <li>• É obrigatória para todos os acidentes de trabalho, mesmo os leves</li>
            <li>• Mantenha todos os documentos médicos e evidências do acidente</li>
            <li>• Nossa equipe auxiliará em todo o processo após o recebimento</li>
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
              <svg class="w-6 h-6 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
              Dados da Empresa
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nome da Empresa *</label>
                <input type="text" wire:model="company_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('company_name') border-red-500 @enderror">
                @error('company_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">CNPJ *</label>
                <input type="text" wire:model="cnpj" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('cnpj') border-red-500 @enderror" placeholder="00.000.000/0000-00">
                @error('cnpj') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Telefone *</label>
                <input type="tel" wire:model="company_phone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('company_phone') border-red-500 @enderror">
                @error('company_phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">E-mail *</label>
                <input type="email" wire:model="company_email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('company_email') border-red-500 @enderror">
                @error('company_email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Endereço Completo *</label>
                <textarea wire:model="company_address" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('company_address') border-red-500 @enderror"></textarea>
                @error('company_address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>
            </div>
          </div>

          {{-- Dados do Acidentado --}}
          <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
              <svg class="w-6 h-6 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
              Dados do Acidentado
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nome Completo *</label>
                <input type="text" wire:model="employee_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('employee_name') border-red-500 @enderror">
                @error('employee_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">CPF *</label>
                <input type="text" wire:model="cpf" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('cpf') border-red-500 @enderror" placeholder="000.000.000-00">
                @error('cpf') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Data de Nascimento *</label>
                <input type="date" wire:model="birth_date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('birth_date') border-red-500 @enderror">
                @error('birth_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cargo/Função *</label>
                <input type="text" wire:model="job_position" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('job_position') border-red-500 @enderror">
                @error('job_position') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Data de Admissão *</label>
                <input type="date" wire:model="admission_date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('admission_date') border-red-500 @enderror">
                @error('admission_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Telefone do Funcionário *</label>
                <input type="tel" wire:model="employee_phone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('employee_phone') border-red-500 @enderror">
                @error('employee_phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>
            </div>
          </div>

          {{-- Dados do Acidente --}}
          <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
              <svg class="w-6 h-6 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.878-.833-2.598 0L4.268 18.5c-.77.833.192 2.5 1.732 2.5z" />
              </svg>
              Dados do Acidente
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Data do Acidente *</label>
                <input type="date" wire:model="accident_date" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('accident_date') border-red-500 @enderror">
                @error('accident_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Horário do Acidente *</label>
                <input type="time" wire:model="accident_time" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('accident_time') border-red-500 @enderror">
                @error('accident_time') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Local do Acidente *</label>
                <input type="text" wire:model="accident_location" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('accident_location') border-red-500 @enderror" placeholder="Ex: Setor de produção, linha 2, próximo à máquina X">
                @error('accident_location') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Descrição Detalhada do Acidente *</label>
                <textarea wire:model="accident_description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('accident_description') border-red-500 @enderror" placeholder="Descreva como o acidente aconteceu, as circunstâncias, equipamentos envolvidos, etc."></textarea>
                @error('accident_description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de Lesão *</label>
                <select wire:model="injury_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('injury_type') border-red-500 @enderror">
                  <option value="">Selecione o tipo de lesão</option>
                  <option value="corte">Corte</option>
                  <option value="fratura">Fratura</option>
                  <option value="contusao">Contusão</option>
                  <option value="queimadura">Queimadura</option>
                  <option value="distensao">Distensão</option>
                  <option value="perfuracao">Perfuração</option>
                  <option value="esmagamento">Esmagamento</option>
                  <option value="outros">Outros</option>
                </select>
                @error('injury_type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Parte do Corpo Atingida *</label>
                <select wire:model="injured_body_part" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('injured_body_part') border-red-500 @enderror">
                  <option value="">Selecione a parte do corpo</option>
                  <option value="cabeca">Cabeça</option>
                  <option value="olhos">Olhos</option>
                  <option value="mao_direita">Mão Direita</option>
                  <option value="mao_esquerda">Mão Esquerda</option>
                  <option value="braço_direito">Braço Direito</option>
                  <option value="braço_esquerdo">Braço Esquerdo</option>
                  <option value="tronco">Tronco</option>
                  <option value="perna_direita">Perna Direita</option>
                  <option value="perna_esquerda">Perna Esquerda</option>
                  <option value="pe_direito">Pé Direito</option>
                  <option value="pe_esquerdo">Pé Esquerdo</option>
                  <option value="multiplas">Múltiplas Partes</option>
                </select>
                @error('injured_body_part') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              </div>

              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Testemunhas (se houver)</label>
                <textarea wire:model="witnesses" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Nome, função e telefone das testemunhas"></textarea>
              </div>
            </div>
          </div>

          {{-- Atendimento Médico --}}
          <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
              <svg class="w-6 h-6 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
              </svg>
              Atendimento Médico
            </h2>

            <div class="space-y-6">
              <div>
                <label class="flex items-center">
                  <input type="checkbox" wire:model="medical_care" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200">
                  <span class="ml-2 text-sm text-gray-700">O acidentado recebeu atendimento médico?</span>
                </label>
              </div>

              @if($medical_care)
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-gray-50 rounded-lg">
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Nome do Hospital/Clínica *</label>
                  <input type="text" wire:model="hospital_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('hospital_name') border-red-500 @enderror">
                  @error('hospital_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-2">Nome do Médico *</label>
                  <input type="text" wire:model="doctor_name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('doctor_name') border-red-500 @enderror">
                  @error('doctor_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Relatório/Diagnóstico Médico</label>
                  <textarea wire:model="medical_report" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Diagnóstico, procedimentos realizados, recomendações médicas"></textarea>
                </div>
              </div>
              @endif
            </div>
          </div>

          {{-- Anexos --}}
          <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
              <svg class="w-6 h-6 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
              </svg>
              Anexos (opcional)
            </h2>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">
                Anexar documentos (fotos do local, relatórios médicos, etc.)
              </label>
              <input type="file" wire:model="attachments" multiple class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
              <p class="text-sm text-gray-500 mt-1">Máximo 10MB por arquivo. Formatos aceitos: PDF, DOC, DOCX, JPG, PNG</p>
              @error('attachments.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror

              @if($attachments)
              <div class="mt-4">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Arquivos selecionados:</h4>
                <ul class="space-y-1">
                  @foreach($attachments as $attachment)
                  <li class="text-sm text-gray-600">• {{ $attachment->getClientOriginalName() }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
            </div>
          </div>

          {{-- Botão de Envio --}}
          <div class="text-center">
            <button
              type="submit"
              class="bg-red-600 hover:bg-red-700 text-white font-semibold px-12 py-4 rounded-lg text-lg transition-colors duration-300 disabled:opacity-50"
              wire:loading.attr="disabled"
            >
              <span wire:loading.remove>Enviar CAT</span>
              <span wire:loading>Enviando...</span>
            </button>
            <p class="text-sm text-gray-500 mt-4">
              Ao enviar, você confirma que todas as informações são verdadeiras e precisas.
            </p>
          </div>
        </form>
      </div>
    </x-container>
  </section>

  {{-- Informações de Suporte --}}
  <section class="py-16 bg-gray-50">
    <x-container>
      <div class="text-center">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">Precisa de Ajuda?</h2>
        <p class="text-gray-600 mb-6">Nossa equipe está disponível para auxiliar no preenchimento da CAT</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a
            href="https://wa.me/5511999999999?text=Preciso de ajuda para preencher a CAT"
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