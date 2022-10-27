@if(!count($animals))
<div class="alert alert-danger text-center">
    <i class="fa fa-exclamation-triangle"></i>
    Oops... nenhum registro encontrado!
</div>
@else
<form id="form-lote" action="{{ route('lote-exit') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="andatasai" class="form-label">Data da saída<star>*</star></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                    <input type="text" class="datepicker form-control @error('andatasai') is-invalid @enderror" id="andatasai" name="andatasai" value="{{ old('andatasai', $animal->andatasai ?? null) }}" placeholder="00/00/0000">
                    @error('andatasai')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="motsaida_id" class="form-label">Motivo da saída<star>*</star></label>
                <select class="form-select @error('motsaida_id') is-invalid @enderror" aria-label="motivo" name="motsaida_id" id="motsaida_id">
                    <option value="">-Selecione-</option>
                    @foreach ($motivos as $motivo)
                    <option 
                        {{ set_selected($animal->motsaida_id ?? null, $motivo->id) }}
                        value="{{ $motivo->id }}">{{ $motivo->msnome }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="causasaida_id" class="form-label">Causa da saída<star>*</star></label>
                <select class="form-select @error('causasaida_id') is-invalid @enderror" aria-label="motivo" name="causasaida_id" id="causasaida_id">
                    <option value="">-Selecione-</option>
                    @foreach ($causas as $causa)
                    <option 
                        {{ set_selected($animal->causasaida_id ?? null, $causa->id) }}
                        value="{{ $causa->id }}">{{ $causa->csnome }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button class="btn btn-primary" type="button" onclick="formSubmit(event)">Enviar</button>
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
                </tr>
            </thead>
            <tbody>
                @foreach($animals as $animal)
                <tr>
                    <td class="text-center"><input type="checkbox" checked name="animal_id[]" value="{{ $animal->id }}"></td>
                    <td>{{ $animal->anregistro }}</td>
                    <td>{{ $animal->ananimal }}</td>
                    <td>{{ $animal->annome }}</td>
                    <td>{{ $animal->sexo->sxnome }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>
@endif
<script>
    function formSubmit(event) {
        const form = document.getElementById('form-lote')
        event.preventDefault()
        console.log(form)
    }
</script>