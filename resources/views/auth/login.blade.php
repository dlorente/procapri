@extends('layouts.auth')

@section('content')
<div class="card-header"><h3 class="text-center font-weight-light my-4">Procapri - Login</h3></div>
<div class="card-body">
    <form method="POST" action="{{ route('login') }}">
        @csrf
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
        </div>
        <div class="form-check mb-3">
        <input type="checkbox" name="remember" class="form-check-input" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Lembrar senha</label>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
            <a class="small" href="#">Esqueceu sua senha?</a>
            <button type="submit" class="btn btn-primary">Acessar</button>
        </div>
    </form>
</div>
<div class="card-footer text-center py-3">
    <div class="small"><a href="{{ route('register') }}">Não tem uma conta? Cadastre-se!</a></div>
</div>
@endsection