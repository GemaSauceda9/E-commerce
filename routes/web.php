<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\CartController;
use App\Models\Producto;

Route::get('/', function () {
    $productosRecomendados = Producto::where('destacado', true)
        ->where('activo', true)
        ->orderBy('created_at', 'DESC')
        ->take(8)
        ->get();

    return view('home', compact('productosRecomendados'));
})->name('home');

// Rutas públicas de productos (accesibles sin autenticación)
Route::get('/productos-all', [ProductoController::class, 'indexAll'])->name('productos.all');
Route::get('/productos/{producto:slug}', [ProductoController::class, 'detalles'])->name('productos.detalles');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para el carrito
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{producto}', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
});

// * Rutas para administradores
Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // * Ruta para el panel de administración
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // * Rutas para productos (administración)
    Route::resource('admin/productos', ProductoController::class)->names([
        'index' => 'productos.index',
        'create' => 'productos.create',
        'store' => 'productos.store',
        'show' => 'productos.show',
        'edit' => 'productos.edit',
        'update' => 'productos.update',
        'destroy' => 'productos.destroy',
    ]);

    // * Rutas para categorías
    Route::resource('admin/categorias', CategoriaController::class)->names([
        'index' => 'categorias.index',
        'create' => 'categorias.create',
        'store' => 'categorias.store',
        'show' => 'categorias.show',
        'edit' => 'categorias.edit',
        'update' => 'categorias.update',
        'destroy' => 'categorias.destroy',
    ]);

    // * Rutas para etiquetas
    Route::resource('admin/etiquetas', EtiquetaController::class)->names([
        'index' => 'etiquetas.index',
        'create' => 'etiquetas.create',
        'store' => 'etiquetas.store',
        'show' => 'etiquetas.show',
        'edit' => 'etiquetas.edit',
        'update' => 'etiquetas.update',
        'destroy' => 'etiquetas.destroy',
    ]);
});

// * Rutas para clientes
Route::middleware(['auth', 'cliente'])->group(function () {
    // Rutas específicas para clientes
    Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.cliente.show');
});

require __DIR__ . '/auth.php';
