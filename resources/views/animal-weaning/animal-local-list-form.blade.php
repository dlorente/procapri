@if(!count($animals))
<div class="alert alert-danger text-center">
    <i class="fa fa-exclamation-triangle"></i>
    Oops... nenhum registro encontrado!
</div>
@else
<form id="form-local" action="{{ route('local-change-location') }}" method="POST">
    @csrf
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="" class="form-label">Local para a entrada dos animais</label>
            <select name="local_id" id="local_id" class="form-select">
                <option></option>
                @foreach($locals as $local)
                <option value="{{ $local->id }}">{{ $local->l2nome }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button class="btn btn-primary" type="submit">Enviar</button>
        </div>
    </div>
    <div class="row">
        <p class="text-center"><strong>Desmarque os animais que NÃO serão processados:</strong></p>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Registro</th>
                    <th>Placa</th>
                    <th>Nome do animal</th>
                    <th>Sexo</th>
                    <th>Data da entrada</th>
                    <th>Motivo entrada</th>
                </tr>
            </thead>
            <tbody>
                @foreach($animals as $animal)
                <tr>
                    <td class="text-center">
                        <input type="checkbox" checked name="animal_id[]" data-anentrada="{{ $animal->anentrada }}" value="{{ $animal->id }}">
                    </td>
                    <td>{{ $animal->anregistro }}</td>
                    <td>{{ $animal->ananimal }}</td>
                    <td>{{ $animal->annome }}</td>
                    <td>{{ $animal->sexo->sxnome }}</td>
                    <td>{{ $animal->anentrada }}</td>
                    <td>{{ $animal->entrada->ennome }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>
@endif