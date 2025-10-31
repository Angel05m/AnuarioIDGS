{{-- resources/views/publicaciones/create.blade.php --}}
<x-app-layout>
  @push('styles')
  <style>
    :root{
      --utesc-base:#129990;   /* verde oscuro institucional */
      --utesc-light:#90D1CA;  /* verde celeste institucional */
    }

    /* Tarjeta verde institucional */
    .card-shell{ padding:1px; border-radius:1rem;
      background:linear-gradient(135deg,var(--utesc-base),var(--utesc-light)); }
    .card-inner{ background:#fff; border-radius:.95rem; }

    /* Botón principal */
    .btn-primary{
      background:var(--utesc-base); color:#fff; border-radius:.8rem;
      padding:.85rem 1.25rem; font-weight:700;
      box-shadow:
        0 10px 20px rgba(18,153,144,.18),
        inset 0 0 0 1px rgba(255,255,255,.25);
      transition:filter .2s ease, transform .08s ease;
    }
    .btn-primary:hover{ filter:brightness(.95); }
    .btn-primary:active{ transform:translateY(1px); }

    /* Inputs y selects en verde (sin gris ni azul) */
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

    label, h1, h2, h3, p, span{ color:#0f172a; } /* texto negro */
    .muted{ color:#334155; } /* gris suave */

    /* Dropzone */
    #dropzone{
      border:2px dashed rgba(0,155,140,.55) !important;
      background:#fff;
      border-radius:1rem;
    }
    #dropzone:hover{ border-color:var(--utesc-base) !important; }
  </style>
  @endpush

  <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

    {{-- Tarjeta institucional (restaurada) --}}
    <div class="card-shell mb-6">
      <div class="card-inner p-6">
        <div class="flex items-center justify-between gap-4">
          <div>
            <h2 class="text-3xl font-extrabold">Nueva Publicación</h2>
            <p class="muted">Crea una nueva entrada para tu galería</p>
          </div>
          <a href="{{ route('publications.index') }}" class="inline-flex items-center btn-primary">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Volver
          </a>
        </div>
      </div>
    </div>

    {{-- Formulario principal --}}
    <div class="card-shell">
      <div class="card-inner p-6">
        <form action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data">
          @include('publicaciones._form')
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
