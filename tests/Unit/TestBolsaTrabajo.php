<?php

namespace Tests\Unit;

use App\Models\BolsaTrabajos;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestBolsaTrabajo extends TestCase
{
    use RefreshDatabase; 

    // Test para verificar que los datos se reciben correctamente

    public function test_recibir_datos(): void
    {
        $bolsaTrabajo = new BolsaTrabajos([
            'nombre_empresa' => 'Empresa Tecualilla',
        ]);

        $this->assertEquals('Empresa Tecualilla', $bolsaTrabajo->nombre_empresa);
    }


    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }


    public function test_guardar_registro_en_base_de_datos(): void
    {
        // Crear un registro en la base de datos
        $bolsa = BolsaTrabajos::create([
            'fk_usuario' => 1,
            'nombre_empresa' => 'Empresa Tecualilla',
            'correo' => 'correo@gmail.com',
            'telefono' => '6951198727',
            'puesto' => 'FullStack',
            'descripcion' => 'Desarrollador FullStack con experiencia en Laravel y Vue.js',
            'direccion' => 'Pedro Prado Cordoba, Tecualilla - Escuinapa',
            'tipo_empleo' => 'Tiempo completo',
            'requisito' => 'Experiencia mínima de 2 años',
            'salario' => 15000,
        ]);

        // Afirmar que el registro existe en la base de datos
        $this->assertDatabaseHas('bolsa_trabajo', [
            'nombre_empresa' => 'Empresa Tecualilla',
            'correo' => 'correo@gmail.com',
        ]);
    }
}
