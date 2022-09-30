@extends('layouts.auth')

@section('content')
<div class="card-header"><h3 class="text-center font-weight-light my-4">Cadastrar Usuário</h3></div>
<div class="card-body">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-floating mb-3">
            <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" type="name" placeholder="Nome Completo" required autofocus />
            <label for="name">Nome Completo</label>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="email" type="email" placeholder="Email" autofocus />
            <label for="email">Email</label>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Password" />
            <label for="password">Senha</label>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" type="password" placeholder="Password" />
            <label for="password_confirmation">Confirmação de Senha</label>
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <a class="small" href="{{ route('login') }}">Já tenho cadastro!</a>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>
</div>

@endsection
