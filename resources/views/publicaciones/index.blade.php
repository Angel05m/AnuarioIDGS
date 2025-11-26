@extends('layouts.app')
@section('title', 'Mis publicaciones')

@push('styles')
<style>
  :root{
    --utesc-base:#129990;
    --utesc-light:#90D1CA;
    --page-navy:#0f2b3a;
  }

  .page-bg{ background: var(--page-navy); }

  .toolbar{
    background:#ffffff;
    border:1px solid #e5e7eb;
    border-radius:1rem;
    padding:0.85rem 1.25rem;
    margin-top:-0.7rem;
    margin-bottom:1rem;
    box-shadow:0 8px 28px rgba(2, 8, 23, .10);
    display:flex;
    flex-wrap:wrap;
    align-items:center;
    gap:0.85rem;
  }

  .toolbar .search,
  .toolbar .select{
    position:relative;
    flex:1;
    min-width:220px;
    background:#fff;
    color:#0f172a;
    border:1px solid var(--utesc-base) !important;
    border-radius:.9rem;
    box-shadow:0 1px 2px rgba(0,0,0,.03) inset;
  }

  .toolbar .search input{
    width:100%;
    background:#fff;
    color:#0f172a;
    border:none;
    border-radius:.9rem;
    padding:.68rem .9rem .7rem 2.1rem;
    font-size:.97rem;
    outline:none !important;
    box-shadow:none !important;
    appearance:none;
  }

  .toolbar .search .icon{
    position:absolute;
    left:.75rem;
    top:50%;
    transform:translateY(-50%);
    color:#6b7280;
    pointer-events:none;
  }

  .toolbar .search input::placeholder{ color:#6b7280; }

  .toolbar .search:focus-within{
    border-color:var(--utesc-base) !important;
    box-shadow:0 0 0 3px rgba(18,153,144,.18) !important;
  }

  .toolbar .select{
    padding:.68rem .95rem;
    font-size:.97rem;
  }

  .toolbar .select:focus{
    outline:none;
    border:1px solid var(--utesc-base) !important;
    box-shadow:0 0 0 2px rgba(18,153,144,.15);
  }

  .toolbar .btn-primary{
    background:#0f7f77;
    color:#fff;
    font-weight:700;
    border-radius:.9rem;
    padding:.68rem 1rem;
    font-size:.97rem;
    display:inline-flex;
    align-items:center;
    gap:.4rem;
    box-shadow:
      0 10px 20px rgba(15,127,119,.22),
      inset 0 0 0 1px rgba(255,255,255,.22);
    transition:filter .2s;
  }

  .toolbar .btn-primary:hover{ filter:brightness(.96); }

  .card-hover{
    transition:all .3s cubic-bezier(.4,0,.2,1);
  }
  .card-hover:hover{ transform:translateY(-6px); }

  /* Tooltip negro (texto "Reaccionar") ABAJO del botón */
  .tooltip{
    visibility:hidden;
    position:absolute;
    background:rgba(0,0,0,.85);
    color:#fff;
    padding:6px 10px;
    border-radius:6px;
    font-size:12px;
    white-space:nowrap;
    z-index:1000;
    top:90%;
    left:50%;
    transform:translateX(-50%);
  }
  .has-tooltip:hover .tooltip{ visibility:visible; }

  /* =======================================================
     ==========   AREA DE REACCIONES (LIKE + LISTA) =========
     ======================================================= */

  .like-wrapper{
    position:relative;
    display:inline-flex;
    align-items:center;
    gap:.5rem;
  }

  /* 🔽 DROPDOWN HACIA ABAJO (lista de usuarios) */
.likes-dropdown{
    position:absolute;
    bottom:130%;   /* <-- ESTE hace que suba */
    top:auto;      /* <-- Desactiva top */
    left:0;
    width:220px;
    max-height:220px;
    overflow:auto;
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:12px;
    box-shadow:0 12px 30px rgba(0,0,0,.18);
    padding:8px;
    display:none;
    z-index:200;

}

  .like-wrapper:hover .likes-dropdown{
    display:block;
  }

  .likes-dropdown .title{
    font-size:12px;
    font-weight:800;
    color:#0f172a;
    margin-bottom:6px;
  }

  .likes-dropdown .user{
    font-size:12px;
    padding:6px 8px;
    border-radius:8px;
    display:flex;
    align-items:center;
    gap:6px;
  }

  .likes-dropdown .user:hover{
    background:#f3f4f6;
  }

  .likes-dropdown .dot{
    width:6px;height:6px;border-radius:50%;
    background:var(--utesc-base);
    flex-shrink:0;
  }

  .likes-dropdown .empty{
    font-size:12px;color:#6b7280;padding:6px 8px;
  }

  @media (max-width:640px){
    .toolbar .search, .toolbar .select{ min-width:100%; }
    .toolbar .btn-primary{ width:100%; justify-content:center; }
  }
</style>
@endpush

@section('content')
  @if(session('success'))
    <div id="alert-success"
         class="mb-4 rounded-2xl p-4 flex items-center bg-white/80 border border-emerald-200 transition-all duration-500">
      <svg class="w-6 h-6 mr-3 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
              clip-rule="evenodd"/>
      </svg>
      <p class="font-medium text-slate-800">{{ session('success') }}</p>
    </div>
  @endif

  {{-- Barra de filtros --}}
  <div class="toolbar toolbar--sm mb-2 md:mb-3">
    <form
      id="filters"
      method="GET"
      action="{{ ($mine ?? false) ? route('publications.index') : route('dashboard') }}"
      class="flex items-center gap-3 flex-wrap w-full"
    >
      {{-- Buscador --}}
      <div class="search w-full sm:w-auto" style="max-width:380px;">
        <span class="icon">🔎</span>
        <input
          id="search-input"
          type="search"
          name="q"
          value="{{ request('q') }}"
          placeholder="Buscar publicaciones..."
        >
      </div>

      {{-- Categoría --}}
      <select name="categoria" class="select" onchange="this.form.submit()">
        <option value="all">📁 Todas las categorías</option>
        @foreach($categorias as $cat)
          <option value="{{ $cat }}" @selected(request('categoria')===$cat)>{{ $cat }}</option>
        @endforeach
      </select>

      {{-- Estado (solo en "Mis publicaciones") --}}
      @if(!empty($showOwnerActions) && $showOwnerActions)
        <select name="estado" class="select" onchange="this.form.submit()">
          <option value="all">📊 Todos los estados</option>
          <option value="publicado" @selected(request('estado')==='publicado')>✅ Publicado</option>
          <option value="borrador"  @selected(request('estado')==='borrador')>📝 Borrador</option>
        </select>
      @endif

      {{-- Botón crear --}}
      <a href="{{ route('publications.create') }}" class="btn-primary ml-auto">
        <span class="text-lg leading-none">＋</span> Nueva publicación
      </a>
    </form>
  </div>

  {{-- Contenedor azul del grid --}}
  <div class="page-bg -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 pt-2 pb-8 rounded-2xl">
    @php use Illuminate\Support\Str; @endphp

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @if($publications->isEmpty())
        <div class="col-span-1 md:col-span-2 lg:col-span-3 rounded-3xl p-16 text-center border border-white/10 bg-white/5 backdrop-blur-sm">
          <div class="w-28 h-28 mx-auto mb-6 rounded-full flex items-center justify-center text-5xl
                      bg-gradient-to-br from-[var(--utesc-base)] to-[var(--utesc-light)] text-white shadow-xl">
            📸
          </div>
          <h3 class="text-3xl font-bold mb-3 text-white">¡Comienza tu galería!</h3>
          <p class="text-lg text-white/80 mb-8">No hay publicaciones aún. Crea la primera.</p>
          <a href="{{ route('publications.create') }}" class="btn-primary text-lg">Crear primera publicación</a>
        </div>
      @else
        @foreach($publications as $publication)
          @php
            $imgPath = $publication->imagen;
            $imgUrl  = null;
            if ($imgPath) {
              $imgPath = Str::replaceFirst('public/', '', $imgPath);
              $imgPath = Str::replaceFirst('storage/', '', $imgPath);
              $imgUrl  = asset('storage/'.$imgPath);
            }
            $shownAt   = $publication->fecha_publicacion ?? $publication->created_at;
            $likedByMe = in_array($publication->id, $likedPubIds ?? []);
          @endphp

          <article
            class="card-hover rounded-2xl p-1 bg-gradient-to-br from-[var(--utesc-base)] to-[var(--utesc-light)] shadow-lg"
          >
            <div class="rounded-xl overflow-hidden bg-white">
              {{-- IMAGEN / PORTADA --}}
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

                {{-- Etiqueta de estado SOLO en "Mis publicaciones" --}}
                @if(!empty($showOwnerActions) && $showOwnerActions)
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
                @endif

                {{-- Overlay de acciones al pasar el cursor --}}
                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity
                            flex items-center justify-center gap-4">
                  <a href="{{ route('publications.show', ['publication'=>$publication, 'back'=>request()->fullUrl()]) }}"
                     class="p-3 bg-white/90 rounded-full hover:bg-white transition transform hover:scale-110">
                    <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                  </a>

                  @if(!empty($showOwnerActions) && $showOwnerActions && auth()->id() === $publication->user_id)
                    <a href="{{ route('publications.edit', $publication) }}"
                       class="p-3 bg-white/90 rounded-full hover:bg-white transition transform hover:scale-110">
                      <svg class="w-6 h-6 text-[var(--utesc-base)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                      </svg>
                    </a>
                  @endif
                </div>
              </div>

              {{-- CUERPO DE LA TARJETA --}}
              <div class="p-6 text-slate-900">
                @if($publication->categoria)
                  <span class="inline-block px-3 py-1 text-xs font-bold rounded-full mb-3
                                bg-[var(--utesc-light)] text-[#003f3a] border-2 border-[var(--utesc-base)]">
                    {{ $publication->categoria }}
                  </span>
                @endif

                <h3 class="text-xl font-bold mb-2 line-clamp-2">
                  <a class="hover:text-[var(--utesc-base)] transition"
                     href="{{ route('publications.show', ['publication'=>$publication, 'back'=>request()->fullUrl()]) }}">
                    {{ $publication->titulo }}
                  </a>
                </h3>

                <div class="flex items-center gap-3 text-xs text-slate-600 mb-3">
                  <div class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A7 7 0 1118.879 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>

                    {{-- Autor clickeable a perfil --}}
                    @if($publication->user_id)
                      <a href="{{ route('perfiles.show', $publication->user_id) }}"
                         class="font-medium hover:text-[var(--utesc-base)] transition">
                        {{ optional($publication->user)->name ?? 'Usuario' }}
                      </a>
                    @else
                      <span class="font-medium">
                        {{ optional($publication->user)->name ?? 'Usuario' }}
                      </span>
                    @endif
                  </div>
                  <span>•</span>
                  <span>{{ $shownAt->format('d/m/Y') }}</span>

                </div>

                @if($publication->descripcion)
                  <p class="text-slate-700 text-sm mb-4 line-clamp-3">
                    {{ $publication->descripcion }}
                  </p>
                @endif

                {{-- ===== FOOTER: REACCIONAR + FECHA ===== --}}
                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                  <div class="flex items-center gap-4">

                    {{-- LIKE + DROPDOWN USUARIOS --}}
                    <div class="like-wrapper has-tooltip"
                         onmouseenter="loadReactionsUsers({{ $publication->id }})">

                      <button type="button"
                              onclick="toggleLike({{ $publication->id }})"
                              class="flex items-center gap-2 text-[var(--utesc-base)] hover:opacity-80 transition relative">
                        <svg class="w-6 h-6 like-icon-{{ $publication->id }}"
                             fill="{{ $likedByMe ? 'var(--utesc-base)' : 'none' }}"
                             stroke="{{ $likedByMe ? 'var(--utesc-base)' : 'currentColor' }}"
                             viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span class="text-sm font-medium like-count-{{ $publication->id }}">
                          {{ $publication->likes_count ?? 0 }}
                        </span>
                        {{-- Tooltip negro pegado abajo del botón --}}
                        <span class="tooltip">Reaccionar</span>
                      </button>

                      {{-- Globito con lista de usuarios --}}
                      <div class="likes-dropdown" id="likes-dropdown-{{ $publication->id }}">
                        <div class="title">Reaccionaron:</div>
                        <div class="body">
                          <div class="empty">Aún no hay reacciones</div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
            </div>
          </article>
        @endforeach

        <div class="col-span-1 md:col-span-2 lg:col-span-3 mt-12">
          {{ $publications->links() }}
        </div>
      @endif
    </div>
  </div>
@endsection

@push('scripts')
<script>
  // Ocultar mensaje de éxito
  (function(){
    const alert = document.getElementById('alert-success');
    if (alert) {
      setTimeout(() => {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-10px)';
        setTimeout(() => alert.remove(), 500);
      }, 10000);
    }
  })();

  const csrfToken  = document.querySelector('meta[name="csrf-token"]').content;
  const loadedUsers = {}; // cache por publicación

  async function toggleLike(id){
    const icon  = document.querySelector(`.like-icon-${id}`);
    const count = document.querySelector(`.like-count-${id}`);

    try{
      const res  = await fetch(`/publications/${id}/like`, {
        method:'POST',
        headers:{
          'Content-Type':'application/json',
          'X-CSRF-TOKEN':csrfToken
        }
      });
      const data = await res.json();

      if(data && (data.success || data.ok)){
        if(typeof data.likes_count !== 'undefined'){
          count.textContent = data.likes_count;
        }

        const liked = !!data.liked;
        icon.style.fill   = liked ? 'var(--utesc-base)' : 'none';
        icon.style.stroke = liked ? 'var(--utesc-base)' : 'currentColor';

        // Para que recargue la lista de nombres al volver a pasar el mouse
        loadedUsers[id] = false;
      }
    }catch(e){
      console.error(e);
    }
  }

  async function loadReactionsUsers(id){
    if(loadedUsers[id]) return;

    const drop = document.getElementById(`likes-dropdown-${id}`);
    if(!drop) return;

    const body = drop.querySelector('.body');
    body.innerHTML = `<div class="empty">Cargando...</div>`;

    try{
      const res  = await fetch(`/publications/${id}/reactions-users`);
      const data = await res.json();

      if(!Array.isArray(data) || data.length === 0){
        body.innerHTML = `<div class="empty">Aún no hay reacciones</div>`;
      } else {
        body.innerHTML = data.map(u => `
          <div class="user">
            <span class="dot"></span>
            <span>${u.name}</span>
          </div>
        `).join('');
      }

      loadedUsers[id] = true;
    }catch(e){
      console.error(e);
      body.innerHTML = `<div class="empty">Error al cargar</div>`;
    }
  }
</script>
@endpush
