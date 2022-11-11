@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Entrada de Partos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Formulário de Entrada de Partos</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <form id="parturition_entry-form" method="POST" action="{{ route('parturition-entries.store', $parturition_entry) }}">
                @csrf
                <input type="hidden" name="animal_id" value="{{ $parturition_entry->animal_id }}">
                <fieldset>
                    <legend>Informações do Animal</legend>
                    <div class="row">
                        <div class="col-sm-4 col-sx-12">
                            <div class="mb-3">
                                <label class="form-label" for="anregistro" class="form-label">Registro</label>
                                <input type="text" name="anregistro" class="form-control" value="{{ old('anregistro', $parturition_entry->anregistro ?? null) }}" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4 col-sx-12">
                            <div class="mb-3">
                                <label class="form-label">Placa</label>
                                <input type="text" class="form-control" id="ananimal" disabled value="{{ old('ananimal', $parturition_entry->animal->ananimal ?? null) }}">
                            </div>
                        </div>
                        <div class="col-sm-4 col-sx-12">
                            <div class="mb-3">
                                <label class="form-label">Nome do animal</label>
                                <input type="text" class="form-control" id="annome" disabled value="{{ old('annome', $parturition_entry->animal->annome ?? null) }}">
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-sx-12">
                            <div class="mb-3">
                                <label class="form-label" for="panubode">Número do bode</label>
                                <input type="text" name="panubode" class="form-control" value="{{ old('panubode', $parturition_entry->cinanimal ?? null) }}" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4 col-sx-12">
                            <div class="mb-3">
                                <label class="form-label" for="padultcob">Data da última cobertura</label>
                                <input type="text" name="padultcob" id="padultcob" class="form-control" value="{{ old('padultcob', $parturition_entry->cidata ?? null) }}" readonly>
                            </div>
                        </div>
                        <div class="col-sm-4 col-sx-12">
                            <div class="mb-3">
                                <label class="form-label" for="paordem">Ordem do parto</label>
                                <input type="text" name="paordem" class="form-control" value="{{ old('paordem', $parturition_entry->paordem ?? null) }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-sx-12">
                            <div class="mb-3">
                                <label class="form-label">Tipo de cio</label>
                                <input disabled type="text" class="form-control" value="{{ $parturition_entry->tpcio->cionome }}">
                                <input type="hidden" name="tpcio_id" value="{{ $parturition_entry->tpcio->id }}">
                            </div>
                        </div>
                        <div class="col-sm-4 col-sx-12">
                            <div class="mb-3">
                                <label class="form-label">Tipo de cobertura</label>
                                <input disabled type="text" class="form-control" value="{{ $parturition_entry->tpcobertura->cobnome }}">
                                <input type="hidden" name="tpcobertura_id" value="{{ $parturition_entry->tpcobertura->id }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-sx-12">
                            <div class="mb-3">
                                <label class="form-label" for="padatapar">Data do parto<star>*</star></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input autocomplete="off" type="text" class="datepicker date form-control @error('padatapar') is-invalid @enderror" id="padatapar" name="padatapar" value="{{ old('padatapar', $animal_heat->padatapar ?? null) }}" required>
                                    @error('padatapar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-sx-12">
                            <div class="mb-3">
                                <label class="form-label" for="tpparto_id">Tipo do parto<star>*</star></label>
                                <select class="form-select @error('tpparto_id') is-invalid @enderror" name="tpparto_id" id="tpparto_id" required>
                                    <option value="">-Selecione-</option>
                                    @foreach ($tppartos as $tpparto)
                                    <option value="{{ $tpparto->id }}">{{ $tpparto->panome }}</option>
                                    @endforeach
                                </select>
                                @error('tpparto_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4 col-sx-12">
                            <div class="mb-3">
                                <label for="panucrias" class="form-label">Número de crias<star>*</star></label>
                                <div class="input-group mb-3">
                                    <input type="number" min="1" class="form-control" name="panucrias" id="panucrias">
                                    <button class="btn btn-primary" type="button" id="addBabies">Entrar crias</button>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div id="babies"></div>
                </fieldset>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var form = document.getElementById('parturition_entry-form')
    form.addEventListener('submit', (event) => {
        let error_msg = '';
        event.preventDefault()
        let padatapar = document.getElementById('padatapar').value
        let padultcob = document.getElementById('padultcob').value

        padatapar = padatapar.split('/')
        padatapar = `${padatapar[2]}-${padatapar[1]}-${padatapar[0]}`
        padatapar = new Date(padatapar).getTime()
        
        padultcob = padultcob.split('/')
        padultcob = `${padultcob[2]}-${padultcob[1]}-${padultcob[0]}`
        padultcob = new Date(padultcob).getTime()

        if(padatapar <= padultcob) {
            error_msg += 'A data do parto deve deve ser posterior a data de cobertura'
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: error_msg
            })
            return false
        }

        Swal.fire({
            title: 'Procapri',
            html: 'Antes de registrar os dados do parto, verifique se todas as informações estão corretas.',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Enviar',
            confirmButtonColor: '#0d4b85',
        }).then(result => {

            if (! result.value) {
                return false
            }

            return form.submit()
        })
    })

    $( function() {
        $("#padatapar").datepicker();

        $('#addBabies').on('click', function (e) {
            $('#babies').html('<h5>Informações da cria (*<b>Preenchimento obrigatório</b>)</h5>')
            const num_babies = parseInt($('#panucrias').val())
            for(let i = 0; i < num_babies; i++) {
                $.get(`{{ route('parturition-entries.baby-form') }}`)
                .done(data => {
                    $('#babies').append(data)
                });
            }
            $(document).on('blur', 'input.b_anregistro' , function(event) {
                const element = $(event.target)
                const anregistro = $(this).val()
                if(anregistro !== '') {
                    $.get("{{ route('animals.search') }}", {q: anregistro})
                        .done(function( data ) {
                            if(data.results.length > 0) {
                                element.addClass('is-invalid')
                                element.removeClass('is-valid')
                                element.parent().append(`
                                <span class="invalid-feedback" role="alert">
                                    <strong>Animal já cadastrado</strong>
                                </span>
                                `)
                            } else {
                                element.removeClass('is-invalid')
                                element.addClass('is-valid')
                                element.parent().remove('.invalid-feedback')
                            }
                        });
                }
            })
        });
    });
</script>
@endpush
