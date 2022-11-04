<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AnimalExitController;
use App\Http\Controllers\AnimalChangeLocationController;
use App\Http\Controllers\AnimalWeaningController;

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
    Route::get('animal-exit/local-list-form/{local}', [AnimalExitController::class, 'animalLocalListForm'])->name('animal-local-list-form');
    Route::get('animal-exit/{animal}/individual-exit', [AnimalExitController::class, 'individualExitForm'])->name('individual-exit-form');
    Route::post('animal-exit/lote-exit', [AnimalExitController::class, 'loteExit'])->name('lote-exit');
    Route::post('animal-exit/local-exit', [AnimalExitController::class, 'LocalExit'])->name('local-exit');
    Route::post('animals/{animal}/exit', [AnimalController::class, 'animalExit'])->name('animals.exit');

    // Animal change location
    Route::get('animal-change-location', [AnimalChangeLocationController::class, 'index'])->name('animal-change-location');
    Route::get('animal-change-location/lote-list-form/{lote}', [AnimalChangeLocationController::class, 'animalLoteListForm'])->name('animal-lote-list-form');
    Route::get('animal-change-location/local-list-form/{local}', [AnimalChangeLocationController::class, 'animalLocalListForm'])->name('animal-local-list-form');
    Route::get('animal-change-location/{animal}/individual-change-location', [AnimalChangeLocationController::class, 'individualChangeLocationForm'])->name('individual-change-location-form');
    Route::post('animal-change-location/lote-change-location', [AnimalChangeLocationController::class, 'loteChangeLocation'])->name('lote-change-location');
    Route::post('animal-change-location/local-change-location', [AnimalChangeLocationController::class, 'LocalChangeLocation'])->name('local-change-location');
    Route::post('animals/{animal}/change-location', [AnimalChangeLocationController::class, 'individualChangeLocation'])->name('animals.change-location');

    // Animal weaning
    Route::get('animal-weaning', [AnimalWeaningController::class, 'index'])->name('animal-weaning');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
