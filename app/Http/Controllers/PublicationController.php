<?php

namespace App\Http\Controllers;

use App\Models\Publication;
<<<<<<< HEAD
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PublicationController extends Controller
{
    /**
     * Lista SOLO mis publicaciones (pantalla "Mis publicaciones").
     */
=======
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicationController extends Controller
{



    // INDEX — listado con búsqueda y filtros
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
    public function index(Request $request)
    {
        $search   = $request->query('q', '');
        $category = $request->query('categoria', 'all');
<<<<<<< HEAD
        $estado   = $request->query('estado', 'all');

        // Este listado siempre es del usuario logueado
        $query = Publication::query()
            ->where('user_id', auth()->id())
            ->orderByRaw('COALESCE(fecha_publicacion, created_at) DESC');

        if ($search !== '') {
=======
        $status   = $request->query('estado', 'all');
        $mine     = $request->boolean('mine');

        $query = Publication::with('user');

        if ($mine && auth()->check()) {
            $query->where('user_id', auth()->id());
        }

        if ($category !== 'all' && !empty($category)) {
            $query->where('categoria', $category);
        }

        if ($status !== 'all' && !empty($status)) {
            $query->where('estado', $status);
        }

        if (!empty($search)) {
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%")
                  ->orWhere('contenido', 'like', "%{$search}%");
            });
        }

<<<<<<< HEAD
        if ($category !== 'all') {
            $query->where('categoria', $category);
        }

        if ($estado !== 'all') {
            $query->where('estado', $estado);
        }

        $publications = $query->paginate(10)->appends($request->query());

        // Categorías solo de MIS publicaciones
        $categorias = Publication::query()
            ->where('user_id', auth()->id())
            ->whereNotNull('categoria')
            ->where('categoria', '<>', '')
=======
        $publications = $query->latest()->paginate(12)->withQueryString();

        $categorias = Publication::select('categoria')
            ->whereNotNull('categoria')
            ->where('categoria', '!=', '')
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

<<<<<<< HEAD
<<<<<<< HEAD
=======
        // ✅ IDs de publicaciones que ESTE usuario ya reaccionó (por user_id)
        $likedPubIds = DB::table('reactions')
            ->where('user_id', auth()->id())
            ->pluck('publication_id')
            ->toArray();

>>>>>>> fe6e960a27f167dd3e85dbfb495b05202a052cca
        return view('publicaciones.index', [
            'publications'      => $publications,
            'categorias'        => $categorias,
            'search'            => $search,
            'category'          => $category,
            'estado'            => $estado,
            'mine'              => true,
            'showOwnerActions'  => true,
            'pageTitle'         => 'Mis publicaciones',
            'likedPubIds'       => $likedPubIds,   // 👈 IMPORTANTE
        ]);
    }

    /**
     * Feed general (Inicio): todas las publicaciones PUBLICADAS.
     */
    public function feed(Request $request)
    {
        // por defecto sólo publicadas
        $request->merge([
            'estado' => $request->query('estado', 'publicado'),
        ]);

        $search   = $request->query('q', '');
        $category = $request->query('categoria', 'all');
        $estado   = $request->query('estado', 'publicado');

        $query = Publication::query()
            ->orderByRaw('COALESCE(fecha_publicacion, created_at) DESC');

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

        $publications = $query->paginate(10)->appends($request->query());

        // Categorías globales
        $categorias = Publication::query()
            ->whereNotNull('categoria')
            ->where('categoria', '<>', '')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        // ✅ IDs de publicaciones que ESTE usuario ya reaccionó
        $likedPubIds = DB::table('reactions')
            ->where('user_id', auth()->id())
            ->pluck('publication_id')
            ->toArray();

        return view('publicaciones.index', [
            'publications'      => $publications,
            'categorias'        => $categorias,
            'search'            => $search,
            'category'          => $category,
            'estado'            => $estado,
            'mine'              => false,
            'showOwnerActions'  => false,
            'pageTitle'         => 'Publicaciones',
            'likedPubIds'       => $likedPubIds,   // 👈 IMPORTANTE
        ]);
    }

=======
        return view('publicaciones.index', compact('publications', 'categorias'));
    }

    // CREATE
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
    public function create()
    {
        return view('publicaciones.create');
    }

<<<<<<< HEAD
=======
    // STORE — guardar nueva publicación
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'      => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string', 'max:300'],
            'contenido'   => ['required', 'string'],
            'categoria'   => ['nullable', 'string', 'max:100'],
            'estado'      => ['required', 'in:borrador,publicado'],
