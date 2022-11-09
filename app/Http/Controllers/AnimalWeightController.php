<?php

namespace App\Http\Controllers;

use App\Models\Peso;
use App\Models\Animal;
use Illuminate\Http\Request;
use App\Http\Requests\AnimalWeightRequest;

class AnimalWeightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Peso::join('animal', 'animal.id', '=', 'peso.animal_id')
            ->select('animal.*', 'peso.pedatapes', 'peso.pepeso', 'peso.id as peso_id')            
            ->search()
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->orderBy('animal.anregistro')
            ->orderBy('peso.pedatapes')
            ->paginate(10);        

        return view('animal-weight.index', [
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
        return view('animal-weight.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalWeightRequest $request)
    {
        $animal = Animal::find($request->animal_id);
        $request['anregistro'] = $animal->anregistro;
        $request['crcodigo'] = $animal->crcodigo;
        $request['criador_id'] = $animal->criador_id;
        $request['pepeso'] = str_replace(',', '.', $request['pepeso']);

        Peso::create($request->all());

        return redirect()
            ->route('animal-weight.index')
            ->withToastSuccess('Peso cadastrado com sucesso!');
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
    public function edit(Peso $animal_weight)
    {
        $animal_weight->pepeso = str_replace('.', ',', $animal_weight->pepeso);
        return view('animal-weight.form', compact('animal_weight'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalWeightRequest $request, Peso $animal_weight)
    {
        $animal = Animal::find($request->animal_id);
        $request['anregistro'] = $animal->anregistro;
        $request['crcodigo'] = $animal->crcodigo;
        $request['criador_id'] = $animal->criador_id;
        $request['pepeso'] = str_replace(',', '.', $request['pepeso']);

        $animal_weight->update($request->all());

        return redirect()
            ->route('animal-weight.index')
            ->withToastSuccess('Peso alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peso $animal_weight)
    {
        $animal_weight->delete();

        return redirect()
            ->route('animal-weight.index')
            ->withToastSuccess('Pesagem exluída com sucesso!');
    }
}
