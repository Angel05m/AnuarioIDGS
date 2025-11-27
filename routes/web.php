<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BolsaTrabajoController;
use App\Http\Controllers\PublicationController;

// ============================================================
// 🏠 PÁGINA PRINCIPAL — Redirige al login
// ============================================================
Route::get('/', function () {
    return view('auth.login');
});

<<<<<<< HEAD
// Inicio => feed con todas las publicaciones (por defecto 'publicado')
Route::get('/dashboard', [PublicationController::class, 'feed'])


    ->middleware(['auth','verified'])
    ->name('dashboard');

=======
// ============================================================
// 📸 DASHBOARD — Muestra el Anuario Digital (publicaciones)
// ============================================================
Route::get('/dashboard', [PublicationController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584

// ============================================================
// 👤 PERFIL Y BOLSA DE TRABAJO — Solo con login
// ============================================================
Route::middleware('auth')->group(function () {

    // 👤 PERFIL DE USUARIO
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

<<<<<<< HEAD
    // RUTAS BOLSA DE TRABAJO
=======
    // 🧩 BOLSA DE TRABAJO
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
    Route::get('/publicacion-trabajo', function () {
        return view('work.public_work');
    })->name('publicWork');

<<<<<<< HEAD
    Route::post('/guardar-trabajo', [BolsaTrabajoController::class, 'registrar'])->name('guardar.trabajo');
    Route::get('/trabajos', [BolsaTrabajoController::class, 'mostrar_trabajos'])->name('trabajos.listado');
    Route::get('/trabajo/{id}', [BolsaTrabajoController::class, 'ver_trabajo'])->name('ver.trabajo');
    Route::get('/usuario/mis-trabajos', [BolsaTrabajoController::class, 'mostrar_mis_trabajos'])->name('usuario.mis_trabajos');
    Route::get('/trabajo/{id}/editar', [BolsaTrabajoController::class, 'editar_trabajo'])->name('trabajo.editar');
    Route::put('/trabajo/{id}/actualizar', [BolsaTrabajoController::class, 'actualizar_trabajo'])->name('trabajo.actualizar');

    // GALERIA
    Route::get('/galeria-detalle', function () {
        return view('galeria.detalle');
    })->name('bodega.detalle');
    
    Route::get('/publicar-imagen', function () {
        return view('galeria.publicar_imagen');
    })->name('bodega.publicar_imagen');

    Route::post('/guardar-imagenes', [App\Http\Controllers\GaleriaController::class, 'guardar'])->name('galeria.guardar_imagenes');
    Route::get('/bodega-galerias', [App\Http\Controllers\GaleriaController::class, 'bodega'])->name('galeria.bodega');
    Route::get('/detalle-galeria/{id}', [App\Http\Controllers\GaleriaController::class, 'detalle'])->name('galeria.detalle');

    // ----- PUBLICACIONES (Anuario) -----
    Route::resource('publications', PublicationController::class);
    Route::post('publications/{publication}/like', [PublicationController::class, 'like'])
        ->name('publications.like');
});

// Auth scaffolding (login, register, etc.)
=======
    Route::post('/guardar-trabajo', [BolsaTrabajoController::class, 'registrar'])
        ->name('guardar.trabajo');

    Route::get('/trabajos', [BolsaTrabajoController::class, 'mostrar_trabajos'])
        ->name('trabajos.listado');

    Route::get('/trabajo/{id}', [BolsaTrabajoController::class, 'ver_trabajo'])
        ->name('ver.trabajo');
});

// ============================================================
// 🖼️ PUBLICACIONES — accesibles sin login para ver o listar
// ============================================================
Route::middleware(['web'])->group(function () {

    // CRUD principal de publicaciones
    Route::resource('publications', PublicationController::class);

    // ✅ Ruta para dar “Me gusta”
    Route::post('/publications/{publication}/like', [PublicationController::class, 'like'])
        ->name('publications.like');

    // ✅ Ruta para registrar vistas
    Route::post('/publications/{publication}/view', [PublicationController::class, 'addView'])
        ->name('publications.view');
});

// ============================================================
// 🔐 AUTENTICACIÓN (Login, Registro, etc.)
// ============================================================
>>>>>>> a055cc8b974297c6dd14fb65795ec4beac518584
require __DIR__ . '/auth.php';
