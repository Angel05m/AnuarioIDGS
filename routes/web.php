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

// ============================================================
// 📸 DASHBOARD — Muestra el Anuario Digital (publicaciones)
// ============================================================
Route::get('/dashboard', [PublicationController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ============================================================
// 👤 PERFIL Y BOLSA DE TRABAJO — Solo con login
// ============================================================
Route::middleware('auth')->group(function () {

    // 👤 PERFIL DE USUARIO
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🧩 BOLSA DE TRABAJO
    Route::get('/publicacion-trabajo', function () {
        return view('work.public_work');
    })->name('publicWork');

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
require __DIR__ . '/auth.php';
