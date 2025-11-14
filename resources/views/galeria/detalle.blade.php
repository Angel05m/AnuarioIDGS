<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ __('Detalles de publicación') }}
            </h2>
            <button onclick="window.history.back()"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition duration-200 cursor-pointer">
                Volver
            </button>
        </div>
    </x-slot>

    <div class="">
        <div class="">
            <img class=""
                src="{{ $galeria->usuario->foto_perfil
                    ? asset('storage/' . $galeria->usuario->foto_perfil)
                    : 'https://ui-avatars.com/api/?name=' . urlencode($galeria->usuario->name) . '&background=14b8a6&color=fff' }}"
                alt="{{ $galeria->usuario->name }}">
            <div>
                <h3 class="">{{ $galeria->usuario->name }}</h3>
                <p class="">Publicado {{ $galeria->created_at->diffForHumans() }}</p>
            </div>


            <div>
                <h2 class="">{{ $galeria->titulo }}</h2>
                <p class="">
                    {{ $galeria->descripcion }}
                </p>
            </div>




            <div class="">
                @forelse ($galeria->imagenes as $imagen)
                    <div class="">
                        <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" class=""
                            alt="{{ $galeria->titulo }}">
                    </div>
                @empty
                    <p class="">No hay imágenes disponibles.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
