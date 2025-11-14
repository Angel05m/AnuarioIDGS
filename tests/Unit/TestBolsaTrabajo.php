<?php

namespace Tests\Unit;

use App\Models\BolsaTrabajos;
use Tests\TestCase;

class TestBolsaTrabajo extends TestCase
{

    // Test para verificar que la llave primaria se haya configurado bien
    public function test_llave_primaria_configurada(): void
    {
        $bolsaTrabajo = new BolsaTrabajos();
        $this->assertEquals('pk_bolsa_trabajo', $bolsaTrabajo->getKeyName());
    }

    // Test para verificar que los campos del modelo sean correctos
    public function test_campos_modelo_correctos(): void
    {
        $bolsaTrabajo = new BolsaTrabajos();
        // Campos esperados incorrectos
        $fileIncorrectos = [
            'fk_usuario',
            'nombre_empresa',
            'puesto',
            'descripcion',
            'requisitos',
            'ubicacion',
            'tipo_contrato',
            'salario',
            'fecha_publicacion',
            'fecha_expiracion',
        ];

        // Campos correctos del modelo
        $fileCorrectos = [
            'fk_usuario',
            'nombre_empresa',
            'correo',
            'telefono',
            'puesto',
            'descripcion',
            'direccion',
            'tipo_empleo',
            'requisito',
            'salario'
        ];


        $this->assertEquals($fileCorrectos, $bolsaTrabajo->getFillable());
    }

    // Test para verificar que los datos se reciben correctamente
    public function test_recibir_dato(): void
    {
        $bolsaTrabajo = new BolsaTrabajos([
            'nombre_empresa' => 'Empresa Tecualilla',
        ]);

        $this->assertEquals('Empresa Tecualilla', $bolsaTrabajo->nombre_empresa);
    }
}
