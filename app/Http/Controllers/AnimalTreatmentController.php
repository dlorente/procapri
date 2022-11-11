<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Ocorre;
use Illuminate\Http\Request;
use App\Http\Requests\AnimalTreatmentRequest;

class AnimalTreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $occurrences = Ocorre::join('animal', 'animal.id', '=', 'ocorre.animal_id')
            ->select('animal.*', 'ocorre.ocdata', 'ocorre.id as ocorre_id')
            ->search()
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->orderBy('animal.anregistro')
            ->orderBy('ocorre.ocdata')
            ->paginate(10); 
            
        return view('animal-treatments.index', [
            'occurrences' => $occurrences,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('animal-treatments.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $animal = Animal::find($request->animal_id);
        $animal_treatment = Ocorre::where('anregistro', $animal->anregistro)
            ->where('crcodigo', $animal->crcodigo)
            ->where('ocdata', date_db($request->ocdata))
            ->get();

        if($animal_treatment->count() > 0) {
            return back()
                ->withInput()
                ->withToastSuccess('Produção já cadastrada para o animal ' . $animal->anregistro . ' -> ' . $request->prdatacon);
        }

        $request['anregistro'] = $animal->anregistro;
        $request['crcodigo'] = $animal->crcodigo;

        Ocorre::create($request->all());

        return redirect()
            ->route('animal-treatments.index')
            ->withToastSuccess('Ocorrência(s) cadastrada(s) com sucesso!');
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
    public function edit(Ocorre $animal_treatment)
    {
        return view('animal-treatments.form', compact('animal_treatment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalTreatmentRequest $request, Ocorre $animal_treatment)
    {
        $animal = Animal::find($request->animal_id);
        $request['anregistro'] = $animal->anregistro;
        $request['crcodigo'] = $animal->crcodigo;

        $animal_treatment->update($request->all());

        return redirect()
            ->route('animal-treatments.index')
            ->withToastSuccess('Ocorrência(s) atualizada(s) com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ocorre $animal_treatment)
    {
        $animal_treatment->delete();
        return redirect()
            ->route('animal-treatments.index')
            ->withToastSuccess('Ocorrência removida com sucesso.');
    }
}
