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
});

Auth::routes();
Route::middleware('role_mag')->group(function () {
    Route::get('/dostawy', [App\Http\Controllers\DostawyController::class, 'index'])->middleware(\App\Http\Middleware\IsMagazynier::class);
    Route::get('/dostawy/stan', [DostawyController::class, 'stan'])->name('dostawy.stan');
    Route::get('/dostawy/dodaj', [DostawyController::class, 'dodaj'])->name('dostawy.dodaj');
    Route::post('/dostawy/wybierz', [DostawyController::class, 'wybierz'])->name('dostawy.wybierz');
    Route::post('/dostawy/wybierzDodaj', [DostawyController::class, 'wybierzDodaj'])->name('dostawy.wybierzDodaj');
    Route::get('/dostawy/wybierzDodaj', [DostawyController::class, 'wybierzDodaj'])->name('dostawy.wybierzDodaj');
    Route::post('dostawy/dodajDoBazy', [DostawyController::class, 'dodajDoBazy'])->name('dostawy.dodajDoBazy');
});


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
Auth::routes();
Route::get('/dostawy', [App\Http\Controllers\DostawyController::class, 'index']);

