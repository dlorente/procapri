@extends('layouts.app')
@push('styles')

@endpush
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Movimento entre instalações</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('animal-change-location') }}">Movimento entre instalações</a></li>
        <li class="breadcrumb-item active">Monivementação individual</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('animals.change-location', $animal) }}">
                @csrf
                <fieldset class="mb-3">
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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="" class="form-label">Lote (Saída)</label>
                                <input type="text" disabled class="form-control" value="{{ $animal->lote->l1nome }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="" class="form-label">Local (Saída)</label>
                                <input type="text" disabled class="form-control" value="{{ $animal->local->l2nome }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="lote_id" class="form-label">Lote (Entrada)</label>
                            <select name="lote_id" id="lote_id" class="form-select @error('lote_id') is-invalid @enderror">
                                <option></option>
                                @foreach($lotes as $lote)
                                <option 
                                    {{ set_selected($animal->lote_id ?? null, $lote->id) }}   
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
                                <option></option>
                                @foreach($locals as $local)
                                <option 
                                {{ set_selected($animal->local_id ?? null, $local->id) }}
                                    value="{{ $local->id }}">{{ $local->l2nome }}</option>
                                @endforeach
                            </select>
                            @error('lote_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
<script>
    $( function() {
        $( ".datepicker" ).datepicker();
    });
</script>
@endpush
