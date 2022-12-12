<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Raca;
use App\Models\Sexo;
use App\Models\Barba;
use App\Models\Corno;
use App\Models\Local;
use App\Models\Animal;
use App\Models\Brinco;
use App\Models\Sangue;
use App\Models\Entrada;
use App\Models\Pelagem;
use App\Models\Finalidade;
use Illuminate\Http\Request;
use App\Models\IndicaRegistro;
use App\Http\Requests\AnimalRequest;
use App\Models\CauSaida;
use App\Models\MotSaida;

class AnimalRegistrationController extends Controller
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
            ->where('animal.criador_id', auth()->user()->farmerId())
            ->orderBy('animal.anregistro')
            ->paginate(10);

        return view('animal-registrations.index', compact('animals'));
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
        $motivos_saida = MotSaida::all();
        $causas_saida = CauSaida::all();
        $lotes = Lote::where('criador_id', auth()->user()->farmerId())->get();
        $locais = Local::where('criador_id', auth()->user()->farmerId())->get();
        return view('animal-registrations.form', [
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
            'motivos_saida' => $motivos_saida,
            'causas_saida' => $causas_saida,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimalRequest $request)
    {
        $farmer = auth()->user()->farmer;
        $finalidade = Finalidade::find($request['finalidade_id']);
        $request['fnlcodigo'] = $finalidade->fnlcodigo;
        $entrada = Entrada::find($request['entrada_id']);
        $request['encodigo'] = $entrada->encodigo;
        $motsaida = MotSaida::find($request['motsaida_id']);
        $request['mscodigo'] = $motsaida->mscodigo;
        $causasaida = CauSaida::find($request['causasaida_id']);
        $request['cscodigo'] = $causasaida->cscodigo;
        $indicaregistro = IndicaRegistro::find($request['indicaregistro_id']);
        $request['irgcodigo'] = $indicaregistro->irgcodigo;
        $raca = Raca::find($request['raca_id']);
        $request['racodigo'] = $raca->racodigo;
        $sangue = Sangue::find($request['sangue_id']);
        $request['sacodigo'] = $sangue->sacodigo;
        $pelagem = Pelagem::find($request['pelagem_id']);
        $request['pecodigo'] = $pelagem->pecodigo;
        $corno = Corno::find($request['corno_id']);
        $request['corcodigo'] = $corno->corcodigo;
        $barba = Barba::find($request['barba_id']);
        $request['bacodigo'] = $barba->bacodigo;
        $brinco = Brinco::find($request['brinco_id']);
        $request['brcodigo'] = $brinco->brcodigo;
        $lote = Lote::where('id', $request['lote_id'])->where('crcodigo', $farmer->crcodigo)->first();
        $request['l1codigo'] = $lote->l1codigo;
        $local = Local::where('id', $request['local_id'])->where('crcodigo', $farmer->crcodigo)->first();
        $request['l2codigo'] = $local->l2codigo;

        Animal::create($request->all());

        return redirect()
            ->route('animal-registrations.index')
            ->withToastSuccess('Cadastro de animal realizado com sucesso!');
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
    public function edit(Animal $animal_registration)
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
        $motivos_saida = MotSaida::all();
        $causas_saida = CauSaida::all();
        $lotes = Lote::where('criador_id', auth()->user()->farmerId())->get();
        $locais = Local::where('criador_id', auth()->user()->farmerId())->get();
        return view('animal-registrations.form', [
            'sexos' => $sexos,
            'animal_registration' => $animal_registration,
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
            'motivos_saida' => $motivos_saida,
            'causas_saida' => $causas_saida,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal_registration)
    {
        $farmer = auth()->user()->farmer;
        $finalidade = Finalidade::find($request['finalidade_id']);
        $request['fnlcodigo'] = $finalidade->fnlcodigo;
        $entrada = Entrada::find($request['entrada_id']);
        $request['encodigo'] = $entrada->encodigo;
        $motsaida = MotSaida::find($request['motsaida_id']);
        $request['mscodigo'] = $motsaida->mscodigo;
        $causasaida = CauSaida::find($request['causasaida_id']);
        $request['cscodigo'] = $causasaida->cscodigo;
        $indicaregistro = IndicaRegistro::find($request['indicaregistro_id']);
        $request['irgcodigo'] = $indicaregistro->irgcodigo;
        $raca = Raca::find($request['raca_id']);
        $request['racodigo'] = $raca->racodigo;
        $sangue = Sangue::find($request['sangue_id']);
        $request['sacodigo'] = $sangue->sacodigo;
        $pelagem = Pelagem::find($request['pelagem_id']);
        $request['pecodigo'] = $pelagem->pecodigo;
        $corno = Corno::find($request['corno_id']);
        $request['corcodigo'] = $corno->corcodigo;
        $barba = Barba::find($request['barba_id']);
        $request['bacodigo'] = $barba->bacodigo;
        $brinco = Brinco::find($request['brinco_id']);
        $request['brcodigo'] = $brinco->brcodigo;
        $lote = Lote::where('id', $request['lote_id'])->where('crcodigo', $farmer->crcodigo)->first();
        $request['l1codigo'] = $lote->l1codigo;
        $local = Local::where('id', $request['local_id'])->where('crcodigo', $farmer->crcodigo)->first();
        $request['l2codigo'] = $local->l2codigo;
        
        $animal_registration->update($request->all());

        return redirect()
            ->route('animal-registrations.index')
            ->withToastSuccess('Alteração de animal realizada com sucesso!');
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
