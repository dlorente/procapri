@if(!count($animals))
<div class="alert alert-danger text-center">
    <i class="fa fa-exclamation-triangle"></i>
    Oops... nenhum registro encontrado!
</div>
@else
<form id="form-local" action="{{ route('local-weaning') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-4">
            <div class="mb-3">
                <label class="form-label" for="andesmama">Data de desmame<star>*</star></label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                    <input autocomplete="off" type="text" class="datepicker date form-control @error('andesmama') is-invalid @enderror" id="andesmama" name="andesmama" value="{{ old('andesmama', $animal_weaning->andesmama ?? null) }}">
                    @error('andesmama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
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
    <input type="hidden" id="local_id" name="local_id">
</form>
<script>
    $('.datepicker').datepicker()
    $('.date').mask('00/00/0000')

    var formLocal = document.getElementById('form-local')
    if(formLocal) {
        formLocal.addEventListener('submit', (event) => {
            event.preventDefault();
            document.getElementById('local_id').value = document.getElementById('local').value
            const animals = document.getElementsByName('animal_id[]')
            let andesmama = document.getElementById('andesmama').value
            let error_msg = ''

            if(andesmama == '') {
                error_msg = 'Infome a data do desmame!<br>'
            } else {
                andesmama = andesmama.split('/')
                andesmama = `${andesmama[2]}-${andesmama[1]}-${andesmama[0]}`
                andesmama = new Date(andesmama).getTime()
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
                    if(andesmama < entrada) {
                        error_msg += 'A data de desmame deve ser posterior a data de entrada'
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
            formLocal.submit()
        });
    }
</script>
@endif