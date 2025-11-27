<<<<<<< HEAD
{{-- resources/views/publicaciones/create.blade.php --}}
<x-app-layout>
  @push('styles')
  <style>
    :root{
      --utesc-base:#129990;   /* verde oscuro institucional */
      --utesc-light:#90D1CA;  /* verde celeste institucional */
    }

    /* Tarjeta superior delgada (igual que index) */
    .card-shell{
      padding:0.5px;                    /* Borde más delgado */
      border-radius:1rem;
      background:linear-gradient(135deg,var(--utesc-base),var(--utesc-light));
    }
    .card-inner{
      background:#fff;
      border-radius:.95rem;
      padding:1.25rem 1.5rem;           /* reduce altura interior */
    }

        /* Reduce el margen superior del bloque principal */
    .py-8 {
      padding-top: 1.5rem !important;   /* antes eran 2rem (py-8) */
    }

    /* Botón principal verde */
    .btn-primary{
      background:var(--utesc-base); color:#fff; border-radius:.8rem;
      padding:.85rem 1.25rem; font-weight:700;
      box-shadow:
        0 10px 20px rgba(18,153,144,.18),
        inset 0 0 0 1px rgba(255,255,255,.25);
      transition: filter .2s ease, transform .08s ease;
    }
    .btn-primary:hover{ filter:brightness(.95); }
    .btn-primary:active{ transform: translateY(1px); }

    /* Inputs siempre con borde verde */
    input[type="text"],
    input[type="search"],
    input[type="email"],
    input[type="file"],
    select,
    textarea{
      background:#fff;
      color:#111827;
      border:1.5px solid var(--utesc-base) !important;
      border-radius:.8rem;
      box-shadow:none !important;
      outline:none !important;
    }
    input:focus, select:focus, textarea:focus{
      border-color:var(--utesc-base) !important;
      box-shadow:0 0 0 3px rgba(18,153,144,.16) !important;
      outline:none !important;
    }

    /* Etiquetas y textos en negro */
    label, h1, h2, h3, p, span { color:#0f172a; } /* slate-900 */
    .muted{ color:#334155; } /* slate-700 */

    /* Dropzone (del _form) forzada a blanco */
    #dropzone{
      border:2px dashed rgba(0,155,140,.55) !important;
      background:#fff !important;
      border-radius:1rem;
    }
    #dropzone:hover{ border-color:var(--utesc-base) !important; }

    /* Secciones internas con borde suave */
    .section{
      background:#fff;
      border-radius:1rem;
      border:1px solid rgba(18,153,144,.25);
    }
  </style>
  @endpush

<div class="pt-0 pb-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

    {{-- Cabecera interna (igual al edit) --}}
    <div class="card-shell mb-6">
      <div class="card-inner p-6">
        <div class="flex items-center justify-between gap-4">
          <div>
            <h2 class="text-3xl font-extrabold">Nueva Publicación</h2>
            <p class="muted">Captura los detalles de tu publicación</p>
          </div>
          
          <a href="{{ route('publications.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[var(--utesc-base)] text-white font-semibold shadow hover:opacity-95 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Mis publicaciones
          </a>

          </a>
        </div>
      </div>
    </div>

    {{-- Formulario principal (mismo parcial que edit) --}}
    <div class="card-shell">
      <div class="card-inner p-6">
        <form action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          {{-- TOKEN ÚNICO PARA EVITAR DUPLICADOS --}}
          <input type="hidden" name="submission_token" value="{{ \Illuminate\Support\Str::uuid() }}">

          @include('publicaciones._form')
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
=======
<x-app-layout>

@section('title', 'Nueva Publicación – Anuario Digital')

@section('content')
  <div class="glass rounded-2xl p-6 mb-6 border border-utesc-teal/50">
    <div class="flex items-center justify-between gap-4">
      <div>
        <h2 class="text-3xl font-extrabold text-white mb-1">Nueva Publicación</h2>
        <p class="text-white/80">Crea una nueva entrada para tu galería</p>
      </div>
      <a href="{{ route('publications.index') }}" class="inline-flex items-center px-5 py-2.5 btn-primary">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Volver
      </a>
    </div>
  </div>

  <form action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data">
    @include('publicaciones._form')
  </form>

</x-app-layout>
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
