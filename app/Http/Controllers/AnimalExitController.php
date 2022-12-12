<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Local;
use App\Models\Animal;
use App\Models\CauSaida;
use App\Models\MotSaida;
use Illuminate\Http\Request;
use App\Http\Requests\AnimalExitRequest;
use App\Http\Requests\AnimalLoteExitRequest;
use App\Http\Requests\AnimalLocalExitRequest;

class AnimalExitController extends Controller
{
    public function index()
    {
        return view('animal-exit.index');
    }

    public function individual()
    {
        $motivos = MotSaida::all();
        $causas = CauSaida::all();
        return view('animal-exit.individual', [
            'motivos' => $motivos,
            'causas' => $causas,
        ]);
    }

    public function lote()
    {
        $lotes = Lote::where('criador_id', auth()->user()->farmerId())->get();
        $locals = Local::where('criador_id', auth()->user()->farmerId())->get();
        return view('animal-exit.lote', compact('lotes'));
    }

    public function local()
    {
        $locals = Local::where('criador_id', auth()->user()->farmerId())->get();
        return view('animal-exit.local', compact('locals'));
    }

    public function animalLoteListForm(Lote $lote)
    {
        $animals = Animal::where('lote_id', $lote->id)
            ->whereNull('andatasai')
            ->where('criador_id', auth()->user()->farmerId())
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
            ->where('criador_id', auth()->user()->farmerId())
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

    public function individualExit(AnimalExitRequest $request)
    {
        $animal = Animal::find($request->animal_id);
        $animal->update($request->all());
        return redirect()
            ->route('animal-exit-individual')
            ->withToastSuccess('Saída de animal realizada com sucesso!');
    }

    public function AnimalLocalFormExit()
    {
    }
}
