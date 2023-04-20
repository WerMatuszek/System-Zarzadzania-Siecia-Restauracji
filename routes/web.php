<?php

use App\Http\Controllers\KontaController;
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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//zakładki
Auth::routes();
Route::get('/konta', [App\Http\Controllers\KontaController::class, 'index']);
Route::get('/konta/dodaj', [KontaController::class, 'dodaj'])->name('konta.dodaj');
Route::get('/konta/usun', [KontaController::class, 'usun'])->name('konta.usun');
Auth::routes();
Route::get('/korespondencja', [App\Http\Controllers\KorespondencjaController::class, 'index']);
Auth::routes();
Route::get('/rezerwacje', [App\Http\Controllers\RezerwacjeController::class, 'index']);
Auth::routes();
Route::get('/pracownicy', [App\Http\Controllers\PracownicyController::class, 'index']);
Auth::routes();
Route::get('/raporty', [App\Http\Controllers\RaportyController::class, 'index']);
Auth::routes();
Route::get('/grafik', [App\Http\Controllers\GrafikController::class, 'index']);

