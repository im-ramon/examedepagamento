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


// Route::prefix('/app')->group(function () {
//     Route::get('/formulario', [\App\Http\Controllers\ContrachequeController::class, 'gerarFormulario'])->name('app.formulario');
//     Route::post('/ficha-auxiliar', [\App\Http\Controllers\ContrachequeController::class, 'fichaauxiliar'])->name('app.fichaauxiliar');
// });

Auth::routes();

Route::get('/app', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
