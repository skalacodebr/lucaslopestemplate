<footer class="bg-gray-900 text-white py-12">
  <x-container>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
      {{-- Logo e Descrição --}}
      <div class="md:col-span-2">
        <div class="flex items-center mb-4">
          <img src="{{ asset('logo.jpg') }}" alt="Global SST" class="h-8 w-auto mr-3 brightness-0 invert">
          <span class="text-xl font-bold">Global SST</span>
        </div>
        <p class="text-gray-300 mb-4">
          Especialistas em Saúde e Segurança do Trabalho há mais de 10 anos.
          Sua empresa mais produtiva e segura.
        </p>
        <div class="flex space-x-4">
          <a href="{{ config('platforms.whatsapp.url') }}" target="_blank" class="text-gray-300 hover:text-green-400 transition-colors">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.785"/>
            </svg>
          </a>
        </div>
      </div>

      {{-- Links Rápidos --}}
      <div>
        <h3 class="text-lg font-semibold mb-4">Links Rápidos</h3>
        <ul class="space-y-2 text-gray-300">
          <li><a href="/" class="hover:text-white transition-colors">Home</a></li>
          <li><a href="/sobre" class="hover:text-white transition-colors">Sobre Nós</a></li>
          <li><a href="/servicos" class="hover:text-white transition-colors">Serviços</a></li>
          <li><a href="/blog" class="hover:text-white transition-colors">Blog</a></li>
          <li><a href="/contato" class="hover:text-white transition-colors">Contato</a></li>
        </ul>
      </div>

      {{-- Serviços --}}
      <div>
        <h3 class="text-lg font-semibold mb-4">Serviços</h3>
        <ul class="space-y-2 text-gray-300">
          <li><a href="/servicos#pcmso" class="hover:text-white transition-colors">PCMSO</a></li>
          <li><a href="/servicos#pgr" class="hover:text-white transition-colors">PGR</a></li>
          <li><a href="/servicos#ltcat" class="hover:text-white transition-colors">LTCAT</a></li>
          <li><a href="/servicos#ppp" class="hover:text-white transition-colors">PPP</a></li>
          <li><a href="/servicos#esocial" class="hover:text-white transition-colors">eSocial</a></li>
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
