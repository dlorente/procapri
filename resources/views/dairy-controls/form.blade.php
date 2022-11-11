@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Entrada de Produção de Leite</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Formulário de Entrada de Produção</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            @if (! isset($dairy_control))
                    <form method="POST" action="{{ route('dairy-controls.store') }}">
            @else
                <form method="POST" action="{{ route('dairy-controls.update', $dairy_control) }}">
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
                                    @if(isset($dairy_control))
                                        <option value="{{ $dairy_control->animal->id }}">{{ old('anregistro', $dairy_control->animal->anregistro ?? null) }}</option>
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
                                <input type="text" class="form-control" id="ananimal" disabled value="{{ old('ananimal', $dairy_control->animal->ananimal ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label">Nome do animal</label>
                                <input type="text" class="form-control" id="annome" disabled value="{{ old('annome', $dairy_control->animal->annome ?? null) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label" for="prdatacon">Data<star>*</star></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input autocomplete="off" type="text" class="datepicker date form-control @error('prdatacon') is-invalid @enderror" id="prdatacon" name="prdatacon" value="{{ old('prdatacon', $dairy_control->prdatacon ?? null) }}">
                                    @error('prdatacon')
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
                                <label for="prplord1" class="form-label">Primeira ordenha</label>
                                <input type="text" class="form-control" name="prplord1" id="prplord1" value="{{ str_replace('.', ',', old('prplord1', $dairy_control->prplord1 ?? null)) }}" placeholder="0,00">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="prplord2" class="form-label">Segunda ordenha</label>
                                <input type="text" class="form-control" name="prplord2" id="prplord2" value="{{ str_replace('.', ',', old('prplord2', $dairy_control->prplord2 ?? null)) }}" placeholder="0,00">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="prplord3" class="form-label">Terceira ordenha</label>
                                <input type="text" class="form-control" name="prplord3" id="prplord3" value="{{ str_replace('.', ',', old('prplord3', $dairy_control->prplord3 ?? null)) }}" placeholder="0,00">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="ocolact_id">Ocorrência</label>
                                <select class="form-select @error('ocolact_id') is-invalid @enderror" name="ocolact_id" id="ocolact_id" required>
                                    <option value="">-Selecione-</option>
                                    @foreach ($ocorrencias as $ocorrencia)
                                    <option 
                                        {{ set_selected(old('ocolact_id', $dairy_control->ocolact_id ?? null), $ocorrencia->id) }}
                                        value="{{ $ocorrencia->id }}">{{ $ocorrencia->olnome }}</option>
                                    @endforeach
                                </select>
                                @error('ocolact_id')
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
                                <label for="prgordura" class="form-label">% Total de gordura</label>
                                <input type="text" class="form-control" name="prgordura" id="prgordura" value="{{ str_replace('.', ',', old('prgordura', $dairy_control->prgordura ?? null)) }}" placeholder="0,00">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">  
                                <label for="prproteina" class="form-label">% Total de proteína</label>
                                <input type="text" class="form-control" name="prproteina" id="prproteina" value="{{ str_replace('.', ',', old('prproteina', $dairy_control->prproteina ?? null)) }}" placeholder="0,00">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="prextseco" class="form-label">% Extrato seco total</label>
                                <input type="text" class="form-control" name="prextseco" id="prextseco" value="{{ str_replace('.', ',', old('prextseco', $dairy_control->prextseco ?? null)) }}" placeholder="0,00">
                            </div>
                        </div>
                    </div>
                </fieldset>
                @if (! isset($dairy_control))
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
