<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use Illuminate\Support\Facades\Route;

// Página de inicio (puedes redirigir a equips si quieres)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (panel de control tras loguearse)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- ZONA PÚBLICA (Cualquiera puede ver) ---
// Solo index (listados)
Route::resource('equips', EquipController::class)->only(['index']);
Route::resource('estadis', EstadiController::class)->only(['index']);


// --- ZONA PRIVADA (Necesitas Login) ---
Route::middleware('auth')->group(function () {
    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestión de datos (Crear, Editar, Borrar)
    Route::resource('equips', EquipController::class)->except(['index', 'show']);
    Route::resource('estadis', EstadiController::class)->except(['index', 'show']);
});

// --- ZONA PÚBLICA (Detalle) ---
// Ponemos 'show' al final para evitar conflictos de rutas
Route::resource('equips', EquipController::class)->only(['show']);
Route::resource('estadis', EstadiController::class)->only(['show']);

require __DIR__.'/auth.php';