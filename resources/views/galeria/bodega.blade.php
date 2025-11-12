<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ __('Galería de publicaciones') }}
            </h2>

            <a href="{{route('bodega.publicar_imagen')}}">
                Publicar imagenes
            </a>
            <button onclick="window.history.back()"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition duration-200 cursor-pointer">
                Volver
            </button>
        </div>
    </x-slot>

    <div class="p-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="grid gap-4">
                <div>
                    <a href="{{route('bodega.detalle')}}">
                        <img class="h-auto max-w-full rounded-lg transition-all duration-300 hover:scale-95"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg" alt="">
                    </a>
                </div>
                <div>
                    <a href="">


                        <img class="h-auto max-w-full rounded-lg transition-all duration-300 hover:scale-95"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg" alt="">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img class="h-auto max-w-full rounded-lg transition-all duration-300 hover:scale-95"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-2.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="grid gap-4">
                <div>
                    <a href="">
                        <img class="h-auto max-w-full rounded-lg transition-all duration-300 hover:scale-95"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-3.jpg" alt="">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img class="h-auto max-w-full rounded-lg transition-all duration-300 hover:scale-95"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-4.jpg" alt="">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img class="h-auto max-w-full rounded-lg transition-all duration-300 hover:scale-95"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-5.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="grid gap-4">
                <div>
                    <a href="">
                        <img class="h-auto max-w-full rounded-lg transition-all duration-300 hover:scale-95"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-6.jpg" alt="">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img class="h-auto max-w-full rounded-lg transition-all duration-300 hover:scale-95"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-7.jpg" alt="">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img class="h-auto max-w-full rounded-lg transition-all duration-300 hover:scale-95"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-8.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="grid gap-4">
                <div>
                    <a href="">
                        <img class="h-auto max-w-full rounded-lg transition-all duration-300 hover:scale-95"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-9.jpg" alt="">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img class="h-auto max-w-full rounded-lg transition-all duration-300 hover:scale-95"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-10.jpg" alt="">
                    </a>
                </div>
                <div>
                    <a href="">
                        <img class="h-auto max-w-full rounded-lg transition-all duration-300 hover:scale-95"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-11.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
        <div class="flex space-x-1 justify-center items-center mt-10">
            <button
                class="bg-white rounded-md border border-teal-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-teal-600 hover:text-white hover:bg-teal-800 hover:border-teal-800 focus:text-white focus:bg-teal-800 focus:border-teal-800 active:border-teal-800 active:text-white active:bg-teal-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                Anterior
            </button>
            <button
                class=" min-w-9 rounded-md bg-teal-800 py-2 px-3 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-teal-700 focus:shadow-none active:bg-teal-700 hover:bg-teal-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                1
            </button>
            <button
                class="bg-white min-w-9 rounded-md border border-teal-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-teal-600 hover:text-white hover:bg-teal-800 hover:border-teal-800 focus:text-white focus:bg-teal-800 focus:border-teal-800 active:border-teal-800 active:text-white active:bg-teal-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                2
            </button>
            <button
                class="bg-white min-w-9 rounded-md border border-teal-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-teal-600 hover:text-white hover:bg-teal-800 hover:border-teal-800 focus:text-white focus:bg-teal-800 focus:border-teal-800 active:border-teal-800 active:text-white active:bg-teal-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                3
            </button>
            <button
                class="bg-white min-w-9 rounded-md border border-teal-300 py-2 px-3 text-center text-sm transition-all shadow-sm hover:shadow-lg text-teal-600 hover:text-white hover:bg-teal-800 hover:border-teal-800 focus:text-white focus:bg-teal-800 focus:border-teal-800 active:border-teal-800 active:text-white active:bg-teal-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2">
                Siguiente
            </button>
        </div>
    </div>


</x-app-layout>
