<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeria;
use App\Models\MasImagenes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriaController extends Controller
{
    // Guardar imagenes
    public function guardar(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,'
        ]);

        // Guardar apartado principal
        $galeria = Galeria::create([
            'fk_usuario' => Auth::id(),
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
        ]);

        // Guardar imagenes adicionales
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $ruta = $imagen->store('galeria_imagenes', 'public');
                MasImagenes::create([
                    'fk_galeria' => $galeria->pk_galeria,
                    'ruta_imagen' => $ruta,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Galería creada correctamente.');
    }

    // Funcion para mostrar la bodega de galerias
    public function bodega(){
        $galerias = Galeria::with('usuario', 'imagenes')->latest()->paginate(20);
        return view('galeria.bodega', compact('galerias'));
    }

    // Funcion para mostrar el detalle de una galeria
    public function detalle($id){
        $galeria = Galeria::with('usuario', 'imagenes')->findOrFail($id);
        return view('galeria.detalle', compact('galeria'));
    }

}