<<<<<<< HEAD
            'imagen'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:4096'],
            'submission_token' => ['required', 'string'],
        ]);

        $token = $validated['submission_token'];
        if (session()->has("submission_used_$token")) {
            return redirect()
                ->route('publications.index')
                ->with('success', '¡Publicación creada!');
        }
        session(["submission_used_$token" => true]);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('publicaciones', 'public');
        }

        $validated['user_id'] = auth()->id();

        if (($validated['estado'] ?? null) === 'publicado' && empty($validated['fecha_publicacion'])) {
            $validated['fecha_publicacion'] = Carbon::now();
        }

        $publication = Publication::create($validated);

        return redirect()
            ->route('publications.index', $publication)
            ->with('success', '¡Publicación creada!');
    }

    public function show(Publication $publication)
    {
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
=======
            'imagen'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('publicaciones', 'public');
        }

        // 🔹 Asignar usuario autenticado
        $validated['user_id'] = auth()->id();

        Publication::create($validated);

        return redirect()->route('publications.index')->with('success', '¡Publicación creada exitosamente!');
    }

    // SHOW
    public function show(Publication $publication)
    {
        return view('publicaciones.show', compact('publication'));
    }

    // EDIT
    public function edit(Publication $publication)
    {
        // 🔹 Restringe edición solo al autor
        if ($publication->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar esta publicación.');
        }

        return view('publicaciones.edit', compact('publication'));
    }

    // UPDATE
    public function update(Request $request, Publication $publication)
    {
        if ($publication->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para actualizar esta publicación.');
        }
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584

        $validated = $request->validate([
            'titulo'      => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string', 'max:300'],
            'contenido'   => ['required', 'string'],
            'categoria'   => ['nullable', 'string', 'max:100'],
            'estado'      => ['required', 'in:borrador,publicado'],
<<<<<<< HEAD
            'imagen'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:4096'],
        ]);

        if ($request->hasFile('imagen')) {
            if ($publication->imagen && Storage::disk('public')->exists($publication->imagen)) {
=======
            'imagen'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        if ($request->hasFile('imagen')) {
            if ($publication->imagen) {
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
                Storage::disk('public')->delete($publication->imagen);
            }
            $validated['imagen'] = $request->file('imagen')->store('publicaciones', 'public');
        }

<<<<<<< HEAD
<<<<<<< HEAD
        // Si pasa de borrador a publicado y no tenía fecha_publicacion, la ponemos
=======
>>>>>>> fe6e960a27f167dd3e85dbfb495b05202a052cca
        $estadoNuevo = $validated['estado'] ?? $publication->estado;
        if ($estadoNuevo === 'publicado' && empty($publication->fecha_publicacion)) {
            $validated['fecha_publicacion'] = Carbon::now();
        }

        $publication->update($validated);

        return redirect()
            ->route('publications.index', $publication)
            ->with('success', '¡Publicación actualizada!');
    }

    public function destroy(Publication $publication)
    {
        $this->authorizeOwner($publication);

        if ($publication->imagen && Storage::disk('public')->exists($publication->imagen)) {
            Storage::disk('public')->delete($publication->imagen);
        }

        $publication->delete();

        return redirect()
            ->route('publications.index')
            ->with('success', 'La publicación fue eliminada correctamente.');
    }

    /**
     * ✅ Toggle like (por usuario) + actualiza contador.
     */
    public function toggleLike(Publication $publication, Request $request)
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'No autenticado',
            ], 401);
        }

        // ¿Ya había reaccionado este usuario a esta publicación?
        $reaction = DB::table('reactions')
            ->where('publication_id', $publication->id)
            ->where('user_id', $userId)
            ->first();

        if ($reaction) {
            // Quitar like
            DB::table('reactions')->where('id', $reaction->id)->delete();
            $liked = false;
        } else {
            // Dar like
            DB::table('reactions')->insert([
                'publication_id' => $publication->id,
                'user_id'        => $userId,
                'type'           => 'like',
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
            $liked = true;
        }

        // Recalcular total de likes de esa publicación
        $likesCount = DB::table('reactions')
            ->where('publication_id', $publication->id)
            ->count();

        DB::table('publications')
            ->where('id', $publication->id)
            ->update(['likes_count' => $likesCount]);

        return response()->json([
            'success'     => true,
            'liked'       => $liked,
            'likes_count' => $likesCount,
        ]);
    }

    /**
     * ✅ Lista de usuarios que han reaccionado (para el dropdown).
     */
    public function reactionsUsers(Publication $publication)
    {
        $users = DB::table('reactions')
            ->join('users', 'users.id', '=', 'reactions.user_id')
            ->where('reactions.publication_id', $publication->id)
            ->orderBy('reactions.created_at', 'desc')
            ->limit(50)
            ->get([
                'users.name',
            ]);

        return response()->json($users);
    }

    /**
     * Asegura que la publicación pertenece al usuario logueado.
     */
    private function authorizeOwner(Publication $publication): void
    {
        abort_if($publication->user_id !== auth()->id(), 403, 'No autorizado.');
=======
        $publication->update($validated);

        return redirect()->route('publications.show', $publication)->with('success', '¡Publicación actualizada exitosamente!');
    }

    // DESTROY
    public function destroy(Publication $publication)
    {
        if ($publication->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para eliminar esta publicación.');
        }

        if ($publication->imagen) {
            Storage::disk('public')->delete($publication->imagen);
        }

        $publication->delete();

        return redirect()->route('publications.index')->with('success', 'Publicación eliminada correctamente.');
    }

    // LIKE
    public function like(Publication $publication)
    {
        $ip = request()->ip();
        $existing = $publication->reactions()->where('ip_address', $ip)->where('type', 'like')->first();

        if ($existing) {
            $existing->delete();
            $publication->decrement('likes_count');
            $liked = false;
        } else {
            $publication->reactions()->create(['ip_address' => $ip, 'type' => 'like']);
            $publication->increment('likes_count');
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $publication->likes_count,
        ]);
    }

    // VIEWS
    public function addView(Publication $publication)
    {
        $publication->increment('views_count');
        return response()->json([
            'success' => true,
            'views_count' => $publication->views_count,
        ]);
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
    }
}
