@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Cadastro de Diagnóstico de Prenhes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Cadastro de Diagnóstico de Prenhes</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            @if (! isset($pregnancy_diagnosis))
                    <form method="POST" action="{{ route('pregnancy-diagnoses.store') }}">
            @else
                <form method="POST" action="{{ route('pregnancy-diagnoses.update', $pregnancy_diagnosis) }}">
                    @method('PUT')
            @endif

                @csrf
                <fieldset>
                    <legend>Informações do Animal</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="animal_id" class="form-label">Registro</label>
                                <input type="text" name="animal_id" class="form-control" value="{{ old('animal_id', $pregnancy_diagnosis->animal_id ?? null) }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">Placa</label>
                                <input type="text" class="form-control" id="ananimal" disabled value="{{ old('ananimal', $pregnancy_diagnosis->animal->ananimal ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">Nome do animal</label>
                                <input type="text" class="form-control" id="annome" disabled value="{{ old('annome', $pregnancy_diagnosis->animal->annome ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label" for="cidata">Data do cio<star>*</star></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input readonly autocomplete="off" type="text" class="date form-control @error('cidata') is-invalid @enderror" id="cidata" name="cidata" value="{{ old('cidata', $pregnancy_diagnosis->cidata ?? null) }}">
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
                                <input type="text" name="cinanimal" class="form-control" value="{{ old('cinanimal', $pregnancy_diagnosis->cinanimal ?? null) }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Data de cobertura</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input readonly type="text" class="form-control @error('cicobertu') is-invalid @enderror" id="cicobertu" name="cicobertu" value="{{ old('cicobertu', $pregnancy_diagnosis->cicobertu ?? null) }}">
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
                                    <input readonly type="text" class="form-control @error('cidatapre') is-invalid @enderror" id="cidatapre" name="cidatapre" value="{{ old('cidatapre', $pregnancy_diagnosis->cidatapre ?? null) }}">
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
                                <label class="form-label" for="tpcobertura_id">Tipo de cobertura</label>
                                <select disabled class="form-select @error('tpcobertura_id') is-invalid @enderror" name="tpcobertura_id" id="tpcobertura_id">
                                    <option value="">-Selecione-</option>
                                    @foreach ($tpcoberturas as $tpcobertura)
                                    <option 
                                        {{ set_selected(old('tpcobertura_id', $pregnancy_diagnosis->tpcobertura_id ?? null), $tpcobertura->id) }}
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
                        <div class="col-3 cidose-div @if(isset($pregnancy_diagnosis)) {{ $pregnancy_diagnosis->cobcodigo <> 'I' ? 'd-none' : '' }} @endif">
                            <div class="mb-3">
                                <label class="form-label" for="cidose">Número de doses</label>
                                <input disabled type="text" class="form-control" name="cidose" value="{{ old('cidose', $pregnancy_diagnosis->cidose ?? null) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="mb-3">
                                <label class="form-label" for="tpcio_id">Tipo do cio</label>
                                <select disabled class="form-select @error('tpcio_id') is-invalid @enderror" name="tpcio_id" id="tpcio_id">
                                    <option value="">-Selecione-</option>
                                    @foreach ($tpcios as $tpcio)
                                    <option 
                                        {{ set_selected(old('tpcio_id', $pregnancy_diagnosis->tpcio_id ?? null), $tpcio->id) }}
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
                                    <input type="text" class="form-control @error('cidtdiagnosticogest') is-invalid @enderror" id="cidtdiagnosticogest" name="cidtdiagnosticogest" value="{{ old('cidtdiagnosticogest', $pregnancy_diagnosis->cidtdiagnosticogest ?? null) }}">
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
                                <input type="text" name="citempoprovgest" class="form-control @error('citempoprovgest') is-invalid @enderror" value="{{ old('citempoprovgest', $pregnancy_diagnosis->citempoprovgest ?? null) }}">
                                @error('citempoprovgest')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="cinumfetosgest" class="form-label">Número de fetos</label>
                                <input type="text" name="cinumfetosgest" class="form-control @error('cinumfetosgest') is-invalid @enderror" value="{{ old('cinumfetosgest', $pregnancy_diagnosis->cinumfetosgest ?? null) }}">
                                @error('cinumfetosgest')
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
                                <label for="cpcodigo" class="form-label">Confirmação de gestação</label>
                                <select name="cpcodigo" id="cpcodigo" class="form-control @error('cpcodigo') is-invalid @enderror">
                                    <option value="">-Selecione-</option>
                                    @foreach($confprenhas as $confprenha)
                                    <option 
                                        {{ set_selected($pregnancy_diagnosis->cpcodigo ?? null, $confprenha->cpcodigo) }}
                                        value="{{ $confprenha->cpcodigo }}">{{ $confprenha->cpnome }}</option>
                                    @endforeach
                                </select>
                                @error('cpcodigo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="tpexgest_id" class="form-label">Tipo de exame</label>
                            <select name="tpexgest_id" id="tpexgest_id" class="form-control @error('tpexgest_id') is-invalid @enderror">
                                <option value="">-Selecione-</option>
                                @foreach($tpexgests as $tpexgest)
                                <option 
                                    {{ set_selected($pregnancy_diagnosis->tpexgest_id ?? null, $tpexgest->id) }}
                                    value="{{ $tpexgest->id }}">{{ $tpexgest->exgnome }}</option>
                                @endforeach
                            </select>
                            @error('tpexgest_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </fieldset>
                @if (! isset($pregnancy_diagnosis))
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
