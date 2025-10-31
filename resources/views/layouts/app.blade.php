{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', config('app.name'))</title>

  {{-- Vite/Tailwind --}}
  @vite(['resources/css/app.css','resources/js/app.js'])

  {{-- Pila de estilos por página --}}
  @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
  <div class="min-h-screen bg-gray-100">

    {{-- Barra superior / navegación --}}
    @include('layouts.navigation')

    {{-- Encabezado opcional (Jetstream) --}}
    @isset($header)
      <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          {{ $header }}
        </div>
      </header>
    @endisset

    {{-- Contenido: sección o slot --}}
    <main class="py-8">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 px-4">
        @hasSection('content')
          @yield('content')
        @else
          {{ $slot ?? '' }}
        @endif
      </div>
    </main>
  </div>

  {{-- Pila de scripts por página --}}
  @stack('scripts')
</body>
</html>
