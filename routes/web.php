<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\TareaController;
use App\Http\Controllers\PokemonChartController;

// Ruta para mostrar la vista del gráfico
Route::get('/pokemon-types-chart', [PokemonChartController::class, 'index'])->name('pokemon.types.chart');

// Ruta API para que el JavaScript obtenga los datos
Route::get('/api/pokemon-types-data', [PokemonChartController::class, 'getPokemonTypesData']);

Route::get('/', [TareaController::class, 'index']);
Route::post('/tareas', [TareaController::class, 'store']);
Route::get('/tareas/{id}/edit', [TareaController::class, 'edit']);
Route::put('/tareas/{id}', [TareaController::class, 'update']);
Route::delete('/tareas/{id}', [TareaController::class, 'destroy']);
