{{-- resources/views/publicaciones/show.blade.php --}}
@extends('layouts.app')
@section('title', $publication->titulo.' – Anuario Digital')

@push('styles')
<style>
  :root{
    --utesc-base:#129990;   /* verde oscuro */
    --utesc-light:#90D1CA;  /* verde claro */
  }
  .glass{background:rgba(255,255,255,.08);backdrop-filter:blur(10px);border:1px solid rgba(18,153,144,.35)}
  .badge{display:inline-flex;align-items:center;font-weight:700;border-radius:9999px;padding:.4rem .9rem}
  .badge-green{background:var(--utesc-base);color:#fff;box-shadow:0 8px 20px rgba(18,153,144,.25)}
  .badge-soft{background:linear-gradient(90deg,var(--utesc-light),var(--utesc-base));color:#083f3b;border:1px solid rgba(255,255,255,.5)}
  .title{color:#0f172a}
  .meta{color:#334155}
  .prose{color:#0f172a;line-height:1.8;font-size:1.125rem}
  .prose p + p{margin-top:1rem}
  .cover{width:100%;max-height:560px;object-fit:cover;border-radius:1rem}
  .shadow-xl-soft{box-shadow:0 20px 45px rgba(2,30,25,.18)}
  .chip{display:inline-flex;align-items:center;border:1px solid rgba(18,153,144,.35);color:#0f3a36;background:#fff;border-radius:9999px;padding:.35rem .75rem;font-weight:700}
</style>
@endpush

@section('content')
  {{-- Portada (si existe) --}}
@if($publication->image_url)
  <div class="mb-8">
    <img src="{{ $publication->image_url }}"
         alt="{{ $publication->titulo }}"
         class="cover shadow-xl-soft ring-1 ring-[rgba(18,153,144,.25)] mx-auto block">
  </div>
@endif


  {{-- Tarjeta principal --}}
  <article class="glass rounded-2xl p-6 md:p-8 shadow-2xl text-slate-900">
    {{-- Badges / meta --}}
    <div class="flex flex-wrap items-center gap-3 mb-6">
      @if($publication->estado === 'publicado')
        <span class="badge badge-green">
          <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
          Publicado
        </span>
      @else
        <span class="badge chip">📝 Borrador</span>
      @endif>

      @if($publication->categoria)
        <span class="badge badge-soft">
          {{ $publication->categoria }}
        </span>
      @endif

      <span class="chip">
        <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2zM16 11H8m4 0v6"/>
        </svg>
        {{ $publication->created_at->format('d/m/Y H:i') }}
      </span>
    </div>

    {{-- Título --}}
    <h1 class="title text-3xl md:text-4xl font-extrabold tracking-tight mb-4">
      {{ $publication->titulo }}
    </h1>

    {{-- Descripción corta (si hay) --}}
    @if($publication->descripcion)
      <div class="mb-6 rounded-xl border-l-4 p-4"
           style="border-color: var(--utesc-base); background: linear-gradient(90deg, rgba(144,209,202,.25), rgba(18,153,144,.12));">
        <p class="text-lg italic">{{ $publication->descripcion }}</p>
      </div>
    @endif

    {{-- Contenido --}}
    <div class="prose">
      {!! nl2br(e($publication->contenido)) !!}
    </div>

    {{-- Acciones --}}
    <div class="mt-8 flex flex-wrap gap-3">
      <a href="{{ route('publications.index') }}"
         class="chip hover:brightness-95 transition">← Volver</a>

      @if(auth()->id() === $publication->user_id)
        <a href="{{ route('publications.edit', $publication) }}"
           class="badge badge-green hover:brightness-95 transition">✏️ Editar</a>
      @endif
    </div>
  </article>
@endsection
