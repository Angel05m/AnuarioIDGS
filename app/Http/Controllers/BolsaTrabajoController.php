<?php

namespace App\Http\Controllers;

use App\Models\BolsaTrabajos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BolsaTrabajoController extends Controller
{
    // Registrar un trabajo
    public function registrar(Request $request)
    {
        $validated = $request->validate([
            'nombre_empresa' => 'required|string|max:200',
            'correo' => 'nullable|email|max:200',
            'telefono' => 'nullable|string|max:15',
            'puesto' => 'nullable|string|max:200',
            'descripcion' => 'nullable|string',
            'direccion' => 'nullable|string|max:200',
            'tipo_empleo' => 'nullable|string|max:200',
            'requisito' => 'nullable|string',
            'salario' => 'nullable|numeric|min:0'
        ], [
            'nombre_empresa.required' => 'El nombre de la empresa es requerido',
        ]);

        try {
            $trabajo = new BolsaTrabajos();
            $trabajo->fk_usuario = Auth::id();
            $trabajo->nombre_empresa = $validated['nombre_empresa'];
            $trabajo->correo = $validated['correo'] ?? null;
            $trabajo->telefono = $validated['telefono'] ?? null;
            $trabajo->puesto = $validated['puesto'] ?? null;
            $trabajo->descripcion = $validated['descripcion'] ?? null;
            $trabajo->direccion = $validated['direccion'] ?? null;
            $trabajo->tipo_empleo = $validated['tipo_empleo'] ?? null;
            $trabajo->requisito = $validated['requisito'] ?? null;
            $trabajo->salario = $validated['salario'] ?? null;

            $trabajo->save();

            return redirect()->route('trabajos.listado')->with('success', 'Publicación exitosa.');
        } catch (\Throwable $th) {
            return back()->withErrors('Ocurrió un error al guardar el trabajo,');
        }
    }

    // MOSTRAR TODOS LO TRABAJOS
    public function mostrar_trabajos()
    {
        $trabajos = BolsaTrabajos::with('usuario')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('work.listado', compact('trabajos'));
    }

    // MOSTRAR LOS DETALLES DE UN TRABAJO
    public function ver_trabajo($id)
    {
        // BUSCAR AL USUARIO POR ID Y CARGARLO EN LA PUBLICACION
        $trabajo = BolsaTrabajos::with('usuario')->findOrFail($id);

        return view('work.detalle', compact('trabajo'));
    }

    // MOSTRAR PUBLICACIONES DEL USUARIO
    public function mostrar_mis_trabajos()
    {
        // OBTENER EL ID DEL USUARIO LOGEADO
        $userId = Auth::id();

        // TRABAJOS PUBLICADOS DEL USUARIO
        $misTrabajos = BolsaTrabajos::where('fk_usuario', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // RETORNAR A LA VISTA
        return view('work.mis_trabajos', compact('misTrabajos'));
    }

    // EDITAR TRABAJO
    public function editar_trabajo($id)
    {
        $trabajo = BolsaTrabajos::findOrFail($id);
        return view('work.editar_trabajo', compact('trabajo'));
    }

    // ACTUALIZAR TRABAJO
    public function actualizar_trabajo(Request $request, $id)
    {
        $trabajo = BolsaTrabajos::where('fk_usuario', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'nombre_empresa' => 'required|string|max:200',
            'correo' => 'nullable|email|max:200',
            'telefono' => 'nullable|string|max:15',
            'puesto' => 'nullable|string|max:200',
            'descripcion' => 'nullable|string',
            'direccion' => 'nullable|string|max:200',
            'tipo_empleo' => 'nullable|string|max:200',
            'requisito' => 'nullable|string',
            'salario' => 'nullable|numeric|min:0'
        ],[
            'nombre_empresa.required' => 'El nombre de la empresa es requerido',
        ]);

        $trabajo->update($validated);

        return redirect()->route('usuario.mis_trabajos')->with('success', 'Trabajo actualizado correctamente.');
    }
}
