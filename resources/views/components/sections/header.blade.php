<header class="bg-white shadow-soft border-b border-neutral-100 sticky top-0 z-50 backdrop-blur-sm bg-white/95">
  <x-container>
    <nav class="flex items-center justify-between py-4">
      <!-- Logo -->
      <a
        wire:navigate
        href="/"
        class="flex items-center flex-shrink-0"
        aria-label="{{ config('app.name') }}"
      >
        <x-logo />
      </a>

      <!-- Navigation Menu -->
      <div class="hidden lg:flex items-center space-x-8">
        <a href="/" class="text-neutral-700 hover:text-primary-600 font-medium transition-colors nav-indicator">
          Início
        </a>
        <div class="relative group">
          <button class="text-neutral-700 hover:text-primary-600 font-medium transition-colors flex items-center space-x-1">
            <span>Serviços</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>
          <div class="absolute top-full left-0 w-64 bg-white shadow-hard rounded-xl border border-neutral-100 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 mt-2 card-glass">
            <a href="/outsourcing" class="block px-4 py-3 text-neutral-700 hover:bg-neutral-50 hover:text-primary-600">
              <div class="font-medium">Outsourcing de TI</div>
              <div class="text-sm text-neutral-500">Times especializados sob demanda</div>
            </a>
            <a href="/fabrica-software" class="block px-4 py-3 text-neutral-700 hover:bg-neutral-50 hover:text-primary-600">
              <div class="font-medium">Fábrica de Software</div>
              <div class="text-sm text-neutral-500">Desenvolvimento sob medida</div>
            </a>
            <a href="/solucoes-ia" class="block px-4 py-3 text-neutral-700 hover:bg-neutral-50 hover:text-primary-600">
              <div class="font-medium">Soluções com IA</div>
              <div class="text-sm text-neutral-500">Inteligência artificial aplicada</div>
            </a>
            <a href="/consultoria" class="block px-4 py-3 text-neutral-700 hover:bg-neutral-50 hover:text-primary-600">
              <div class="font-medium">Consultoria Estratégica</div>
              <div class="text-sm text-neutral-500">Transformação digital</div>
            </a>
          </div>
        </div>
        <a href="/cases" class="text-neutral-700 hover:text-primary-600 font-medium transition-colors nav-indicator">
          Cases
        </a>
        <a href="/sobre" class="text-neutral-700 hover:text-primary-600 font-medium transition-colors nav-indicator">
          Sobre
        </a>
        <a href="/blog" class="text-neutral-700 hover:text-primary-600 font-medium transition-colors nav-indicator">
          Blog
        </a>
        <a href="/contato" class="text-neutral-700 hover:text-primary-600 font-medium transition-colors nav-indicator">
          Contato
        </a>
      </div>

      <!-- CTA and Mobile Menu -->
      <div class="flex items-center space-x-4">
        <!-- CTA Button -->
        <a
          href="#contato"
          class="hidden lg:flex bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg font-medium transition-all transform hover:scale-105 shadow-medium"
        >
          Falar com Especialista
        </a>

        <!-- Admin Button -->
        <x-button
          :icon="Auth::check() ? 'heroicon-o-cog' : 'heroicon-s-user'"
          size="xs"
          :url="Filament\Pages\Dashboard::getUrl()"
          class="hidden lg:flex"
        >
          {{ Auth::check() ? 'Painel' : 'Login' }}
        </x-button>

        <!-- Mobile Menu Button -->
        <button class="lg:hidden p-2 text-neutral-700 hover:text-primary-600" id="mobile-menu-button">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="lg:hidden hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1 border-t border-neutral-100">
        <a href="/" class="block px-3 py-2 text-neutral-700 hover:text-primary-600 font-medium">Início</a>
        <div class="px-3 py-2">
          <div class="text-neutral-700 font-medium mb-2">Serviços</div>
          <div class="pl-4 space-y-1">
            <a href="/outsourcing" class="block py-1 text-sm text-neutral-600 hover:text-primary-600">Outsourcing de TI</a>
            <a href="/fabrica-software" class="block py-1 text-sm text-neutral-600 hover:text-primary-600">Fábrica de Software</a>
            <a href="/solucoes-ia" class="block py-1 text-sm text-neutral-600 hover:text-primary-600">Soluções com IA</a>
            <a href="/consultoria" class="block py-1 text-sm text-neutral-600 hover:text-primary-600">Consultoria</a>
          </div>
        </div>
        <a href="/cases" class="block px-3 py-2 text-neutral-700 hover:text-primary-600 font-medium">Cases</a>
        <a href="/sobre" class="block px-3 py-2 text-neutral-700 hover:text-primary-600 font-medium">Sobre</a>
        <a href="/blog" class="block px-3 py-2 text-neutral-700 hover:text-primary-600 font-medium">Blog</a>
        <a href="/contato" class="block px-3 py-2 text-neutral-700 hover:text-primary-600 font-medium">Contato</a>
        <div class="px-3 py-2">
          <a href="#contato" class="block w-full bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg font-medium text-center">
            Falar com Especialista
          </a>
        </div>
      </div>
    </div>
  </x-container>
</header>

<script>
// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', function() {
      mobileMenu.classList.toggle('hidden');
    });
  }
});
</script>
