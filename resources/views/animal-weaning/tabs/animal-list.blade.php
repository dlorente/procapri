<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Listagem dos animais cadastrados
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form method="GET" action="{{ route('animal-weaning.index') }}">
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
        </div>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Registro</th>
                    <th>Placa</th>
                    <th>Nome do animal</th>
                    <th>Sexo</th>
                    <th class="text-center w-15">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($animals as $animal)
                    <tr>
                        <td>{{ $animal->anregistro }}</td>
                        <td>{{ $animal->ananimal }}</td>
                        <td>{{ $animal->annome }}</td>
                        <td>{{ $animal->sexo->sxnome }}</td>
                        <td class="text-center">
                            <a href="{{ route('individual-weaning-form', $animal) }}" class="btn btn-primary" title="Cadastrar desmame do animal">
                                <i class="fa-solid fa-arrows-left-right-to-line"></i>
                            </a>
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