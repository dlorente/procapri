<?php

namespace App\Http\Controllers;

use App\Models\Cio;
use App\Models\Lote;
use App\Models\Local;
use App\Models\Animal;
use App\Models\CauSaida;
use App\Models\MotSaida;
use App\Http\Requests\AnimalChangeLocationRequest;
use App\Http\Requests\AnimalHeatRequest;
use App\Http\Requests\AnimalLoteChangeLocationRequest;
use App\Http\Requests\AnimalLocalChangeLocationRequest;
use App\Models\ConfPrenha;
use App\Models\TPCio;
use App\Models\TPCobertura;
use App\Models\TPExGest;
use Illuminate\Http\Request;

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
        $tpcios = TPCio::all();
        return view('animal-heat.form', [
            'tpcoberturas' => $tpcoberturas,
            'confprenhas' => $confprenhas,
            'tpexgests' => $tpexgests,
            'tpcios' => $tpcios,
        ]);
    }

    public function store(AnimalHeatRequest $request)
    {
        $animal = Animal::find($request->animal_id);
        $request['anregistro'] = $animal->anregistro;
        $request['cpcodigo'] = null;
        if($request->confprenha_id) {
            $confp = ConfPrenha::find($request->confprenha_id);
            $request['cpcodigo'] = $confp->cpcodigo;
        }
        $request['cobcodigo'] = null;
        if($request->tpcobertura_id) {
            $confp = TPCobertura::find($request->tpcobertura_id);
            $request['cobcodigo'] = $confp->cobcodigo;
        }
        $request['exgcodigo'] = null;
        if($request->tpexgest_id) {
            $confp = TPExGest::find($request->tpexgest_id);
            $request['exgcodigo'] = $confp->exgcodigo;
        }
        $request['ciocodigo'] = null;
        if($request->tpcio_id) {
            $confp = TPCio::find($request->tpcio_id);
            $request['ciocodigo'] = $confp->ciocodigo;
        }
        dd($request->all());
    }

    public function update(Request $request, Cio $animal_heat)
    {
        $animal = Animal::find($request->animal_id);
        $request['anregistro'] = $animal->anregistro;
        $request['cpcodigo'] = null;
        if($request->confprenha_id) {
            $confp = ConfPrenha::find($request->confprenha_id);
            $request['cpcodigo'] = $confp->cpcodigo;
        }
        $request['cobcodigo'] = null;
        if($request->tpcobertura_id) {
            $confp = TPCobertura::find($request->tpcobertura_id);
            $request['cobcodigo'] = $confp->cobcodigo;
        }
        $request['exgcodigo'] = null;
        if($request->tpexgest_id) {
            $confp = TPExGest::find($request->tpexgest_id);
            $request['exgcodigo'] = $confp->exgcodigo;
        }

        $request['ciocodigo'] = null;
        if($request->tpcio_id) {
            $confp = TPCio::find($request->tpcio_id);
            $request['ciocodigo'] = $confp->ciocodigo;
        }

        // dd($request->all());
        
        $animal_heat->update($request->all());

        return redirect()
            ->route('animal-heat.index')
            ->withToastSuccess('Cio (Monta campo) atualizado com sucesso!');
    }

    public function show()
    {

    }

    public function edit(Cio $animal_heat)
    {
        $tpcoberturas = TPCobertura::all();
        $confprenhas = ConfPrenha::all();
        $tpexgests = TPExGest::all();
        $tpcios = TPCio::all();
        return view('animal-heat.form', [
            'animal_heat' => $animal_heat,
            'tpcoberturas' => $tpcoberturas,
            'confprenhas' => $confprenhas,
            'tpexgests' => $tpexgests,
            'tpcios' => $tpcios,
        ]);
    }

    public function destroy()
    {

    }
}