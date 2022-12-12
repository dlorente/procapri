@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Movimento entre instalações</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('animal-change-location') }}">Movimento entre instalações</a></li>
        <li class="breadcrumb-item active">Local</li>
      </ol>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 col-sm-12">
                    <label for="" class="form-label">Local onde os animais se encontram</label>
                    <select name="local_select" id="local_select" class="form-select">
                        <option value="">-Selecione o local-</option>
                        @foreach($locals as $local)
                        <option value="{{ $local->id }}">{{ $local->l2nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>                
            <div class="row">
                <div class="col-12">
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
        $('#local_select').select2( {
            placeholder: 'Selecione o local',
            theme: 'bootstrap-5',            
        });

        $('#local_select').on('select2:select', function (e) {
            $.get(`local-list-form/${$('#local_select').val()}`)
                .done(data => {
                    $('#local').html(data)
                });
        });
    </script>
@endpush