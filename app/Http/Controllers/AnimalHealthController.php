<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Doenca;
use App\Models\Famacha;
use App\Models\AnimalDoenca;
use Illuminate\Http\Request;
use App\Http\Requests\AnimalHealthRequest;

class AnimalHealthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = AnimalDoenca::join('animal', 'animal.id', '=', 'animaldoenca.animal_id')
            ->join('doenca', 'doenca.id', '=', 'animaldoenca.doenca_id')
            ->select('animal.*', 'animaldoenca.addtinicio', 'doenca.nomedoenca', 'animaldoenca.id as animaldoenca_id')
            ->search()
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->orderBy('animal.anregistro')
            ->orderBy('animaldoenca.addtinicio')
            ->paginate(10);        
        return view('animal-health.index', [
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
        $doencas = Doenca::all();
        $famachas = Famacha::all();

        return view('animal-health.form', [
            'doencas' => $doencas,
            'famachas' => $famachas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalHealthRequest $request)
    {
        $animal = Animal::find($request->animal_id);
        $animal_health = AnimalDoenca::where('anregistro', $animal->anregistro)
            ->where('crcodigo', $animal->crcodigo)
            ->where('addtinicio', date_db($request->addtinicio))
            ->get();

        if($animal_health->count() > 0) {
            return back()
                ->withInput()
                ->withToastSuccess('Doença já cadastrada para o animal ' . $animal->anregistro . ' -> ' . $request->addtinicio);
        }

        $request['anregistro'] = $animal->anregistro;
        $request['crcodigo'] = $animal->crcodigo;
        $request['coddoenca'] = Doenca::find($request->doenca_id)->coddoenca;

        AnimalDoenca::create($request->all());
        return redirect()
            ->route('animal-health.index')
            ->withToastSuccess('Cadastro de doença/animal realizado com sucesso');
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
    public function edit(AnimalDoenca $animal_health)
    {
        $doencas = Doenca::all();
        $famachas = Famacha::all();

        return view('animal-health.form', [
            'doencas' => $doencas,
            'famachas' => $famachas,
            'animal_health' => $animal_health,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalHealthRequest $request, AnimalDoenca $animal_health)
    {
        $animal = Animal::find($request->animal_id);
        $request['anregistro'] = $animal->anregistro;
        $request['crcodigo'] = $animal->crcodigo;
        $request['coddoenca'] = Doenca::find($request->doenca_id)->coddoenca;
        
        $animal_health->update($request->all());
        return redirect()
            ->route('animal-health.index')
            ->withToastSuccess('Ateração de doença realizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnimalDoenca $animal_health)
    {
        $animal_health->delete();

        return redirect()
            ->route('animal-health.index')
            ->withToastSuccess('Doença excluída com sucesso!');
    }
}
