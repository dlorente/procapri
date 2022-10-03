@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Entrada de animais</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Entrada de animais</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            Alguma descrição aqui
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Listagem dos animais cadastrados
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('animals.index') }}">
                        <div class="input-group mb-3">
                            <input class="form-control" name="search" value="{{ request('search') ?? '' }}" placeholder="Pesquisar pelo animal..."/>
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="submit" >
                                    <i class="fa fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('animals.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Novo animal
                    </a>
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Nome do animal</th>
                        <th>Nome da mãe</th>
                        <th>Nome do pai</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
