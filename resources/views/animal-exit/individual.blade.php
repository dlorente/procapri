@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush
@section('content')
<div class="container-fluid px-4">
  <h1 class="mt-4">Saída de animais</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('animal-exit') }}">Saída de animais</a></li>
    <li class="breadcrumb-item active">Individual</li>
  </ol>
  <div class="card mb-4">
    <div class="card-body">
      <form id="form-individual" method="POST" action="{{ route('animal-exit-individual') }}">
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
        <fieldset>
          <legend>Dados da saída</legend>
          <div class="row">
            <div class="col-md-4">
              <div class="mb-3">
                <label for="andatasai" class="form-label">Data da saída<star>*</star></label>
                <div class="input-group">
                  <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                  <input type="text" autocomplete="off" class="datepicker form-control @error('andatasai') is-invalid @enderror" id="andatasai" name="andatasai" value="{{ old('andatasai', $animal->andatasai ?? null) }}" placeholder="00/00/0000">
                  @error('andatasai')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="motsaida_id" class="form-label">Motivo da saída<star>*</star></label>
                <select class="form-select @error('motsaida_id') is-invalid @enderror" aria-label="motivo" name="motsaida_id" id="motsaida_id">
                  <option value="">-Selecione-</option>
                  @foreach ($motivos as $motivo)
                  <option 
                  {{ set_selected($animal->motsaida_id ?? null, $motivo->id) }}
                  value="{{ $motivo->id }}">{{ $motivo->msnome }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="mb-3">
                <label for="causaida_id" class="form-label">Causa da saída<star>*</star></label>
                <select class="form-select @error('causaida_id') is-invalid @enderror" aria-label="motivo" name="causaida_id" id="causaida_id">
                  <option value="">-Selecione-</option>
                  @foreach ($causas as $causa)
                  <option 
                  {{ set_selected($animal->causaida_id ?? null, $causa->id) }}
                  value="{{ $causa->id }}">{{ $causa->csnome }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </fieldset>
        <button type="button" class="btn btn-primary" onclick="validate()">Realizar saída</button>
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
    });
    $("#animal_id").on("select2:unselecting", function(e) {
      $('#annome').val('');
      $('#ananimal').val('')
      $('#andnasc').val('')
      $('#anentrada').val('')
      $('#sxnome').val('')
    });
  });

  function validate() {
    let anentrada = $('#anentrada').val();
    let andatasai = $('#andatasai').val();
    anentrada = anentrada.split('/')
    anentrada = `${anentrada[2]}-${anentrada[1]}-${anentrada[0]}`
    andatasai = andatasai.split('/')
    andatasai = `${andatasai[2]}-${andatasai[1]}-${andatasai[0]}`
    andatasai = new Date(andatasai)
    anentrada = new Date(anentrada)
    if(anentrada > andatasai) {
      Swal.fire({
          icon: 'error',
          title: 'Oops...',
          html: 'Data de saída deve ser posterior a data de entrada.'
      })
      return false;
    }
    $('#form-individual').submit();
  }
</script>
@endpush