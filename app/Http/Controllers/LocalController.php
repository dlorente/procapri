<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locais = Local::where('criador_id', auth()->user()->farmerId())
            ->search()
            ->orderBy('l2codigo')
            ->orderBy('l2nome')
            ->paginate(10);
        return view('local.index', compact('locais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('local.form');
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
            'l2nome' => ['required'],
            'l2codigo' => ['required', 'max:50'],
        ]);
        $data['crcodigo'] = auth()->user()->farmer->crcodigo;
        $data['criador_id'] = auth()->user()->farmerId();

        Local::create($data);
        return redirect()
            ->route('local.index')
            ->withToastSuccess('local cadastrado com sucesso');
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
    public function edit(Local $local)
    {
        return view('local.form', compact('local'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Local $local)
    {
        $data = $request->validate([
            'l2nome' => ['required'],
            'l2codigo' => ['required', 'max:50'],
        ]);
        $data['crcodigo'] = auth()->user()->farmer->crcodigo;
        $data['criador_id'] = auth()->user()->farmerId();
        
        $local->update($data);
        return redirect()
            ->route('local.index')
            ->withToastSuccess('local alterado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Local $local)
    {
        $local->delete();

        return redirect()
            ->route('local.index')
            ->withToastSuccess('Local excluído com sucesso!');
    }
}
