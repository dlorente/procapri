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
                    <input autocomplete="off" type="text" class="datepicker form-control @error('andatasai') is-invalid @enderror" id="andatasai" name="andatasai" value="{{ old('andatasai', $animal->andatasai ?? null) }}" placeholder="00/00/0000">
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
                <label for="causaida_id" class="form-label">Causa da saída<star>*</star></label>
                <select class="form-select @error('causaida_id') is-invalid @enderror" aria-label="motivo" name="causaida_id" id="causaida_id">
                    <option value="">-Selecione-</option>
                    @foreach ($causas as $causa)
                    <option 
                        {{ set_selected($animal->causaida_id ?? null, $causa->id) }}
                        value="{{ $causa->id }}">{{ $causa->csnome }}</option>
                    @endforeach
                </select>
            </div>
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
<script>
    $( function() {
        $( ".datepicker" ).datepicker();
    });

    $('.datepicker').mask('00/00/0000')
    
    var formLote = document.getElementById('form-lote')
    if(formLote) {
        formLote.addEventListener('submit', (event) => {
            event.preventDefault();
            const animals = document.getElementsByName('animal_id[]')
            let andatasai = document.getElementById('andatasai').value
            let causaida_id = document.getElementById('causaida_id').value
            let motsaida_id = document.getElementById('motsaida_id').value
            let error_msg = ''

            if(andatasai == '') {
                error_msg = 'Infome uma data de saída!<br>'
            } else {
                andatasai = andatasai.split('/')
                andatasai = `${andatasai[2]}-${andatasai[1]}-${andatasai[0]}`
                andatasai = new Date(andatasai).getTime()
            }

            if(causaida_id == '') {
                error_msg += 'Infome a causa da saída!<br>'
            }

            if(motsaida_id == '') {
                error_msg += 'Infome o motivo da saída!<br>'
            }

            if(error_msg != '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: error_msg
                })
            }
            for(let animal of animals) {
                if(animal.checked) {
                    let entrada = animal.dataset.anentrada.split('/')
                    entrada = `${entrada[2]}-${entrada[1]}-${entrada[0]}`
                    entrada = new Date(entrada).getTime()
                    if(andatasai < entrada) {
                        error_msg += 'A data de saída deve ser posterior a data de entrada'
                    break;
                    }
                }
            }

            if(error_msg != '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: error_msg
                })
                return
            }
            formLote.submit()
        });
    }
</script>