<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-lg sm:text-2xl text-teal-600 leading-tight">
                {{ __('Detalles de publicación') }}
            </h2>
            <button onclick="window.history.back()"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition duration-200 cursor-pointer">
                Volver
            </button>
        </div>
    </x-slot>

    <div class="py-2 sm:p-4">
        <div class="flex flex-col gap-3">
            <div class="bg-white p-3 sm:p-4 rounded-lg shadow mb-5">
                <div class="flex flex-row gap-3 items-center">
                    <img class="rounded-full w-10 h-10"
                        src="{{ $galeria->usuario->foto_perfil
                            ? asset('storage/' . $galeria->usuario->foto_perfil)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($galeria->usuario->name) . '&background=14b8a6&color=fff' }}"
                        alt="{{ $galeria->usuario->name }}">

                    <div>
                        <h3 class="text-lg sm:text-xl text-teal-600 font-bold">{{ $galeria->usuario->name }}</h3>
                        <div class="p-1.5 text-gray-700 bg-teal-50 border border-teal-200 rounded-lg mt-1.5">
                            <p class="text-[10px] sm:text-sm">Publicado {{ $galeria->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>


                <div class="mt-5">
                    <h2 class="text-xl sm:text-2xl text-teal-700 font-semibold">{{ $galeria->titulo }}</h2>
                    <p class="text-sm sm:text-xl text-gray-600 text-justify">
                        {{ $galeria->descripcion }}
                    </p>
                </div>
            </div>




            <div class="grid grid-cols-3 gap-10">
                @forelse ($galeria->imagenes as $imagen)
                    <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}"
                        class="w-80 h-64 sm:w-auto sm:h-auto object-cover rounded-xl transition-all duration-300 group-hover:scale-105"
                        alt="{{ $galeria->titulo }}">

                @empty
                    <p class="">No hay imágenes disponibles.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
