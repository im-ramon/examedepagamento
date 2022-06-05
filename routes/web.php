<?php

use App\Mail\MensagemPadrao;
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

Route::get('/singup', function () {
    return view('singup');
});

Route::get('/app', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// -- Rota de teste para o modelo de e-mail -- //

// Route::get('/teste-email', function() {
//     return new MensagemPadrao();
// });

Auth::routes();
