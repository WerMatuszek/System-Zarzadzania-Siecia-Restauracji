<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//zakładki
Auth::routes();
Route::get('/home/konta', [App\Http\Controllers\KontaController::class, 'index']);
Auth::routes();
Route::get('/home/korespondencja', [App\Http\Controllers\KorespondencjaController::class, 'index']);
Auth::routes();
Route::get('/home/rezerwacje', [App\Http\Controllers\RezerwacjeController::class, 'index']);
Auth::routes();
Route::get('/home/pracownicy', [App\Http\Controllers\PracownicyController::class, 'index']);
Auth::routes();
Route::get('/home/raporty', [App\Http\Controllers\RaportyController::class, 'index']);
