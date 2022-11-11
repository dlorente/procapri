<?php

namespace App\Http\Controllers;

use App\Http\Requests\PregnancyDiagnosesRequest;
use App\Models\Cio;
use App\Models\TPCio;
use App\Models\TPExGest;
use App\Models\ConfPrenha;
use App\Models\TPCobertura;
use Illuminate\Http\Request;

class PregnancyDiagnosesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Cio::join('animal', 'animal.id', '=', 'cio.animal_id')
            ->select('animal.*', 'cio.cidata', 'cio.id as cio_id', 'cio.ciflag')            
            ->search()
            ->where('cio.ciflag', 'S')
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->orderBy('animal.anregistro')
            ->orderBy('cio.cidata')
            ->paginate(10);

        return view('pregnancy-diagnoses.index', [
            'animals' => $animals,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PregnancyDiagnosesRequest $request)
    {
        $request['ciflag'] = $request['cpcodigo'] == 'N' ? 'N' : 'S';
        Cio::create($request->all());
        return redirect()
            ->route('pregnancy-diagnoses.index')
            ->withToast('Diagnóstico de prenhes cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cio $pregnancy_diagnosis)
    {
        $tpcoberturas = TPCobertura::all();
        $confprenhas = ConfPrenha::all();
        $tpexgests = TPExGest::all();
        $tpcios = TPCio::all();
        return view('pregnancy-diagnoses.form', [
            'pregnancy_diagnosis' => $pregnancy_diagnosis,
            'tpcoberturas' => $tpcoberturas,
            'confprenhas' => $confprenhas,
            'tpexgests' => $tpexgests,
            'tpcios' => $tpcios,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PregnancyDiagnosesRequest $request, Cio $pregnancy_diagnosis)
    {
        $request['ciflag'] = $request['cpcodigo'] == 'N' ? 'N' : 'S';
        $pregnancy_diagnosis->update($request->all());
        return redirect()
            ->route('pregnancy-diagnoses.index')
            ->withToast('Diagnóstico de prenhes alterado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
