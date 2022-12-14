@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Cadastro de lotes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Cadastro de lotes</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            Alguma descrição aqui
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Listagem dos lotes cadastrados
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('lote.index') }}">
                        <div class="input-group mb-3">
                            <input class="form-control" name="search" value="{{ request('search') ?? '' }}" placeholder="Pesquisar pelo lote..."/>
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="submit" >
                                    <i class="fa fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('lote.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Cadastrar
                    </a>
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th class="text-center w-15">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lotes as $lote)
                        <tr>
                            <td>{{ $lote->l1codigo }}</td>
                            <td>{{ $lote->l1nome }}</td>
                            <td class="text-center">
                                <a href="{{ route('lote.edit', $lote->id) }}" class="btn btn-primary" title="Editar lote">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <a href="javascript:;" class="btn btn-danger" onclick="confirmDelete({{ $lote->id }})" title="Remover lote">
                                    <i class="fa fa-trash"></i>
                                </a>

                                <form id="btn-delete-{{ $lote->id }}" action="{{ route('lote.destroy', $lote->id) }}"
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
                {{ $lotes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
