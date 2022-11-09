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
                  <button class="nav-link active" id="individual-weaning-tab" data-bs-toggle="tab" data-bs-target="#individual-weaning" type="button" role="tab" aria-controls="individual-weaning" aria-selected="true">Desmame individual</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="lote-weaning-tab" data-bs-toggle="tab" data-bs-target="#lote-weaning" type="button" role="tab" aria-controls="lote-weaning" aria-selected="false">Desmame de lote</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="local-weaning-tab" data-bs-toggle="tab" data-bs-target="#local-weaning" type="button" role="tab" aria-controls="local-weaning" aria-selected="false">Desmame de Local</button>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="individual-weaning" role="tabpanel" aria-labelledby="individual-tab">
                    @include('animal-weaning.tabs.animal-list')                    
                </div>
                <div class="tab-pane fade" id="lote-weaning" role="tabpanel" aria-labelledby="lote-weaning-tab">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="form-label">Informe o lote de animais que serão desmamados</label>
                            <select name="lote" id="lote" class="form-select">
                                <option></option>
                                @foreach($lotes as $lote)
                                <option value="{{ $lote->id }}">{{ $lote->l1nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="lote-content"></div>
                </div>
                <div class="tab-pane fade" id="local-weaning" role="tabpanel" aria-labelledby="local-weaning-tab">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="form-label">Informe o local de animais que serão desmamados</label>
                            <select name="local" id="local" class="form-select">
                                <option></option>
                                @foreach($locals as $local)
                                <option value="{{ $local->id }}">{{ $local->l2nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="local-content"></div>
                </div>
              </div>              
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#lote').select2( {
            placeholder: 'Selecione o lote',
            theme: 'bootstrap-5',            
        });

        $('#local').select2( {
            placeholder: 'Selecione o lote',
            theme: 'bootstrap-5',            
        });

        $('#lote').on('select2:select', function (e) {
            $.get(`animal-weaning/lote-list-form/${$('#lote').val()}`)
                .done(data => {
                    $('#lote-content').html(data)
                });
        });

        $('#local').on('select2:select', function (e) {
            $.get(`animal-weaning/local-list-form/${$('#local').val()}`)
                .done(data => {
                    $('#local-content').html(data)
                });
        });
    </script>
@endpush