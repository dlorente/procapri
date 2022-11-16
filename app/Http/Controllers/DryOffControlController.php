<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Local;
use App\Models\Parto;
use App\Models\Animal;
use App\Models\Criador;
use App\Models\Encerra;
use Illuminate\Http\Request;

class DryOffControlController extends Controller
{
    public function index(Request $request)
    {
        $animals = Parto::join('animal', 'animal.id', '=', 'parto.animal_id')
            ->select('animal.*', 'parto.padatapar', 'parto.id as parto_id')
            ->search()
            ->where('animal.sexo_id', 1)
            ->whereNull('parto.padenclac')
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->orderBy('animal.anregistro')
            ->orderBy('parto.padatapar')
            ->paginate(10);

        $lotes = Lote::where('criador_id', auth()->user()->farmerId())->get();
        $locals = Local::where('criador_id', auth()->user()->farmerId())->get();
            
        return view('dryoff-controls.index', [
            'animals' => $animals,
            'lotes' => $lotes,
            'locals' => $locals,
        ]);
    }

    public function edit(Parto $dryoff_control)
    {
        $motivos = Encerra::all();
        return view('dryoff-controls.form-individual', [
            'dryoff_control' => $dryoff_control,
            'motivos' => $motivos,
        ]);
    }

    public function update(Request $request, Parto $dryoff_control) {
        $data = $request->validate([
            'animal_id' => ['required', 'exists:animal,id'],
            'anregistro' => ['required'],
            'padenclac' => ['required', 'date_format:"d/m/Y"'],
            'padatapar' => ['required', 'date_format:"d/m/Y"']
        ]);

        $farmer = Criador::find(auth()->user()->farmerId());
        $data['criador_id'] = $farmer->id;
        $data['crcodigo'] = $farmer->crcodigo;

        $dryoff_control->update($data);

        return redirect()
            ->route('dryoff-controls.index')
            ->withToastSuccess('Encerramento de lactação cadastrado com sucesso');
    }

    public function formLote(Request $request)
    {
        $animals = Parto::join('animal', 'animal.id', '=', 'parto.animal_id')
            ->select('animal.*', 'parto.padatapar', 'parto.id as parto_id')
            ->search()
            ->where('animal.sexo_id', 1)
            ->whereNull('parto.padenclac')
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->where('animal.lote_id', $request->lote_id)
            ->orderBy('animal.anregistro')
            ->orderBy('parto.padatapar')
            ->get();

        $motivos = Encerra::all();
        return view('dryoff-controls.form-lote', [
            'animals' => $animals,
            'lote_id' => $request->lote_id,
            'motivos' => $motivos,
        ]);
    }

    public function formLocal(Request $request)
    {
        $animals = Parto::join('animal', 'animal.id', '=', 'parto.animal_id')
            ->select('animal.*', 'parto.padatapar', 'parto.id as parto_id')
            ->search()
            ->where('animal.sexo_id', 1)
            ->whereNull('parto.padenclac')
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->where('animal.local_id', $request->local_id)
            ->orderBy('animal.anregistro')
            ->orderBy('parto.padatapar')
            ->get();

        $motivos = Encerra::all();
        return view('dryoff-controls.form-local', [
            'animals' => $animals,
            'local_id' => $request->local_id,
            'motivos' => $motivos,
        ]);
    }

    public function updateLote(Request $request, Lote $lote_id)
    {
        $partos = Parto::whereIn('id', $request->parto_id)->get();
        $motivo = Encerra::find($request->encerra_id);
        $request['eccodigo'] = $motivo->eccodigo;
        foreach($partos as $parto) {
            $parto->update($request->all());
        }

        return redirect()
            ->route('dryoff-controls.index')
            ->withToastSuccess('Encerramento de lote cadastrado com sucesso');
    }

    public function updateLocal(Request $request, Local $local_id)
    {
        $partos = Parto::whereIn('id', $request->parto_id)->get();
        $motivo = Encerra::find($request->encerra_id);
        $request['eccodigo'] = $motivo->eccodigo;
        foreach($partos as $parto) {
            $parto->update($request->all());
        }

        return redirect()
            ->route('dryoff-controls.index')
            ->withToastSuccess('Encerramento de local cadastrado com sucesso');
    }
}
