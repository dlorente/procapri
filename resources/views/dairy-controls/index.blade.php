@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Entrada de Produção de Leite</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Formulario para entrada de produção de leite</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <p><a href="{{ route('animal-milk.create') }}">Individual</a></p>
            <p><a href="{{ route('dairy-controls.create-by-date') }}">Por data</a></p>
        </div>
    </div>
</div>
@endsection