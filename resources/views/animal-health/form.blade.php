@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Cadastro de doença/animal</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Cadastro de doença/animal</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            @if (! isset($animal_health))
                    <form method="POST" action="{{ route('animal-health.store') }}">
            @else
                <form method="POST" action="{{ route('animal-health.update', $animal_health) }}">
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
                                    @if(isset($animal_health))
                                        <option value="{{ $animal_health->animal->id }}">{{ old('anregistro', $animal_health->animal->anregistro ?? null) }}</option>
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
                                <input type="text" class="form-control" id="ananimal" disabled value="{{ old('ananimal', $animal_health->animal->ananimal ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">Nome do animal</label>
                                <input type="text" class="form-control" id="annome" disabled value="{{ old('annome', $animal_health->animal->annome ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label" for="addtinicio">Data<star>*</star></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input autocomplete="off" type="text" class="datepicker date form-control @error('addtinicio') is-invalid @enderror" id="addtinicio" name="addtinicio" value="{{ old('addtinicio', $animal_health->addtinicio ?? null) }}">
                                    @error('addtinicio')
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
                                <label class="form-label" for="doenca_id">Doença</label>
                                <select class="form-select @error('doenca_id') is-invalid @enderror" name="doenca_id" id="doenca_id" required>
                                    <option value="">-Selecione-</option>
                                    @foreach ($doencas as $doenca)
                                    <option 
                                        {{ set_selected(old('doenca_id', $animal_health->doenca_id ?? null), $doenca->id) }}
                                        value="{{ $doenca->id }}">{{ $doenca->nomedoenca }}</option>
                                    @endforeach
                                </select>
                                @error('doenca_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <p class="text-gray-600 mb-3">(1) Bacteriana; (2) Viral; (3) Endoparasitaria; (4) Ectoparasitaria; (5) Nutricional; (6) Outros</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="famacha_id">Famacha</label>
                                <select class="form-select @error('famacha_id') is-invalid @enderror" name="famacha_id" id="famacha_id" required>
                                    <option value="">-Selecione-</option>
                                    @foreach ($famachas as $famacha)
                                    <option 
                                        {{ set_selected(old('famacha_id', $animal_health->famacha_id ?? null), $famacha->id) }}
                                        value="{{ $famacha->id }}">{{ $famacha->fanome }}</option>
                                    @endforeach
                                </select>
                                @error('famacha_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <a href="http://www.nda.agric.za/docs/AAPS/FAMACHA/FAMACHA2.jpg" target="_blank" class="text-primary fw-600">Clique aqui para visualizar a Tabela FAMACHA</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="adobs" class="form-label">Observações</label>
                                <input type="text" class="form-control @error('adobs') is-invalid @enderror" name="adobs" maxlength="100" value="{{ old('adobs', $animal_health->adobs ?? null) }}">
                                @error('adobs')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </fieldset>
                @if (! isset($animal_health))
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
                    q: params.term
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


        $("#addtinicio").datepicker();
        $('#padultcob').datepicker();
        $('#padenclac').datepicker();
    });
</script>
@endpush
