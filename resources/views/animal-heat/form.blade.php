@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Cadastro de cio (Monta campo)</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Cadastro de cio (Monta campo)</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            @if (! isset($animal_heat))
                    <form method="POST" action="{{ route('animal-heat.store') }}">
            @else
                <form method="POST" action="{{ route('animal-heat.update', $animal_heat) }}">
                    @method('PUT')
            @endif

                @csrf
                <fieldset>
                    <legend>Informações do Animal</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="animal_id" class="form-label">Registro<star>*</star></label>
                                <select class="form-select select2 @error('animal_id') is-invalid @enderror" aria-label="Lote" name="animal_id" id="animal_id" required>
                                    @if(isset($animal_heat))
                                        <option value="{{ $animal_heat->animal->id }}">{{ old('anregistro', $animal_heat->animal->anregistro ?? null) }}</option>
                                    @endif
                                </select>
                                @error('animal_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">Placa</label>
                                <input type="text" class="form-control" id="ananimal" disabled value="{{ old('ananimal', $animal_heat->animal->ananimal ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">Nome do animal</label>
                                <input type="text" class="form-control" id="annome" disabled value="{{ old('annome', $animal_heat->animal->annome ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label" for="cidata">Data do cio<star>*</star></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input autocomplete="off" type="text" class="datepicker date form-control @error('cidata') is-invalid @enderror" id="cidata" name="cidata" value="{{ old('cidata', $animal_heat->cidata ?? null) }}">
                                    @error('cidata')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="cinanimal">Número do bode</label>
                                <select class="form-select select2" aria-label="Lote" name="cinanimal" id="cinanimal" required>
                                    @if(isset($animal_heat))
                                        <option value="{{ $animal_heat->cinanimal }}">{{ $animal_heat->cinanimal }}</option>
                                    @endif
                                </select>
                                @error('cinanimal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Data de cobertura</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input readonly type="text" class="form-control @error('cicobertu') is-invalid @enderror" id="cicobertu" name="cicobertu" value="{{ old('cicobertu', $animal_heat->cicobertu ?? null) }}">
                                    @error('cicobertu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Previsão do parto</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input readonly type="text" class="form-control @error('cidatapre') is-invalid @enderror" id="cidatapre" name="cidatapre" value="{{ old('cidatapre', $animal_heat->cidatapre ?? null) }}">
                                    @error('cidatapre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">                        
                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label" for="tpcobertura_id">Tipo de cobertura<star>*</star></label>
                                <select class="form-select @error('tpcobertura_id') is-invalid @enderror" name="tpcobertura_id" id="tpcobertura_id" required>
                                    <option value="">-Selecione-</option>
                                    @foreach ($tpcoberturas as $tpcobertura)
                                    <option 
                                        {{ set_selected(old('tpcobertura_id', $animal_heat->tpcobertura_id ?? null), $tpcobertura->id) }}
                                        value="{{ $tpcobertura->id }}">{{ $tpcobertura->cobnome }}</option>
                                    @endforeach
                                </select>
                                @error('tpcobertura_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3 cidose-div @if(isset($animal_heat)) {{ $animal_heat->cobcodigo <> 'I' ? 'd-none' : '' }} @endif">
                            <div class="mb-3">
                                <label class="form-label" for="cidose">Número de doses</label>
                                <input type="text" class="form-control" name="cidose" value="{{ old('cidose', $animal_heat->cidose ?? null) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label" for="tpcio_id">Tipo do cio<star>*</star></label>
                                <select class="form-select @error('tpcio_id') is-invalid @enderror" name="tpcio_id" id="tpcio_id" required>
                                    <option value="">-Selecione-</option>
                                    @foreach ($tpcios as $tpcio)
                                    <option 
                                        {{ set_selected(old('tpcio_id', $animal_heat->tpcio_id ?? null), $tpcio->id) }}
                                        value="{{ $tpcio->id }}">{{ $tpcio->cionome }}</option>
                                    @endforeach
                                </select>
                                @error('tpcio_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="cidtdiagnosticogest" class="form-label">Data do diagnóstico</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input type="text" class="form-control @error('cidtdiagnosticogest') is-invalid @enderror" id="cidtdiagnosticogest" name="cidtdiagnosticogest" value="{{ old('cidtdiagnosticogest', $animal_heat->cidtdiagnosticogest ?? null) }}">
                                    @error('cidtdiagnosticogest')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="citempoprovgest" class="form-label">Tempo de gestação</label>
                                <input type="text" name="citempoprovgest" class="form-control" value="{{ old('citempoprovgest', $animal_heat->citempoprovgest ?? null) }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="cinumfetosgest" class="form-label">Número de fetos</label>
                                <input type="text" name="cinumfetosgest" class="form-control" value="{{ old('cinumfetosgest', $animal_heat->cinumfetosgest ?? null) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="cpcodigo" class="form-label">Confirmação de gestação</label>
                                <select name="cpcodigo" id="cpcodigo" class="form-control">
                                    <option value="">-Selecione-</option>
                                    @foreach($confprenhas as $confprenha)
                                    <option 
                                        {{ set_selected($animal_heat->cpcodigo ?? null, $confprenha->cpcodigo) }}
                                        value="{{ $confprenha->cpcodigo }}">{{ $confprenha->cpnome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="tpexgest_id" class="form-label">Tipo de exame</label>
                            <select name="tpexgest_id" id="tpexgest_id" class="form-control">
                                <option value="">-Selecione-</option>
                                @foreach($tpexgests as $tpexgest)
                                <option 
                                    {{ set_selected($animal_heat->tpexgest_id ?? null, $tpexgest->id) }}
                                    value="{{ $tpexgest->id }}">{{ $tpexgest->exgnome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>
                @if (! isset($animal_heat))
                <button type="submit" class="btn btn-primary">Cadastrar</button>
                @else
                <button type="submit" class="btn btn-primary">Atualizar</button>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $( function() {
        $('#animal_id').select2({
            placeholder: 'Selecione o animal',
            theme: 'bootstrap-5',
            allowClear: true,
            minimumInputLength: 1,
            delay: 250,
            ajax: {
                url: '{{ route("animals.search") }}',
                data: function (params) {
                var query = {
                    q: params.term,
                    sexo_id: 1 //femea
                }
                return query;
                },
            }
        });        

        $('#animal_id').on('select2:select', function (e) {
            var data = e.params.data;
            $('#annome').val(data.annome);
            $('#ananimal').val(data.ananimal)
        });
        $("#animal_id").on("select2:unselecting", function(e) {
            $('#annome').val('')
            $('#ananimal').val('')
        });

        $('#cinanimal').select2({
            placeholder: 'Selecione o bode',
            theme: 'bootstrap-5',
            allowClear: true,
            minimumInputLength: 1,
            delay: 250,
            ajax: {
                url: '{{ route("animals.search") }}',
                data: function (params) {
                    var query = {
                        q: params.term,
                        sexo_id: 3 //macho
                    }
                    return query;
                },
                processResults: (data) => {
                    return {
                        results: $.map(data.results, function (item) {
                            return {
                                text: item.anregistro,
                                id: item.anregistro
                            }
                        })
                    };
                }
            },            
        });

        $("#cidata").datepicker({
            onClose: function(dateText, inst) {
                const date = $(this).val()
                $('#cicobertu').val(date)
                $('#cidatapre').val(sumDaysToDate(date, 152))
            }
        });

        $('#tpcobertura_id').on('change', (e) => {
            const tp = parseInt($('#tpcobertura_id').val())
            if(tp === 1) {
                $('.cidose-div').removeClass('d-none')
            } else {
                $('.cidose-div').addClass('d-none')
            }
        })

        $("#cidtdiagnosticogest").datepicker();
    });
</script>
@endpush
