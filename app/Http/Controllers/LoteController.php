<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lotes = Lote::where('criador_id', auth()->user()->farmerId())
            ->search()
            ->orderBy('l1codigo')
            ->orderBy('l1nome')
            ->paginate(10);
        return view('lotes.index', compact('lotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lotes.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'l1nome' => ['required'],
            'l1codigo' => ['required', 'max:50'],
        ]);
        $data['crcodigo'] = auth()->user()->farmer->crcodigo;
        $data['criador_id'] = auth()->user()->farmerId();

        Lote::create($data);
        return redirect()
            ->route('lote.index')
            ->withToastSuccess('Lote cadastrado com sucesso');
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
    public function edit(Lote $lote)
    {
        return view('lotes.form', compact('lote'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lote $lote)
    {
        $data = $request->validate([
            'l1nome' => ['required'],
            'l1codigo' => ['required', 'max:50'],
        ]);
        $data['crcodigo'] = auth()->user()->farmer->crcodigo;
        $data['criador_id'] = auth()->user()->farmerId();
        
        $lote->update($data);
        return redirect()
            ->route('lote.index')
            ->withToastSuccess('Lote alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lote $lote)
    {
        $lote->delete();

        return redirect()
            ->route('lote.index')
            ->withToastSuccess('lote excluído com sucesso!');
    }
}
