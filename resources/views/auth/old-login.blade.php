@extends('layouts.auth')

@section('content')
<div class="card-header"><h3 class="text-center font-weight-light my-4">Procapri - Criador Login</h3></div>
<div class="card-body">
    <form method="POST" action="{{ route('old-login.login') }}">
        @csrf
        <div class="form-floating mb-3">
            <input class="form-control @error('user') is-invalid @enderror" name="user" value="{{ old('user') }}" id="user" type="text" placeholder="usuário" autofocus />
            <label for="user">Código do criador</label>
            @error('user')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="senha" />
            <label for="password">Senha</label>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="d-flex align-items-center justify-content-center mt-4 mb-0">
            <button type="submit" class="btn btn-primary">Vincular cadastro</button>
        </div>
    </form>
</div>
@endsection