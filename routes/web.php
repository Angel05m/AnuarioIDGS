<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BolsaTrabajo;

Route::get('/', function () {
    return view('login');
});


// RUTAS BOLSA DE TRABAJO
Route::get('/publicacion-trabajo', function () {
    return view('work.public_work');
})->name('publicWork');

Route::post('/guardar-trabajo', [BolsaTrabajo::class, 'registrar'])->name('guardar.trabajo');