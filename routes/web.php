<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\OldLoginController;
use App\Http\Controllers\AnimalExitController;
use App\Http\Controllers\AnimalHeatController;
use App\Http\Controllers\AnimalMilkController;
use App\Http\Controllers\AnimalBirthController;
use App\Http\Controllers\AnimalHealthController;
use App\Http\Controllers\AnimalWeightController;
use App\Http\Controllers\AnimalWeaningController;
use App\Http\Controllers\AnimalChangeLocationController;
use App\Http\Controllers\AnimalTreatmentController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\ParturitionEntriesController;
use App\Http\Controllers\PregnancyDiagnosesController;

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


Route::group(['middleware' => ['auth', 'check.farmer']], function () {

    Route::resources([
        'animals' => AnimalController::class,
        'animal-heat' => AnimalHeatController::class,
        'animal-birth' => AnimalBirthController::class,
        'animal-weight' => AnimalWeightController::class,
        'animal-milk' => AnimalMilkController::class,
        'farmer' => FarmerController::class,
        'animal-health' => AnimalHealthController::class,
        'lote' => LoteController::class,
        'local' => LocalController::class,
        'animal-treatments' => AnimalTreatmentController::class,
        'pregnancy-diagnoses' => PregnancyDiagnosesController::class,
    ]);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    
    Route::get('animals-search', [AnimalController::class, 'animalSearch'])->name('animals.search');
    
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
    Route::get('animal-weaning', [AnimalWeaningController::class, 'index'])->name('animal-weaning.index');
    Route::get('animal-weaning/{animal_weaning}/individual-weaning', [AnimalWeaningController::class, 'individualWeaningForm'])->name('individual-weaning-form');
    Route::get('animal-weaning/local-list-form/{local}', [AnimalWeaningController::class, 'animalLocalListForm'])->name('animal-weaning-local-list-form');
    Route::get('animal-weaning/lote-list-form/{lote}', [AnimalWeaningController::class, 'animalLoteListForm'])->name('animal-weaning-lote-list-form');
    Route::post('animal-weaning/{animal_weaning}/individual-weaning', [AnimalWeaningController::class, 'individualWeaning'])->name('individual-weaning');
    Route::post('animal-weaning/lote', [AnimalWeaningController::class, 'animalWeaningLote'])->name('lote-weaning');
    Route::post('animal-weaning/local', [AnimalWeaningController::class, 'animalWeaningLocal'])->name('local-weaning');

    //Route::resource('parturition-entries', ParturitionEntriesController::class)->except(['create', 'show']);
    Route::get('parturition-entries', [ParturitionEntriesController::class, 'index'])->name('parturition-entries.index');
    Route::post('parturition-entries/store/{parturition_entry}', [ParturitionEntriesController::class, 'store'])
        ->name('parturition-entries.store');
    Route::get('parturition-entries/{parturition_entry}/create', [ParturitionEntriesController::class, 'create'])
        ->name('parturition-entries.create');
    Route::get('parturition-entries/baby-form', [ParturitionEntriesController::class, 'babyForm'])
        ->name('parturition-entries.baby-form');
    // Route::get('animal-heat', [AnimalHeatController::class, 'index'])->name('animal-heat.index');
    // Route::get('animal-heat/{cio}', [AnimalHeatController::class, 'show'])->name('animal-heat.show');
    // Route::get('animal-heat/{cio}/edit', [AnimalHeatController::class, 'edit'])->name('animal-heat.edit');
    // Route::get('animal-heat/{cio}/destroy', [AnimalHeatController::class, 'destroy'])->name('animal-heat.destroy');
    // Route::get('animal-heat/create', [AnimalHeatController::class, 'create'])->name('animal-heat.create');
});

// Old login
Route::get('old-login', [OldLoginController::class, 'index'])->name('old-login.index')->middleware('auth');
Route::get('old-login/message', [OldLoginController::class, 'message'])->name('old-login.message')->middleware('auth');
Route::post('old-login/login', [OldLoginController::class, 'login'])->name('old-login.login')->middleware('auth');

Route::get('old-login/farmer-form', [OldLoginController::class, 'oldLoginFarmerForm'])->name('old-login.farmer-form')->middleware('auth');
Route::post('old-login/farmer', [OldLoginController::class, 'oldLoginFarmer'])->name('old-login.farmer')->middleware('auth');
