@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Registro de desmame</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Registro de desmame</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="individual-change-location-tab" data-bs-toggle="tab" data-bs-target="#individual-change-location" type="button" role="tab" aria-controls="individual-change-location" aria-selected="true">Saída individual</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="lote-change-location-tab" data-bs-toggle="tab" data-bs-target="#lote-change-location" type="button" role="tab" aria-controls="lote-change-location" aria-selected="false">Saída em lote</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="local-change-location-tab" data-bs-toggle="tab" data-bs-target="#local-change-location" type="button" role="tab" aria-controls="local-change-location" aria-selected="false">Saída de Local</button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="individual-change-location" role="tabpanel" aria-labelledby="individual-tab">
                    @include('animal-change-location.tabs.animal-list')                    
                </div>
                <div class="tab-pane fade" id="lote-change-location" role="tabpanel" aria-labelledby="lote-change-location-tab">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="form-label">Lote onde os animais se encontram</label>
                            <select name="lote_id" id="lote_id" class="form-select">
                                <option></option>
                                @foreach($lotes as $lote)
                                <option value="{{ $lote->id }}">{{ $lote->l1nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="lote"></div>
                </div>
                <div class="tab-pane fade" id="local-change-location" role="tabpanel" aria-labelledby="local-change-location-tab">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="form-label">Local onde os animais se encontram</label>
                            <select name="local_id" id="local_id" class="form-select">
                                <option></option>
                                @foreach($locals as $local)
                                <option value="{{ $local->id }}">{{ $local->l2nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="local"></div>
                </div>
              </div>              
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#lote_id').select2( {
            placeholder: 'Selecione o lote',
            theme: 'bootstrap-5',            
        });

        $('#local_id').select2( {
            placeholder: 'Selecione o lote',
            theme: 'bootstrap-5',            
        });

        $('#lote_id').on('select2:select', function (e) {
            $.get(`animal-change-location/lote-list-form/${$('#lote_id').val()}`)
                .done(data => {
                    $('#lote').html(data)
                });
        });

        $('#local_id').on('select2:select', function (e) {
            $.get(`animal-change-location/local-list-form/${$('#local_id').val()}`)
                .done(data => {
                    $('#local').html(data)
                });
        });
    </script>
@endpush