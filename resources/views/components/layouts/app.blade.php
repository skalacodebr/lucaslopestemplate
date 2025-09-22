<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    {{ seo()->render() }}

    @stack('head')

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- UI Enhancements CSS -->
    <link rel="stylesheet" href="{{ asset('css/ui-enhancements.css') }}">

    <!-- Homepage specific assets -->
    @if(request()->routeIs('home'))
      <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @endif
  </head>

  <body class="font-sans text-base leading-normal tracking-normal text-gray-800">
    <div class="flex flex-col min-h-screen">
      <x-sections.header />

      <div class="flex-1">
        {{ $slot }}
      </div>

      <x-sections.footer />
    </div>

    @livewireScriptConfig
    @stack('scripts')

    <!-- UI Interactions JavaScript -->
    <script src="{{ asset('js/ui-interactions.js') }}"></script>

    <!-- Homepage specific JavaScript -->
    @if(request()->routeIs('home'))
      <script src="{{ asset('js/home.js') }}"></script>
    @endif
  </body>
</html>
