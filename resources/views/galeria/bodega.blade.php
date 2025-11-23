@section('title', 'Galeria | Anuario IDGS')
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl sm:text-2xl text-teal-600 leading-tight">
                {{ __('Galería de publicaciones') }}
            </h2>

            <a href="{{ route('bodega.publicar_imagen') }}"
                class="bg-teal-600 p-2.5 rounded-lg text-white hover:bg-teal-700 transition">
                Publicar
            </a>
        </div>
    </x-slot>

    <div class="p-2">
        {{-- Mensajes de éxito --}}
        @if (session('success'))
            <div id="success-message" class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-wrap-reverse sm:flex-wrap justify-center gap-6">
            @forelse ($galerias as $galeria)
                @if ($galeria->imagenes->isNotEmpty())
                    <div class="relative overflow-hidden rounded-xl shadow-md break-inside-avoid group">
                        <a href="{{ route('galeria.detalle', $galeria->pk_galeria) }}">
                            <img src="{{ asset('storage/' . $galeria->imagenes->first()->ruta_imagen) }}"
                                alt="{{ $galeria->titulo }}"
                                class="w-80 h-64 sm:w-50 sm:h-50 object-cover rounded-xl transition-all duration-300 group-hover:scale-105">
                            <div
                                class="absolute inset-0 from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                            </div>

                            <div
                                class="absolute bottom-0 left-0 w-full p-4 bg-white opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <h3 class="text-lg text-teal-600 font-semibold">{{ $galeria->titulo }}</h3>
                                <p class="text-sm text-teal-600 truncate">
                                    Publicado por {{ $galeria->usuario->name ?? 'Anónimo' }}
                                </p>
                            </div>
                        </a>
                    </div>
                @endif
            @empty
                <div class="h-128 w-full flex justify-center items-center">
                    <p class="text-white text-sm sm:text-2xl">No hay publicaciones por mostrar.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8 mb-4 p-4 flex justify-center ">
            {{ $galerias->links() }}
        </div>
    </div>


</x-app-layout>
<script>
    setTimeout(function() {
        const msg = document.getElementById('success-message');
        if (msg) {
            msg.style.transition = "opacity 0.5s ease";
            msg.style.opacity = 0;
            setTimeout(() => msg.remove(), 300);
        }
    }, 5000);
</script>
