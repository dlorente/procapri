@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Movimento entre instalações</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('animal-exit') }}">Movimento entre instalações</a></li>
    <li class="breadcrumb-item active">Individual</li>
  </ol>
  <div class="card mb-4">
    <div class="card-body">
      <form id="form-individual" method="POST" action="{{ route('animal-change-location-individual') }}">
        @csrf
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="mb-3">
              <label class="form-label" for="animal_id" class="form-label">Número do registro ou placa <star>*</star></label>
              <select class="form-select select2 @error('animal_id') is-invalid @enderror" aria-label="Lote" name="animal_id" id="animal_id" required>
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
          <div class="col-md-3">
            <div class="mb-3">
              <label for="ananimal" disabled class="form-label">Placa</label>
              <input type="text" disabled class="form-control @error('ananimal') is-invalid @enderror" id="ananimal" name="ananimal" value="{{ old('ananimal', $animal->ananimal ?? null) }}" placeholder="Placa">
              @error('ananimal')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="col-md-3">
            <div class="mb-3">
              <label for="andnasc" class="form-label">Nascimento</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                <input type="text" disabled class="datepicker form-control @error('andnasc') is-invalid @enderror" id="andnasc" name="andnasc" value="{{ old('andnasc') }}" placeholder="00/00/0000">
                @error('andnasc')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="mb-3">
              <label for="anentrada" class="form-label">Entrada</label>
              <div class="input-group">
                <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                <input type="text" disabled class="datepicker form-control @error('anentrada') is-invalid @enderror" id="anentrada" name="anentrada" value="{{ old('anentrada') }}" placeholder="00/00/0000">
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="mb-3">
              <label for="anentrada" class="form-label">Sexo</label>
              <input type="text" disabled class="form-control" id="sxnome" value="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="mb-3">
              <label for="" class="form-label">Lote (Saída)</label>
              <input type="text" disabled class="form-control" id="l1nome" value="">
            </div>
          </div>
          <div class="col-md-4">
            <div class="mb-3">
              <label for="" class="form-label">Local (Saída)</label>
              <input type="text" disabled class="form-control" id="l2nome" value="">
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="lote_id" class="form-label">Lote (Entrada)</label>
            <select name="lote_id" id="lote_id" class="form-select @error('lote_id') is-invalid @enderror">
              <option value="">-Selecione o lote-</option>
              @foreach($lotes as $lote)
              <option 
              {{ set_selected(old('lote_id'), $lote->id) }}   
              value="{{ $lote->id }}">{{ $lote->l1nome }}</option>
              @endforeach
            </select>
            @error('lote_id')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="col-md-4">
            <label for="local_id" class="form-label">Local (Entrada)</label>
            <select name="local_id" id="local_id" class="form-select @error('local_id') is-invalid @enderror">
              <option value="">-Selecione o local-</option>
              @foreach($locals as $local)
              <option 
              {{ set_selected(old('local_id'), $local->id) }}
              value="{{ $local->id }}">{{ $local->l2nome }}</option>
              @endforeach
            </select>
            @error('local_id')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>
        <button type="button" class="btn btn-primary" onclick="validate()">Realizar movimentação</button>
      </form>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $("#andatasai").datepicker();
    $('#padultcob').datepicker();
    
    
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
          }
          return query;
        },
      }
    });        
    
    $('#animal_id').on('select2:select', function (e) {
      var data = e.params.data;
      $('#annome').val(data.annome);
      $('#ananimal').val(data.ananimal)
      $('#andnasc').val(data.andnasc)
      $('#anentrada').val(data.anentrada)
      $('#sxnome').val(data.sxnome)
      $('#l1nome').val(data.l1nome)
      $('#l2nome').val(data.l2nome)
      $('#lote_id').val(data.lote_id).change();
      $('#local_id').val(data.local_id).change();

    });
    $("#animal_id").on("select2:unselecting", function(e) {
      $('#annome').val('');
      $('#ananimal').val('')
      $('#andnasc').val('')
      $('#anentrada').val('')
      $('#sxnome').val('')
      $('#l1nome').val('')
      $('#l2nome').val('')
      $('#lote_id').val('').change();
      $('#local_id').val('').change();
    });
  });
  
  function validate() {
    let lote_id = $('#lote_id').val();
    let local_id = $('#local_id').val();

    if(lote_id === '' || local_id === '') {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: 'Verifique se o lote e o local foram informados'
      })
      return false;
    }
    $('#form-individual').submit();
  }
</script>
@endpush