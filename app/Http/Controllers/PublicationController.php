<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicationController extends Controller
{



    // INDEX — listado con búsqueda y filtros
    public function index(Request $request)
    {
        $search   = $request->query('q', '');
        $category = $request->query('categoria', 'all');
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
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%")
                  ->orWhere('contenido', 'like', "%{$search}%");
            });
        }

        $publications = $query->latest()->paginate(12)->withQueryString();

        $categorias = Publication::select('categoria')
            ->whereNotNull('categoria')
            ->where('categoria', '!=', '')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        return view('publicaciones.index', compact('publications', 'categorias'));
    }

    // CREATE
    public function create()
    {
        return view('publicaciones.create');
    }

    // STORE — guardar nueva publicación
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'      => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string', 'max:300'],
            'contenido'   => ['required', 'string'],
            'categoria'   => ['nullable', 'string', 'max:100'],
            'estado'      => ['required', 'in:borrador,publicado'],
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

        $validated = $request->validate([
            'titulo'      => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string', 'max:300'],
            'contenido'   => ['required', 'string'],
            'categoria'   => ['nullable', 'string', 'max:100'],
            'estado'      => ['required', 'in:borrador,publicado'],
            'imagen'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        if ($request->hasFile('imagen')) {
            if ($publication->imagen) {
                Storage::disk('public')->delete($publication->imagen);
            }
            $validated['imagen'] = $request->file('imagen')->store('publicaciones', 'public');
        }

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
    }
}
