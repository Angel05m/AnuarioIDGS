<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ofertas de trabajo') }}
            </h2>
            <a href="{{ route('publicWork') }}"
               class="bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition duration-200">
                + Publicar trabajo
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Mensajes de éxito --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Si hay trabajos publicados --}}
                    @if ($trabajos->count() > 0)
                        <div class="space-y-6">
                            @foreach ($trabajos as $trabajo)
                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between bg-white p-6 border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition">
                                    <div class="flex items-start gap-4 w-full sm:w-3/4">

                                        {{-- Información del trabajo --}}
                                        <div class="flex flex-col">
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $trabajo->puesto }}</h3>
                                            <p class="text-gray-600 text-sm font-medium">{{ $trabajo->nombre_empresa }}</p>
                                            <p class="text-gray-500 text-sm mt-1">{{ $trabajo->direccion }}</p>

                                            <div class="flex flex-wrap gap-2 mt-3">
                                                <span class="px-2 py-1 text-xs bg-teal-100 text-teal-700 rounded-md">
                                                    {{ $trabajo->tipo_empleo }}
                                                </span>
                                                <span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded-md">
                                                    Publicado {{ $trabajo->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Información secundaria --}}
                                    <div class="mt-4 sm:mt-0 text-right sm:w-1/4">
                                        <p class="text-teal-700 font-semibold text-lg">
                                            ${{ number_format($trabajo->salario, 2) }}
                                        </p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            Publicado por:
                                            <span class="font-medium text-gray-700">
                                                {{ $trabajo->usuario->name ?? 'Usuario desconocido' }}
                                            </span>
                                        </p>

                                        <a href="{{ route('ver.trabajo', $trabajo->pk_bolsa_trabajo) }}"
                                           class="mt-3 inline-block text-sm text-teal-600 hover:text-teal-800 font-semibold">
                                            Ver detalles →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-10">Aún no hay ofertas de trabajo publicadas.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
