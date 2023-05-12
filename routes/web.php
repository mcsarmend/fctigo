<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminsettingsController;
use App\Http\Controllers\labelledController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\statusController;
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
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return redirect('/login');
    }
})->middleware('auth');


Route::get('/dashboard', function () {
    if (Auth::check()) {
        return view('/dashboard');
    } else {
        return redirect('/login');
    }
})->middleware(['auth']);

// Configuraciones
Route::get('admin/settings',[adminsettingsController::class, 'index'])->middleware(['auth']);

//Etiqeutado
Route::get('etiquetado/jucavi/bursa', [labelledController::class, 'jucavibursa'])->middleware('auth');
Route::get('etiquetado/jucavi/promecap', [labelledController::class, 'jucavipromecap'])->middleware('auth');
Route::get('etiquetado/jucavi/blao', [labelledController::class, 'jucaviblao'])->middleware('auth');
Route::get('etiquetado/mambu/bursa', [labelledController::class, 'mambubursa'])->middleware('auth');
Route::get('etiquetado/mambu/promecap', [labelledController::class, 'mambupromecap'])->middleware('auth');
Route::get('etiquetado/mambu/blao', [labelledController::class, 'mambublao'])->middleware('auth');
Route::get('etiquetado/mambu/mintos', [labelledController::class, 'mambumintos'])->middleware('auth');

//Reportes
Route::get('reportes/recuperacioncartera', [reportController::class, 'recuperacioncartera'])->middleware('auth');
Route::get('reportes/sesioncartera', [reportController::class, 'sesioncartera'])->middleware('auth');
Route::get('reportes/fondeadores', [reportController::class, 'fondeadores'])->middleware('auth');


//Estatus
Route::get('estatus/importantes', [statusController::class, 'importantes'])->middleware('auth');
Route::get('estatus/avisos', [statusController::class, 'avisos'])->middleware('auth');
Route::get('estatus/informacion', [statusController::class, 'informacion'])->middleware('auth');



require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

