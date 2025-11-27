@csrf
<<<<<<< HEAD
<div class="space-y-8">

  {{-- =========================
       Información Básica
       ========================= --}}
  <div class="rounded-xl border-2 border-[#129990] p-6 shadow-sm bg-white">
    <h3 class="text-lg font-bold text-[#129990] mb-4 flex items-center">
      <svg class="w-5 h-5 mr-2 text-[#129990]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
=======
<div class="space-y-6">

  {{-- ============================
       Sección: Información Básica
       ============================ --}}
  <div class="glass rounded-xl shadow-2xl p-6">
    <h3 class="text-lg font-bold text-white mb-4 flex items-center">
      <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
      </svg>
      Información Básica
    </h3>

<<<<<<< HEAD
    <div class="space-y-4 text-gray-800">
      {{-- Título --}}
      <div>
        <label class="block text-sm font-semibold text-gray-800 mb-1">Título <span class="text-[#129990]">*</span></label>
        <input type="text" name="titulo"
               value="{{ old('titulo', $publication->titulo ?? '') }}"
               placeholder="Escribe un título atractivo"
               class="block w-full rounded-lg border-2 border-[#129990] px-4 py-2.5 focus:outline-none focus:ring-0 focus:border-[#129990]"
               required maxlength="255">
      </div>

      {{-- Resumen --}}
      <div>
        <label class="block text-sm font-semibold text-gray-800 mb-1">
          Resumen <span class="text-gray-500 text-xs font-normal">(opcional)</span>
        </label>
        <textarea name="descripcion" rows="2"
                  placeholder="Un breve resumen de tu publicación (máx. 300 caracteres)"
                  class="block w-full rounded-lg border-2 border-[#129990] px-4 py-2.5 resize-none focus:outline-none focus:border-[#129990]"
                  maxlength="300">{{ old('descripcion', $publication->descripcion ?? '') }}</textarea>
      </div>

      {{-- Contenido --}}
      <div>
        <label class="block text-sm font-semibold text-gray-800 mb-1">Contenido <span class="text-[#129990]">*</span></label>
        <textarea name="contenido" rows="8"
                  placeholder="Escribe el contenido completo de tu publicación..."
                  class="block w-full rounded-lg border-2 border-[#129990] px-4 py-2.5 focus:outline-none focus:border-[#129990]"
                  required>{{ old('contenido', $publication->contenido ?? '') }}</textarea>
=======
    <div class="space-y-4">
      {{-- TÍTULO --}}
      <div>
        <label class="block text-sm font-semibold text-white mb-1">
          Título <span class="text-utesc-teal">*</span> {{-- UTESC: turquesa --}}
        </label>
        <input type="text" name="titulo"
               value="{{ old('titulo', $publication->titulo ?? '') }}"
               placeholder="Escribe un título atractivo"
               class="block w-full rounded-lg input-dark px-4 py-2.5" {{-- UTESC: input oscuro --}}
               required maxlength="255">
        @error('titulo')
          <p class="text-sm text-rose-300 mt-1 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            {{ $message }}
          </p>
        @enderror
      </div>

      {{-- RESUMEN --}}
      <div>
        <label class="block text-sm font-semibold text-white mb-1">
          Resumen <span class="text-white/70 text-xs font-normal">(opcional)</span>
        </label>
        <textarea name="descripcion" rows="2"
                  placeholder="Un breve resumen de tu publicación (máx. 300 caracteres)"
                  class="block w-full rounded-lg input-dark px-4 py-2.5 resize-none"
                  maxlength="300">{{ old('descripcion', $publication->descripcion ?? '') }}</textarea>
        @error('descripcion')
          <p class="text-sm text-rose-300 mt-1 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            {{ $message }}
          </p>
        @enderror
      </div>

      {{-- CONTENIDO --}}
      <div>
        <label class="block text-sm font-semibold text-white mb-1">
          Contenido <span class="text-utesc-teal">*</span>
        </label>
        <textarea name="contenido" rows="8"
                  placeholder="Escribe el contenido completo de tu publicación..."
                  class="block w-full rounded-lg input-dark px-4 py-2.5"
                  required>{{ old('contenido', $publication->contenido ?? '') }}</textarea>
        @error('contenido')
          <p class="text-sm text-rose-300 mt-1 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            {{ $message }}
          </p>
        @enderror
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
      </div>
    </div>
  </div>

