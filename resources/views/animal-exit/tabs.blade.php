@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Saída de animais</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('animals.index') }}">Animais</a></li>
        <li class="breadcrumb-item active">Saída de animais</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="individual-exit-tab" data-bs-toggle="tab" data-bs-target="#individual-exit" type="button" role="tab" aria-controls="individual-exit" aria-selected="true">Saída individual</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="lote-exit-tab" data-bs-toggle="tab" data-bs-target="#lote-exit" type="button" role="tab" aria-controls="lote-exit" aria-selected="false">Saída em lote</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="local-exit-tab" data-bs-toggle="tab" data-bs-target="#local-exit" type="button" role="tab" aria-controls="local-exit" aria-selected="false">Saída de Local</button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="individual-exit" role="tabpanel" aria-labelledby="individual-tab">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3">
                                <select id="animal" class="form-select">
                                    <option value=""></option>
                                </select>
                              </div>
                        </div>
                    </div>
                    <div id="individual-form">
                        @error('andatasai')
                            @include('animal-exit.tabs.individual-exit-form')
                        @enderror
                    </div>
                </div>
                <div class="tab-pane fade" id="lote-exit" role="tabpanel" aria-labelledby="lote-exit-tab">Saída em lote</div>
                <div class="tab-pane fade" id="local-exit" role="tabpanel" aria-labelledby="local-exit-tab">Saída de local</div>
              </div>              
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#animal').select2( {
            placeholder: 'Número do registro ou placa',
            theme: 'bootstrap-5',
            minimumInputLength: 3,
            allowClear: true,
            ajax: {
                dataType: 'json',
                delay: 250,                
                type: 'GET',
                url: '{{ route("animals.search") }}',
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
            }
        });

        $('#animal').on('select2:select', function (e) {
            var data = e.params.data;
            $.get(`animal-individual-exit-form/${data.animal_id}`)
                .done(data => {
                    $('#individual-form').html(data)
                });
        });
    </script>
@endpush