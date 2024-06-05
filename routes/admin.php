<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FormaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TallaController;

Route::get('', [HomeController::class, 'index'])->middleware('can:admin.home')->name('admin.home');
Route::resource('usuarios', UsuarioController::class)->only(['index', 'edit', 'update'])->names('admin.usuarios');
Route::resource('roles', RoleController::class)->names('admin.roles');

Route::resource('categorias', CategoriaController::class)->names('admin.categorias');
Route::resource('formas', FormaController::class)->names('admin.formas');
Route::resource('productos', ProductoController::class)->names('admin.productos');
Route::resource('marcas', MarcaController::class)->names('admin.marcas');
Route::resource('categorias', CategoriaController::class)->names('admin.categorias');
Route::resource('tallas', TallaController::class)->names('admin.tallas');
Route::resource('colors', ColorController::class)->names('admin.colors');
/*
Route::resource('empleados', EmpleadoController::class)->names('admin.empleados');
Route::resource('clientes', ClienteController::class)->names('admin.clientes');
Route::resource('paquetes', PaqueteController::class)->names('admin.paquetes');
Route::resource('trucks', TruckController::class)->names('admin.trucks');
Route::resource('envios', EnvioController::class)->names('admin.envios');
Route::resource('destinos', DestinoController::class)->names('admin.destinos');
Route::resource('encargadotrucks', EncargadotruckController::class)->names('admin.encargadotrucks');
Route::resource('salidas', SalidaController::class)->names('admin.salidas');
Route::post('salidas/{salida}/remove-envio', [SalidaController::class, 'removeEnvio'])->name('salidas.remove-envio');
Route::post('salidas/{salida}/add-envio', [SalidaController::class, 'addEnvio'])->name('salidas.add-envio');


Route::get('predicciones/pmv1', [AIController::class, 'index'])->name('admin.predicciones.pmv1');
Route::get('predicciones/pmv1', [AIController::class, 'predict'])->name('admin.predicciones.pmv1');
*/