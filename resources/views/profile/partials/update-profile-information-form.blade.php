<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Información del Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Actualiza la información del perfil y la dirección de correo electrónico de tu cuenta.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- 
        ******************************************************
        * ¡IMPORTANTE! Se añade 'enctype="multipart/form-data"'
        * para permitir la subida de la foto de perfil.
        ******************************************************
    --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- Campo: Foto de Perfil --}}
        <div>
            <x-input-label for="foto_perfil" :value="__('Foto de Perfil')" />
            
            {{-- Muestra la foto actual si existe --}}
            @if ($user->foto_perfil)
                <div class="mt-2 mb-4">
                    <img src="{{ asset('storage/' . $user->foto_perfil) }}" alt="Foto de perfil actual" class="h-20 w-20 rounded-full object-cover border-2 border-gray-200">
                </div>
            @endif
            
            {{-- Input para subir nueva foto --}}
            <input id="foto_perfil" name="foto_perfil" type="file" class="mt-1 block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-md file:border-0
                file:text-sm file:font-semibold
                file:bg-indigo-50 file:text-indigo-700
                hover:file:bg-indigo-100" />
            
            <x-input-error class="mt-2" :messages="$errors->get('foto_perfil')" />
        </div>
        
        {{-- Campo: Nombre --}}
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Campo: Apellido Paterno --}}
        <div>
            <x-input-label for="apellido_paterno" :value="__('Apellido Paterno')" />
            <x-text-input id="apellido_paterno" name="apellido_paterno" type="text" class="mt-1 block w-full" :value="old('apellido_paterno', $user->apellido_paterno)" required autocomplete="apellido-paterno" />
            <x-input-error class="mt-2" :messages="$errors->get('apellido_paterno')" />
        </div>

        {{-- Campo: Apellido Materno --}}
        <div>
            <x-input-label for="apellido_materno" :value="__('Apellido Materno (Opcional)')" />
            <x-text-input id="apellido_materno" name="apellido_materno" type="text" class="mt-1 block w-full" :value="old('apellido_materno', $user->apellido_materno)" autocomplete="apellido-materno" />
            <x-input-error class="mt-2" :messages="$errors->get('apellido_materno')" />
        </div>
        
        {{-- Campo: Matrícula --}}
        <div>
            <x-input-label for="matricula" :value="__('Matrícula')" />
            <x-text-input id="matricula" name="matricula" type="text" class="mt-1 block w-full" :value="old('matricula', $user->matricula)" required autocomplete="matricula" />
            <x-input-error class="mt-2" :messages="$errors->get('matricula')" />
        </div>

        {{-- Campo: Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar Cambios') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Guardado.') }}</p>
            @endif
        </div>
    </form>
</section>