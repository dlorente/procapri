<?php

namespace App\Http\Controllers;

use App\Models\Cio;
use App\Models\Parto;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $this->resetActiveAba();

        $criador_id = auth()->user()->farmerId();
        $animals = Animal::where('criador_id', $criador_id)->get();
        $cios = Cio::where('criador_id', $criador_id)->get();
        $partos = Parto::where('criador_id', $criador_id)->get();

        $resultsParto = Parto::select(DB::raw('count(anregistro) as qty, year(padatapar) as `year`'))
            ->where('criador_id', $criador_id)
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();

        $resultsCio = Cio::select(DB::raw('count(anregistro) as qty, year(cidata) as `year`'))
            ->where('criador_id', $criador_id)
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();

        $yearsParto = $resultsParto->map(function ($item, $key) {
            return $item->year;
        });
        $yearsCio = $resultsCio->map(function ($item, $key) {
            return $item->year;
        });

        $totalYears = array_merge($yearsParto->toArray(), $yearsCio->toArray());
        $totalYears = array_unique($totalYears);
        
        $serieParto['qties'] = [];
        foreach($resultsParto as $result) {
            if(in_array($result->year, $totalYears)) {
                array_push($serieParto['qties'], $result->qty);
            } else {
                array_push($serieParto['qties'], 0);
            }
        }


        $serieCio['qties'] = [];
        foreach($resultsCio as $result) {
            if(in_array($result->year, $totalYears)) {
                array_push($serieCio['qties'], $result->qty);
            } else {
                array_push($serieCio['qties'], 0);
            }
        }

        return view('home', [
            'totalAnimals' => $animals->count(),
            'totalCios' => $cios->count(),
            'totalPartos' => $partos->count(),
            'serieParto' => $serieParto,
            'serieCio' => $serieCio,
            'totalYears' => $totalYears,
        ]);
    }

    public function resetActiveAba()
    {
        session(['active_aba' => -1]);
    }
}
