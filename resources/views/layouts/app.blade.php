{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('image/logo_anuario.png') }}">

    <title>@yield('title', config('app.name'))</title>

    {{-- Vite/Tailwind (solo una vez) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Estilos inyectados por vistas hijas --}}
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen bg-[#0D2A3F]"> {{-- fondo general tipo “galería” --}}
        @include('layouts.navigation')

        {{-- Encabezado opcional --}}
        @isset($header)
            <header class="mx-auto sm:mx-30 md:mx-30 md:mt-5 p-4 sm:p-0 md:p-0 mt-5 shadow ">
                <div class="max-w-7xl bg-white mx-auto py-6 px-4 sm:px-6 lg:px-8 rounded-xl">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Contenido --}}
        <main class="py-5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @hasSection('content')
                    @yield('content')
                @else
                    {{ $slot ?? '' }}
                @endif
            </div>
        </main>
    </div>

    {{-- Scripts inyectados por vistas hijas --}}
    @stack('scripts')
</body>
</html>
