<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ __('Galería de publicaciones') }}
            </h2>

            <a href="{{ route('bodega.publicar_imagen') }}">
                Publicar imagenes
            </a>
            <button onclick="window.history.back()"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition duration-200 cursor-pointer">
                Volver
            </button>
        </div>
    </x-slot>

    <div class="p-2">
        <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-5 space-y-5">
            @forelse ($galerias as $galeria)
                @if ($galeria->imagenes->isNotEmpty())
                    <div class="relative overflow-hidden rounded-xl shadow-md break-inside-avoid group">
                        <a href="{{ route('galeria.detalle', $galeria->pk_galeria) }}">
                            <img src="{{ asset('storage/' . $galeria->imagenes->first()->ruta_imagen) }}"
                                alt="{{ $galeria->titulo }}"
                                class="w-full h-auto object-cover rounded-xl transition-all duration-300 group-hover:scale-105">
                            <div
                                class="absolute inset-0 from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                            </div>

                            <div
                                class="absolute bottom-0 left-0 w-full p-4 text-white opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <h3 class="text-lg text-teal-700 font-semibold">{{ $galeria->titulo }}</h3>
                                <p class="text-sm text-teal-700 truncate">
                                    Publicado por {{ $galeria->usuario->name ?? 'Anónimo' }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endif
            @empty
                <p class="text-gray-500 text-center col-span-4">No hay publicaciones por mostrar.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $galerias->links() }}
        </div>
    </div>


</x-app-layout>
