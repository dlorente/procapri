@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Cadastro de lotes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Cadastro de lotes</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            @if (! isset($lote))
                    <form method="POST" action="{{ route('lote.store') }}">
            @else
                <form method="POST" action="{{ route('lote.update', $lote) }}">
                    @method('PUT')
            @endif

                @csrf
                <fieldset>
                    <legend>Informações do lote</legend>
                    <div class="row">
                        <div class="col-sm-3 col-sx-12">
                            <div class="mb-3">
                                <label for="l1codigo" class="form-label">Código<start>*</start></label>
                                <input type="text" class="form-control @error('l1codigo') is-invalid @enderror" name="l1codigo" value="{{ old('l1codigo', $lote->l1codigo ?? null) }}" required>
                                @error('l1codigo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-9 col-sx-12">
                            <div class="mb-3">
                                <label for="l1codigo" class="form-label">Descrição<start>*</start></label>
                                <input type="text" class="form-control @error('l1nome') is-invalid @enderror" name="l1nome" value="{{ old('l1nome', $lote->l1nome ?? null) }}" maxlength="50" required>
                                @error('l1nome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </fieldset>
                @if (! isset($lote))
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
