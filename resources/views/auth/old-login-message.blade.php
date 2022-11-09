@extends('layouts.auth')

@section('content')
<div class="card-header"><h3 class="text-center font-weight-light my-4">Procapri</h3></div>
<div class="card-body">
    <p style="color: #69707a;">
        O usuário <b>{{ auth()->user()->email }}</b> não está vinculado a um cadastro de criador. Caso já tenha um cadastro de criador,
        <a href="{{ route('old-login.index') }}">clique aqui</a> para vincular sua conta a este cadastro.
    </p>
    <p style="color: #69707a;"><a href="{{ route('old-login.farmer-form') }}">Não tenho cadastro. Quero criar um novo.</a></p>
    <p style="color: #69707a;">
        <a href="{{ route('logout') }}" onclick="logout()">Sair do sistema.</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </p>
</div>
@endsection