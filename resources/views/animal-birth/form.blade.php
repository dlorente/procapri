@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Cadastro de parto</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Cadastro de parto</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            @if (! isset($animal_birth))
                    <form method="POST" action="{{ route('animal-birth.store') }}">
            @else
                <form method="POST" action="{{ route('animal-birth.update', $animal_birth) }}">
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
                                    @if(isset($animal_birth))
                                        <option value="{{ $animal_birth->animal->id }}">{{ old('anregistro', $animal_birth->animal->anregistro ?? null) }}</option>
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
                                <input type="text" class="form-control" id="ananimal" disabled value="{{ old('ananimal', $animal_birth->animal->ananimal ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">Nome do animal</label>
                                <input type="text" class="form-control" id="annome" disabled value="{{ old('annome', $animal_birth->animal->annome ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label" for="padatapar">Data do parto<star>*</star></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input autocomplete="off" type="text" class="datepicker date form-control @error('padatapar') is-invalid @enderror" id="padatapar" name="padatapar" value="{{ old('padatapar', $animal_birth->padatapar ?? null) }}">
                                    @error('padatapar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="" class="form-label">Ordem do parto</label>
                                <input type="text" class="form-control" name="paordem" id="paordem" value="{{ old('paordem', $animal_birth->paordem ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="panucrias" class="form-label">Número de crias</label>
                                <input type="text" class="form-control" name="panucrias" id="panucrias" value="{{ old('panucrias', $animal_birth->panucrias ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="tpparto_id" class="form-label">Tipo do parto</label>
                                <select name="tpparto_id" id="tpparto_id" class="form-control">
                                    <option value="">-Selecione-</option>
                                    @foreach($tppartos as $tp)
                                    <option 
                                        {{ set_selected($animal_birth->tpparto_id ?? null, $tp->id) }}
                                        value="{{ $tp->id }}">{{ $tp->panome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="panubode">Número do bode</label>
                                <select class="form-select select2" aria-label="Lote" name="panubode" id="panubode" required>
                                    @if(isset($animal_birth))
                                        <option value="{{ $animal_birth->panubode }}">{{ $animal_birth->panubode }}</option>
                                    @endif
                                </select>
                                @error('panubode')
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
                                <label class="form-label" for="padultcob">Data de cobertura</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input autocomplete="off" type="text" class="datepicker date form-control @error('padultcob') is-invalid @enderror" id="padultcob" name="padultcob" value="{{ old('padultcob', $animal_birth->padultcob ?? null) }}">
                                    @error('padultcob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="cobcodigo">Tipo de cobertura<star>*</star></label>
                                <select class="form-select @error('cobcodigo') is-invalid @enderror" name="cobcodigo" id="cobcodigo" required>
                                    <option value="">-Selecione-</option>
                                    @foreach ($tpcoberturas as $tpcobertura)
                                    <option 
                                        {{ set_selected(old('cobcodigo', $animal_birth->cobcodigo ?? null), $tpcobertura->cobcodigo) }}
                                        value="{{ $tpcobertura->cobcodigo }}">{{ $tpcobertura->cobnome }}</option>
                                    @endforeach
                                </select>
                                @error('cobcodigo')
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
                                <label class="form-label" for="padenclac">Encerramento da lactação</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input autocomplete="off" type="text" class="datepicker date form-control @error('padenclac') is-invalid @enderror" id="padenclac" name="padenclac" value="{{ old('padenclac', $animal_birth->padenclac ?? null) }}">
                                    @error('padenclac')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="encerra_id">Motivo<star>*</star></label>
                                <select class="form-select @error('encerra_id') is-invalid @enderror" name="encerra_id" id="encerra_id" required>
                                    <option value="">-Selecione-</option>
                                    @foreach ($encerra_motivos as $motivo)
                                    <option 
                                        {{ set_selected(old('encerra_id', $animal_birth->encerra_id ?? null), $motivo->id) }}
                                        value="{{ $motivo->id }}">{{ $motivo->ecnome }}</option>
                                    @endforeach
                                </select>
                                @error('encerra_id')
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
                                <label class="form-label" for="ciocodigo">Tipo do cio<star>*</star></label>
                                <select class="form-select @error('ciocodigo') is-invalid @enderror" name="ciocodigo" id="ciocodigo" required>
                                    <option value="">-Selecione-</option>
                                    @foreach ($tpcios as $tpcio)
                                    <option 
                                        {{ set_selected(old('ciocodigo', $animal_birth->ciocodigo ?? null), $tpcio->ciocodigo) }}
                                        value="{{ $tpcio->ciocodigo }}">{{ $tpcio->cionome }}</option>
                                    @endforeach
                                </select>
                                @error('ciocodigo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="pancioncob" class="form-label">Número de cios não cobertos</label>
                                <input type="text" class="form-control" name="pancioncob" id="pancioncob" value="{{ old('pancioncob', $animal_birth->pancioncob ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="panciocob" class="form-label">Número de cios cobertos</label>
                                <input type="text" class="form-control" name="panciocob" id="panciocob" value="{{ old('panciocob', $animal_birth->panciocob ?? null) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="paprtolei" class="form-label">Produção leite total</label>
                                <input type="text" class="form-control" name="paprtolei" id="paprtolei" value="{{ old('paprtolei', $animal_birth->paprtolei ?? null) }}" placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="paprmaxima" class="form-label">Produção máxima leite</label>
                                <input type="text" class="form-control" name="paprmaxima" id="paprmaxima" value="{{ old('paprmaxima', $animal_birth->paprmaxima ?? null) }}" placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="paprminima" class="form-label">Produção mínima leite</label>
                                <input type="text" class="form-control" name="paprminima" id="paprminima" value="{{ old('paprminima', $animal_birth->paprminima ?? null) }}" placeholder="0.00">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="patgordura" class="form-label">% Total de gordura</label>
                                <input type="text" class="form-control" name="patgordura" id="patgordura" value="{{ old('patgordura', $animal_birth->patgordura ?? null) }}" placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">  
                                <label for="patprotei" class="form-label">% Total de proteína</label>
                                <input type="text" class="form-control" name="patprotei" id="patprotei" value="{{ old('patprotei', $animal_birth->patprotei ?? null) }}" placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="paextseco" class="form-label">% Extrato seco total</label>
                                <input type="text" class="form-control" name="paextseco" id="paextseco" value="{{ old('paextseco', $animal_birth->paextseco ?? null) }}" placeholder="0.00">
                            </div>
                        </div>
                    </div>
                </fieldset>
                @if (! isset($animal_birth))
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

        $('#panubode').select2({
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


        $("#padatapar").datepicker();
        $('#padultcob').datepicker();
        $('#padenclac').datepicker();
    });
</script>
@endpush
