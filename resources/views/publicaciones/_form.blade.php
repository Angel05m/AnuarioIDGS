@csrf
<div class="space-y-8">

  {{-- ============================
       Sección: Información Básica
       ============================ --}}
  <div class="rounded-xl border-2 border-[#129990] p-6 shadow-sm bg-white">
    <h3 class="text-lg font-bold text-[#129990] mb-4 flex items-center">
      <svg class="w-5 h-5 mr-2 text-[#129990]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
      </svg>
      Información Básica
    </h3>

    <div class="space-y-4 text-gray-800">
      {{-- TÍTULO --}}
      <div>
        <label class="block text-sm font-semibold text-gray-800 mb-1">
          Título <span class="text-[#129990]">*</span>
        </label>
        <input type="text" name="titulo"
               value="{{ old('titulo', $publication->titulo ?? '') }}"
               placeholder="Escribe un título atractivo"
               class="block w-full rounded-lg border-2 border-[#129990] px-4 py-2.5 focus:outline-none focus:ring-0 focus:border-[#129990]"
               required maxlength="255">
      </div>

      {{-- RESUMEN --}}
      <div>
        <label class="block text-sm font-semibold text-gray-800 mb-1">
          Resumen <span class="text-gray-500 text-xs font-normal">(opcional)</span>
        </label>
        <textarea name="descripcion" rows="2"
                  placeholder="Un breve resumen de tu publicación (máx. 300 caracteres)"
                  class="block w-full rounded-lg border-2 border-[#129990] px-4 py-2.5 resize-none focus:outline-none focus:border-[#129990]"
                  maxlength="300">{{ old('descripcion', $publication->descripcion ?? '') }}</textarea>
      </div>

      {{-- CONTENIDO --}}
      <div>
        <label class="block text-sm font-semibold text-gray-800 mb-1">
          Contenido <span class="text-[#129990]">*</span>
        </label>
        <textarea name="contenido" rows="8"
                  placeholder="Escribe el contenido completo de tu publicación..."
                  class="block w-full rounded-lg border-2 border-[#129990] px-4 py-2.5 focus:outline-none focus:border-[#129990]"
                  required>{{ old('contenido', $publication->contenido ?? '') }}</textarea>
      </div>
    </div>
  </div>

  {{-- ============================
       Sección: Imagen de Portada
       ============================ --}}
  <div class="rounded-xl border-2 border-[#129990] p-6 shadow-sm bg-white">
    <h3 class="text-lg font-bold text-[#129990] mb-4 flex items-center">
      <svg class="w-5 h-5 mr-2 text-[#129990]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
      </svg>
      Imagen de Portada <span class="ml-2 text-xs text-gray-500 font-normal">(opcional)</span>
    </h3>

    {{-- Dropzone --}}
    <div id="dropzone"
         class="relative border-2 border-dashed border-[#129990] rounded-xl p-8 text-center bg-white hover:bg-[#f6fffe] transition-colors cursor-pointer">
      <input type="file" id="imagen-input" name="imagen" accept="image/*" class="hidden">

      {{-- Instrucciones --}}
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

      {{-- Vista previa --}}
      <div id="preview-container" class="hidden">
        <div class="relative inline-block">
          <img id="preview-image" src="" alt="Vista previa" class="max-h-64 rounded-lg shadow-md border border-[#129990]">
          <button type="button" id="remove-preview"
                  class="absolute -top-3 -right-3 bg-[#129990] text-white rounded-full p-2 hover:bg-[#0f7a73] transition shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
        <p id="file-name" class="text-sm text-gray-800 mt-3 font-medium"></p>
      </div>
    </div>
  </div>

  {{-- =====================
       Configuración
       ===================== --}}
  <div class="rounded-xl border-2 border-[#129990] p-6 shadow-sm bg-white">
    <h3 class="text-lg font-bold text-[#129990] mb-4 flex items-center">
      <svg class="w-5 h-5 mr-2 text-[#129990]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
      </svg>
      Configuración
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-800">

      {{-- Categoría --}}
      <div>
        <label class="block text-sm font-semibold mb-1 text-gray-800">
          Categoría <span class="text-[#129990]">*</span>
        </label>
        @php $cat = old('categoria', $publication->categoria ?? ''); @endphp
        <select name="categoria"
                class="block w-full rounded-lg border-2 border-[#129990] px-4 py-2.5 bg-white focus:outline-none focus:ring-0 focus:border-[#129990]"
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

      {{-- Estado --}}
      <div>
        <label class="block text-sm font-semibold mb-1 text-gray-800">
          Estado <span class="text-[#129990]">*</span>
        </label>
        @php $estado = old('estado', $publication->estado ?? 'publicado'); @endphp
        <select name="estado"
                class="block w-full rounded-lg border-2 border-[#129990] px-4 py-2.5 bg-white focus:outline-none focus:ring-0 focus:border-[#129990]"
                required>
          <option value="borrador"  @selected($estado==='borrador')>📝 Borrador</option>
          <option value="publicado" @selected($estado==='publicado')>✅ Publicado</option>
        </select>
      </div>
    </div>
  </div>

{{-- Acciones --}}
<div class="mt-6 flex items-center justify-between gap-3">

  {{-- IZQUIERDA: Eliminar (solo en edición) --}}
  @if(isset($publication) && $publication->exists)
    <button type="button"
            onclick="toggleDeleteModal(true)"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-red-200 text-red-700 hover:bg-red-50">
      {{-- icono papelera --}}
      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m-1-3H10a1 1 0 00-1 1v2h8V5a1 1 0 00-1-1z"/>
      </svg>
      Eliminar publicación
    </button>
  @else
    <span></span>
  @endif

  {{-- DERECHA: Cancelar / Guardar --}}
  <div class="ml-auto flex items-center gap-3">
    <a href="{{ isset($publication) ? route('publications.show',$publication) : route('publications.index') }}"
       class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-200 text-slate-700 hover:bg-gray-50">
      Cancelar
    </a>

    <button type="submit" class="btn-primary">
      {{ isset($publication) ? 'Actualizar publicación' : 'Publicar' }}
    </button>
  </div>
</div>



{{-- Script para vista previa --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
  const drop = document.getElementById('dropzone');
  const input = document.getElementById('imagen-input');
  const preview = document.getElementById('preview-container');
  const img = document.getElementById('preview-image');
  const prompt = document.getElementById('upload-prompt');
  const fileName = document.getElementById('file-name');
  const removeBtn = document.getElementById('remove-preview');

  drop.addEventListener('click', () => input.click());
  input.addEventListener('change', e => show(e.target.files[0]));

  drop.addEventListener('dragover', e => { e.preventDefault(); drop.classList.add('bg-[#f0fffd]'); });
  drop.addEventListener('dragleave', e => drop.classList.remove('bg-[#f0fffd]'));
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
    };
    reader.readAsDataURL(file);
  }

  removeBtn.addEventListener('click', e=>{
    e.stopPropagation();
    input.value = '';
    img.src = '';
    prompt.classList.remove('hidden');
    preview.classList.add('hidden');
  });
});
</script>
