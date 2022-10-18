<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalRequest;
use App\Models\Sexo;
use App\Models\Animal;
use App\Models\Barba;
use App\Models\Brinco;
use App\Models\Corno;
use App\Models\Entrada;
use App\Models\Finalidade;
use App\Models\IndicaRegistro;
use App\Models\Local;
use App\Models\Lote;
use App\Models\Pelagem;
use App\Models\Raca;
use App\Models\Sangue;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Animal::search()
            ->where('crcodigo', 1)
            ->orderBy('anregistro')
            ->paginate(10);

        return view('animals.index', compact('animals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sexos = Sexo::all();
        $finalidades = Finalidade::all();
        $entradas = Entrada::all();
        $iRegistros = IndicaRegistro::all();
        $racas = Raca::all();
        $tiposSangue = Sangue::all();
        $pelagens = Pelagem::all();
        $cornos = Corno::all();
        $barbas = Barba::all();
        $brincos = Brinco::all();
        $lotes = Lote::where('criador_id', 1)->get();
        $locais = Local::where('criador_id', 1)->get();
        return view('animals.form', [
            'sexos' => $sexos,
            'finalidades' => $finalidades,
            'entradas' => $entradas,
            'iRegistros' => $iRegistros,
            'racas' => $racas,
            'tiposSangue' => $tiposSangue,
            'pelagens' => $pelagens,
            'cornos' => $cornos,
            'barbas' => $barbas,
            'brincos' => $brincos,
            'lotes' => $lotes,
            'locais' => $locais,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Animal $animal)
    {
        // dd($animal);
        $sexos = Sexo::all();
        $finalidades = Finalidade::all();
        $entradas = Entrada::all();
        $iRegistros = IndicaRegistro::all();
        $racas = Raca::all();
        $tiposSangue = Sangue::all();
        $pelagens = Pelagem::all();
        $cornos = Corno::all();
        $barbas = Barba::all();
        $brincos = Brinco::all();
        $lotes = Lote::where('criador_id', $animal->criador_id)->get();
        $locais = Local::where('criador_id', $animal->criador_id)->get();
        return view('animals.form', [
            'sexos' => $sexos,
            'animal' => $animal,
            'finalidades' => $finalidades,
            'entradas' => $entradas,
            'iRegistros' => $iRegistros,
            'racas' => $racas,
            'tiposSangue' => $tiposSangue,
            'pelagens' => $pelagens,
            'cornos' => $cornos,
            'barbas' => $barbas,
            'brincos' => $brincos,
            'lotes' => $lotes,
            'locais' => $locais,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimalRequest $request, Animal $animal)
    {
        dd($request->all());
        $animal->update($request->all());

        return redirect()
            ->route('animals.index');
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
