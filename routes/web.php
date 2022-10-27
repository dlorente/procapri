<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AnimalExitController;

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

Auth::routes();



Route::middleware(['auth'])->group(function () {
    Route::get('animals-search', [AnimalController::class, 'animalSearch'])->name('animals.search');
    Route::resources([
        'animals' => AnimalController::class,
    ]);

    Route::get('animal-exit', [AnimalExitController::class, 'index'])->name('animal-exit');
    Route::get('animal-exit/lote-list-form/{lote}', [AnimalExitController::class, 'animalLoteListForm'])->name('animal-lote-list-form');
    Route::get('animal-exit/{animal}/individual-exit', [AnimalExitController::class, 'individualExitForm'])->name('individual-exit-form');
    Route::post('animal-exit/lote-exit', [AnimalExitController::class, 'loteExit'])->name('lote-exit');
    Route::post('animals/{animal}/exit', [AnimalController::class, 'animalExit'])->name('animals.exit');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
