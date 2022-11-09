@extends('layouts.app')
@push('styles')

@endpush
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Registro de desmame</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('animal-weaning.index') }}">Registro de desmame</a></li>
        <li class="breadcrumb-item active">Desmame individual</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('individual-weaning', $animal_weaning) }}">
                @csrf
                <fieldset class="mb-3">
                    <legend>Informações do Animal</legend>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="anregistro" class="form-label">Registro</label>
                                <input type="text" disabled class="form-control @error('anregistro') is-invalid @enderror" id="anregistro" name="anregistro" value="{{ old('anregistro', $animal_weaning->anregistro ?? null) }}" placeholder="Registro">
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
                                <input type="text" disabled class="form-control @error('annome') is-invalid @enderror" id="annome" name="annome" value="{{ old('annome', $animal_weaning->annome ?? null) }}" placeholder="Nome do animal">
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
                                <input type="text" disabled class="form-control @error('ananimal') is-invalid @enderror" id="ananimal" name="ananimal" value="{{ old('ananimal', $animal_weaning->ananimal ?? null) }}" placeholder="Placa">
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
                                    <input type="text" disabled class="datepicker form-control @error('andnasc') is-invalid @enderror" id="andnasc" name="andnasc" value="{{ old('andnasc', $animal_weaning->andnasc ?? null) }}" placeholder="00/00/0000">
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
                                    <input type="text" disabled class="datepicker form-control @error('anentrada') is-invalid @enderror" id="anentrada" name="anentrada" value="{{ old('anentrada', $animal_weaning->anentrada ?? null) }}" placeholder="00/00/0000">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="anentrada" class="form-label">Sexo</label>
                                <input type="text" disabled class="form-control" value="{{ $animal_weaning->sexo->sxnome }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="mb-3">
                                <label class="form-label" for="andesmama">Data de desmame<star>*</star></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input autocomplete="off" type="text" class="datepicker date form-control @error('andesmama') is-invalid @enderror" id="andesmama" name="andesmama" value="{{ old('andesmama', $animal_weaning->andesmama ?? null) }}">
                                    @error('andesmama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
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
