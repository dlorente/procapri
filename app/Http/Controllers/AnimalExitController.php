<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Local;
use App\Models\Animal;
use App\Models\CauSaida;
use App\Models\MotSaida;
use App\Http\Requests\AnimalLoteExitRequest;
use App\Http\Requests\AnimalLocalExitRequest;

class AnimalExitController extends Controller
{
    public function index()
    {
        $animals = Animal::search()
            ->where('animal.criador_id', 137)
            ->orderBy('animal.anregistro')
            ->paginate(10);
        $lotes = Lote::where('criador_id', 137)->get();
        $locals = Local::where('criador_id', 137)->get();

        return view('animal-exit.tabs', [
            'animals' => $animals,
            'lotes' => $lotes,
            'locals' => $locals,
        ]);
    }

    public function animalLoteListForm(Lote $lote)
    {
        $animals = Animal::where('lote_id', $lote->id)
            ->whereNull('andatasai')
            ->where('criador_id', 137)
            ->get();
        $motivos = MotSaida::all();
        $causas = CauSaida::all();
        return view('animal-exit.animal-lote-list-form', [
            'animals' => $animals,
            'motivos' => $motivos,
            'causas' => $causas,
        ]);
    }

    public function animalLocalListForm(Local $local)
    {
        $animals = Animal::where('local_id', $local->id)
            ->whereNull('andatasai')
            ->where('criador_id', 137)
            ->get();
        $motivos = MotSaida::all();
        $causas = CauSaida::all();
        return view('animal-exit.animal-local-list-form', [
            'animals' => $animals,
            'motivos' => $motivos,
            'causas' => $causas,
        ]);
    }

    public function LoteExit(AnimalLoteExitRequest $request)
    {
        $animals = Animal::whereIn('id', $request->animal_id)->get();
        foreach($animals as $animal) {
            $animal->update($request->all());
        }
        return redirect()
            ->route('animal-exit')
            ->withToastSuccess('Saída de animal realizada com sucesso!'); 
    }

    public function LocalExit(AnimalLocalExitRequest $request)
    {
        $animals = Animal::whereIn('id', $request->animal_id)->get();
        foreach($animals as $animal) {
            $animal->update($request->all());
        }
        return redirect()
            ->route('animal-exit')
            ->withToastSuccess('Saída de animal, por local, realizada com sucesso!'); 
    }

    public function individualExitForm(Animal $animal)
    {
        $motivos = MotSaida::all();
        $causas = CauSaida::all();
        return view('animal-exit.individual-exit-form', [
            'animal' => $animal,
            'motivos' => $motivos,
            'causas' => $causas,
        ]);
    }

    public function individualExit(AnimalExitRequest $request, Animal $animal)
    {
        $animal->update($request->all());
        return redirect()
            ->route('animals.index')
            ->withToastSuccess('Saída de animal realizada com sucesso!');
    }

    public function AnimalLocalFormExit()
    {
    }
}
