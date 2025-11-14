<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Publication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Tests\TestCase;

class PublicationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica que la vista "Mis publicaciones" muestre solo las publicaciones
     * del usuario autenticado y las categorías correspondientes.
     *
     * @test
     */
    public function index_mis_publicaciones_muestra_solo_las_mias()
    {
        // Usuarios correctos según tu User model
        $user = User::create([
            'name' => 'Autor Uno',
            'apellido_paterno' => 'Uno',
            'apellido_materno' => 'X',
            'matricula' => 'MAT001',
            'email' => 'autor1@test.local',
            'password' => Hash::make('secret'),
        ]);

        $other = User::create([
            'name' => 'Autor Dos',
            'apellido_paterno' => 'Dos',
            'apellido_materno' => 'X',
            'matricula' => 'MAT002',
            'email' => 'autor2@test.local',
            'password' => Hash::make('secret'),
        ]);

        // Publicaciones: 2 del usuario y 1 de otro
        Publication::create([
            'titulo' => 'Mi publicación 1',
            'descripcion' => 'Desc 1',
            'contenido' => 'Contenido 1',
            'categoria' => 'News',
            'estado' => 'publicado',
            'user_id' => $user->id,
            'created_at' => now()->subDays(2),
        ]);

        Publication::create([
            'titulo' => 'Mi publicación 2',
            'descripcion' => 'Desc 2',
            'contenido' => 'Contenido 2',
            'categoria' => 'Tutorial',
            'estado' => 'borrador',
            'user_id' => $user->id,
            'created_at' => now()->subDay(),
        ]);

        Publication::create([
            'titulo' => 'Otra publicación',
            'descripcion' => 'Desc 3',
            'contenido' => 'Contenido 3',
            'categoria' => 'News',
            'estado' => 'publicado',
            'user_id' => $other->id,
        ]);

        // Actuar como $user y solicitar "Mis publicaciones"
        $this->actingAs($user);
        $response = $this->get(route('publications.index'));

        $response->assertStatus(200);

        // Verifica publicaciones del usuario
        $response->assertSee('Mi publicación 1')
                 ->assertSee('Mi publicación 2')
                 ->assertDontSee('Otra publicación');

        // Categorías
        $response->assertSee('News')
                 ->assertSee('Tutorial');
    }

    /**
     * Comprueba que al crear una publicación con imagen y estado 'publicado'
     * se guarde la imagen, se asigne el user_id y se establezca fecha_publicacion.
     *
     * @test
     */
    public function store_guarda_publicacion_con_imagen_y_fecha_publicacion_si_publicado()
    {
        Storage::fake('public');

        $user = User::create([
            'name' => 'Store Test',
            'apellido_paterno' => 'Test',
            'apellido_materno' => 'X',
            'matricula' => 'MAT100',
            'email' => 'store@test.local',
            'password' => Hash::make('secret'),
        ]);

        $this->actingAs($user);

        // Archivo de prueba
        $file = UploadedFile::fake()->create('foto.jpg', 100, 'image/jpeg');


        // Simular petición POST al store
        $response = $this->post(route('publications.store'), [
            'titulo' => 'Publicación con imagen',
            'descripcion' => 'Descripción corta',
            'contenido' => 'Contenido largo...',
            'categoria' => 'Pruebas',
            'estado' => 'publicado',
            'imagen' => $file,
        ]);

        // Redirección esperada
        $response->assertStatus(302);

        // Recuperar la publicación creada
        $publication = Publication::where('titulo', 'Publicación con imagen')->first();
        $this->assertNotNull($publication);

        // Imagen guardada
        $this->assertNotNull($publication->imagen);
        Storage::disk('public')->assertExists($publication->imagen);

        // user_id asignado
        $this->assertEquals($user->id, $publication->user_id);

        // fecha_publicacion asignada
        $this->assertNotNull($publication->fecha_publicacion);

        $this->assertEquals(
            Carbon::now()->toDateString(),
            Carbon::parse($publication->fecha_publicacion)->toDateString()
        );
    }



    /**
     * Asegura que un usuarioo que NO es el dueño de la publicación reciba 403 al intentar editarla.
     *
     * @test
     */
    public function editar_no_autorizado_para_no_dueno()
    {
        $owner = User::create([
            'name' => 'Dueño Real',
            'apellido_paterno' => 'Real',
            'apellido_materno' => 'X',
            'matricula' => 'MAT200',
            'email' => 'dueno@test.local',
            'password' => Hash::make('secret'),
        ]);

        $other = User::create([
            'name' => 'Intruso Fake',
            'apellido_paterno' => 'Fake',
            'apellido_materno' => 'X',
            'matricula' => 'MAT201',
            'email' => 'intruso@test.local',
            'password' => Hash::make('secret'),
        ]);

        // Publicación creada por el dueño
        $publication = Publication::create([
            'titulo' => 'Publicación protegida',
            'descripcion' => 'Desc',
            'contenido' => 'Contenido',
            'categoria' => 'Privado',
            'estado' => 'borrador',
            'user_id' => $owner->id,
        ]);

        // Actuar como otro usuario e intentar acceder a edit 
        $this->actingAs($other);
        $response = $this->get(route('publications.edit', $publication));

        $response->assertStatus(403);
    }
}
