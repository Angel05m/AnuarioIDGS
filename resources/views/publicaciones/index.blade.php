<x-app-layout>
    @section('title', 'Galería de Publicaciones')

    @push('styles')
    <style>
        .glass {
            background: rgba(255, 255, 255, .08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 155, 140, .38);
        }
        .card-hover {
            transition: all .3s cubic-bezier(.4, 0, .2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, .35);
        }
        .tooltip {
            visibility: hidden;
            position: absolute;
            background: rgba(0, 0, 0, .85);
            color: #fff;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 1000;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            margin-bottom: 5px;
        }
        .has-tooltip:hover .tooltip {
            visibility: visible;
        }
    </style>
    @endpush

    {{-- Mensaje de éxito --}}
@if(session('success'))
    <div class="mb-6 glass rounded-2xl p-4 flex items-center text-white">
        <svg class="w-6 h-6 mr-3 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd" />
        </svg>
        <p class="font-medium">{{ session('success') }}</p>
    </div>
@endif

{{-- Galería de publicaciones --}}
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse ($publications as $publication)
        <div class="glass card-hover rounded-2xl overflow-hidden">
            <!-- Imagen -->
            <img src="{{ asset('storage/' . $publication->imagen) }}"
                 alt="Imagen de {{ $publication->titulo }}"
                 class="w-full h-56 object-cover">

            <!-- Contenido -->
            <div class="p-5 flex flex-col gap-3 text-white">
                <h2 class="text-xl font-semibold leading-tight">
                    {{ $publication->titulo }}
                </h2>

                <p class="text-slate-200 line-clamp-3">
                    {{ $publication->contenido }}
                </p>

                <div class="flex justify-between items-center mt-3 text-sm text-slate-300">
                    <span>Publicado por:
                        <span class="font-semibold text-white">
                            {{ $publication->user->name ?? 'Anónimo' }}
                        </span>
                    </span>

                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.485-4.5-5.5-4.5S10 5.765 10 8.25c0 2.486 2.485 4.5 5.5 4.5S21 10.736 21 8.25zM3 8.25c0 2.486 2.485 4.5 5.5 4.5S14 10.736 14 8.25 11.515 3.75 8.5 3.75 3 5.765 3 8.25zM21 15.75c0-2.486-2.485-4.5-5.5-4.5S10 13.265 10 15.75c0 2.486 2.485 4.5 5.5 4.5S21 18.236 21 15.75zM3 15.75c0 2.486 2.485 4.5 5.5 4.5S14 18.236 14 15.75 11.515 11.25 8.5 11.25 3 13.265 3 15.75z" />
                        </svg>
                        <span>{{ $publication->likes_count ?? 0 }}</span>
                    </div>
                </div>

                <!-- BOTONES -->
                <div class="flex justify-between mt-4">
                    <!-- Ver -->
                    <a href="{{ route('publications.show', $publication->id) }}"
                       class="px-3 py-1 bg-emerald-600 hover:bg-emerald-700 rounded-lg text-sm text-white transition">
                        Ver
                    </a>

                    <!-- Editar -->
                    <a href="{{ route('publications.edit', $publication->id) }}"
                       class="px-3 py-1 bg-cyan-600 hover:bg-cyan-700 rounded-lg text-sm text-white transition">
                        Editar
                    </a>

                    <!-- Eliminar -->
                    <form action="{{ route('publications.destroy', $publication->id) }}" method="POST"
                          onsubmit="return confirm('¿Seguro que deseas eliminar esta publicación?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-3 py-1 bg-rose-600 hover:bg-rose-700 rounded-lg text-sm text-white transition">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="text-white">No hay publicaciones disponibles.</p>
    @endforelse
</div>


    {{-- Paginación --}}
    @if ($publications->hasPages())
        <div class="mt-12">
            {{ $publications->links() }}
        </div>
    @endif

    @push('scripts')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Función para dar like
        async function toggleLike(publicationId) {
            try {
                const res = await fetch(`/publications/${publicationId}/like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                const data = await res.json();

                if (data.success) {
                    const icon = document.getElementById(`like-icon-${publicationId}`);
                    const count = document.getElementById(`like-count-${publicationId}`);
                    count.textContent = data.likes_count;

                    if (data.liked) {
                        icon.style.fill = '#009B8C';
                        icon.style.stroke = '#009B8C';
                    } else {
                        icon.style.fill = 'none';
                        icon.style.stroke = 'currentColor';
                    }
                }
            } catch (e) {
                console.error(e);
            }
        }
    </script>
    @endpush
</x-app-layout>
