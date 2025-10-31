<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BolsaTrabajoController;
use App\Http\Controllers\PublicationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing al login
Route::get('/', fn () => view('auth.login'));

// Dashboard
Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas protegidas (requieren usuario autenticado y verificado)
Route::middleware(['auth', 'verified'])->group(function () {

    // ----- BOLSA DE TRABAJO -----
    Route::get('/publicacion-trabajo', fn () => view('work.public_work'))
        ->name('publicWork');

    Route::post('/guardar-trabajo', [BolsaTrabajoController::class, 'registrar'])
        ->name('guardar.trabajo');

    Route::get('/trabajos', [BolsaTrabajoController::class, 'mostrar_trabajos'])
        ->name('trabajos.listado');

    Route::get('/trabajo/{id}', [BolsaTrabajoController::class, 'ver_trabajo'])
        ->name('ver.trabajo');

    Route::get('/usuario/mis-trabajos', [BolsaTrabajoController::class, 'mostrar_mis_trabajos'])
        ->name('usuario.mis_trabajos');

    Route::get('/trabajo/{id}/editar', [BolsaTrabajoController::class, 'editar_trabajo'])
        ->name('trabajo.editar');

    Route::put('/trabajo/{id}/actualizar', [BolsaTrabajoController::class, 'actualizar_trabajo'])
        ->name('trabajo.actualizar');

    // ----- PUBLICACIONES (Anuario / Galería) -----
    Route::resource('publications', PublicationController::class);
    Route::post('publications/{publication}/like', [PublicationController::class, 'like'])
        ->name('publications.like');

    // ----- PERFIL -----
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Auth scaffolding (login, register, etc.)
require __DIR__ . '/auth.php';
