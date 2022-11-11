<?php

namespace App\Http\Controllers;

use App\Models\Peso;
use App\Models\Animal;
use App\Models\OCOLact;
use App\Models\Producao;
use Illuminate\Http\Request;
use App\Http\Requests\AnimalWeightRequest;

class DairyControlController extends Controller
{
    public function index()
    {
        $animals = Producao::join('animal', 'animal.id', '=', 'producao.animal_id')
            ->select('animal.*', 'producao.prdatacon', 'producao.id as producao_id', 'producao.prplord1', 'producao.prplord2', 'producao.prplord3')
            ->search()
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->orderBy('animal.anregistro')
            ->orderBy('producao.prdatacon')
            ->paginate(10); 
            
        return view('dairy-controls.index', [
            'animals' => $animals,
        ]);
    }

    public function create()
    {
        $ocorrencias = OCOLact::all();
        return view('dairy-controls.form', compact('ocorrencias'));
    }

    public function createByDate()
    {
        return view('dairy-controls.form-by-date');
    }

    public function edit(Producao $dairy_control)
    {
        $ocorrencias = OCOLact::all();
        return view('dairy-controls.form', [
            'ocorrencias' => $ocorrencias,
            'dairy_control' => $dairy_control,
        ]);
    }

    public function update(Request $request, Producao $dairy_control)
    {
        $animal = Animal::find($request->animal_id);

        $request['anregistro'] = $animal->anregistro;
        $request['crcodigo'] = $animal->crcodigo;
        $request['criador_id'] = $animal->criador_id;
        $request['prplord1'] = str_replace(',', '.', $request['prplord1']) || 0;
        $request['prplord2'] = str_replace(',', '.', $request['prplord2']) || 0;
        $request['prplord3'] = str_replace(',', '.', $request['prplord3']) || 0;
        $request['prgordura'] = str_replace(',', '.', $request['prgordura']) || 0;
        $request['prproteina'] = str_replace(',', '.', $request['prproteina']) || 0;
        $request['prextseco'] = str_replace(',', '.', $request['prextseco']) || 0;

        $dairy_control->update($request->all());

        return redirect()
            ->route('dairy_controls.index')
            ->withToastSuccess('Produção alterada com sucesso!');
    }

    public function store(AnimalWeightRequest $request)
    {
        $animal = Animal::find($request->animal_id);
        $request['anregistro'] = $animal->anregistro;
        $request['crcodigo'] = $animal->crcodigo;
        $request['criador_id'] = $animal->criador_id;
        $request['pepeso'] = str_replace(',', '.', $request['pepeso']);

        Peso::create($request->all());

        return redirect()
            ->route('dairy-controls.index')
            ->withToastSuccess('Peso cadastrado com sucesso!');
    }

    public function storeByDate(Request $request)
    {
        $data = $request->all();
        foreach($data['animal_id'] as $key => $value) {
            $animal = Animal::find($data['animal_id'][$key]);
            $data_dairy = [];
            $data_dairy['animal_id'] = $animal->id;
            $data_dairy['criador_id'] = $animal->criador_id;
            $data_dairy['anregistro'] = $animal->anregistro;
            $data_dairy['crcodigo'] = $animal->crcodigo;
            $data_dairy['prdatacon'] = $data['prdatacon'];
            $data_dairy['prplord1'] = str_replace(',', '.', $data['prplord1'][$key]) || 0;
            $data_dairy['prplord2'] = str_replace(',', '.', $data['prplord2'][$key]) || 0;
            $data_dairy['prplord3'] = str_replace(',', '.', $data['prplord3'][$key]) || 0;
            
            Producao::create($data_dairy);
        }

        return redirect()
            ->route('dairy-controls.index')
            ->withToastSucess('Entrada de produção realizada com sucesso.');
    }

    public function destroy(Producao $dairy_control)
    {
        $dairy_control->delete();

        return redirect()
            ->route('dairy-controls.index')
            ->withToastSuccess('Produção excluída com sucesso!');
    }
}
