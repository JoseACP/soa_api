<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TacoController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\FuerteController;
use App\Http\Controllers\SopaController;
use App\Http\Controllers\BebidaController;
use App\Http\Controllers\ComplementoController;
use App\Http\Controllers\EnsaladaController;
use App\Http\Controllers\InfantilController;
use App\Http\Controllers\CorteController;
use App\Models\Ensalada;
use App\Models\Bebida;
use App\Models\Complemento;
use App\Models\Corte;
use App\Models\Entrada;
use App\Models\Infantil;
use App\Models\Sopa;
use App\Models\Taco;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('cortes', CorteController::class);
    Route::resource('infantils', InfantilController::class);
    Route::resource('complementos', ComplementoController::class);
    Route::resource('ensaladas', EnsaladaController::class);
    Route::resource('bebidas', BebidaController::class);
    Route::resource('sopas', SopaController::class);
    Route::resource('fuertes', FuerteController::class);
    Route::resource('tacos', TacoController::class);
    Route::resource('entradas', EntradaController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
