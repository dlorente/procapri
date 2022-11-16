@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Cadastro de Ocorrências</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Cadastro de Ocorrências</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            Alguma descrição aqui
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Listagem ocorrências cadastradas
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('occurrences.index') }}">
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
                    <a href="{{ route('occurrences.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus mr-2"></i> Nova ocorrência
                    </a>
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Placa</th>
                        <th>Nome do animal</th>
                        <th>Data da ocorrência</th>
                        <th class="text-center w-15">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($animals as $animal)
                        <tr>
                            <td>{{ $animal->anregistro }}</td>
                            <td>{{ $animal->ananimal }}</td>
                            <td>{{ $animal->annome }}</td>
                            <td>{{ date_br($animal->ocdata) }}</td>
                            <td class="text-center">
                                <a href="{{ route('occurrences.edit', $animal->ocorre_id) }}" class="btn btn-primary" title="Editar ocorrência">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <a href="javascript:;" class="btn btn-danger" onclick="confirmDelete({{ $animal->ocorre_id }})" title="Remover ocorrência">
                                    <i class="fa fa-trash"></i>
                                </a>

                                <form id="btn-delete-{{ $animal->ocorre_id }}" action="{{ route('occurrences.destroy', $animal->ocorre_id) }}"
                                      method="post" class="hidden">

                                    @method('DELETE')
                                    @csrf

                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="alert alert-danger text-center">
                                    <i class="fa fa-exclamation-triangle"></i>
                                    Oops... nenhum registro encontrado!
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="row justify-content-md-center">
                {{ $animals->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
