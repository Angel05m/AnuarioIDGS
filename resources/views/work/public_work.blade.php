<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publicación de trabajo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 text-gray-900">

                    {{-- Errores --}}
                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Éxito --}}
                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('guardar.trabajo') }}" method="post"
                        class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        <input type="hidden" name="fk_usuario" value="{{ Auth::id() }}">

                        {{--  Datos de la empresa --}}
                        <div class="space-y-4 border-b md:border-b-0 md:border-r border-gray-200 pb-4 md:pb-0 md:pr-4">
                            <h2 class="text-xl font-medium mb-2">Datos de la empresa</h2>

                            <div>
                                <label class="block text-gray-700">Nombre de la empresa</label>
                                <input type="text" name="nombre_empresa"
                                    class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Correo electrónico</label>
                                <input type="text" name="correo"
                                    class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Teléfono de la empresa</label>
                                <input type="text" name="telefono"
                                    class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Dirección</label>
                                <input type="text" name="direccion"
                                    class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                        </div>

                        {{-- Detalles del trabajo --}}
                        <div class="space-y-4 md:pl-4">
                            <h2 class="text-xl font-medium mb-2">Detalles del trabajo</h2>

                            <div>
                                <label class="block text-gray-700">Puesto</label>
                                <input type="text" name="puesto"
                                    class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Descripción del puesto</label>
                                <textarea class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                    name="descripcion" id="" cols="30" rows="10"></textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700">Tipo de empleo</label>
                                <input type="text" name="tipo_empleo"
                                    class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>

                            <div>
                                <label class="block text-gray-700">Requisitos</label>
                                <textarea class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500" name="requisito" id="" cols="30" rows="10"></textarea>
                            </div>

                            <div>
                                <label class="block text-gray-700">Salario</label>
                                <input type="number" name="salario"  min="0"
                                    class="mt-1 w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500">
                            </div>
                        </div>

                        <div class="md:col-span-2 mt-4">
                            <button type="submit"
                                class="w-full md:w-auto bg-teal-500 text-gray-800 px-6 py-2 rounded hover:bg-teal-600 transition">
                                Publicar
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
