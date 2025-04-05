<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EtiquetaController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// * Rutas para administradores
Route::middleware(['auth', 'admin'])->group(function () {
    // * Rutas para productos (administración)
    Route::resource('productos', ProductoController::class);
    
    // * Rutas para categorías
    Route::resource('categorias', CategoriaController::class);
    
    // * Rutas para etiquetas
    Route::resource('etiquetas', EtiquetaController::class);
});

// * Rutas para clientes
Route::middleware(['auth', 'cliente'])->group(function () {
    // Rutas específicas para clientes
    Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.cliente.show');
});

require __DIR__.'/auth.php';
