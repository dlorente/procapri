<?php

namespace App\Http\Controllers;

use App\Models\Peso;
use App\Models\Animal;
use Illuminate\Http\Request;
use App\Http\Requests\AnimalWeightRequest;

class WeightControlController extends Controller
{
    public function index()
    {
        $animals = Peso::join('animal', 'animal.id', '=', 'peso.animal_id')
            ->select('animal.*', 'peso.pedatapes', 'peso.pepeso', 'peso.id as peso_id')            
            ->search()
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->orderBy('animal.anregistro')
            ->orderBy('peso.pedatapes')
            ->paginate(10);        

        return view('weight-controls.index', [
            'animals' => $animals,
        ]);
    }

    public function createByDate()
    {
        return view('weight-controls.form-by-date');
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
            ->route('weight-controls.index')
            ->withToastSuccess('Peso cadastrado com sucesso!');
    }

    public function storeByDate(Request $request)
    {
        $data = $request->all();
        foreach($data['animal_id'] as $key => $value) {
            $animal = Animal::find($data['animal_id'][$key]);
            $data_weight = [];
            $data_weight['animal_id'] = $animal->id;
            $data_weight['criador_id'] = $animal->criador_id;
            $data_weight['anregistro'] = $animal->anregistro;
            $data_weight['crcodigo'] = $animal->crcodigo;
            $data_weight['pedatapes'] = $data['pedatapes'];
            $data_weight['pepeso'] = str_replace(',', '.', $data['pepeso'][$key]);

            Peso::create($data_weight);
        }

        return redirect()
            ->route('weight-controls.index')
            ->withToastSucess('Entrada ponderal realizada com sucesso.');
    }
}