<<<<<<< HEAD
  {{-- =========================
       Imagen de Portada
       ========================= --}}
  <div class="rounded-xl border-2 border-[#129990] p-6 shadow-sm bg-white">
    <h3 class="text-lg font-bold text-[#129990] mb-4 flex items-center">
      <svg class="w-5 h-5 mr-2 text-[#129990]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
      </svg>
      Imagen de Portada <span class="ml-2 text-xs text-gray-500 font-normal">(opcional)</span>
    </h3>

    <div id="dropzone"
         class="relative border-2 border-dashed border-[#129990] rounded-xl p-8 text-center bg-white hover:bg-[#f6fffe] transition-colors cursor-pointer">
      <input type="file" id="imagen-input" name="imagen" accept="image/*" class="hidden">

      <div id="upload-prompt" class="space-y-3">
        <div class="mx-auto w-16 h-16 bg-[#90D1CA]/20 rounded-full flex items-center justify-center">
          <svg class="w-8 h-8 text-[#129990]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
          </svg>
        </div>
        <p class="text-base font-semibold text-gray-800">
          Arrastra tu imagen aquí o <span class="text-[#129990]">haz clic para seleccionar</span>
        </p>
        <p class="text-sm text-gray-600">JPG, PNG o WebP • Máximo 2 MB</p>
      </div>

      <div id="preview-container" class="hidden">
        <div class="relative inline-block">
          <img id="preview-image" src="" alt="Vista previa" class="max-h-64 rounded-lg shadow-md border border-[#129990]">
          <button type="button" id="remove-preview"
                  class="absolute -top-3 -right-3 bg-[#129990] text-white rounded-full p-2 hover:bg-[#0f7a73] transition shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
        <p id="file-name" class="text-sm text-gray-800 mt-3 font-medium"></p>
      </div>
    </div>
  </div>

  {{-- =========================
       Configuración
       ========================= --}}
  <div class="rounded-xl border-2 border-[#129990] p-6 shadow-sm bg-white">
    <h3 class="text-lg font-bold text-[#129990] mb-4 flex items-center">
      <svg class="w-5 h-5 mr-2 text-[#129990]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
=======
  {{-- ============================
       Sección: Imagen de Portada
       ============================ --}}
  <div class="glass rounded-xl shadow-2xl p-6">
    <h3 class="text-lg font-bold text-white mb-4 flex items-center">
      <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
      </svg>
      Imagen de Portada
      <span class="ml-2 text-xs font-normal text-white/70">(opcional)</span>
    </h3>

    <div class="space-y-4">
      {{-- Drag & Drop + click --}}
      <div id="dropzone"
           class="relative border-2 border-dashed border-utesc-teal/60 rounded-xl p-8 text-center
                  hover:border-utesc-teal transition-colors cursor-pointer bg-white/5 hover:bg-white/10 backdrop-blur-sm">
        <input type="file" id="imagen-input" name="imagen" accept="image/*" class="hidden">

        {{-- Instrucciones --}}
        <div id="upload-prompt" class="space-y-3">
          <div class="mx-auto w-16 h-16 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
            </svg>
          </div>
          <p class="text-base font-semibold text-white">
            Arrastra tu imagen aquí o <span class="text-utesc-teal">haz clic para seleccionar</span>
          </p>
          <p class="text-sm text-white/70 mt-1">JPG, PNG o WebP • Máximo 2 MB</p>
        </div>

        {{-- Vista previa NUEVA imagen --}}
        <div id="preview-container" class="hidden">
          <div class="relative inline-block">
            <img id="preview-image" src="" alt="Vista previa" class="max-h-64 rounded-lg shadow-md">
            <button type="button" id="remove-preview"
                    class="absolute -top-3 -right-3 bg-utesc-teal text-white rounded-full p-2 hover:bg-utesc-dark transition shadow-lg">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
          <p id="file-name" class="text-sm text-white mt-3 font-medium"></p>
          <p class="text-xs text-white/70 mt-1">Haz clic en la X para cambiar la imagen</p>
        </div>
      </div>

      @error('imagen')
        <p class="text-sm text-rose-300 flex items-center">
          <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
          {{ $message }}
        </p>
      @enderror

      {{-- Imagen ACTUAL (si existe) --}}
      @if(isset($publication) && $publication->imagen)
        <div class="glass border border-utesc-teal/50 rounded-lg p-4">
          <p class="text-sm font-semibold text-white mb-2">Imagen actual:</p>
          <img src="{{ asset('storage/'.$publication->imagen) }}"
               alt="Imagen actual"
               class="max-h-48 rounded-lg border-2 border-utesc-teal/50 shadow-lg">
          <p class="text-xs text-white/70 mt-2">Si subes una nueva imagen, esta será reemplazada</p>
        </div>
      @endif
    </div>
  </div>

  {{-- =====================
       Sección: Configuración
       ===================== --}}
  <div class="glass rounded-xl shadow-2xl p-6">
    <h3 class="text-lg font-bold text-white mb-4 flex items-center">
      <svg class="w-5 h-5 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
      </svg>
      Configuración
    </h3>

