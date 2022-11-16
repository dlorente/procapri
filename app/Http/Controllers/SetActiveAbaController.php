<?php

namespace App\Http\Controllers;

class SetActiveAbaController extends Controller
{
    public function __invoke($index = 0)
    {
        session(['active_aba' => $index]);
        return response()->json([
            'message' => 'aba: ' . $index . ' setada com sucesso',
        ]);
    }
}