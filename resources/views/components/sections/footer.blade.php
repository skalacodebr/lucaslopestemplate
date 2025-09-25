<footer class="bg-blue-900 text-white py-16">
  <x-container>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
      {{-- Logo e Descrição --}}
      <div class="md:col-span-2">
        <div class="mb-6">
          <h3 class="text-2xl font-bold text-yellow-400 mb-2">Global SST</h3>
          <div class="w-16 h-1 bg-yellow-400 mb-4"></div>
        </div>
        <p class="text-blue-100 mb-6 leading-relaxed">
          Soluções personalizadas em saúde e segurança do trabalho para seu negócio.
          Especialistas em engenharia de segurança e medicina do trabalho há mais de 10 anos.
        </p>

        {{-- Contact Info --}}
        <div class="space-y-3 mb-6">
          <div class="flex items-center">
            <svg class="w-5 h-5 text-yellow-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            <span class="text-blue-100">(11) 99999-9999</span>
          </div>
          <div class="flex items-center">
            <svg class="w-5 h-5 text-yellow-400 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <span class="text-blue-100">contato@globalsst.com.br</span>
          </div>
          <div class="flex items-start">
            <svg class="w-5 h-5 text-yellow-400 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <span class="text-blue-100">Rua das Flores, 123<br>Centro - São Paulo/SP<br>CEP: 01234-567</span>
          </div>
        </div>

        {{-- Social Media --}}
        <div class="flex space-x-4">
          <a href="https://wa.me/5511999999999" target="_blank" class="w-10 h-10 bg-green-600 hover:bg-green-700 rounded-full flex items-center justify-center transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.687"/>
            </svg>
          </a>
          <a href="#" class="w-10 h-10 bg-blue-700 hover:bg-blue-600 rounded-full flex items-center justify-center transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M22 12.017c0-5.525-4.478-10.003-10.003-10.003S2.014 6.492 2.014 12.017c0 4.993 3.658 9.128 8.438 9.879v-6.987h-2.54v-2.892h2.54V9.797c0-2.508 1.493-3.891 3.776-3.891 1.094 0 2.24.195 2.24.195v2.459h-1.264c-1.243 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.892h-2.33v6.987C18.342 21.145 22 16.01 22 12.017z"/>
            </svg>
          </a>
          <a href="#" class="w-10 h-10 bg-blue-500 hover:bg-blue-400 rounded-full flex items-center justify-center transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
            </svg>
          </a>
          <a href="#" class="w-10 h-10 bg-red-600 hover:bg-red-500 rounded-full flex items-center justify-center transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
              <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
            </svg>
          </a>
        </div>
      </div>

      {{-- Links Rápidos --}}
      <div>
        <h3 class="text-lg font-semibold mb-6 text-yellow-400">Links Rápidos</h3>
        <div class="w-12 h-1 bg-yellow-400 mb-4"></div>
        <ul class="space-y-3 text-blue-100">
          <li><a href="/" wire:navigate class="hover:text-yellow-400 transition-colors flex items-center">
            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>Home
          </a></li>
          <li><a href="/sobre" wire:navigate class="hover:text-yellow-400 transition-colors flex items-center">
            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>Sobre Nós
          </a></li>
          <li><a href="/servicos" wire:navigate class="hover:text-yellow-400 transition-colors flex items-center">
            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>Serviços
          </a></li>
          <li><a href="/blog" wire:navigate class="hover:text-yellow-400 transition-colors flex items-center">
            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>Blog
          </a></li>
          <li><a href="/contato" wire:navigate class="hover:text-yellow-400 transition-colors flex items-center">
            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>Contato
          </a></li>
        </ul>
      </div>

      {{-- Serviços --}}
      <div>
        <h3 class="text-lg font-semibold mb-6 text-yellow-400">Nossos Serviços</h3>
        <div class="w-12 h-1 bg-yellow-400 mb-4"></div>
        <ul class="space-y-3 text-blue-100">
          <li><a href="/servicos#medicina" class="hover:text-yellow-400 transition-colors flex items-center">
            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>Medicina do Trabalho
          </a></li>
          <li><a href="/servicos#seguranca" class="hover:text-yellow-400 transition-colors flex items-center">
            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>Segurança do Trabalho
          </a></li>
          <li><a href="/servicos#treinamentos" class="hover:text-yellow-400 transition-colors flex items-center">
            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>Treinamentos NRS
          </a></li>
          <li><a href="/servicos#pericias" class="hover:text-yellow-400 transition-colors flex items-center">
            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>Perícias
          </a></li>
          <li><a href="/servicos#gestao" class="hover:text-yellow-400 transition-colors flex items-center">
            <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2"></span>Gestão de Terceiros
          </a></li>
        </ul>
      </div>
    </div>

    {{-- Informações de Contato --}}
    <div class="border-t border-gray-800 mt-8 pt-8">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-300">
        <div>
          <strong class="text-white">Telefone:</strong><br>
          {{ config('platforms.contact.phone') }}
        </div>
        <div>
          <strong class="text-white">E-mail:</strong><br>
          {{ config('platforms.contact.email') }}
        </div>
        <div>
          <strong class="text-white">Endereço:</strong><br>
          {{ config('platforms.contact.address') }}
        </div>
      </div>
    </div>

    {{-- Copyright --}}
    <div class="border-t border-gray-800 mt-8 pt-8 text-center">
      <p class="text-gray-400 text-sm">
        &copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
      </p>
    </div>
  </x-container>
</footer>
