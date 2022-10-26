<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalExitRequest;
use App\Http\Requests\AnimalRequest;
use App\Models\Sexo;
use App\Models\Animal;
use App\Models\Barba;
use App\Models\Brinco;
use App\Models\CauSaida;
use App\Models\Corno;
use App\Models\Entrada;
use App\Models\Finalidade;
use App\Models\IndicaRegistro;
use App\Models\Local;
use App\Models\Lote;
use App\Models\MotSaida;
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
        $animals = Animal::join('sexo', 'animal.sexo_id', '=', 'sexo.id')
            ->select('animal.*')
            ->search()
            ->where('animal.criador_id', 137)
            ->orderBy('animal.anregistro')
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
        $animal->update($request->all());

        return redirect()
            ->route('animals.index')
            ->withToastSuccess('Animal atualizado com sucesso!');
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

    public function animalSearch(Request $request)
    {
        if (! $request->q) {
            return response()->json([1]);
        }

        if(!isset($request->sexo_id)) {
            $animais = Animal::where(function ($query) use ($request) {
                $query->where('anregistro', 'LIKE', $request->q . '%')
                    ->orWhere('ananimal', 'LIKE', $request->q . '%');
                })
                ->whereNull('andatasai')
                ->where('criador_id', 137)
                ->get()
                ->map(function ($animal) {
                    return [
                        'id' => $animal->anregistro,
                        'animal_id' => $animal->id,
                        'text' => $animal->anregistro . ' --> ' . $animal->ananimal . ' --> ' . $animal->annome .
                         ' --> ' . $animal->anregistro . ' --> ' . $animal->sxcodigo
                    ];
                });
            
            return response()->json($animais);
        }

        $animais = Animal::join('sexo', 'animal.sexo_id', '=', 'sexo.id')
            ->where(function ($query) use ($request) {
                $query->where('anregistro', 'LIKE', $request->q . '%')
                    ->orWhere('ananimal', 'LIKE', $request->q . '%');
            })->whereNull('andatasai')
            ->where('criador_id', 137)
            ->where('sexo_id', $request->sexo_id)
            ->get()
            ->map(function ($animal) {
                return [
                    'id' => $animal->anregistro,
                    'text' => $animal->anregistro . ' --> ' . $animal->ananimal . ' --> ' . $animal->annome .
                     ' --> ' . $animal->anregistro . ' --> ' . $animal->sxcodigo
                ];
            });

        return response()->json($animais);
    }

    public function animalExitFormIndividual(Animal $animal)
    {
        $motivos = MotSaida::all();
        $causas = CauSaida::all();
        return view('animals.form-saida-individual', [
            'animal' => $animal,
            'motivos' => $motivos,
            'causas' => $causas,
        ]);
    }

    public function animalExit(AnimalExitRequest $request, Animal $animal)
    {
        $animal->update($request->all());
        return redirect()
            ->route('animals.index')
            ->withToastSuccess('Saída de animal realizada com sucesso!');
    }

    public function animalExitFormLote(Animal $animal)
    {
        $motivos = MotSaida::all();
        $causas = CauSaida::all();
        return view('animals.form-saida-individual', [
            'animal' => $animal,
            'motivos' => $motivos,
            'causas' => $causas,
        ]);
    }

    public function animalExitLote(AnimalExitRequest $request, Animal $animal)
    {
        $animal->update($request->all());
        return redirect()
            ->route('animals.index')
            ->withToastSuccess('Saída de animal realizada com sucesso!');
    }

    public function animalExitFormLocal(Animal $animal)
    {
        $motivos = MotSaida::all();
        $causas = CauSaida::all();
        return view('animals.form-saida-individual', [
            'animal' => $animal,
            'motivos' => $motivos,
            'causas' => $causas,
        ]);
    }

    public function animalExitLocal(AnimalExitRequest $request, Animal $animal)
    {
        $animal->update($request->all());
        return redirect()
            ->route('animals.index')
            ->withToastSuccess('Saída de animal realizada com sucesso!');
    }
}
