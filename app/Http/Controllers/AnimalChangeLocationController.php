<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Local;
use App\Models\Animal;
use App\Models\CauSaida;
use App\Models\MotSaida;
use App\Http\Requests\AnimalChangeLocationRequest;
use App\Http\Requests\AnimalLoteChangeLocationRequest;
use App\Http\Requests\AnimalLocalChangeLocationRequest;

class AnimalChangeLocationController extends Controller
{
    public function index()
    {
        $animals = Animal::search()
            ->where('animal.criador_id', 137)
            ->orderBy('animal.anregistro')
            ->paginate(10);
        $lotes = Lote::where('criador_id', 137)->get();
        $locals = Local::where('criador_id', 137)->get();

        return view('animal-change-location.tabs', [
            'animals' => $animals,
            'lotes' => $lotes,
            'locals' => $locals,
        ]);
    }

    public function animalLoteListForm(Lote $lote)
    {
        $animals = Animal::leftJoin('local', function($join) {
            $join->on('animal.local_id', '=', 'local.id')
                ->where('animal.criador_id', '=', 'local.criador_id');
            })
            ->leftJoin('lote', function($join) {
                $join->on('animal.lote_id', '=', 'lote.id')
                    ->where('animal.criador_id', '=', 'lote.criador_id');
            })
            ->where(function($query) {
                $query->whereNull('animal.andatasai')
                    ->orWhere('animal.andatasai', '=', '0000-00-00');
            })
            ->select('animal.*')
            ->where('animal.criador_id', 137)
            ->where('animal.lote_id', $lote->id)
            ->get();

        $lotes = Lote::where('criador_id', 137)->get();
        return view('animal-change-location.animal-lote-list-form', [
            'animals' => $animals,
            'lotes' => $lotes,
        ]);
    }

    public function animalLocalListForm(Local $local)
    {
        $animals = Animal::where('local_id', $local->id)
            ->whereNull('andatasai')
            ->get();
        $motivos = MotSaida::all();
        $causas = CauSaida::all();
        return view('animal-change-location.animal-local-list-form', [
            'animals' => $animals,
            'motivos' => $motivos,
            'causas' => $causas,
        ]);
    }

    public function LoteChangeLocation(AnimalLoteChangeLocationRequest $request)
    {        
        $animals = Animal::whereIn('id', $request->animal_id)->get();
        foreach($animals as $animal) {
            $animal->update($request->all());
        }
        return redirect()
            ->route('animal-change-location')
            ->withToastSuccess('Movimentação realizada com sucesso!'); 
    }

    public function LocalChangeLocation(AnimalLocalChangeLocationRequest $request)
    {
        $animals = Animal::whereIn('id', $request->animal_id)->get();
        foreach($animals as $animal) {
            $animal->update($request->all());
        }
        return redirect()
            ->route('animal-change-location')
            ->withToastSuccess('Saída de animal, por local, realizada com sucesso!'); 
    }

    public function individualChangeLocationForm(Animal $animal)
    {
        $lotes = Lote::where('criador_id', 137)->get();
        $locals = Local::where('criador_id', 137)->get();
        return view('animal-change-location.individual-change-location-form', [
            'animal' => $animal,
            'lotes' => $lotes,
            'locals' => $locals,
        ]);
    }

    public function individualChangeLocation(AnimalChangeLocationRequest $request, Animal $animal)
    {
        $animal->update($request->all());
        return redirect()
            ->route('animal-change-location')
            ->withToastSuccess('Movimentação de animal realizada com sucesso!');
    }

    public function AnimalLocalFormChangeLocation()
    {
    }
}