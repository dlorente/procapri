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
    Route::get('animals/{animal}/exit', [AnimalController::class, 'animalExitFormIndividual'])->name('animals.exit.form');
    Route::post('animals/{animal}/exit', [AnimalController::class, 'animalExit'])->name('animals.exit');
    Route::resources([
        'animals' => AnimalController::class,
    ]);

    Route::get('animal-exit', [AnimalExitController::class, 'index'])->name('animal-exit');
    Route::get('animal-individual-exit-form/{animal}', [AnimalExitController::class, 'individualExitForm'])->name('animal-individual-exit-form');
    Route::post('animal-individual-exit/{animal}', [AnimalExitController::class, 'individualExit'])->name('animal-individual-exit');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
