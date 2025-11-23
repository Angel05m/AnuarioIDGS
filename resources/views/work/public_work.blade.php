@section('title', 'Publicar oferta laboral | Anuario IDGS')
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl sm:text-2xl text-teal-600 leading-tight">
                {{ __('Publicación de trabajo') }}
            </h2>
            <button
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition duration-200 cursor-pointer">
                <a href="{{route('trabajos.listado')}}">Cancelar</a>
                
            </button>
        </div>

    </x-slot>

    <div class="py-2 sm:py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900">

                    {{-- NOTIFICACION DE ERROR --}}
                    @if ($errors->any())
                        <div id="success-message" class="mb-4 p-2 bg-red-200 text-red-600 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('guardar.trabajo') }}" method="post" class="flex flex-col ">
                        @csrf
                        <input type="hidden" name="fk_usuario" value="{{ Auth::id() }}">

                        {{--  DATOS DE LA EMPRESA --}}
                        <div class="space-y-4 mb-3 md:pb-0 md:pr-4">
                            <h2 class="text-xl font-medium mb-2">Datos de la empresa </h2>

                            <div>
                                <label class="block text-gray-700">Nombre de la empresa: <span
                                        class="text-red-600">*</span></label>
                                <input type="text" name="nombre_empresa" placeholder="Ej: Microsoft" required
                                    class="mt-1 w-full border border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Correo electrónico:</label>
                                <input type="email" name="correo" placeholder="Ej: correo@gmail.com"
                                    class="mt-1 w-full border border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Teléfono de la empresa:</label>
                                <input type="text" name="telefono" placeholder="Ej: 6699779922" maxlength="10"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                                    class="mt-1 w-full border border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Dirección:</label>
                                <input type="text" name="direccion" placeholder="Ej: Pedro Prado Cordoba. Escuinapa"
                                    class="mt-1 w-full border border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                        </div>

                        {{-- DATOS GENERALES --}}
                        <div class="space-y-4 mt-5">
                            <h2 class="text-xl font-medium mb-2">Detalles del trabajo</h2>

                            <div>
                                <label class="block text-gray-700">Puesto:</label>
                                <input type="text" name="puesto" placeholder="Ej: FullStack"
                                    class="mt-1 w-full border border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Descripción del puesto:</label>
                                <textarea
                                    class="mt-1 w-full border border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                    name="descripcion" id="" cols="30" rows="10"
                                    placeholder="Agrega contenido detallado, promoviendo el puesto"></textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700">Tipo de empleo:</label>
                                <input type="text" name="tipo_empleo" placeholder="Offline"
                                    class="mt-1 w-full border border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Requisitos:</label>
                                <textarea
                                    class="mt-1 w-full border border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                    name="requisito" id="" cols="30" rows="10"
                                    placeholder="Detalla los requisitos que el postulante necesite para trabajar"> 
                                </textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700">Salario:</label>
                                <input type="number" name="salario" min="0" placeholder="Ej: 20000"
                                    maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9)"
                                    class="mt-1 w-full border border-gray-400 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                        </div>

                        <div class=" flex justify-end md:col-span-2 mt-4">
                            <button type="submit"
                                class="w-full md:w-auto bg-teal-600 text-white px-6 py-2 rounded-lg hover:bg-teal-700 transition cursor-pointer">
                                Publicar
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script>
    setTimeout(function() {
        const msg = document.getElementById('success-message');
        if (msg) {
            msg.style.transition = "opacity 0.5s ease";
            msg.style.opacity = 0;
            setTimeout(() => msg.remove(), 300);
        }
    }, 5000);
</script>
