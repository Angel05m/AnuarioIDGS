<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    // Rutas ya están protegidas con auth/verified en web.php

    public function index(Request $request)
    {
        $search   = $request->query('q', '');
        $category = $request->query('categoria', 'all');
        $estado   = $request->query('estado', 'all');

        // 🔒 SIEMPRE filtrar por el usuario logueado
        $query = Publication::query()
            ->where('user_id', auth()->id())
            ->latest();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%")
                  ->orWhere('contenido', 'like', "%{$search}%");
            });
        }

        if ($category !== 'all') {
            $query->where('categoria', $category);
        }

        if ($estado !== 'all') {
            $query->where('estado', $estado);
        }

        // Mantener filtros en la paginación
        $publications = $query->paginate(10)->appends($request->query());

        // Categorías solo de MIS publicaciones
        $categorias = Publication::query()
            ->where('user_id', auth()->id())
            ->whereNotNull('categoria')
            ->where('categoria', '<>', '')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        return view('publicaciones.index', compact('publications', 'categorias', 'search', 'category', 'estado'));
    }

    public function create()
    {
        return view('publicaciones.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'      => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string', 'max:300'],
            'contenido'   => ['required', 'string'],
            'categoria'   => ['nullable', 'string', 'max:100'],
            'estado'      => ['required', 'in:borrador,publicado'],
            'imagen'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:4096'],
        ]);

        if ($request->hasFile('imagen')) {
            // Guarda en storage/app/public/publicaciones (requiere php artisan storage:link)
            $validated['imagen'] = $request->file('imagen')->store('publicaciones', 'public');
        }

        $validated['user_id'] = auth()->id();

        $publication = Publication::create($validated);

        return redirect()
            ->route('publications.show', $publication)
            ->with('success', '¡Publicación creada!');
    }

    public function show(Publication $publication)
    {
        // Si quieres que NADIE más pueda ver publicaciones ajenas en esta ruta, descomenta:
        // abort_if($publication->user_id !== auth()->id(), 403, 'No autorizado.');

        // Si luego deseas contar vistas: $publication->increment('views_count');

        return view('publicaciones.show', compact('publication'));
    }

    public function edit(Publication $publication)
    {
        $this->authorizeOwner($publication);
        return view('publicaciones.edit', compact('publication'));
    }

    public function update(Request $request, Publication $publication)
    {
        $this->authorizeOwner($publication);

        $validated = $request->validate([
            'titulo'      => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string', 'max:300'],
            'contenido'   => ['required', 'string'],
            'categoria'   => ['nullable', 'string', 'max:100'],
            'estado'      => ['required', 'in:borrador,publicado'],
            'imagen'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:4096'],
        ]);

        if ($request->hasFile('imagen')) {
            if ($publication->imagen) {
                Storage::disk('public')->delete($publication->imagen);
            }
            $validated['imagen'] = $request->file('imagen')->store('publicaciones', 'public');
        }

        $publication->update($validated);

        return redirect()
            ->route('publications.show', $publication)
            ->with('success', '¡Publicación actualizada!');
    }

    public function destroy(Publication $publication)
    {
        $this->authorizeOwner($publication);

        if ($publication->imagen) {
            Storage::disk('public')->delete($publication->imagen);
        }

        $publication->delete();

        return redirect()
            ->route('publications.index')
            ->with('success', 'Publicación eliminada.');
    }

    public function like(Publication $publication, Request $request)
    {
        // Placeholder de like: aquí iría la lógica real (por usuario/IP)
        return response()->json([
            'success'      => true,
            'liked'        => false,
            'likes_count'  => $publication->likes_count,
        ]);
    }

    private function authorizeOwner(Publication $publication): void
    {
        abort_if($publication->user_id !== auth()->id(), 403, 'No autorizado.');
    }
}
