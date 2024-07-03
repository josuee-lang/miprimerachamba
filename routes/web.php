<?php

use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\ReservarController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::resource('libros', LibroController::class)->middleware('auth');;;
Route::resource('prestamos',PrestamoController ::class)->middleware('auth');;;
Route::resource('etiquetas', EtiquetaController::class)->middleware('auth');;;
Route::resource('reservars', ReservarController::class)->middleware('auth');;;

Auth::routes(['register'=>false, 'reser'=>false]);

Route::group(['middleware'=>'auth'],function(){
    
    Route::get('/', [HomeController::class, 'index'])->name('home');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


