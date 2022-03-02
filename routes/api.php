<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get(
    '/',
    function (Request $request) {
        return ['foi' => 'sim'];
    }
);
Route::middleware('jwt.auth')->group(function () {
    // Route::resource('ficha-auxiliar', 'App\Http\Controllers\ContrachequeController');
    Route::get('ficha-auxiliar', 'App\Http\Controllers\ContrachequeController@gerarContracheque');
    Route::get('ficha-auxiliar/{email}', 'App\Http\Controllers\ContrachequeController@recuperarContracheques');
    Route::post('ficha-auxiliar', 'App\Http\Controllers\ContrachequeController@store');
    Route::patch('ficha-auxiliar/{id}', 'App\Http\Controllers\ContrachequeController@update');
    Route::delete('ficha-auxiliar/{id}', 'App\Http\Controllers\ContrachequeController@destroy');
    Route::resource('pg-constantes', 'App\Http\Controllers\PgConstanteController');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
});

Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::get('legislacao', 'App\Http\Controllers\LegislacaoController@index');
