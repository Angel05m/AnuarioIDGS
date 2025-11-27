<div class="mt-10 border-t border-white/10 pt-5 flex justify-between items-center text-sm text-slate-300">
  <div>
      Publicado por:
      <span class="font-semibold text-white">
          {{ $publication->user->name ?? 'Anónimo' }}
      </span>
  </div>

  @auth
      @if($publication->user_id === auth()->id())
          <div class="flex gap-3">
              <a href="{{ route('publications.edit', $publication->id) }}"
                 class="px-3 py-1 bg-cyan-600 hover:bg-cyan-700 rounded-lg text-sm text-white transition">
                  Editar
              </a>

              <form action="{{ route('publications.destroy', $publication->id) }}" method="POST"
                    onsubmit="return confirm('¿Seguro que deseas eliminar esta publicación?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          class="px-3 py-1 bg-rose-600 hover:bg-rose-700 rounded-lg text-sm text-white transition">
                      Eliminar
                  </button>
              </form>
          </div>
      @endif
  @endauth
</div>
