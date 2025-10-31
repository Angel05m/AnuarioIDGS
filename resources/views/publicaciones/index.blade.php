@extends('layouts.app')
@section('title', 'Mis publicaciones')

@push('styles')
<style>
  :root{
    --utesc-base:#129990;   /* verde oscuro institucional */
    --utesc-light:#90D1CA;  /* verde celeste institucional */
  }
  .glass{ background:rgba(255,255,255,.08); backdrop-filter:blur(10px); border:1px solid rgba(0,155,140,.28); }
  .card-hover{ transition:all .3s cubic-bezier(.4,0,.2,1); }
  .card-hover:hover{ transform:translateY(-6px); }
  .input-dark{
    background:#ffffff; border:1px solid #e5e7eb; color:#111827;
    box-shadow:0 1px 2px rgba(0,0,0,0.04) inset; border-radius:.75rem; padding:.79rem 1rem .83rem 2.0rem;
  }
  .input-dark:focus{ outline:none; border-color:var(--utesc-base); box-shadow:0 0 0 3px rgba(18,153,144,.16); }

  .fbtn{
    display:inline-flex; align-items:center; gap:.5rem;
    padding:.75rem 1.1rem; border:1px solid #e5e7eb; border-radius:.8rem; background:#fff; color:#0f172a;
  }
  .fbtn:focus, .fbtn:hover{ border-color:var(--utesc-base); box-shadow:0 0 0 3px rgba(18,153,144,.12); }

  /* compactado */
  .btn-primary{
    background:var(--utesc-base); color:#fff; border-radius:.8rem; padding:.7rem 1.15rem; font-weight:600; font-size:.95rem;
    box-shadow:0 10px 20px rgba(18,153,144,.18), inset 0 0 0 1px rgba(255,255,255,.25);
    display:inline-flex; align-items:center;
  }
  .btn-primary:hover{ filter:brightness(.95); }

  .tooltip{visibility:hidden;position:absolute;background:rgba(0,0,0,.85);color:#fff;padding:6px 10px;border-radius:6px;font-size:12px;white-space:nowrap;z-index:1000;bottom:100%;left:50%;transform:translateX(-50%);margin-bottom:6px}
  .has-tooltip:hover .tooltip{visibility:visible}
</style>
@endpush

@section('content')
  @if(session('success'))
    <div class="mb-6 glass rounded-2xl p-4 flex items-center text-gray-900 bg-white/70">
      <svg class="w-6 h-6 mr-3 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
      <p class="font-medium">{{ session('success') }}</p>
    </div>
  @endif

  {{-- Filtros / acciones --}}
  <div class="mb-8 rounded-2xl p-5 bg-white border border-gray-200 shadow-sm">
    <form id="filters" method="GET" action="{{ route('publications.index') }}" class="flex flex-wrap gap-4 items-center w-full">
    
      <div class="flex-1 min-w-[260px]">
        <div class="relative">
          <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none">🔎</span>
          <input id="search-input" type="search" name="q"
                 value="{{ request('q') }}"
                 placeholder="Buscar publicaciones..."
                 class="w-full rounded-xl input-dark pl-12 pr-4 py-3">
        </div>
      </div>

      <select name="categoria" class="fbtn" onchange="this.form.submit()">
        <option value="all">📁 Todas las categorías</option>
        @foreach($categorias as $cat)
          <option value="{{ $cat }}" @selected(request('categoria')===$cat)>{{ $cat }}</option>
        @endforeach
      </select>

      <select name="estado" class="fbtn" onchange="this.form.submit()">
        <option value="all">📊 Todos los estados</option>
        <option value="publicado" @selected(request('estado')==='publicado')>✅ Publicado</option>
        <option value="borrador"  @selected(request('estado')==='borrador')>📝 Borrador</option>
      </select>

      <a href="{{ route('publications.create') }}" class="ml-auto btn-primary">
        <span class="text-lg leading-none mr-2">＋</span> Nueva publicación
      </a>
    </form>
  </div>

  @php use Illuminate\Support\Str; @endphp

  @if($publications->isEmpty())
    <div class="rounded-3xl p-16 text-center border border-gray-200 bg-white">
      <div class="w-28 h-28 mx-auto mb-6 rounded-full flex items-center justify-center text-5xl
                  bg-gradient-to-br from-[var(--utesc-base)] to-[var(--utesc-light)] text-white shadow-xl">📸</div>
      <h3 class="text-3xl font-bold mb-3 text-slate-900">¡Comienza tu galería!</h3>
      <p class="text-lg text-slate-600 mb-8">No hay publicaciones aún. Crea la primera.</p>
      <a href="{{ route('publications.create') }}" class="btn-primary text-lg">Crear primera publicación</a>
    </div>
  @else
    <div id="publications-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($publications as $publication)
        @php
          $imgPath = $publication->imagen;
          $imgUrl  = null;
          if ($imgPath) {
            $imgPath = Str::replaceFirst('public/', '', $imgPath);
            $imgPath = Str::replaceFirst('storage/', '', $imgPath);
            $imgUrl  = asset('storage/'.$imgPath);
          }
        @endphp

        <article
          class="card-hover rounded-2xl p-1 bg-gradient-to-br from-[var(--utesc-base)] to-[var(--utesc-light)] shadow-lg"
          data-titulo="{{ strtolower($publication->titulo) }}"
          data-categoria="{{ strtolower($publication->categoria ?? '') }}"
          data-estado="{{ $publication->estado }}"
          data-id="{{ $publication->id }}"
        >
          <!-- Contenedor interior blanco -->
          <div class="rounded-xl overflow-hidden bg-white">
            <!-- Imagen -->
            <div class="relative h-64 overflow-hidden group">
              @if($imgUrl)
                <img src="{{ $imgUrl }}" alt="{{ $publication->titulo }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
              @else
                <div class="w-full h-full bg-gradient-to-br from-[var(--utesc-base)] to-[var(--utesc-light)]
                            flex items-center justify-center">
                  <svg class="w-20 h-20 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                  </svg>
                </div>
              @endif

              <!-- Badge de estado -->
              <div class="absolute top-4 right-4">
                @if($publication->estado === 'publicado')
                  <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-500 text-white shadow">
                    <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span> Publicado
                  </span>
                @else
                  <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-amber-500 text-white shadow">
                    📝 Borrador
                  </span>
                @endif
              </div>

              <!-- Overlay acciones -->
              <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity
                          flex items-center justify-center gap-4">
                <a href="{{ route('publications.show', $publication) }}"
                   class="p-3 bg-white/90 rounded-full hover:bg-white transition transform hover:scale-110">
                  <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                </a>
                <a href="{{ route('publications.edit', $publication) }}"
                   class="p-3 bg-white/90 rounded-full hover:bg-white transition transform hover:scale-110">
                  <svg class="w-6 h-6 text-[var(--utesc-base)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                  </svg>
                </a>
              </div>
            </div>

            <!-- Contenido -->
            <div class="p-6 text-slate-900">
              @if($publication->categoria)
                <span class="inline-block px-3 py-1 text-xs font-bold rounded-full mb-3
                             bg-[var(--utesc-light)] text-[#003f3a] border-2 border-[var(--utesc-base)]">
                  {{ $publication->categoria }}
                </span>
              @endif

              <h3 class="text-xl font-bold mb-2 line-clamp-2">
                <a class="hover:text-[var(--utesc-base)] transition"
                   href="{{ route('publications.show', $publication) }}">{{ $publication->titulo }}</a>
              </h3>

              @if($publication->descripcion)
                <p class="text-slate-600 text-sm mb-4 line-clamp-2">{{ $publication->descripcion }}</p>
              @endif

              <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <div class="flex items-center gap-4">
                  <button onclick="toggleLike({{ $publication->id }})"
                          class="has-tooltip flex items-center gap-2 text-[var(--utesc-base)] hover:opacity-80 transition relative">
                    <svg class="w-6 h-6 like-icon-{{ $publication->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <span class="text-sm font-medium like-count-{{ $publication->id }}">{{ $publication->likes_count ?? 0 }}</span>
                    <span class="tooltip">Me gusta</span>
                  </button>
                  <div class="has-tooltip flex items-center gap-2 text-slate-700 relative">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <span class="text-sm font-medium">{{ $publication->views_count ?? 0 }}</span>
                    <span class="tooltip">Vistas</span>
                  </div>
                </div>
                <span class="text-xs text-slate-500">{{ $publication->created_at->diffForHumans() }}</span>
              </div>
            </div>
          </div>
        </article>
      @endforeach
    </div>

    <div class="mt-12">{{ $publications->links() }}</div>
  @endif
@endsection

@push('scripts')
<script>
  const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

  async function toggleLike(id){
    const icon = document.querySelector(`.like-icon-${id}`);
    const count = document.querySelector(`.like-count-${id}`);
    try{
      const res = await fetch(`/publications/${id}/like`, {
        method:'POST',
        headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrfToken}
      });
      const data = await res.json();
      if(data && (data.success || data.ok)){
        if(typeof data.likes_count !== 'undefined') count.textContent = data.likes_count;
        const liked = !!data.liked;
        icon.style.fill  = liked ? 'var(--utesc-base)' : 'none';
        icon.style.stroke= liked ? 'var(--utesc-base)' : 'currentColor';
      }
    }catch(e){ console.error(e); }
  }
</script>
@endpush
