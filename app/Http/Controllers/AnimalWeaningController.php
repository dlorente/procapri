<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Local;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalWeaningController extends Controller
{
    public function index()
    {
        $animals = Animal::search()
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->whereNull('andesmama')
            ->orderBy('animal.anregistro')
            ->paginate(10);
        $lotes = Lote::where('criador_id', auth()->user()->farmerId())->get();
        $locals = Local::where('criador_id', auth()->user()->farmerId())->get();

        return view('animal-weaning.tabs', [
            'animals' => $animals,
            'lotes' => $lotes,
            'locals' => $locals,
        ]);
    }

    public function animalLoteListForm(Lote $lote)
    {
        $animals = Animal::whereNull('andesmama')
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->where('animal.lote_id', $lote->id)
            ->get();

        $lotes = Lote::where('criador_id', auth()->user()->farmerId())->get();
        return view('animal-weaning.animal-lote-list-form', [
            'animals' => $animals,
            'lotes' => $lotes,
        ]);
    }

    public function animalLocalListForm(Local $local)
    {
        $animals = Animal::whereNull('andesmama')
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->where('animal.local_id', $local->id)
            ->get();

        $locals = Lote::where('criador_id', auth()->user()->farmerId())->get();
        return view('animal-weaning.animal-local-list-form', [
            'animals' => $animals,
            'locals' => $locals,
        ]);
    }

    public function animalWeaningLote(Request $request)
    {
        $data = $request->validate([
            'andesmama' => ['required', 'date_format:"d/m/Y"'],
            'animal_id' => ['required', 'array'],            
            'lote_id' => ['required', 'exists:lote,id'],
        ]);
        
        $animals = Animal::whereIn('id', $request->animal_id)->get();
        foreach($animals as $animal) {
            $animal->update($data);
        }
        return redirect()
            ->route('animal-weaning.index')
            ->withToastSuccess('Desamame de lote realizado com sucesso!'); 
    }

    public function animalWeaningLocal(Request $request)
    {
        $data = $request->validate([
            'andesmama' => ['required', 'date_format:"d/m/Y"'],
            'animal_id' => ['required', 'array'],            
            'local_id' => ['required', 'exists:local,id'],
        ]);
        
        $animals = Animal::whereIn('id', $request->animal_id)->get();
        foreach($animals as $animal) {
            $animal->update($data);
        }
        return redirect()
            ->route('animal-weaning.index')
            ->withToastSuccess('Desamame de local realizado com sucesso!'); 
    }

    public function individualWeaningForm(Animal $animal_weaning)
    {
        return view('animal-weaning.individual-weaning-form', [
            'animal_weaning' => $animal_weaning,
        ]);
    }

    public function individualWeaning(Request $request, Animal $animal_weaning)
    {
        $data = $request->validate([
            'andesmama' => ['required', 'date_format:"d/m/Y"'],
        ]);
        $animal_weaning->update($data);
        return redirect()
            ->route('animal-weaning.index')
            ->withToastSuccess('Desmame de animal cadastrado com sucesso!');
    }

    public function AnimalLocalFormChangeLocation()
    {
    }
}