<<<<<<< HEAD
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-800">
      {{-- Categoría --}}
      <div>
        <label class="block text-sm font-semibold mb-1 text-gray-800">Categoría <span class="text-[#129990]">*</span></label>
        @php $cat = old('categoria', $publication->categoria ?? ''); @endphp
        <select name="categoria"
                class="block w-full rounded-lg border-2 border-[#129990] px-4 py-2.5 bg-white focus:outline-none focus:ring-0 focus:border-[#129990]"
=======
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

      {{-- CATEGORÍA --}}
      <div>
        <label class="block text-sm font-semibold text-white mb-1">
          Categoría <span class="text-utesc-teal">*</span>
        </label>
        @php $cat = old('categoria', $publication->categoria ?? ''); @endphp
        <select name="categoria"
                class="block w-full rounded-lg input-dark px-4 py-2.5
                       appearance-none cursor-pointer"
                style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke=%27white%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27M19 9l-7 7-7-7%27/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right .75rem center;background-size:1.5rem;padding-right:2.5rem;"
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
                required>
          <option value="">Selecciona una categoría</option>
          <option value="Avisos"      @selected($cat==='Avisos')>Avisos</option>
          <option value="Eventos"     @selected($cat==='Eventos')>Eventos</option>
          <option value="Noticias"    @selected($cat==='Noticias')>Noticias</option>
          <option value="Arte"        @selected($cat==='Arte')>Arte</option>
          <option value="Fotografía"  @selected($cat==='Fotografía')>Fotografía</option>
          <option value="Tutoriales"  @selected($cat==='Tutoriales')>Tutoriales</option>
        </select>
      </div>

<<<<<<< HEAD
      {{-- Estado --}}
      <div>
        <label class="block text-sm font-semibold mb-1 text-gray-800">Estado <span class="text-[#129990]">*</span></label>
        @php $estado = old('estado', $publication->estado ?? 'publicado'); @endphp
        <select name="estado"
                class="block w-full rounded-lg border-2 border-[#129990] px-4 py-2.5 bg-white focus:outline-none focus:ring-0 focus:border-[#129990]"
=======
      {{-- ESTADO --}}
      <div>
        <label class="block text-sm font-semibold text-white mb-1">
          Estado <span class="text-utesc-teal">*</span>
        </label>
        @php $estado = old('estado', $publication->estado ?? 'publicado'); @endphp
        <select name="estado"
                class="block w-full rounded-lg input-dark px-4 py-2.5
                       appearance-none cursor-pointer"
                style="background-image:url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 fill=%27none%27 viewBox=%270 0 24 24%27 stroke=%27white%27%3E%3Cpath stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27M19 9l-7 7-7-7%27/%3E%3C/svg%3E');background-repeat:no-repeat;background-position:right .75rem center;background-size:1.5rem;padding-right:2.5rem;"
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
                required>
          <option value="borrador"  @selected($estado==='borrador')>📝 Borrador</option>
          <option value="publicado" @selected($estado==='publicado')>✅ Publicado</option>
        </select>
      </div>
