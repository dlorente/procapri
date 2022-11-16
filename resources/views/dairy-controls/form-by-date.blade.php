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
        <li class="breadcrumb-item active">Formulário de Entrada de Produção do Animal por Data</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <form id="form-dairies" method="POST" action="{{ route('dairy-controls.store-by-date') }}">

                @csrf
                <fieldset>
                    <legend>Informações das produções</legend>
                    <div class="row">
                        <div class="col-sm-4 bol-sx-12">
                            <div class="mb-3">
                                <label class="form-label" for="prdatacon">Data da produção<star>*</star></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input required autocomplete="off" type="text" class="datepicker date form-control @error('prdatacon') is-invalid @enderror" id="prdatacon" name="prdatacon" value="{{ old('prdatacon', $weight_control->prdatacon ?? null) }}">
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
                        <div class="col-sm-3">
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
                        <div class="col-sm-2 col-sx-12">
                            <div class="mb-3">
                                <label for="annome" class="form-label">Nome</label>
                                <input type="text" disabled name="annome" id="annome" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-2 col-sx-12">
                            <div class="mb-3">
                                <label for="ordenha1" class="form-label">Ordenha 1</label>
                                <input type="text" class="form-control" placeholder="0,00" name="ordenha1" id="ordenha1">
                            </div>
                        </div>
                        <div class="col-sm-2 col-sx-12">
                            <div class="mb-3">
                                <label for="ordenha2" class="form-label">Ordenha 2</label>
                                <input type="text" class="form-control" placeholder="0,00" name="ordenha2" id="ordenha2">
                            </div>
                        </div>
                        <div class="col-sm-2 col-sx-12">
                            <div class="mb-3">
                                <label for="ordenha3" class="form-label">Ordenha 3</label>
                                <input type="text" class="form-control" placeholder="0,00" name="ordenha3" id="ordenha3">
                            </div>
                        </div>
                        <div class="col-sm-1 col-sx-12 col-sm-1 col-sx-12  d-flex align-items-end pb-0">
                            <div class="mb-3">
                                <button class="btn btn-primary" type="button" id="add-dairy" title="Adicionar">
                                    <i class="fa fa-plus-circle"></i>
                                </button>
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
                                        <th>Ordenha 1</th>
                                        <th>Ordenha 2</th>
                                        <th>Ordenha 3</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="dairies-table"></tbody>
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
                    q: params.term,
                    sexo_id: 1, //femea
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

        $("#prdatacon").datepicker();

        $('#add-dairy').on('click', () => {
            const ordenha1 = $('#ordenha1').val()
            const ordenha2 = $('#ordenha2').val()
            const ordenha3 = $('#ordenha3').val()
            const name = data.annome
            const animal_id = $('#animal_id').val()
            const anregistro = data.anregistro
            if ((typeof data !== 'undefined') && ordenha1 !== '') {
                if(document.getElementById(`row_${animal_id}`)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Animal já adicionado.',
                    })
                    return false;
                }
                $('#dairies-table').append(`
                    <tr id="row_${animal_id}">
                        <td>${anregistro}</td>
                        <td>${name}</td>
                        <td>${ordenha1}</td>
                        <td>${ordenha2}</td>
                        <td>${ordenha3}</td>
                        <td class="text-center">
                            <button type="button" onclick="deleteEntry(${animal_id})" class="btn btn-danger" title="Excluir"><i class="fa fa-trash-alt"></i></button>
                        </td>
                    </tr>
                `)
                $('#form-dairies').append(`<input class="animal_${animal_id}" type="hidden" name="animal_id[]" value="${animal_id}">`)
                $('#form-dairies').append(`<input class="animal_${animal_id}" type="hidden" name="prplord1[]" value="${ordenha1}">`)
                $('#form-dairies').append(`<input class="animal_${animal_id}" type="hidden" name="prplord2[]" value="${ordenha2}">`)
                $('#form-dairies').append(`<input class="animal_${animal_id}" type="hidden" name="prplord3[]" value="${ordenha3}">`)


                $('#animal_id').val(null).trigger('change');
                $('#ordenha1').val('')
                $('#ordenha2').val('')
                $('#ordenha3').val('')
                $('#annome').val('')
                data = {}
            }
        })

        form = document.getElementById('form-dairies')
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
