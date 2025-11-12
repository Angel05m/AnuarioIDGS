<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-white leading-tight">
                {{ __('Detalles de publicación') }}
            </h2>
            <button onclick="window.history.back()"
                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition duration-200 cursor-pointer">
                Volver
            </button>
        </div>
    </x-slot>
    <div class="px-6 sm:px-40 mt-5">
        <div class="flex justify-center items-center">

            <div class="px-6 sm:px-40 mt-5">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">

                        <div>
                            <div id="animation-carousel" class="relative w-full" data-carousel="static">
                                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                                    <!-- Item 1 -->
                                    <div class="hidden duration-200 ease-linear" data-carousel-item>
                                        <img src="/docs/images/carousel/carousel-1.svg"
                                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                            alt="...">
                                    </div>
                                    <!-- Item 2 -->
                                    <div class="hidden duration-200 ease-linear" data-carousel-item>
                                        <img src="/docs/images/carousel/carousel-2.svg"
                                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                            alt="...">
                                    </div>
                                    <!-- Item 3 -->
                                    <div class="hidden duration-200 ease-linear" data-carousel-item="active">
                                        <img src="/docs/images/carousel/carousel-3.svg"
                                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                            alt="...">
                                    </div>
                                    <!-- Item 4 -->
                                    <div class="hidden duration-200 ease-linear" data-carousel-item>
                                        <img src="/docs/images/carousel/carousel-4.svg"
                                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                            alt="...">
                                    </div>
                                    <!-- Item 5 -->
                                    <div class="hidden duration-200 ease-linear" data-carousel-item>
                                        <img src="/docs/images/carousel/carousel-5.svg"
                                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                            alt="...">
                                    </div>
                                </div>
                                <!-- Slider controls -->
                                <button type="button"
                                    class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                    data-carousel-prev>
                                    <span
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M5 1 1 5l4 4" />
                                        </svg>
                                        <span class="sr-only">Previous</span>
                                    </span>
                                </button>
                                <button type="button"
                                    class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                                    data-carousel-next>
                                    <span
                                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 6 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 9 4-4-4-4" />
                                        </svg>
                                        <span class="sr-only">Next</span>
                                    </span>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-col space-y-4">
                            <div class="flex items-center space-x-3">
                                <img class="w-12 h-12 rounded-full object-cover bg-gray-700" src=""
                                    alt="">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Juan Pérez</h3>
                                    <p class="text-sm text-gray-500">Publicado hace 2 horas</p>
                                </div>
                            </div>

                            <h2 class="text-xl font-bold text-gray-900">Explorando nuevos destinos</h2>
                            <p class="text-gray-600">
                                Hoy comparto algunas imágenes de mi último viaje a las montañas.
                                Fue una experiencia increíble rodeado de naturaleza y buena compañía.
                            </p>

                            <div class="flex items-center gap-4 pt-2">
                                <button
                                    class="bg-teal-700 text-white px-4 py-2 rounded-lg hover:bg-teal-600 transition">
                                    Me gusta</button>
                                <button
                                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 transition">
                                    Comentar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
