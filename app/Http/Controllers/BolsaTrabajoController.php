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
            'correo' => 'required|email|max:200',
            'telefono' => 'required|string|max:15',
            'puesto' => 'required|string|max:200',
            'descripcion' => 'required|string',
            'direccion' => 'required|string|max:200',
            'tipo_empleo' => 'required|string|max:200',
            'requisito' => 'required|string',
            'salario' => 'required|numeric|min:0'
        ],[
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

        $trabajo->update($validated);

        return redirect()->route('usuario.mis_trabajos')->with('success', 'Trabajo actualizado correctamente.');
    }
}
