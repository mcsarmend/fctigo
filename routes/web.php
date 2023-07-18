<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\adminsettingsController;
use App\Http\Controllers\labelledController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\statusController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\usersController;

/*
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
        return view('/home');
    } else {
        return redirect('/login');
    }
})->middleware(['auth']);

// Configuraciones
Route::get('admin/settings',[adminsettingsController::class, 'index'])->middleware(['auth']);

//Etiquetado RUTAS
Route::get('etiquetado/jucavi/bursa', [labelledController::class, 'jucavibursa'])->middleware('auth');
Route::get('etiquetado/jucavi/promecap', [labelledController::class, 'jucavipromecap'])->middleware('auth');
Route::get('etiquetado/jucavi/blao', [labelledController::class, 'jucaviblao'])->middleware('auth');
Route::get('etiquetado/mambu/bursa', [labelledController::class, 'mambubursa'])->middleware('auth');

Route::get('etiquetado/mambu/promecap', [labelledController::class, 'mambupromecap'])->middleware('auth');
Route::get('etiquetado/mambu/blao', [labelledController::class, 'mambublao'])->middleware('auth');
Route::get('etiquetado/mambu/mintos', [labelledController::class, 'mambumintos'])->middleware('auth');


Route::get('estatus/importantes', [statusController::class, 'importantes'])->middleware('auth');
Route::get('estatus/avisos', [statusController::class, 'avisos'])->middleware('auth');
Route::get('estatus/informacion', [statusController::class, 'informacion'])->middleware('auth');



// Etiquetado blao JUCAVI
Route::get('etiquetado/jucavi/preeliminarjucaviblao', [labelledController::class, 'preeliminarjucaviblao'])->middleware('auth');
Route::post('etiquetado/jucavi/preetiquetadoblaojucavi', [labelledController::class, 'preetiquetadoblaojucavi'])->name('preetiquetadoblaojucavi');
Route::post('etiquetado/jucavi/bajablaojucavi', [labelledController::class, 'bajablaojucavi'])->name('bajablaojucavi');

//Etiquetado Promecap JUCAVI
Route::get('etiquetado/jucavi/promecap_preetiequetado_jucavi', [labelledController::class, 'promecap_preetiequetado_jucavi'])->middleware('auth');
Route::post('etiquetado/jucavi/bajapromecapjucavi', [labelledController::class, 'bajapromecapjucavi'])->name('bajapromecapjucavi');
Route::post('etiquetado/jucavi/etiquetadopromecapjucavi', [labelledController::class, 'etiquetadopromecapjucavi'])->name('etiquetadopromecapjucavi');


// Etiquetado promecap MAMBU
Route::get('etiquetado/mambu/promecap_preetiequetado_mambu', [labelledController::class, 'promecap_preetiequetado_mambu'])->middleware('auth');
Route::post('etiquetado/mambu/bajapromecapmambu', [labelledController::class, 'bajapromecapmambu'])->name('bajapromecapmambu');
Route::post('etiquetado/mambu/etiquetadopromecapmambu', [labelledController::class, 'etiquetadopromecapmambu'])->name('etiquetadopromecapmambu');

// etiquetado blao MAMBU
Route::get('etiquetado/mambu/blao_preetiequetado_mambu', [labelledController::class, 'blao_preetiequetado_mambu'])->middleware('auth');
Route::post('etiquetado/mambu/bajablaomambu', [labelledController::class, 'bajablaomambu'])->name('bajablaomambu');
Route::post('etiquetado/mambu/etiquetadoblaomambu', [labelledController::class, 'etiquetadoblaomambu'])->name('etiquetadoblaomambu');


// etiquetado MINTOS MAMBU
Route::get('etiquetado/mambu/mintos_preetiquetado', [labelledController::class, 'mintos_preetiquetado'])->middleware('auth');
Route::post('etiquetado/mambu/etiquetadomintos', [labelledController::class, 'etiquetadomintos'])->name('etiquetadomintos');

//Etiquetado Promecap Jucavi
Route::get('etiquetado/jucavi/promecap_preetiequetado_jucavi', [labelledController::class, 'promecap_preetiequetado_jucavi'])->middleware('auth');
Route::post('etiquetado/jucavi/bajapromecapjucavi', [labelledController::class, 'bajapromecapjucavi'])->name('bajapromecapjucavi');
Route::post('etiquetado/jucavi/etiquetadopromecapjucavi', [labelledController::class, 'etiquetadopromecapjucavi'])->name('etiquetadopromecapjucavi');


//Reportes
Route::get('reportes/recuperacioncartera', [reportController::class, 'recuperacioncartera'])->middleware('auth');
Route::get('reportes/sesioncartera', [reportController::class, 'sesioncartera'])->middleware('auth');
Route::get('reportes/fondeadores', [reportController::class, 'fondeadores'])->middleware('auth');
Route::get('reportes/fondeadoresreport', [reportController::class, 'fondeadoresreport']);
Route::get('reportes/reportesesioncartera', [reportController::class, 'reportesesioncartera']);
Route::get('reportes/reporterecuperacioncartera', [reportController::class, 'reporterecuperacioncartera']);



//Tablero
Route::get('testsoh', [dashboardController::class, 'testsoh'])->middleware('auth');
Route::get('testsohrep', [dashboardController::class, 'testsohrep']);
Route::get('sohmambu', [dashboardController::class, 'sohmambu']);

Route::get('profile/username', [usersController::class, 'usuarios']);
Route::post('guardar-usuario', [usersController::class, 'guardar']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

