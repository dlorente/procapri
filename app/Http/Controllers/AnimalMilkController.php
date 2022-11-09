<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\OCOLact;
use App\Models\Producao;
use Illuminate\Http\Request;
use App\Http\Requests\AnimalMilkRequest;

class AnimalMilkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Producao::join('animal', 'animal.id', '=', 'producao.animal_id')
            ->select('animal.*', 'producao.prdatacon', 'producao.id as producao_id', 'producao.prplord1', 'producao.prplord2', 'producao.prplord3')
            ->search()
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->orderBy('animal.anregistro')
            ->orderBy('producao.prdatacon')
            ->paginate(10); 
            
        return view('animal-milk.index', [
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
        $ocorrencias = OCOLact::all();
        return view('animal-milk.form', compact('ocorrencias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalMilkRequest $request)
    {
        $animal = Animal::find($request->animal_id);
        $animal_milk = Producao::where('anregistro', $animal->anregistro)
            ->where('crcodigo', $animal->crcodigo)
            ->where('prdatacon', date_db($request->prdatacon))
            ->get();

        if($animal_milk->count() > 0) {
            return back()
                ->withInput()
                ->withToastSuccess('Produção já cadastrada para o animal ' . $animal->anregistro . ' -> ' . $request->prdatacon);
        }

        $request['anregistro'] = $animal->anregistro;
        $request['crcodigo'] = $animal->crcodigo;
        $request['criador_id'] = $animal->criador_id;

        Producao::create($request->all());

        return redirect()
            ->route('animal-milk.index')
            ->withToastSuccess('Produção de leite cadastrada com sucesso!');
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
    public function edit(Producao $animal_milk)
    {
        $ocorrencias = OCOLact::all();
        return view('animal-milk.form', [
            'ocorrencias' => $ocorrencias,
            'animal_milk' => $animal_milk,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producao $animal_milk)
    {
        $animal = Animal::find($request->animal_id);

        $request['anregistro'] = $animal->anregistro;
        $request['crcodigo'] = $animal->crcodigo;
        $request['criador_id'] = $animal->criador_id;
        $request['prplord1'] = str_replace(',', '.', $request['prplord1']);
        $request['prplord2'] = str_replace(',', '.', $request['prplord2']);
        $request['prplord3'] = str_replace(',', '.', $request['prplord3']);
        $request['prgordura'] = str_replace(',', '.', $request['prgordura']);
        $request['prproteina'] = str_replace(',', '.', $request['prproteina']);
        $request['prextseco'] = str_replace(',', '.', $request['prextseco']);

        $animal_milk->update($request->all());

        return redirect()
            ->route('animal-milk.index')
            ->withToastSuccess('Produção de leite alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producao $animal_milk)
    {
        $animal_milk->delete();

        return redirect()
            ->route('animal-milk.index')
            ->withToastSuccess('Produção excluída com sucesso!');
    }
}
