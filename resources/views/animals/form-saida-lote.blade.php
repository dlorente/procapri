@extends('layouts.app')
@push('styles')

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
            <form method="POST" action="{{ route('animals.exit', $animal) }}">
                @csrf
                <fieldset>
                    <legend>Informações do Animal</legend>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="anregistro" class="form-label">Registro</label>
                                <input type="text" disabled class="form-control @error('anregistro') is-invalid @enderror" id="anregistro" name="anregistro" value="{{ old('anregistro', $animal->anregistro ?? null) }}" placeholder="Registro">
                                @error('anregistro')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="annome" class="form-label">Nome</label>
                                <input type="text" disabled class="form-control @error('annome') is-invalid @enderror" id="annome" name="annome" value="{{ old('annome', $animal->annome ?? null) }}" placeholder="Nome do animal">
                                @error('annome')
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
                                    <input type="text" disabled class="datepicker form-control @error('andnasc') is-invalid @enderror" id="andnasc" name="andnasc" value="{{ old('andnasc', $animal->andnasc ?? null) }}" placeholder="00/00/0000">
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
                                    <input type="text" disabled class="datepicker form-control @error('anentrada') is-invalid @enderror" id="anentrada" name="anentrada" value="{{ old('anentrada', $animal->anentrada ?? null) }}" placeholder="00/00/0000">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="anentrada" class="form-label">Sexo</label>
                                <input type="text" disabled class="form-control" value="{{ $animal->sexo->sxnome }}">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Dados da saída</legend>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="andatasai" class="form-label">Data da saída<star>*</star></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input type="text" class="datepicker form-control @error('andatasai') is-invalid @enderror" id="andatasai" name="andatasai" value="{{ old('andatasai', $animal->andatasai ?? null) }}" placeholder="00/00/0000">
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
                                <label for="causasaida_id" class="form-label">Causa da saída<star>*</star></label>
                                <select class="form-select @error('causasaida_id') is-invalid @enderror" aria-label="motivo" name="causasaida_id" id="causasaida_id">
                                    <option value="">-Selecione-</option>
                                    @foreach ($causas as $causa)
                                    <option 
                                        {{ set_selected($animal->causasaida_id ?? null, $causa->id) }}
                                        value="{{ $causa->id }}">{{ $causa->csnome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-primary">Realizar saída</button>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $( function() {
        $( ".datepicker" ).datepicker();
    });
</script>
@endpush
