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
            @if (! isset($animal_treatment))
                    <form method="POST" action="{{ route('animal-treatments.store') }}">
            @else
                <form method="POST" action="{{ route('animal-treatments.update', $animal_treatment) }}">
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
                                    @if(isset($animal_treatment))
                                        <option value="{{ $animal_treatment->animal->id }}">{{ old('anregistro', $animal_treatment->animal->anregistro ?? null) }}</option>
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
                                <input type="text" class="form-control" id="ananimal" readonly value="{{ old('ananimal', $animal_treatment->animal->ananimal ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">Nome do animal</label>
                                <input type="text" class="form-control" id="annome" readonly value="{{ old('annome', $animal_treatment->animal->annome ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label" for="ocdata">Data<star>*</star></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input autocomplete="off" type="text" class="datepicker date form-control @error('ocdata') is-invalid @enderror" id="ocdata" name="ocdata" value="{{ old('ocdata', $animal_treatment->ocdata ?? null) }}">
                                    @error('ocdata')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="oc1" class="form-label">Ocorrência(1)</label>
                                <input type="text" class="form-control @error('oc1') is-invalid @enderror" name="oc1" id="oc1" value="{{ old('oc1', $animal_treatment->oc1 ?? null) }}" maxlength="55" required>
                                @error('oc1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="oc2" class="form-label">Ocorrência(2)</label>
                                <input type="text" class="form-control @error('oc2') is-invalid @enderror" name="oc2" id="oc2" value="{{ old('oc2', $animal_treatment->oc2 ?? null) }}" maxlength="55">
                                @error('oc2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="oc3" class="form-label">Ocorrência(3)</label>
                                <input type="text" class="form-control @error('oc3') is-invalid @enderror" name="oc3" id="oc3" value="{{ old('oc3', $animal_treatment->oc3 ?? null) }}" maxlength="55">
                                @error('oc3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="oc4" class="form-label">Ocorrência(4)</label>
                                <input type="text" class="form-control @error('oc4') is-invalid @enderror" name="oc4" id="oc4" value="{{ old('oc4', $animal_treatment->oc4 ?? null) }}" maxlength="55">
                                @error('oc4')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="oc5" class="form-label">Ocorrência(5)</label>
                                <input type="text" class="form-control @error('oc5') is-invalid @enderror" name="oc5" id="oc5" value="{{ old('oc5', $animal_treatment->oc5 ?? null) }}" maxlength="55">
                                @error('oc5')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="oc6" class="form-label">Ocorrência(6)</label>
                                <input type="text" class="form-control @error('oc6') is-invalid @enderror" name="oc6" id="oc6" value="{{ old('oc6', $animal_treatment->oc6 ?? null) }}" maxlength="55">
                                @error('oc6')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </fieldset>
                @if (! isset($animal_treatment))
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


        $("#ocdata").datepicker();
    });
</script>
@endpush
