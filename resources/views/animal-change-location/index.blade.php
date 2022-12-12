@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Movimento entre instalações</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Formulario de movimento entre instalações</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <p><a href="{{route('animal-change-location-individual-form')}}">Individual</a></p>
            <p><a href="{{ route('animal-change-location-lote-form') }}">Lote</a></p>
            <p><a href="{{ route('animal-change-location-local-form') }}">Local</a></p>
        </div>
    </div>
</div>
@endsection