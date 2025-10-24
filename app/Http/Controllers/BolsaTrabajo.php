<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use App\Models\BolsaTrabajos;
use Illuminate\Http\Request;

class BolsaTrabajo extends Controller
{
    public function registrar(Request $request)
    {
        $validated = $request->validate([
            'fk_usuario' => 'required|string|max:1',
            'nombre_empresa' => 'required|string|max:200',
            'correo' => 'required|string|max:200',
            'telefono' => 'required|string|max:15',
            'puesto' => 'required|string|max:200',
            'descripcion' => 'required|string',
            'direccion' => 'required|string',
            'tipo_empleo' => 'required|string|max:200',
            'requisito' => 'required|string',
            'salario' => 'required|numeric|min:0'
        ], [
            'nombre_empresa' => 'El nombre de la empresa es requerido',
            'correo' => 'Correo requerido',
            'telefono' => 'Telefono requerido',
            'puesto' => 'Puesto del trabajo requerido',
            'descripcion' => 'Es obligatorio una descripción',
            'direccion' => 'La direccion es obligatorio',
            'tipo_empleo' => 'El tipo de empleo es obligatorio',
            'requisito' => 'Es obligatorio el requisito',
            'salario' => 'Salario obligatorio'
        ]);
        try {
            $t = new BolsaTrabajos();
            $t->fk_usuario = 1;
            $t->nombre_empresa = $request->nombre_empresa;
            $t->correo = $request->correo;
            $t->telefono = $request->telefono;
            $t->puesto = $request->puesto;
            $t->descripcion = $request->descripcion;
            $t->direccion = $request->direccion;
            $t->tipo_empleo = $request->tipo_empleo;
            $t->requisito = $request->requisito;
            $t->salario = $request->salario;

            $t->save();
            return back()->with('success', 'Trabajo publicado correctamente.');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function mostrar_trabajo(){
        $Mtrabajo = BolsaTrabajos::all();
        return view('work.listado', compact('trabajos'));
    }
}
