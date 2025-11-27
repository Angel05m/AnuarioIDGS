@extends('layouts.app')
@section('title', 'Perfiles')

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
    padding:0.75rem 1rem;
    margin-top:-0.7rem;
    margin-bottom:1rem;
    box-shadow:0 8px 28px rgba(2, 8, 23, .10);
    display:flex; flex-wrap:wrap; gap:.85rem; align-items:center;
  }
  .toolbar .search{
    position:relative; flex:1; min-width:220px;
    background:#fff; border:1px solid var(--utesc-base) !important;
    border-radius:.9rem;
  }
  .toolbar .search input{
    width:100%; border:none; outline:none;
    padding:.68rem .9rem .7rem 2.1rem; border-radius:.9rem;
  }
  .toolbar .search .icon{
    position:absolute; left:.75rem; top:50%;
    transform:translateY(-50%); color:#6b7280;
  }

  .card-hover{ transition:all .25s ease; }
  .card-hover:hover{ transform:translateY(-6px); }

  .chip{
    display:inline-flex; align-items:center;
    border:1px solid rgba(18,153,144,.35);
    color:#0f3a36; background:#fff;
    border-radius:9999px; padding:.25rem .6rem;
    font-weight:700; font-size:.75rem;
  }
</style>
@endpush

@section('content')

  {{-- Barra arriba --}}
  <div class="toolbar">
    <form method="GET" action="{{ route('perfiles.index') }}" class="flex items-center gap-3 flex-wrap w-full">
      <div class="search w-full sm:w-auto" style="max-width:380px;">
        <span class="icon">🔎</span>
        <input type="search" name="q" value="{{ $q ?? '' }}" placeholder="Buscar perfil por nombre, matrícula o correo...">
      </div>
      <button class="ml-auto px-4 py-2 rounded-lg bg-[var(--utesc-base)] text-white font-semibold shadow hover:opacity-95">
        Buscar
      </button>
    </form>
  </div>

  <div class="page-bg -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 pt-3 pb-8 rounded-2xl">

    @if($users->isEmpty())
      <div class="rounded-3xl p-14 text-center border border-white/10 bg-white/5 backdrop-blur-sm text-white">
        <div class="text-5xl mb-4">👤</div>
        <h3 class="text-2xl font-bold mb-2">No hay perfiles</h3>
        <p class="text-white/80">No se encontraron usuarios con ese filtro.</p>
      </div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($users as $u)

          @php
            // ✅ TU COLUMNA REAL DE FOTO
            $foto = $u->foto_perfil ?? null;

            $fotoUrl = $foto
              ? asset('storage/'.ltrim(str_replace(['public/','storage/'],'',$foto), '/'))
              : null;

            $fullName = trim($u->name.' '.$u->apellido_paterno.' '.$u->apellido_materno);
          @endphp

          <a href="{{ route('perfiles.show', $u) }}"
             class="card-hover rounded-2xl p-1 bg-gradient-to-br from-[var(--utesc-base)] to-[var(--utesc-light)] shadow-lg">

            <div class="rounded-xl bg-white overflow-hidden">
              <div class="p-6 flex items-center gap-4">
                {{-- Foto --}}
                <div class="shrink-0">
                  @if($fotoUrl)
                    <img src="{{ $fotoUrl }}" class="w-16 h-16 rounded-full object-cover border-2 border-[var(--utesc-base)] shadow">
                  @else
                    <div class="w-16 h-16 rounded-full flex items-center justify-center
                                bg-gradient-to-br from-[var(--utesc-base)] to-[var(--utesc-light)]
                                text-white text-2xl font-bold">
                      {{ strtoupper(substr($u->name,0,1)) }}
                    </div>
                  @endif
                </div>

                {{-- Datos --}}
                <div class="min-w-0">
                  <h3 class="text-lg font-bold text-slate-900 truncate">
                    {{ $fullName }}
                  </h3>

                  @if(!empty($u->matricula))
                    <div class="chip mt-1">Matrícula: {{ $u->matricula }}</div>
                  @endif

                  <p class="text-sm text-slate-600 mt-2 truncate">{{ $u->email }}</p>
                </div>
              </div>
            </div>

          </a>
        @endforeach
      </div>

      <div class="mt-10">
        {{ $users->links() }}
      </div>
    @endif

  </div>
@endsection
