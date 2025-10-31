<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Mis publicaciones de trabajos') }}

            </h2>
            <button onclick="window.history.back()"
                class="bg-gray-600 text-white px-2 py-2 rounded-lg hover:bg-gray-500 transition duration-200 cursor-pointer">
                Volver
            </button>
        </div>

    </x-slot>
    <div class="p-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- NOTIFICACION DE EXITO --}}
            @if (session('success'))
                <div id="success-message" class="flex justify-end mb-4 bg-green-400 text-green-600 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($misTrabajos->isEmpty())
                <p>No has publicado ningún trabajo aún.</p>
            @else
                <div class="grid gap-4 md:grid-cols-2">
                    @foreach ($misTrabajos as $trabajo)
                        <div class="border border-gray-300 rounded-2xl p-4 shadow-sm bg-white">
                            <h2 class="font-semibold text-[#0D2A3F] text-lg">{{ $trabajo->puesto }} -
                                {{ $trabajo->nombre_empresa }}
                            </h2>
                            <p class="text-gray-700 text-justify">{{ Str::limit($trabajo->descripcion, 250) }}</p>
                            <p class="text-sm text-gray-500">Publicado: {{ $trabajo->created_at->format('d/m/Y') }}</p>
                            <div class="mt-2 flex gap-2">
                                <a href="{{ route('ver.trabajo', $trabajo->pk_bolsa_trabajo) }}"
                                    class="text-blue-600 hover:underline">
                                    Ver detalle
                                </a>
                                <a href="{{ route('trabajo.editar', $trabajo->pk_bolsa_trabajo) }}"
                                    class="text-teal-600 hover:underline">
                                    Editar
                                </a>
                                {{-- <a href="#" class="text-red-500 hover:underline">
                                    Deshabilitar
                                </a> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
<script>
    setTimeout(function() {
        const msg = document.getElementById('success-message');
        if (msg) {
            msg.style.transition = "opacity 0.5s ease";
            msg.style.opacity = 0;
            setTimeout(() => msg.remove(), 500);
        }
    }, 5000);
</script>
