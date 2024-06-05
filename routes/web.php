<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta Pública del Dashboard
Route::get('/', [ProductoController::class, 'dashboard']);
Route::get('/dashboard', [ProductoController::class, 'dashboard'])->name('dashboard');



Route::post('cart/add', [CartController::class, 'add'])->name('add');
Route::get('cart/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('cart/clear', [CartController::class, 'clear'])->name('clear');
Route::post('cart/removeitem', [CartController::class, 'removeItem'])->name('removeItem');


// Grupo de Rutas Protegidas
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::post('/pagar', 'PagosController@realizarPago')->name('realizar_pago');
    
});
