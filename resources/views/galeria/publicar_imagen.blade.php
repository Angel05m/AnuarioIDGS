<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ __('Publicaciones de imagenes') }}
            </h2>

            <button onclick="window.history.back()"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition duration-200 cursor-pointer">
                Volver
            </button>
        </div>
    </x-slot>
    <div class="bg-white p-4 border border-gray-300 rounded-lg shadow">
        <form action="{{route('galeria.guardar_imagenes')}}" method="post" enctype="multipart/form-data" class="flex flex-col">
            @csrf
            <input type="hidden" name="fk_usuario" value="{{ Auth::id() }}">
            <div class="flex flex-col gap-2">
                <label for="" class="">Titulo</label>
                <input class="border border-gray-300 p-3 rounded-lg" type="text" name="titulo" required>
            </div>

            <div class="flex flex-col gap-2">
                <label for="" class="">Descripción</label>
                <textarea class="border border-gray-300 p-3 rounded-lg" name="descripcion" id="" cols="30" rows="10"></textarea>
            </div>

            <label for="fileInput" class="block mb-2 font-medium text-gray-700">Subir imágenes</label>
            <div id="dropzone"
                class="flex flex-col items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-xl p-6 text-center bg-gray-50 hover:bg-gray-100 transition cursor-pointer relative">

                <!-- Contenido inicial -->
                <div id="placeholder" class="flex flex-col items-center justify-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16V4m0 0L3 8m4-4l4 4M17 8v12m0 0l4-4m-4 4l-4-4" />
                    </svg>
                    <p class="text-gray-600">Arrastra tus imágenes aquí o
                        <span class="text-blue-500 font-semibold">haz clic para seleccionar</span>
                    </p>
                </div>

                <input id="fileInput" type="file" name="imagenes[]" accept="image/*" multiple class="hidden">

                <!-- Previsualizaciones dentro del dropzone -->
                <div id="preview" class="mt-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 w-full"></div>
            </div>

            <div class="flex w-full justify-center mt-4">
                <button type="submit"
                    class="w-1/4 bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 transition duration-200 cursor-pointer">Guardar</button>
            </div>
        </form>
    </div>

</x-app-layout>


<script>
    const dropzone = document.getElementById('dropzone');
    const input = document.getElementById('fileInput');
    const preview = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder');
    let filesArray = [];

    // Click en el contenedor abre el input
    dropzone.addEventListener('click', () => input.click());

    // Cambiar estilos cuando se arrastran archivos encima
    dropzone.addEventListener('dragover', e => {
        e.preventDefault();
        dropzone.classList.add('border-blue-500', 'bg-blue-50');
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('border-blue-500', 'bg-blue-50');
    });

    dropzone.addEventListener('drop', e => {
        e.preventDefault();
        dropzone.classList.remove('border-blue-500', 'bg-blue-50');
        const newFiles = Array.from(e.dataTransfer.files);
        filesArray = filesArray.concat(newFiles);
        mostrarPrevisualizacion();
    });

    input.addEventListener('change', e => {
        const newFiles = Array.from(e.target.files);
        filesArray = filesArray.concat(newFiles);
        mostrarPrevisualizacion();
    });

    function mostrarPrevisualizacion() {
        preview.innerHTML = '';
        placeholder.style.display = filesArray.length > 0 ? 'none' : 'flex';

        filesArray.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = e => {
                const div = document.createElement('div');
                div.className = "relative group";
                div.innerHTML = `
                    <img src="${e.target.result}" alt="preview"
                        class="w-full  object-cover rounded-lg shadow-sm border border-gray-200">
                    <button type="button" data-index="${index}"
                        class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full px-2 py-1 opacity-0 group-hover:opacity-100 transition cursor-pointer">
                        ✕
                    </button>
                `;
                preview.appendChild(div);
            };
            reader.readAsDataURL(file);
        });

        // Botones de eliminación (con stopPropagation)
        setTimeout(() => {
            document.querySelectorAll('#preview button').forEach(btn => {
                btn.addEventListener('click', e => {
                    e.stopPropagation(); // <- evita que se abra el panel de selección
                    const index = parseInt(e.target.dataset.index);
                    filesArray.splice(index, 1);
                    mostrarPrevisualizacion();
                });
            });
        }, 50);
    }
</script>
