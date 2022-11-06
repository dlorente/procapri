<?php

namespace App\Http\Controllers;

use App\Models\Cio;
use App\Models\Lote;
use App\Models\Local;
use App\Models\Animal;
use App\Models\CauSaida;
use App\Models\MotSaida;
use App\Http\Requests\AnimalChangeLocationRequest;
use App\Http\Requests\AnimalLoteChangeLocationRequest;
use App\Http\Requests\AnimalLocalChangeLocationRequest;
use App\Models\ConfPrenha;
use App\Models\TPCobertura;
use App\Models\TPExGest;

class AnimalHeatController extends Controller
{
    public function index()
    {
        $animals = Cio::join('animal', 'animal.id', '=', 'cio.animal_id')
            ->select('animal.*', 'cio.cidata', 'cio.id as cio_id')            
            ->search()
            ->where('animal.criador_id', 137)
            ->orderBy('animal.anregistro')
            ->orderBy('cio.cidata')
            ->paginate(10);        

        return view('animal-heat.index', [
            'animals' => $animals,
        ]);
    }

    public function create()
    {
        $tpcoberturas = TPCobertura::all();
        $confprenhas = ConfPrenha::all();
        $tpexgests = TPExGest::all();
        return view('animal-heat.form', [
            'tpcoberturas' => $tpcoberturas,
            'confprenhas' => $confprenhas,
            'tpexgests' => $tpexgests,
        ]);
    }

    public function show()
    {

    }

    public function edit(Cio $animal_heat)
    {
        $tpcoberturas = TPCobertura::all();
        $confprenhas = ConfPrenha::all();
        $tpexgests = TPExGest::all();
        return view('animal-heat.form', [
            'animal_heat' => $animal_heat,
            'tpcoberturas' => $tpcoberturas,
            'confprenhas' => $confprenhas,
            'tpexgests' => $tpexgests,
        ]);
    }

    public function destroy()
    {

    }
}