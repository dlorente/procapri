@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Encerramento de Lactação do Rebanho - Local</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Processamento de Local de Animais</li>
    </ol>
    @if(!count($animals))
    <div class="alert alert-danger text-center">
        <i class="fa fa-exclamation-triangle"></i>
        Oops... nenhum registro encontrado!
    </div>
    @else
    <div class="card mb-4">
        <div class="card-body">
            <form id="form-local" method="POST" action="{{ route('dryoff-controls.update-local', $local_id) }}">

                @csrf
                <div class="row">
                    <div class="col-sm-4 bol-sx-12">
                        <div class="mb-3">
                            <label class="form-label" for="padenclac">Encerramento da lactação<star>*</star></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                <input required autocomplete="off" type="text" class="datepicker date form-control @error('padenclac') is-invalid @enderror" id="padenclac" name="padenclac" value="{{ old('padenclac', $dryoff_control->padenclac ?? null) }}">
                                @error('padenclac')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 bol-sx-12">
                        <div class="mb-3">
                            <label for="encerra_id" class="form-label">Motivo<star>*</star></label>
                            <select class="form-select @error('encerra_id') is-invalid @enderror" aria-label="motivo" name="encerra_id" id="encerra_id">
                                <option value="">-Selecione-</option>
                                @foreach ($motivos as $motivo)
                                <option 
                                    {{ set_selected($dryoff_control->encerra_id ?? null, $motivo->id) }}
                                    value="{{ $motivo->id }}">{{ $motivo->ecnome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
                <div class="row">
                    <p class="text-center"><strong>Desmarque os animais que NÃO serão processados:</strong></p>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Registro</th>
                                <th>Placa</th>
                                <th>Nome do animal</th>
                                <th>Data do parto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($animals as $animal)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" checked name="parto_id[]" data-padatapar="{{ $animal->padatapar }}" value="{{ $animal->parto_id }}">
                                </td>
                                <td>{{ $animal->anregistro }}</td>
                                <td>{{ $animal->ananimal }}</td>
                                <td>{{ $animal->annome }}</td>
                                <td>{{ $animal->padatapar }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection
@push('scripts')
<script>
    $("#padenclac").datepicker();
    var formlocal = document.getElementById('form-local')
    if(formlocal) {
        formlocal.addEventListener('submit', (event) => {
            event.preventDefault();
            const animals = document.getElementsByName('parto_id[]')
            let padenclac = document.getElementById('padenclac').value
            let encerra_id = document.getElementById('encerra_id').value
            let error_msg = ''

            if(padenclac == '') {
                error_msg = 'Infome uma data de encerramento!<br>'
            } else {
                padenclac = padenclac.split('/')
                padenclac = `${padenclac[2]}-${padenclac[1]}-${padenclac[0]}`
                padenclac = new Date(padenclac).getTime()
            }

            if(encerra_id == '') {
                error_msg += 'Infome o motivo do encerramento!<br>'
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
                    let entrada = animal.dataset.padatapar.split('/')
                    entrada = `${entrada[2]}-${entrada[1]}-${entrada[0]}`
                    entrada = new Date(entrada).getTime()
                    if(padenclac < entrada) {
                        error_msg += 'A data de encerramento deve ser posterior a data do parto'
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
            formlocal.submit()
        });
    }
</script>
@endpush