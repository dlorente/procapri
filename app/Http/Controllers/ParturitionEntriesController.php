<?php

namespace App\Http\Controllers;

use App\Models\Cio;
use App\Models\Lote;
use App\Models\Peso;
use App\Models\Sexo;
use App\Models\Parto;
use App\Models\TPCio;
use App\Models\Animal;
use App\Models\Encerra;
use App\Models\TPParto;
use App\Models\TPExGest;
use App\Models\ConfPrenha;
use App\Models\Finalidade;
use App\Models\TPCobertura;
use Illuminate\Http\Request;
use App\Http\Requests\ParturitionEntriesRequest;
use App\Models\Barba;
use App\Models\Brinco;
use App\Models\Corno;
use App\Models\IndicaRegistro;
use App\Models\Local;
use App\Models\Pelagem;
use App\Models\Raca;
use App\Models\Sangue;

class ParturitionEntriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animals = Cio::join('animal', 'animal.id', '=', 'cio.animal_id')
            ->select('animal.*', 'cio.cidata', 'cio.id as cio_id', 'cio.ciflag')            
            ->search()
            ->where('cio.ciflag', 'S')
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->orderBy('animal.anregistro')
            ->orderBy('cio.cidata')
            ->paginate(10);

        return view('parturition-entries.index', [
            'animals' => $animals,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cio $parturition_entry)
    {
        $tpcoberturas = TPCobertura::all();
        $confprenhas = ConfPrenha::all();
        $tpexgests = TPExGest::all();
        $tppartos = TPParto::all();
        $paordem = Parto::nextParturitionNumber($parturition_entry->animal_id);
        $parturition_entry['paordem'] = $paordem;
        return view('parturition-entries.form', [
            'parturition_entry' => $parturition_entry,
            'tpcoberturas' => $tpcoberturas,
            'confprenhas' => $confprenhas,
            'tpexgests' => $tpexgests,
            'tppartos' => $tppartos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParturitionEntriesRequest $request, Cio $parturition_entry)
    {
        $mae = Animal::find($request['animal_id']);
        $request['panucrias'] = ! $request['panucrias'] ? 0 : $request['panucrias'];
        $request['pacodigo'] = TPParto::find($request['tpparto_id'])->pacodigo;
        $request['criador_id'] = auth()->user()->farmerId();
        $request['crcodigo'] = auth()->user()->farmer->crcodigo;
        $request['ciocodigo'] = TPCio::find($request['tpcio_id'])->ciocodigo;
        $request['cobcodigo'] = TPCobertura::find($request['tpcobertura_id'])->cobcodigo;
        Parto::create($request->all());

        $bode = Animal::where('anregistro', $request['panubode'])
            ->where('crcodigo', $request['crcodigo'])
            ->first();
        $sangue = 99;
        if (! in_array($bode->racodigo, [98, 99])) {
            if($bode->racodigo === $mae->racodigo) {
                if ((($bode->sacodigo == 9) or ($bode->sacodigo == 10)) and (($mae->sacodigo == 9) or ($mae->sacodigo == 10))) {
                    $sangue = 10;
                } else {
                    if (($bode->sacodigo == 9) or ($bode->sacodigo == 10)) {
                        if (($mae->sacodigo  >= 1) and  ($mae->sacodigo <= 5)) {
                            $sangue = $mae->sacodigo + 1;
                        }
                    }
                }
            } else {
                if (($bode->sacodigo == 9) or ($bode->sacodigo == 10)) {
                    $sangue = 1;
                }
            }
        }       
        for($i = 0; $i < intval($request['panucrias']); $i++) {
            $data = [];
            $data['crcodigo'] = auth()->user()->farmer->crcodigo;
            $data['criador_id'] = auth()->user()->farmerId();
            $data['anregistro'] = $request['b_anregistro'][$i];
            $data['annome'] = $request['b_annome'][$i];
            $data['ananimal'] = $request['b_ananimal'][$i];
            $data['anregpai'] = $request['panubode'];
            $data['annomepai'] = $bode->annome ?? null;
            $data['anregmae'] = $mae->anregistro;
            $data['annomemae'] = $mae->annome;
            $data['sacodigo'] = $sangue;
            $data['sangue_id'] = Sangue::where('sacodigo', $sangue)->first()->id;
            $data['sxcodigo'] = $request['b_sxcodigo'][$i];
            $data['sexo_id'] = Sexo::where('sxcodigo', $data['sxcodigo'])->first()->id;
            $data['andnasc'] = $request['padatapar'];
            $data['racodigo'] = $bode->racodigo;
            $data['raca_id'] = Raca::where('racodigo', $bode->racodigo)->first()->id;
            $data['finalidade_id'] = $request['b_finalidade_id'][$i];
            $data['fnlcodigo'] = Finalidade::find($data['finalidade_id'])->fnlcodigo;
            $data['anentrada'] = $request['padatapar'];
            $data['encodigo'] = 1;
            $data['corcodigo'] = 'A';
            $data['corno_id'] = Corno::where('corcodigo', 'A')->first()->id;
            $data['bacodigo'] = 'N';
            $data['barba_id'] = Barba::where('bacodigo', 'N')->first()->id;
            $data['brcodigo'] = 'N';
            $data['brinco_id'] = Brinco::where('brcodigo', 'N')->first()->id;
            $data['pecodigo'] = 99;
            $data['pelagem_id'] = Pelagem::where('pecodigo', 99)->first()->id;
            $data['l1codigo'] = 99;
            $data['lote_id'] = Lote::where('l1codigo', 99)->first()->id;
            $data['l2codigo'] = 99;
            $data['lote_id'] = Local::where('l2codigo', 99)->first()->id;
            $data['l3codigo'] = 99;
            $data['irgcodigo'] = 'S';
            $data['indicaregistro_id'] = IndicaRegistro::where('irgcodigo', 'S')->first()->id;
            
            $animal = Animal::create($data);
            
            $data = [];
            $data['anregistro'] = $animal->anregistro;
            $data['animal_id'] = $animal->id;
            $data['crcodigo'] = $animal->crcodigo;
            $data['criador_id'] = $animal->criador_id;
            $data['pedatapes'] = $request['padatapar'];
            $data['pepeso'] = str_replace(',', '.', $request['b_pepeso'][$i]);
            Peso::create($data);
        }

        return redirect()
            ->route('parturition-entries.index')
            ->withToast('Parto cadastrado com sucesso');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function babyForm()
    {
        $sexos = Sexo::all();
        $finalidades = Finalidade::all();
        $registro = auth()->user()->farmer->crcodigo . date('y');
        return view('parturition-entries.form-baby', [
            'registro' => $registro,
            'sexos' => $sexos,
            'finalidades' => $finalidades,
        ]);
    }
}
