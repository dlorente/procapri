@extends('layouts.app')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Encerramento de Lactação Individual do Rebanho</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Formulário de Encerramento de Lactação</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            <form id="form-weights" method="POST" action="{{ route('dryoff-controls.update', $dryoff_control) }}">

                @csrf
                <fieldset>
                    <legend>Informações</legend>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="animal_id" class="form-label">Registro</label>
                                <input readonly type="text" name="anregistro" class="form-control" value="{{ $dryoff_control->animal->anregistro }}">
                                <input type="hidden" name="animal_id" value="{{ $dryoff_control->animal->id }}">
                            </div>
                        </div>
                        <div class="col-sm-5 col-sx-12">
                            <div class="mb-3">
                                <label for="annome" class="form-label">Nome</label>
                                <input type="text" disabled name="annome" id="annome" class="form-control" value="{{ $dryoff_control->animal->annome }}">
                            </div>
                        </div>
                        <div class="col-sm-3 col-sx-12">
                            <div class="mb-3">
                                <label class="form-label" for="padenclac">Data do parto</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input readonly type="text" name="padatapar" class="form-control" value="{{ $dryoff_control->padatapar }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 bol-sx-12">
                            <div class="mb-3">
                                <label class="form-label" for="padenclac">Encerramento da lactação<star>*</star></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input required autocomplete="off" type="text" class="datepicker date form-control @error('padenclac') is-invalid @enderror" id="padenclac" name="padenclac" value="{{ old('padenclac', $dryoff_control->padenclac ?? null) }}">
                                    @error('padenclac')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 bol-sx-12">
                            <div class="mb-3">
                                <label for="encerra_id" class="form-label">Motivo<star>*</star></label>
                                <select class="form-select @error('encerra_id') is-invalid @enderror" aria-label="motivo" name="encerra_id" id="encerra_id">
                                    <option value="">-Selecione-</option>
                                    @foreach ($motivos as $motivo)
                                    <option 
                                        {{ set_selected($dryoff_control->encerra_id ?? null, $motivo->id) }}
                                        value="{{ $motivo->id }}">{{ $motivo->ecnome }}</option>
                                    @endforeach
                                </select>
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
    $("#padenclac").datepicker();
</script>
@endpush