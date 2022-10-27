<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Animal;
use App\Models\CauSaida;
use App\Models\MotSaida;
use Illuminate\Http\Request;
use App\Http\Requests\AnimalExitRequest;
use App\Http\Requests\AnimalLoteExitRequest;

class AnimalExitController extends Controller
{
    public function index()
    {
        $animals = Animal::search()
            ->where('animal.criador_id', 137)
            ->orderBy('animal.anregistro')
            ->paginate(10);
        $lotes = Lote::where('criador_id', 137)->get();

        return view('animal-exit.tabs', [
            'animals' => $animals,
            'lotes' => $lotes,
        ]);
    }

    public function animalLoteListForm(Lote $lote)
    {
        $animals = Animal::where('lote_id', $lote->id)
            ->whereNull('andatasai')
            ->get();
        $motivos = MotSaida::all();
        $causas = CauSaida::all();

        return view('animal-exit.animal-lote-list-form', [
            'animals' => $animals,
            'motivos' => $motivos,
            'causas' => $causas,
        ]);
    }

    public function LoteExit(AnimalLoteExitRequest $request)
    {
        dd($request->all());
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

    public function LoteFormExit()
    {
    }

    public function LocalFormExit()
    {
    }

    public function LocalExit()
    {
    }
}
