<?php
use App\Http\Controllers\SalasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


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


Route::resource('/', HomeController::class);

Route::resource('/home', HomeController::class);

Route::resource('/salas', SalasController::class);


//aqui va la ruta del calendario que hice en php y js,



Route::get('/calendario', function () {
    return view('calendario');
});

Route::get('/dashboard', function () {
  return view('dashboard');
});