@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Entrada Ponderal</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Formulário de Entrada de Peso do Animal por Data</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <form id="form-weights" method="POST" action="{{ route('weight-controls.store-by-date') }}">

                @csrf
                <fieldset>
                    <legend>Informações das Pesagens</legend>
                    <div class="row">
                        <div class="col-sm-4 bol-sx-12">
                            <div class="mb-3">
                                <label class="form-label" for="pedatapes">Data da pesagem<star>*</star></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input required autocomplete="off" type="text" class="datepicker date form-control @error('pedatapes') is-invalid @enderror" id="pedatapes" name="pedatapes" value="{{ old('pedatapes', $weight_control->pedatapes ?? null) }}">
                                    @error('pedatapes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="animal_id" class="form-label">Registro</label>
                                <select class="form-select select2 @error('animal_id') is-invalid @enderror" aria-label="Lote" name="animal_id" id="animal_id">
                                    @if(isset($weight_control))
                                        <option value="{{ $weight_control->animal->id }}">{{ old('anregistro', $weight_control->animal->anregistro ?? null) }}</option>
                                    @endif
                                </select>
                                @error('animal_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-5 col-sx-12">
                            <div class="mb-3">
                                <label for="annome" class="form-label">Nome</label>
                                <input type="text" disabled name="annome" id="annome" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-3 col-sx-12">
                            <div class="mb-3">
                                <label for="peso" class="form-label">Peso</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="0,00" name="peso" id="peso">
                                    <button class="btn btn-primary" type="button" id="add-weight"><i class="fa fa-plus mr-2"></i>Adicionar</button>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-stripped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Registro do animal</th>
                                        <th>Nome</th>
                                        <th>Peso</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="weights-table"></tbody>
                            </table>
                        </div>
                    </div>
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
    const deleteEntry = (animal_id) => {
        Swal.fire({
            title: 'Procapri',
            html: 'Deseja remover esse registro?',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Sim',
            confirmButtonColor: '#0d4b85',
        }).then(result => {

            if (! result.value) {
                return false
            }
            $(`.animal_${animal_id}`).remove();
            $(`#row_${animal_id}`).remove();
        })            
    }

    $( function() {
        var data = {}
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
            data = e.params.data;
            $('#annome').val(data.annome);
        });
        $("#animal_id").on("select2:unselecting", function(e) {
            $('#annome').val('')
            data = {}
        });

        $("#pedatapes").datepicker();

        $('#add-weight').on('click', () => {
            const weight = $('#peso').val()
            const name = data.annome
            const animal_id = $('#animal_id').val()
            const anregistro = data.anregistro
            if ((typeof data !== 'undefined') && weight !== '') {
                if(document.getElementById(`row_${animal_id}`)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Animal já adicionado.',
                    })
                    return false;
                }
                $('#weights-table').append(`
                    <tr id="row_${animal_id}">
                        <td>${anregistro}</td>
                        <td>${name}</td>
                        <td>${weight} kg</td>
                        <td class="text-center">
                            <button type="button" onclick="deleteEntry(${animal_id})" class="btn btn-danger" title="Excluir"><i class="fa fa-trash-alt"></i></button>
                        </td>
                    </tr>
                `)
                $('#form-weights').append(`<input class="animal_${animal_id}" type="hidden" name="animal_id[]" value="${animal_id}">`)
                $('#form-weights').append(`<input class="animal_${animal_id}" type="hidden" name="pepeso[]" value="${weight}">`)

                $('#animal_id').val(null).trigger('change');
                $('#peso').val('')
                $('#annome').val('')
                data = {}
            }
        })

        form = document.getElementById('form-weights')
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const animals = document.getElementsByName('animal_id[]')
            if(animals.length < 1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Adicione ao menos um registro para realizar essa tarefa.',
                })
                return false;
            }
            form.submit()
        })
    });
</script>
@endpush
