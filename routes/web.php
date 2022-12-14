<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\OldLoginController;
use App\Http\Controllers\AnimalExitController;
use App\Http\Controllers\AnimalHeatController;
use App\Http\Controllers\AnimalMilkController;
use App\Http\Controllers\AnimalBirthController;
use App\Http\Controllers\AnimalHealthController;
use App\Http\Controllers\AnimalWeightController;
use App\Http\Controllers\DairyControlController;
use App\Http\Controllers\SetActiveAbaController;
use App\Http\Controllers\AnimalWeaningController;
use App\Http\Controllers\WeightControlController;
use App\Http\Controllers\AnimalTreatmentController;
use App\Http\Controllers\ParturitionEntriesController;
use App\Http\Controllers\PregnancyDiagnosesController;
use App\Http\Controllers\AnimalChangeLocationController;
use App\Http\Controllers\AnimalRegistrationController;
use App\Http\Controllers\DryOffControlController;
use App\Http\Controllers\OccurrenceController;

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
    Route::get('set-active-aba/{index}', [SetActiveAbaController::class, '__invoke'])->name('set.active.aba');
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
        'occurrences' => OccurrenceController::class,
        'animal-registrations' => AnimalRegistrationController::class,
    ]);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    
    Route::get('animals-search', [AnimalController::class, 'animalSearch'])->name('animals.search');
    
    Route::get('animal-exit', [AnimalExitController::class, 'index'])->name('animal-exit');
    Route::get('animal-exit/individual', [AnimalExitController::class, 'individual'])->name('animal-exit-individual-form');
    Route::get('animal-exit/lote', [AnimalExitController::class, 'lote'])->name('animal-exit-lote-form');
    Route::get('animal-exit/local', [AnimalExitController::class, 'local'])->name('animal-exit-local-form');
    Route::get('animal-exit/lote-list-form/{lote}', [AnimalExitController::class, 'animalLoteListForm'])->name('animal-lote-list-form');
    Route::get('animal-exit/local-list-form/{local}', [AnimalExitController::class, 'animalLocalListForm'])->name('animal-local-list-form');
    Route::post('animal-exit/lote-exit', [AnimalExitController::class, 'loteExit'])->name('lote-exit');
    Route::post('animal-exit/local-exit', [AnimalExitController::class, 'LocalExit'])->name('local-exit');
    Route::post('animal-exit/individual', [AnimalExitController::class, 'individualExit'])->name('animal-exit-individual');

    // Animal change location
    Route::get('animal-change-location', [AnimalChangeLocationController::class, 'index'])->name('animal-change-location');
    Route::get('animal-change-location/individual', [AnimalChangeLocationController::class, 'individual'])->name('animal-change-location-individual-form');
    Route::get('animal-change-location/lote', [AnimalChangeLocationController::class, 'lote'])->name('animal-change-location-lote-form');
    Route::get('animal-change-location/local', [AnimalChangeLocationController::class, 'local'])->name('animal-change-location-local-form');
    Route::get('animal-change-location/lote-list-form/{lote}', [AnimalChangeLocationController::class, 'animalLoteListForm'])->name('animal-lote-list-form');
    Route::get('animal-change-location/local-list-form/{local}', [AnimalChangeLocationController::class, 'animalLocalListForm'])->name('animal-local-list-form');
    Route::get('animal-change-location/{animal}/individual-change-location', [AnimalChangeLocationController::class, 'individualChangeLocationForm'])->name('individual-change-location-form');
    Route::post('animal-change-location/lote-change-location', [AnimalChangeLocationController::class, 'loteChangeLocation'])->name('lote-change-location');
    Route::post('animal-change-location/local-change-location', [AnimalChangeLocationController::class, 'LocalChangeLocation'])->name('local-change-location');
    Route::post('animal-change-location/individual', [AnimalChangeLocationController::class, 'individualChangeLocation'])->name('animal-change-location-individual');

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
    
    // Weight Controls
    Route::get('weight-controls', [WeightControlController::class, 'index'])->name('weight-controls.index');
    Route::get('weight-controls/create', [WeightControlController::class, 'create'])->name('weight-controls.create');
    Route::get('weight-controls/create-by-date', [WeightControlController::class, 'createByDate'])->name('weight-controls.create-by-date');
    Route::post('weight-controls/store', [WeightControlController::class, 'store'])->name('weight-controls.store');
    Route::post('weight-controls/store-by-date', [WeightControlController::class, 'storeByDate'])->name('weight-controls.store-by-date');

    // Dairy Controls
    Route::get('dairy-controls', [DairyControlController::class, 'index'])->name('dairy-controls.index');
    Route::get('dairy-controls/create', [DairyControlController::class, 'create'])->name('dairy-controls.create');
    Route::get('dairy-control/{dairy_control}/edit', [DairyControlController::class, 'edit'])->name('dairy-controls.edit');
    Route::get('dairy-controls/create-by-date', [DairyControlController::class, 'createByDate'])->name('dairy-controls.create-by-date');
    Route::post('dairy-controls/store', [DairyControlController::class, 'store'])->name('dairy-controls.store');
    Route::post('dairy-controls/store-by-date', [DairyControlController::class, 'storeByDate'])->name('dairy-controls.store-by-date');
    Route::post('dairy-control/{dairy_control}', [DairyControlController::class, 'destroy'])->name('dairy-controls.destroy');

    // Dryoff Controls
    Route::get('dryoff-controls', [DryOffControlController::class, 'index'])->name('dryoff-controls.index');
    Route::get('dryoff-control/{dryoff_control}/edit', [DryOffControlController::class, 'edit'])->name('dryoff-controls.edit');
    Route::get('dryoff-control/{lote_id}/form-lote', [DryOffControlController::class, 'formLote'])->name('dryoff-controls.form-lote');
    Route::get('dryoff-control/{local_id}/form-local', [DryOffControlController::class, 'formLocal'])->name('dryoff-controls.form-local');
    Route::get('dryoff-control/{dryoff_control}/form-local', [DryOffControlController::class, 'formLocal'])->name('dryoff-controls.form-local');
    Route::post('dryoff-control/{dryoff_control}', [DryOffControlController::class, 'update'])->name('dryoff-controls.update');
    Route::post('dryoff-control/update-local/{local_id}', [DryOffControlController::class, 'updateLocal'])->name('dryoff-controls.update-local');
    Route::post('dryoff-control/update-lote/{lote_id}', [DryOffControlController::class, 'updateLote'])->name('dryoff-controls.update-lote');
});

// Old login
Route::get('old-login', [OldLoginController::class, 'index'])->name('old-login.index')->middleware('auth');
Route::get('old-login/message', [OldLoginController::class, 'message'])->name('old-login.message')->middleware('auth');
Route::post('old-login/login', [OldLoginController::class, 'login'])->name('old-login.login')->middleware('auth');

Route::get('old-login/farmer-form', [OldLoginController::class, 'oldLoginFarmerForm'])->name('old-login.farmer-form')->middleware('auth');
Route::post('old-login/farmer', [OldLoginController::class, 'oldLoginFarmer'])->name('old-login.farmer')->middleware('auth');
