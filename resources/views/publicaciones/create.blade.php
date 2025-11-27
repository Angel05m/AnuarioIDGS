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
