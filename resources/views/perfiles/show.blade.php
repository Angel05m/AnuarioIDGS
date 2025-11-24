@extends('layouts.app')
@section('title', 'Perfil de '.$user->name)

@push('styles')
<style>
  :root{
    --utesc-base:#129990;
    --utesc-light:#90D1CA;
  }
  .detail-card{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:1.25rem;
    box-shadow:0 8px 28px rgba(2,8,23,.10);
  }
  .chip{
    display:inline-flex; align-items:center;
    border:1px solid rgba(18,153,144,.35);
    color:#0f3a36; background:#fff;
    border-radius:9999px; padding:.35rem .75rem;
    font-weight:700;
  }
</style>
@endpush

@section('content')

@php
  $foto = $user->profile_photo_path ?? $user->foto_perfil ?? null;
  $fotoUrl = $foto
    ? asset('storage/'.ltrim(str_replace(['public/','storage/'],'',$foto), '/'))
    : null;
@endphp

<article class="detail-card p-8">

  <div class="flex flex-col md:flex-row items-center md:items-start gap-6">

    {{-- Foto grande --}}
    <div>
      @if($fotoUrl)
        <img src="{{ $fotoUrl }}" class="w-36 h-36 rounded-full object-cover border-4 border-[var(--utesc-base)] shadow-lg">
      @else
        <div class="w-36 h-36 rounded-full flex items-center justify-center
                    bg-gradient-to-br from-[var(--utesc-base)] to-[var(--utesc-light)]
                    text-white text-5xl font-bold shadow-lg">
          {{ strtoupper(substr($user->name,0,1)) }}
        </div>
      @endif
    </div>

    {{-- Info --}}
    <div class="w-full">
      <h1 class="text-3xl font-extrabold text-slate-900">
        {{ $user->name }} {{ $user->apaterno }} {{ $user->amaterno }}
      </h1>

      <div class="mt-4 flex flex-wrap gap-2">
        @if(!empty($user->matricula))
          <span class="chip">Matrícula: {{ $user->matricula }}</span>
        @endif
        <span class="chip">{{ $user->email }}</span>
      </div>

      <div class="mt-6 text-slate-700">
        {{-- aquí puedes mostrar más campos si quieres --}}
        <p><strong>Registrado:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
      </div>

      <div class="mt-6">
        <a href="{{ route('perfiles.index') }}"
           class="chip hover:brightness-95 transition">← Volver a perfiles</a>
      </div>
    </div>

  </div>

</article>
@endsection
