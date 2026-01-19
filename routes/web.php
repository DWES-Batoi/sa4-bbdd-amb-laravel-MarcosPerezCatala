<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session; // <--- IMPORTANT

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- 🌍 CANVI D'IDIOMA ---
Route::get('/locale/{locale}', function (string $locale) {
    $available = ['ca', 'es', 'en'];
    // Si l'idioma no és vàlid, posem anglès per defecte
    if (!in_array($locale, $available, true)) {
        $locale = config('app.fallback_locale', 'en');
    }
    // Guardem en sessió
    Session::put('locale', $locale);
    
    return redirect()->back();
})->name('setLocale');


// --- ZONA PÚBLICA (Listados) ---
Route::resource('equips', EquipController::class)->only(['index']);
Route::resource('estadis', EstadiController::class)->only(['index']);
Route::resource('jugadoras', JugadoraController::class)->only(['index']); 
Route::resource('partits', PartitController::class)->only(['index']);     


// --- ZONA PRIVADA (Gestión: Crear, Editar, Borrar) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD completo excepto lo público (Protegido por Auth y algunos botones por Admin en vista)
    Route::resource('equips', EquipController::class)->except(['index', 'show']);
    Route::resource('estadis', EstadiController::class)->except(['index', 'show']);
    Route::resource('jugadoras', JugadoraController::class)->except(['index', 'show']);
    Route::resource('partits', PartitController::class)->except(['index', 'show']);
});

// --- ZONA PÚBLICA (Detalles / Show) ---
Route::resource('equips', EquipController::class)->only(['show']);
Route::resource('estadis', EstadiController::class)->only(['show']);
Route::resource('jugadoras', JugadoraController::class)->only(['show']);
Route::resource('partits', PartitController::class)->only(['show']);

require __DIR__.'/auth.php';