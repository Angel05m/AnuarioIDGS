{{-- resources/views/publicaciones/edit.blade.php --}}
<x-app-layout>
  @push('styles')
  <style>
    :root{
      --utesc-base:#129990;
      --utesc-light:#90D1CA;
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


    .btn-primary{
      background:var(--utesc-base); color:#fff; border-radius:.8rem;
      padding:.85rem 1.25rem; font-weight:700;
      box-shadow:0 10px 20px rgba(18,153,144,.18), inset 0 0 0 1px rgba(255,255,255,.25);
      transition:filter .2s, transform .08s;
    }
    .btn-primary:hover{ filter:brightness(.95); }

    /* Espaciado general — deja igual arriba y abajo */
    .page-wrapper{
      padding-top:0.0rem;  /* espacio arriba */
      padding-bottom:0.0rem; /* espacio abajo */
    }

    /* Modal */
    .modal-backdrop{ position:fixed; inset:0; background:rgba(2,6,23,.6);
      display:none; align-items:center; justify-content:center; z-index:50; padding:1rem; }
    .modal-backdrop.show{ display:flex; }
    .modal-card{ width:100%; max-width:480px; border-radius:1rem; background:#fff;
      border:1px solid rgba(225,29,72,.35); box-shadow:0 25px 60px rgba(2,6,23,.35); }
  </style>
  @endpush

  {{-- Contenedor general con espaciado superior e inferior iguales --}}
  <div class="page-wrapper max-w-7xl mx-auto sm:px-6 lg:px-8">

    {{-- Cabecera --}}
    <div class="card-shell mb-6">
      <div class="card-inner p-6">
        <div class="flex items-center justify-between gap-4">
          <div>
            <h2 class="text-3xl font-extrabold">Editar Publicación</h2>
            <p class="text-slate-600">Modifica los detalles de tu publicación</p>
          </div>
          <a href="{{ route('publications.show', $publication) }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[var(--utesc-base)] text-white font-semibold shadow hover:opacity-95 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Ver
          </a>

        </div>
      </div>
    </div>

    {{-- Formulario principal --}}
    <div class="card-shell">
      <div class="card-inner p-6">
        <form action="{{ route('publications.update', $publication) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          @include('publicaciones._form')
        </form>
      </div>
    </div>

    {{-- Form oculto para DELETE --}}
    <form id="deleteForm" action="{{ route('publications.destroy', $publication) }}" method="POST" class="hidden">
      @csrf
      @method('DELETE')
    </form>
  </div>

  {{-- Modal confirmación --}}
  <div id="deleteModal" class="modal-backdrop" aria-hidden="true">
    <div class="modal-card">
      <div class="p-6">
        <h3 class="text-xl font-bold text-slate-900 mb-2">Eliminar publicación</h3>
        <p class="text-slate-600">Esta acción no se puede deshacer. ¿Deseas eliminarla definitivamente?</p>
        <div class="mt-6 flex justify-end gap-3">
          <button type="button" id="closeDelete"
                  class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 bg-white hover:bg-slate-50">
            Cancelar
          </button>
          <button type="button" id="confirmDelete"
                  class="px-4 py-2 rounded-lg bg-rose-600 text-white font-semibold hover:opacity-95">
            Sí, eliminar
          </button>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
  <script>
    document.addEventListener('click', (e) => {
      if (e.target.closest('.openDelete')) {
        document.getElementById('deleteModal')?.classList.add('show');
      }
    });
    document.getElementById('closeDelete')?.addEventListener('click', () =>
      document.getElementById('deleteModal')?.classList.remove('show')
    );
    document.getElementById('deleteModal')?.addEventListener('click', (e) => {
      if (e.target.id === 'deleteModal') e.currentTarget.classList.remove('show');
    });
    document.getElementById('confirmDelete')?.addEventListener('click', () =>
      document.getElementById('deleteForm')?.submit()
    );
  </script>
  @endpush
</x-app-layout>
