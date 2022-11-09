<?php

namespace App\Http\Controllers;

use App\Http\Requests\OldLoginFormRequest;
use App\Models\State;
use App\Models\Criador;
use Illuminate\Http\Request;

class OldLoginController extends Controller
{
    public function index()
    {
        return view('auth.old-login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'user' => 'required',
            'password' => 'required',
        ]);

        $criador = Criador::where('crcodigo', $data['user'])
            ->where('crsenha', $data['password'])
            ->first();

        if($criador) {
            $criador->update(['user_id' => auth()->user()->farmerId()]);
            
            return redirect()->route('home');
        }

        return back()
            ->withInput()
            ->withToastError('Cadastro não encontrado para as credenciais apresentadas');
    }

    public function message()
    {
        return view('auth.old-login-message');
    }

    public function oldLoginFarmerForm()
    {
        $states = State::all();
        return view('farmer.old-login-farmer-form', [
            'states' => $states
        ]);
    }

    public function oldLoginFarmer(OldLoginFormRequest $request)
    {
        $request['user_id'] = auth()->user()->id;
        Criador::create($request->all());
        
        return redirect()
            ->route('home')
            ->withToastSuccess('Cadastro realizado com sucesso');
    }
}