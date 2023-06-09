<?php

use App\Http\Controllers\DostawyController;
use App\Http\Controllers\KontaController;
use App\Http\Controllers\RezerwacjeController;
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

Route::post('/rezerwacje', [App\Http\Controllers\RezerwacjeController::class, 'store'])->name('rezerwacje.store');

//zakładki
Auth::routes();
Route::middleware(['role:szef,kierownik'])->group(function () {
    Route::get('/konta', [App\Http\Controllers\KontaController::class, 'index']);
    Route::get('/konta/dodaj', [KontaController::class, 'dodaj'])->name('konta.dodaj');
    Route::get('/konta/usun', [KontaController::class, 'usun'])->name('konta.usun');
    Route::get('/konta/rola', [KontaController::class, 'rola'])->name('konta.rola');
    Route::post('/konta/zmienRole/{id}', [KontaController::class, 'zmienRole'])->name('konta.zmienRole');
    Route::post('/konta/dodajDoBazy', [KontaController::class, 'dodajDoBazy'])->name('konta.dodajDoBazy');
    Route::get('/konta/usunZBazy/{id}', [KontaController::class, 'usunZBazy'])->name('konta.usunZBazy');
    Route::get('/konta/edytuj', [KontaController::class, 'edytuj'])->name('konta.edytuj');
    Route::get('/konta/edytujpracownika/{id}', [KontaController::class, 'edytujPracownika'])->name('konta.edytujPracownika');
    Route::post('/konta/zmienDane/{id}', [KontaController::class, 'zmienDane'])->name('konta.zmienDane');
    Route::get('/rezerwacje', [App\Http\Controllers\RezerwacjeController::class, 'index'])->name('rezerwacje.index');
    Route::get('/rezerwacje/dodaj', [App\Http\Controllers\RezerwacjeController::class, 'dodaj'])->name('rezerwacje.dodaj');
    Route::get('/rezerwacje/lista', [App\Http\Controllers\RezerwacjeController::class, 'lista'])->name('rezerwacje.lista');
});

Auth::routes();
Route::middleware(\App\Http\Middleware\IsMagazynier::class )->group(function () {
    Route::get('/dostawy/dodaj', [DostawyController::class, 'dodaj'])->name('dostawy.dodaj');
    Route::get('/dostawy/usun', [DostawyController::class, 'usun'])->name('dostawy.usun');
    Route::post('/dostawy/wybierzDodaj', [DostawyController::class, 'wybierzDodaj'])->name('dostawy.wybierzDodaj');
    Route::get('/dostawy/wybierzDodaj', [DostawyController::class, 'wybierzDodaj'])->name('dostawy.wybierzDodaj');
    Route::post('/dostawy/wybierzUsun', [DostawyController::class, 'wybierzUsun'])->name('dostawy.wybierzUsun');
    Route::get('/dostawy/wybierzUsun', [DostawyController::class, 'wybierzUsun'])->name('dostawy.wybierzUsun');
    Route::post('dostawy/dodajDoBazy', [DostawyController::class, 'dodajDoBazy'])->name('dostawy.dodajDoBazy');
    Route::post('dostawy/usunZBazy', [DostawyController::class, 'usunZBazy'])->name('dostawy.usunZBazy');
});

Route::middleware(\App\Http\Middleware\HasDostawy::class)->group(function () {
    Route::get('/dostawy', [App\Http\Controllers\DostawyController::class, 'index']);
    Route::get('/dostawy/stan', [DostawyController::class, 'stan'])->name('dostawy.stan');
    Route::post('/dostawy/wybierz', [DostawyController::class, 'wybierz'])->name('dostawy.wybierz');
    Route::get('/dostawy/wybierz', [DostawyController::class, 'wybierz'])->name('dostawy.wybierz');
});

Auth::routes();
Route::get('/korespondencja', [App\Http\Controllers\KorespondencjaController::class, 'index']);

Auth::routes();
Route::get('/pracownicy', [App\Http\Controllers\PracownicyController::class, 'index']);
Auth::routes();
Route::get('/raporty', [App\Http\Controllers\RaportyController::class, 'index']);
Auth::routes();
Route::get('/grafik', [App\Http\Controllers\GrafikController::class, 'index']);