<<<<<<< HEAD
    </div>
  </div>

  {{-- =========================
       Acciones (UNA SOLA FILA)
       ========================= --}}
  <div class="mt-6 flex items-center justify-end gap-3">

    {{-- Eliminar (solo si estamos editando) --}}
    @if(isset($publication) && $publication->exists)
      <button type="button"
              class="openDelete inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-rose-600 text-white font-semibold hover:opacity-95 shadow">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-1-3H10a1 1 0 00-1 1v2h8V5a1 1 0 00-1-1z"/>
        </svg>
        Eliminar publicación
      </button>
    @endif

    {{-- Cancelar --}}
    <a href="{{ route('publications.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 bg-white hover:bg-gray-50">
      Cancelar
    </a>

    {{-- Guardar / Actualizar --}}
    <button type="submit"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[var(--utesc-base)] text-white font-semibold hover:opacity-95 shadow">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
      </svg>
      {{ isset($publication) && $publication->exists ? 'Actualizar publicación' : 'Crear publicación' }}
    </button>
  </div>
</div>

{{-- Scripts de la dropzone (igual que ya tenías) --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
  const drop = document.getElementById('dropzone');
  const input = document.getElementById('imagen-input');
  const preview = document.getElementById('preview-container');
  const img = document.getElementById('preview-image');
  const prompt = document.getElementById('upload-prompt');
  const fileName = document.getElementById('file-name');
  const removeBtn = document.getElementById('remove-preview');

  if(!drop) return;

  drop.addEventListener('click', () => input.click());
  input.addEventListener('change', e => show(e.target.files[0]));
  drop.addEventListener('dragover', e => { e.preventDefault(); drop.classList.add('bg-[#f0fffd]'); });
  drop.addEventListener('dragleave', () => drop.classList.remove('bg-[#f0fffd]'));
  drop.addEventListener('drop', e => {
    e.preventDefault();
    const file = e.dataTransfer.files[0];
    input.files = e.dataTransfer.files;
    show(file);
  });

  function show(file){
    if(!file) return;
    if(!file.type.startsWith('image/')){ alert('Selecciona una imagen válida'); return; }
    const reader = new FileReader();
    reader.onload = e => {
      img.src = e.target.result;
      prompt.classList.add('hidden');
      preview.classList.remove('hidden');
      fileName.textContent = file.name;
=======

    </div>
  </div>

  {{-- ===================
       Botones de Acción
       =================== --}}
  <div class="flex items-center justify-between glass rounded-xl p-4 shadow-xl">
    <a href="{{ route('publications.index') }}"
       class="inline-flex items-center text-white hover:text-utesc-teal transition">
      <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      Cancelar
    </a>

    <div class="flex items-center gap-3">
      {{-- Eliminar (si existe) --}}
      @if(isset($publication) && $publication->id)
        <button type="button"
                onclick="toggleDeleteModal(true)"
                class="inline-flex items-center px-6 py-3 rounded-lg bg-rose-600 text-white font-semibold
                       hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-400 transition shadow-lg hover:shadow-xl">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1H9a1 1 0 00-1 1v3M4 7h16"/>
          </svg>
          Eliminar
        </button>
      @endif

      <button type="submit" class="inline-flex items-center px-6 py-3 btn-primary">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ isset($publication) ? 'Actualizar publicación' : 'Guardar publicación' }}
      </button>
    </div>
  </div>

  {{-- ==========================
       Modal eliminar (completo)
       ========================== --}}
  @if(isset($publication) && $publication->id)
    <div id="deleteModal" class="fixed inset-0 z-50 hidden">
      <div class="absolute inset-0 bg-black/60" onclick="toggleDeleteModal(false)"></div>

      <div class="relative max-w-md mx-auto mt-40 w-[92%] sm:w-auto glass rounded-2xl p-6 bg-slate-900/90">
        <div class="flex items-start gap-3">
          <div class="p-2 rounded-full bg-rose-600/20">
            <svg class="w-6 h-6 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 9v4m0 4h.01M4.93 4.93a10 10 0 1014.14 0 10 10 0 00-14.14 0z"/>
            </svg>
          </div>
          <div>
            <h3 class="text-lg font-bold text-white">¿Eliminar publicación?</h3>
            <p class="text-white/80 mt-1">Esta acción no se puede deshacer.</p>
          </div>
        </div>

        <div class="flex justify-end gap-3 mt-6">
          <button type="button" onclick="toggleDeleteModal(false)"
                  class="px-4 py-2 rounded-lg bg-white/10 text-white hover:bg-white/20 transition">
            Cancelar
          </button>

          <button type="button" onclick="submitDelete()"
                  class="px-4 py-2 rounded-lg bg-rose-600 text-white font-semibold hover:bg-rose-700 transition">
            Sí, eliminar
          </button>
        </div>
      </div>
    </div>
  @endif
</div>

{{-- ======================================================
     JS: Drag&Drop + Vista previa + Modal de eliminación
     (NO QUITÉ NADA — es tu misma lógica original)
     ====================================================== --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  const dropzone = document.getElementById('dropzone');
  const fileInput = document.getElementById('imagen-input');
  const uploadPrompt = document.getElementById('upload-prompt');
  const previewContainer = document.getElementById('preview-container');
  const previewImage = document.getElementById('preview-image');
  const fileName = document.getElementById('file-name');
  const removeBtn = document.getElementById('remove-preview');

  if (dropzone) {
    dropzone.addEventListener('click', (e) => {
      if (!e.target.closest('#remove-preview')) fileInput.click();
    });

    ['dragenter','dragover','dragleave','drop'].forEach(ev =>
      dropzone.addEventListener(ev, (e) => { e.preventDefault(); e.stopPropagation(); }, false)
    );

    ['dragenter','dragover'].forEach(ev =>
      dropzone.addEventListener(ev, () => dropzone.classList.add('border-utesc-teal','bg-white/10'))
    );
    ['dragleave','drop'].forEach(ev =>
      dropzone.addEventListener(ev, () => dropzone.classList.remove('border-utesc-teal','bg-white/10'))
    );

    dropzone.addEventListener('drop', (e) => {
      const files = e.dataTransfer.files;
      if (files && files.length) {
        fileInput.files = files;
        handleFiles(files);
      }
    });
  }

  fileInput?.addEventListener('change', (e) => handleFiles(e.target.files));

  function handleFiles(files) {
    if (!files || !files.length) return;
    const file = files[0];

    if (!file.type.startsWith('image/')) {
      alert('Por favor selecciona un archivo de imagen válido');
      return;
    }
    if (file.size > 2 * 1024 * 1024) {
      alert('La imagen debe ser menor a 2 MB');
      fileInput.value = '';
      return;
    }

    const reader = new FileReader();
    reader.onload = (e) => {
      previewImage.src = e.target.result;
      fileName.textContent = file.name;
      uploadPrompt.classList.add('hidden');
      previewContainer.classList.remove('hidden');
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
    };
    reader.readAsDataURL(file);
  }

<<<<<<< HEAD
  removeBtn?.addEventListener('click', e=>{
    e.stopPropagation();
    input.value = '';
    img.src = '';
    prompt.classList.remove('hidden');
    preview.classList.add('hidden');
  });
});
=======
  removeBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    fileInput.value = '';
    previewImage.src = '';
    fileName.textContent = '';
    uploadPrompt.classList.remove('hidden');
    previewContainer.classList.add('hidden');
  });
});

function toggleDeleteModal(show) {
  const m = document.getElementById('deleteModal');
  if (!m) return;
  m.classList.toggle('hidden', !show);
}
function submitDelete() {
  const f = document.getElementById('deleteForm');
  if (f) f.submit();
}
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
</script>
