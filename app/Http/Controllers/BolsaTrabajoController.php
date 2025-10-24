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
            'correo' => 'required|email|max:200',
            'telefono' => 'required|string|max:15',
            'puesto' => 'required|string|max:200',
            'descripcion' => 'required|string',
            'direccion' => 'required|string|max:200',
            'tipo_empleo' => 'required|string|max:200',
            'requisito' => 'required|string',
            'salario' => 'required|numeric|min:0'
        ], [
            'nombre_empresa.required' => 'El nombre de la empresa es requerido',
            'correo.required' => 'Correo requerido',
            'correo.email' => 'El correo debe ser válido',
            'telefono.required' => 'Teléfono requerido',
            'puesto.required' => 'Puesto del trabajo requerido',
            'descripcion.required' => 'Es obligatorio una descripción',
            'direccion.required' => 'La dirección es obligatoria',
            'tipo_empleo.required' => 'El tipo de empleo es obligatorio',
            'requisito.required' => 'Es obligatorio el requisito',
            'salario.required' => 'Salario obligatorio'
        ]);

        try {
            $trabajo = new BolsaTrabajos();
            $trabajo->fk_usuario = Auth::id();
            $trabajo->nombre_empresa = $validated['nombre_empresa'];
            $trabajo->correo = $validated['correo'];
            $trabajo->telefono = $validated['telefono'];
            $trabajo->puesto = $validated['puesto'];
            $trabajo->descripcion = $validated['descripcion'];
            $trabajo->direccion = $validated['direccion'];
            $trabajo->tipo_empleo = $validated['tipo_empleo'];
            $trabajo->requisito = $validated['requisito'];
            $trabajo->salario = $validated['salario'];

            $trabajo->save();

            return back()->with('success', 'Trabajo publicado correctamente.');
        } catch (\Throwable $th) {
            return back()->withErrors('Ocurrió un error al guardar el trabajo: ' . $th->getMessage());
        }
    }

    // Mostrar todos los trabajos
    public function mostrar_trabajos()
    {
        $trabajos = BolsaTrabajos::with('usuario')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('work.listado', compact('trabajos'));
    }

    // Mostrar los detalles de un trabajo específico
    public function ver_trabajo($id)
    {
        // Buscar el trabajo por su ID y cargar la relación con el usuario
        $trabajo = BolsaTrabajos::with('usuario')->findOrFail($id);

        return view('work.detalle', compact('trabajo'));
    }
}
