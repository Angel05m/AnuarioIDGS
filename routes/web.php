<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BolsaTrabajoController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // RUTAS BOLSA DE TRABAJO
    Route::get('/publicacion-trabajo', function () {
        return view('work.public_work');
    })->name('publicWork');

    Route::post('/guardar-trabajo', [BolsaTrabajoController::class, 'registrar'])->name('guardar.trabajo');
    Route::get('/trabajos', [BolsaTrabajoController::class, 'mostrar_trabajos'])->name('trabajos.listado');
    Route::get('/trabajo/{id}', [BolsaTrabajoController::class, 'ver_trabajo'])->name('ver.trabajo');
});

require __DIR__ . '/auth.php';
