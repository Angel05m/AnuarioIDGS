<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Ofertas de trabajo') }}
            </h2>

            <input id="buscadorTrabajo"
                class="bg-white text-gray-700 broder w-3xl border-gray-200 px-2 py-2 rounded-lg shadow" type="text"
                placeholder="Buscar trabajo...">

            <a href="{{ route('publicWork') }}"
                class="bg-teal-800 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition duration-200">
                + Publicar trabajo
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-[#0D2A3F] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Mensajes de éxito --}}
                    @if (session('success'))
                        <div id="success-message" class="mb-4 p-4 text-green-700 bg-green-100 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Si hay trabajos publicados --}}
                    @if ($trabajos->count() > 0)
                        <div class="space-y-6">
                            @foreach ($trabajos as $trabajo)
                                <div
                                    class="flex flex-col sm:flex-row items-start sm:items-center justify-between bg-white p-6 border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition">
                                    <div class="flex items-start gap-4 w-full sm:w-3/4">

                                        {{-- Información del trabajo --}}
                                        <div class="flex flex-col">
                                            <h3 class="text-lg font-semibold text-gray-900">{{ $trabajo->puesto }}</h3>
                                            <p class="text-gray-600 text-sm font-medium">{{ $trabajo->nombre_empresa }}
                                            </p>
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
                        <div class="flex justify-center items-center">
                            <p class="text-white text-2xl py-10">Aún no hay ofertas de trabajo publicadas.</p>
                        </div>
                    @endif

                </div>
            </div>
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

    // Filtro sencillo de trabajos
    const buscador = document.getElementById('buscadorTrabajo');
    const trabajos = document.querySelectorAll('.bg-white.p-6.border');

    // Crear mensaje
    const mensajeNoResultados = document.createElement('p');
    mensajeNoResultados.textContent = 'No se encontraron trabajos, por favor vuelva a buscar.';
    mensajeNoResultados.className = 'text-white text-2xl py-10 text-center hidden';
    // Agregado despues del contenedor
    const contenedor = document.querySelector('.space-y-6');
    if (contenedor) contenedor.parentNode.appendChild(mensajeNoResultados);

    buscador.addEventListener('keyup', () => {
        const texto = buscador.value.toLowerCase();
        let visibles = 0;

        trabajos.forEach(trabajo => {
            const contenido = trabajo.innerText.toLowerCase();
            const coincide = contenido.includes(texto);
            trabajo.style.display = coincide ? '' : 'none';
            if (coincide) visibles++;
        });

        // Mostrar u ocultar el mensaje según el resultado
        mensajeNoResultados.classList.toggle('hidden', visibles > 0);
    });
</script>
