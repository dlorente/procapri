<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\CauSaida;
use App\Models\MotSaida;
use Illuminate\Http\Request;
use App\Http\Requests\AnimalExitRequest;

class AnimalExitController extends Controller
{
    public function index()
    {
        return view('animal-exit.tabs');
    }

    public function individualExitForm(Animal $animal)
    {
        $motivos = MotSaida::all();
        $causas = CauSaida::all();
        return view('animal-exit.tabs.individual-exit-form', [
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

    public function LoteExit()
    {
        
    }

    public function LocalFormExit()
    {
        
    }

    public function LocalExit()
    {
        
    }
}