<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalBirthRequest;
use App\Models\Animal;
use App\Http\Requests\AnimalHeatRequest;
use App\Models\ConfPrenha;
use App\Models\Encerra;
use App\Models\Parto;
use App\Models\TPCio;
use App\Models\TPCobertura;
use App\Models\TPExGest;
use App\Models\TPParto;
use Illuminate\Http\Request;

class AnimalBirthController extends Controller
{
    public function index()
    {
        $animals = Parto::join('animal', 'animal.id', '=', 'parto.animal_id')
            ->select('animal.*', 'parto.padatapar', 'parto.id as parto_id')            
            ->search()
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->orderBy('animal.anregistro')
            ->orderBy('parto.padatapar')
            ->paginate(10);        

        return view('animal-birth.index', [
            'animals' => $animals,
        ]);
    }

    public function create()
    {
        $tppartos = TPParto::all();
        $tpcoberturas = TPCobertura::all();
        $encerra_motivos = Encerra::all();
        $tpcios = TPCio::all();
        return view('animal-birth.form', [
            'tppartos' => $tppartos,
            'tpcoberturas' => $tpcoberturas,
            'encerra_motivos' => $encerra_motivos,
            'tpcios' => $tpcios,
        ]);
    }

    public function store(AnimalBirthRequest $request)
    {
        $animal = Animal::find($request->animal_id);
        $animal_birth = Parto::where('anregistro', $animal->anregistro)
            ->where('crcodigo', $animal->crcodigo)
            ->where('padatapar', date_db($request->padatapar))
            ->get();

        if($animal_birth->count() > 0) {
            return back()
                ->withInput()
                ->withToastSuccess('Cio já cadastrado para o animal ' . $animal->anregistro . ' -> ' . $request->padatapar);
        }
        $request['anregistro'] = $animal->anregistro;
        $request['crcodigo'] = $animal->crcodigo;
        $request['criador_id'] = $animal->criador_id;

        Parto::create($request->all());

        return redirect()
            ->route('animal-birth.index')
            ->withToastSuccess('Parto cadastrado com sucesso!');
        
    }

    public function update(AnimalBirthRequest $request, Parto $animal_birth)
    {
        $animal = Animal::find($request->animal_id);

        $request['anregistro'] = $animal->anregistro;
        $request['crcodigo'] = $animal->crcodigo;
        $request['criador_id'] = $animal->criador_id;

        $animal_birth->update($request->all());

        return redirect()
            ->route('animal-birth.index')
            ->withToastSuccess('Parto alterado com sucesso!');
    }

    public function show()
    {

    }

    public function edit(Parto $animal_birth)
    {
        $tppartos = TPParto::all();
        $tpcoberturas = TPCobertura::all();
        $encerra_motivos = Encerra::all();
        $tpcios = TPCio::all();
        return view('animal-birth.form', [
            'tppartos' => $tppartos,
            'tpcoberturas' => $tpcoberturas,
            'encerra_motivos' => $encerra_motivos,
            'tpcios' => $tpcios,
            'animal_birth' => $animal_birth,
        ]);
    }

    public function destroy(Parto $animal_birth)
    {
        $animal_birth->delete();

        return redirect()
            ->route('animal-heat.index')
            ->withToastSuccess('Parto exluído com sucesso!');
    }
}