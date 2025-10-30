<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $trabajo->puesto }}
            </h2>
            <a href="{{ route('trabajos.listado') }}"
               class="bg-gray-200 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-300 transition">
                ← Volver al listado
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="flex flex-col sm:flex-row gap-6 items-start">
                    {{-- TITULO DE LA PUBLICACION --}}
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $trabajo->puesto }}</h1>
                        <p class="text-gray-600 text-lg">{{ $trabajo->nombre_empresa }}</p>
                        <p class="text-gray-500 text-sm mt-1">{{ $trabajo->direccion }}</p>
                        <p class="text-sm mt-2 text-teal-700 font-semibold">
                            ${{ number_format($trabajo->salario, 2) }} MXN
                        </p>
                    </div>
                </div>

                <hr class="my-6">

                {{-- DESCRIPCION DE PUESTO --}}
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Descripción del puesto</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $trabajo->descripcion }}</p>
                </div>

                {{-- REQUISITOS --}}
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">Requisitos</h2>
                    <p class="text-gray-700 leading-relaxed">{{ $trabajo->requisito }}</p>
                </div>

                {{-- INFORMACION ADICIONAL --}}
                <div class="mb-6 grid sm:grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-1">Tipo de empleo</h2>
                        <p class="text-gray-700">{{ $trabajo->tipo_empleo }}</p>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800 mb-1">Publicado por</h2>
                        <p class="text-gray-700">{{ $trabajo->usuario->name ?? 'Usuario desconocido' }}</p>
                    </div>
                </div>

                {{-- CONTACTOS --}}
                <div class="bg-teal-50 border border-teal-200 rounded-lg p-4">
                    <h3 class="font-semibold text-teal-700 mb-1">Contacto</h3>
                    <p class="text-gray-700 text-sm">{{ $trabajo->correo }}</p>
                    <p class="text-gray-700 text-sm">{{ $trabajo->telefono }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
