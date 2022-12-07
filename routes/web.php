<?php

use App\Http\Livewire\Categorias;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Horarios;
use App\Http\Livewire\Programas;
use App\Http\Livewire\Proveedors;
use App\Http\Livewire\Marcas;
use App\Http\Livewire\Productos;
use App\Http\Livewire\Users;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*   revisar si la ruta se llama con la carpeta livewire*/





Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/programas', Programas::class)->name('programas');

Route::middleware(['auth:sanctum', 'verified'])->get('/horarios', Horarios::class)->name('horarios');
Route::middleware(['auth:sanctum', 'verified'])->get('/categorias', Categorias::class)->name('categorias');

Route::middleware(['auth:sanctum', 'verified'])->get('/proveedors', Proveedors::class)->name('proveedors');
Route::middleware(['auth:sanctum', 'verified'])->get('/marcas',Marcas::class)->name('marcas');
Route::middleware(['auth:sanctum', 'verified'])->get('/productos', Productos::class)->name('productos');
Route::middleware(['auth:sanctum', 'verified'])->get('/users', Users::class)->name('users');

Route::middleware(['auth:sanctum', 'verified'])->get('/tags', function () {
    return view('tags');
})->name('tags');