<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title','Anuario Digital')</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Paleta UTESC -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            utesc: {
              dark: '#0D2A3F',
              dark2:'#0A2536',
              teal: '#009B8C',
              ink:  '#F8FAFC',
              muted:'#CBD5E1'
            }
          },
          borderRadius: { xl2: '1rem' },
          boxShadow: { soft: '0 10px 24px rgba(0,0,0,.25)' }
        }
      }
    }
  </script>

  <style>
    body{
      background: linear-gradient(135deg, #0D2A3F 0%, #0A2536 55%, #081B29 100%);
      background-attachment: fixed;
      color: #F8FAFC;
      min-height: 100vh;
    }
    .glass{ background: rgba(255,255,255,.08); backdrop-filter: blur(10px); border: 1px solid rgba(0,155,140,.38); }
    .btn-primary{
      background: #009B8C; color: #fff; border-radius: 9999px; border: 1px solid rgba(255,255,255,.45);
      box-shadow: 0 10px 22px rgba(0,155,140,.32);
      transition: transform .15s ease, box-shadow .2s ease, background-color .2s ease, color .2s ease;
    }
    .btn-primary:hover{ background:#007F76; box-shadow:0 12px 26px rgba(0,155,140,.4); transform: translateY(-1px); }
    .input-dark{ background: rgba(13,42,63,.65); border: 1.5px solid rgba(255,255,255,.18); color: #F8FAFC; }
    .input-dark::placeholder{ color: rgba(248,250,252,.7); }
    .input-dark:focus{ outline: none; border-color: #009B8C; box-shadow: 0 0 0 3px rgba(0,155,140,.25); }
    @media (min-width: 1024px){ html { font-size: 90%; } }
  </style>

  @stack('styles')
</head>
<body class="text-utesc-ink">

  <!-- HEADER turquesa -->
  <header class="sticky top-0 z-40 bg-utesc-teal text-white shadow-md">
    <div class="max-w-7xl mx-auto px-2 py-4 flex items-center justify-between gap-4">

      <!-- 📸 Flecha + título -->
      <a href="{{ route('publications.index') }}" class="flex items-center gap-2 group pl-10 relative">
        <button type="button" onclick="appGoBack()" aria-label="Volver"
                class="absolute -left-8 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full bg-white/20 hover:bg-white/30 ring-1 ring-white/30 grid place-items-center transition">
          <svg aria-hidden="true" class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
        </button>

        <div class="flex items-center gap-2">
          <div class="text-3xl leading-none">📸</div>
          <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-white drop-shadow-sm">Anuario Digital</h1>
            <p class="text-sm text-white/90 -mt-0.5">Explora, reacciona y comparte</p>
          </div>
        </div>
      </a>

      <!-- Acciones inyectables -->
      <div class="hidden md:flex items-center gap-3 text-white">
        @isset($header) {!! $header !!} @endisset
      </div>

      <!-- Botones lado derecho -->
      <div class="flex items-center gap-3">
        @unless (request()->routeIs('publications.create', 'publications.edit'))
          <a href="{{ route('publications.create') }}" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 btn-primary">
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nueva Publicación
          </a>
        @endunless

        <!-- Usuario -->
        <div class="relative" data-dropdown>
          <button id="userMenuBtn"
                  class="flex items-center gap-3 px-4 py-2 rounded-full bg-white/15 hover:bg-white/25 transition ring-1 ring-white/20">
            <span class="w-9 h-9 rounded-full bg-white/95 text-utesc-teal font-bold grid place-items-center">
              {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
            </span>
            <span class="hidden sm:block font-semibold text-white">
              {{ Auth::user()->name ?? 'Usuario' }}
            </span>
            <svg class="w-5 h-5 text-white/90" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
          </button>

          <!-- Menú -->
          <div id="userMenu"
               class="invisible opacity-0 pointer-events-none absolute right-0 mt-2 w-80 rounded-2xl bg-white text-utesc-dark shadow-2xl ring-1 ring-black/5 transition-all duration-150 origin-top-right z-50">
            <div class="px-5 py-4 border-b border-slate-200">
              <p class="font-bold">Usuario invitado</p>
              <p class="text-sm text-slate-600">invitado@example.com</p>
            </div>
            <nav class="py-2">
              <a href="#" class="flex items-center gap-3 px-5 py-3 hover:bg-slate-50">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Ver perfil
              </a>
              <a href="#" class="flex items-center gap-3 px-5 py-3 hover:bg-slate-50">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M16 3l5 5M16 3v5h5"/>
                </svg>
                Editar perfil
              </a>
              <a href="{{ route('publications.index') }}?mine=1" class="flex items-center gap-3 px-5 py-3 hover:bg-slate-50">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8M8 8h8M4 6h16v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/>
                </svg>
                Mis publicaciones
              </a>
            </nav>
            <div class="px-5 py-3 border-t border-slate-200">
              <a href="{{ url('/login') }}"
                 class="flex items-center gap-3 px-4 py-2 rounded-lg bg-rose-600 text-white font-semibold hover:bg-rose-700 w-full justify-center">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1"/>
                </svg>
                Cerrar sesión
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- CONTENIDO -->
  <main class="max-w-7xl mx-auto px-4 py-8">
    {{ $slot }}  {{-- <<--- CONTENIDO DE LAS PÁGINAS --}}
  </main>

  @stack('scripts')

  <script>
    (function(){
      const btn = document.getElementById('userMenuBtn');
      const menu = document.getElementById('userMenu');
      if(!btn || !menu) return;
      const open = () => menu.classList.remove('invisible','opacity-0','pointer-events-none');
      const close = () => menu.classList.add('invisible','opacity-0','pointer-events-none');
      btn.addEventListener('click', (e)=>{ e.stopPropagation(); (menu.classList.contains('invisible') ? open : close)(); });
      document.addEventListener('click', (e)=>{ if (!menu.contains(e.target) && !btn.contains(e.target)) close(); });
      document.addEventListener('keydown', (e)=>{ if (e.key === 'Escape') close(); });
    })();

    function appGoBack() {
      if (window.history.length > 1) window.history.back();
      else window.location.href = "{{ route('publications.index') }}";
    }
  </script>
</body>
</html>
