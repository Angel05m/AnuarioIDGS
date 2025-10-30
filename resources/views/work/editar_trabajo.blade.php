<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editar trabajo') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900">

                    {{-- NOTIFICACION DE ERROR --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-400 text-red-600">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('trabajo.actualizar', $trabajo->pk_bolsa_trabajo) }}" method="post"
                        class="flex flex-col">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="fk_usuario" value="{{ Auth::id() }}">

                        {{-- DATOS DE LA EMPRESA --}}
                        <div class="space-y-4 mb-3 md:pb-0 md:pr-4">
                            <h2 class="text-xl font-medium mb-2">Datos de la empresa</h2>

                            <div>
                                <label class="block text-gray-700">Nombre de la empresa:</label>
                                <input type="text" name="nombre_empresa" placeholder="Ej: Microsoft" required
                                    value="{{ old('nombre_empresa', $trabajo->nombre_empresa) }}"
                                    class="mt-1 w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Correo electrónico:</label>
                                <input type="email" name="correo" placeholder="Ej: correo@gmail.com" required
                                    value="{{ old('correo', $trabajo->correo) }}"
                                    class="mt-1 w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Teléfono de la empresa:</label>
                                <input type="text" name="telefono" placeholder="Ej: 6699779922" maxlength="10" required
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                                    value="{{ old('telefono', $trabajo->telefono) }}"
                                    class="mt-1 w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Dirección:</label>
                                <input type="text" name="direccion" placeholder="Ej: Pedro Prado Cordoba. Escuinapa" required
                                    value="{{ old('direccion', $trabajo->direccion) }}"
                                    class="mt-1 w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                        </div>

                        {{-- DATOS GENERALES --}}
                        <div class="space-y-4 mt-5">
                            <h2 class="text-xl font-medium mb-2">Detalles del trabajo</h2>

                            <div>
                                <label class="block text-gray-700">Puesto:</label> 
                                <input type="text" name="puesto" placeholder="Ej: FullStack" required
                                    value="{{ old('puesto', $trabajo->puesto) }}"
                                    class="mt-1 w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Descripción del puesto:</label>
                                <textarea
                                    class="mt-1 w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                    name="descripcion" required cols="30" rows="10" placeholder="Agrega contenido detallado, promoviendo el puesto">{{ old('descripcion', $trabajo->descripcion) }}</textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700">Tipo de empleo:</label>
                                <input type="text" name="tipo_empleo" placeholder="Offline"
                                    value="{{ old('tipo_empleo', $trabajo->tipo_empleo) }}"
                                    class="mt-1 w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Requisitos:</label>
                                <textarea
                                    class="mt-1 w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                    name="requisito" cols="30" rows="10" required
                                    placeholder="Detalla los requisitos que el postulante necesite para trabajar">{{ old('requisito', $trabajo->requisito) }}</textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700">Salario:</label>
                                <input type="number" name="salario" min="0" placeholder="Ej: 20000" required
                                    maxlength="9" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9)"
                                    value="{{ old('salario', $trabajo->salario) }}"
                                    class="mt-1 w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                        </div>

                        <div class="flex justify-end md:col-span-2 mt-4">
                            <button type="submit"
                                class="w-full md:w-auto bg-teal-600 text-white px-6 py-2 rounded hover:bg-teal-600 transition">
                                Actualizar información
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
