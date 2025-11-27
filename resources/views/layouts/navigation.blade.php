@php
    use Illuminate\Support\Facades\Auth;

    $user = Auth::user();
    $avatarUrl = $user?->foto_perfil
        ? asset('storage/'.$user->foto_perfil)   // ajusta si guardas en otra carpeta
        : null;

    $initial = strtoupper(mb_substr($user?->name ?? 'U', 0, 1, 'UTF-8'));
@endphp

<nav x-data="{ open: false, logoutOpen: false }"
     class="bg-[#009B8C] border-b border-[#058578] shadow mb-8">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- LADO IZQUIERDO: Logo + Links -->
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo/>
                    </a>
                </div>

                <!-- Navigation Links (desktop) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link class="text-white"
                                :href="route('dashboard')"
                                :active="request()->routeIs('dashboard')">
                        {{ __('Inicio') }}
                    </x-nav-link>

                    <x-nav-link class="text-white"
                                :href="route('trabajos.listado')"
                                :active="request()->routeIs('trabajos.listado')">
                        {{ __('Trabajos') }}
                    </x-nav-link>

                    <x-nav-link class="text-white"
                                :href="route('galeria.bodega')"
                                :active="request()->routeIs('galeria.bodega')">
                        {{ __('Galería') }}
                    </x-nav-link>

                    <x-nav-link class="text-white"
                                :href="route('publications.index')"
                                :active="request()->routeIs('publications.*')">
                        {{ __('Mis publicaciones') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- LADO DERECHO: Dropdown usuario (avatar redondo) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button type="button"
                                class="relative inline-flex items-center justify-center focus:outline-none">
                            {{-- Avatar SIEMPRE 40x40 --}}
                            <div style="
                                width:40px;
                                height:40px;
                                border-radius:9999px;
                                overflow:hidden;
                                border:2px solid #ffffff;
                                background:#ffffff;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                            ">
                                @if($avatarUrl)
                                    <img src="{{ $avatarUrl }}"
                                         alt="Avatar"
                                         style="width:100%;height:100%;object-fit:cover;">
                                @else
                                    <span style="color:#009B8C;font-weight:700;font-size:18px;">
                                        {{ $initial }}
                                    </span>
                                @endif
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- Mi perfil --}}
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Mi perfil') }}
                        </x-dropdown-link>

                        {{-- Usuarios --}}
                        <x-dropdown-link :href="route('perfiles.index')">
                            {{ __('Usuarios') }}
                        </x-dropdown-link>

                        {{-- Publicaciones con submenú --}}
                        <div x-data="{ pubOpen: false }" class="relative">
                            <button @click="pubOpen = !pubOpen"
                                    type="button"
                                    class="w-full text-left text-sm text-gray-700 flex items-center justify-between px-4 py-2 hover:bg-gray-100">
                                <span>{{ __('Publicaciones') }}</span>
                                <svg class="h-4 w-4 text-gray-500 transform"
                                     :class="{ 'rotate-180': pubOpen }"
                                     xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.19l3.71-3.96a.75.75 0 1 1 1.1 1.02l-4.25 4.53a.75.75 0 0 1-1.1 0l-4.25-4.53a.75.75 0 0 1 .02-1.06Z"
                                          clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="pubOpen"
                                 x-transition
                                 @click.away="pubOpen = false"
                                 class="mt-1 mx-2 mb-2 bg-white border border-gray-200 rounded-md shadow-lg overflow-hidden">
                                <a href="{{ route('publications.index') }}"
                                   class="block text-sm text-gray-700 px-4 py-2 hover:bg-gray-100">
                                    {{ __('Mis publicaciones') }}
                                </a>
                                <a href="{{ route('usuario.mis_trabajos') }}"
                                   class="block text-sm text-gray-700 px-4 py-2 hover:bg-gray-100">
                                    {{ __('Trabajos') }}
                                </a>
                                <a href="#"
                                   class="block text-sm text-gray-700 px-4 py-2 hover:bg-gray-100">
                                    {{ __('Contenido') }}
                                </a>
                            </div>
                        </div>

                        <!-- Logout: abre modal -->
                        <x-dropdown-link href="#" @click.prevent="logoutOpen = true">
                            {{ __('Cerrar sesión') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (móvil) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-100 hover:text-white hover:bg-[#00b3a1] focus:outline-none focus:bg-[#00b3a1] focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                              class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }"
         class="hidden sm:hidden bg-[#00425c]">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Inicio') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('trabajos.listado')" :active="request()->routeIs('trabajos.listado')">
                {{ __('Trabajos') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('galeria.bodega')" :active="request()->routeIs('galeria.bodega')">
                {{ __('Galería') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('publications.index')" :active="request()->routeIs('publications.*')">
                {{ __('Mis publicaciones') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-4 border-t border-gray-700 px-4">
            <div class="px-1 mb-3 flex items-center gap-3">
                {{-- Avatar móvil también 40x40 --}}
                <div style="
                    width:36px;
                    height:36px;
                    border-radius:9999px;
                    overflow:hidden;
                    border:1px solid #a5e3dd;
                    background:#ffffff;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                ">
                    @if($avatarUrl)
                        <img src="{{ $avatarUrl }}"
                             alt="Avatar"
                             style="width:100%;height:100%;object-fit:cover;">
                    @else
                        <span style="color:#009B8C;font-weight:700;">
                            {{ $initial }}
                        </span>
                    @endif
                </div>

                <div>
                    <div class="font-medium text-base text-white">{{ $user->name }}</div>
                    <div class="font-medium text-xs text-teal-100">{{ $user->email }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('perfiles.index')">
                    {{ __('Usuarios') }}
                </x-responsive-nav-link>

                <div x-data="{ contenidoOpen: false }" class="relative">
                    <button @click="contenidoOpen = !contenidoOpen"
                            class="w-full font-medium sm:text-sm text-white flex justify-between px-3 py-2 hover:bg-white/10 rounded-md">
                        {{ __('Publicaciones') }}
                        <svg class="h-4 w-4 text-teal-100 transform"
                             :class="{ 'rotate-180': contenidoOpen }"
                             xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.19l3.71-3.96a.75.75 0 1 1 1.1 1.02l-4.25 4.53a.75.75 0 0 1 .02-1.06Z"
                                  clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="contenidoOpen" @click.away="contenidoOpen = false" x-transition
                         class="mt-2 bg-white border border-gray-200 rounded-md shadow-lg overflow-hidden">
                        <a href="{{ route('publications.index') }}"
                           class="block text-sm text-gray-700 px-4 py-2 hover:bg-gray-100">
                            {{ __('Mis publicaciones') }}
                        </a>
                        <a href="{{ route('usuario.mis_trabajos') }}"
                           class="block text-sm text-gray-700 px-4 py-2 hover:bg-gray-100">
                            {{ __('Trabajos') }}
                        </a>
                        <a href="#"
                           class="block text-sm text-gray-700 px-4 py-2 hover:bg-gray-100">
                            {{ __('Contenido') }}
                        </a>
                    </div>
                </div>

                <x-responsive-nav-link href="#" @click.prevent="logoutOpen = true">
                    {{ __('Cerrar sesión') }}
                </x-responsive-nav-link>
            </div>
        </div>
    </div>

    <!-- FORMULARIO REAL DE LOGOUT (oculto) -->
    <form x-ref="logoutForm" method="POST" action="{{ route('logout') }}" class="hidden">
        @csrf
    </form>

    <!-- MODAL PEQUEÑO DE CONFIRMACIÓN -->
    <div x-show="logoutOpen"
         x-cloak
         x-transition.opacity
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/30">

        <div @click.away="logoutOpen = false"
             x-transition.scale
             class="bg-white rounded-xl shadow-xl w-[360px] max-w-[90vw] p-6 border border-gray-100">

            <div class="flex items-start gap-3">
                <div class="mt-1 h-9 w-9 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm0 5a1.25 1.25 0 1 1-1.25 1.25A1.25 1.25 0 0 1 12 7Zm1 9h-2v-6h2Z"/>
                    </svg>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-gray-800">
                        ¿Cerrar sesión?
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Vas a salir de tu cuenta. Podrás volver a entrar cuando quieras.
                    </p>
                </div>
            </div>

            <div class="mt-5 flex justify-end gap-2">
                <button type="button"
                        @click="logoutOpen = false"
                        class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50">
                    Cancelar
                </button>

                <button type="button"
                        @click="$refs.logoutForm.submit()"
                        class="px-4 py-2 text-sm font-medium rounded-lg bg-red-500 text-white hover:bg-red-600 shadow-sm">
                    Sí, cerrar sesión
                </button>
            </div>
        </div>
    </div>
</nav>
