<header class="text-white bg-blue-900 shadow-lg">
  <x-container>
    <nav class="flex items-center justify-between py-4">
      <a
        wire:navigate
        href="/"
        class="flex items-center flex-shrink-0"
        aria-label="Global SST"
      >
        <x-logo />
      </a>

      {{-- Menu Desktop --}}
      <div class="hidden md:flex items-center space-x-8">
        <a href="/" wire:navigate class="hover:text-orange-300 transition-colors {{ request()->routeIs('home') ? 'text-orange-300 font-semibold' : '' }}">
          Home
        </a>
        <a href="/sobre" wire:navigate class="hover:text-orange-300 transition-colors {{ request()->routeIs('about') ? 'text-orange-300 font-semibold' : '' }}">
          Sobre
        </a>
        <a href="/servicos" wire:navigate class="hover:text-orange-300 transition-colors {{ request()->routeIs('services') ? 'text-orange-300 font-semibold' : '' }}">
          Serviços
        </a>
        <a href="/blog" wire:navigate class="hover:text-orange-300 transition-colors {{ request()->routeIs('post.*') ? 'text-orange-300 font-semibold' : '' }}">
          Blog
        </a>
        <a href="/contato" wire:navigate class="hover:text-orange-300 transition-colors {{ request()->routeIs('contact') ? 'text-orange-300 font-semibold' : '' }}">
          Contato
        </a>
      </div>

      {{-- Ações --}}
      <div class="flex items-center space-x-3">
        {{-- WhatsApp Button --}}
        <a
          href="https://wa.me/5511999999999"
          target="_blank"
          class="hidden sm:flex items-center bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors"
        >
          <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.785"/>
          </svg>
          WhatsApp
        </a>

        {{-- Mobile Menu Button --}}
        <button
          x-data="{ open: false }"
          @click="open = !open"
          class="md:hidden p-2"
          aria-label="Menu"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>

        {{-- Admin Button --}}
        <x-button
          :icon="Auth::check() ? 'heroicon-o-cog' : 'heroicon-s-user'"
          size="xs"
          :url="Filament\Pages\Dashboard::getUrl()"
          class="bg-gray-700 hover:bg-gray-600"
        >
          {{ Auth::check() ? 'Admin' : 'Login' }}
        </x-button>
      </div>
    </nav>

    {{-- Mobile Menu --}}
    <div
      x-data="{ open: false }"
      x-show="open"
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 transform -translate-y-2"
      x-transition:enter-end="opacity-100 transform translate-y-0"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100 transform translate-y-0"
      x-transition:leave-end="opacity-0 transform -translate-y-2"
      class="md:hidden border-t border-blue-800 py-4"
      @click.away="open = false"
    >
      <div class="flex flex-col space-y-4">
        <a href="/" wire:navigate class="block hover:text-orange-300 transition-colors {{ request()->routeIs('home') ? 'text-orange-300 font-semibold' : '' }}">
          Home
        </a>
        <a href="/sobre" wire:navigate class="block hover:text-orange-300 transition-colors {{ request()->routeIs('about') ? 'text-orange-300 font-semibold' : '' }}">
          Sobre
        </a>
        <a href="/servicos" wire:navigate class="block hover:text-orange-300 transition-colors {{ request()->routeIs('services') ? 'text-orange-300 font-semibold' : '' }}">
          Serviços
        </a>
        <a href="/blog" wire:navigate class="block hover:text-orange-300 transition-colors {{ request()->routeIs('post.*') ? 'text-orange-300 font-semibold' : '' }}">
          Blog
        </a>
        <a href="/contato" wire:navigate class="block hover:text-orange-300 transition-colors {{ request()->routeIs('contact') ? 'text-orange-300 font-semibold' : '' }}">
          Contato
        </a>
        <a
          href="https://wa.me/5511999999999"
          target="_blank"
          class="flex items-center text-green-300 hover:text-green-200 transition-colors"
        >
          <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.785"/>
          </svg>
          WhatsApp
        </a>
      </div>
    </div>
  </x-container>
</header>
