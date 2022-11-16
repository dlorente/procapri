@extends('layouts.app')
@push('styles')

@endpush
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Cadastro de Animal</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Formulário de Cadastro</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
            @if (! isset($animal_registration))
                    <form method="POST" action="{{ route('animal-registrations.store') }}">
            @else
                <form method="POST" action="{{ route('animal-registrations.update', $animal_registration) }}">
                    @method('PUT')
            @endif

                @csrf
                <fieldset>
                    <legend>Informações do Animal</legend>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="anregistro" class="form-label">Registro<star>*</star></label>
                                <input type="text" class="form-control @error('anregistro') is-invalid @enderror" id="anregistro" name="anregistro" value="{{ old('anregistro', $animal_registration->anregistro ?? null) }}" placeholder="Registro">
                                @error('anregistro')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="annome" class="form-label">Nome<star>*</star></label>
                                <input type="text" class="form-control @error('annome') is-invalid @enderror" id="annome" name="annome" value="{{ old('annome', $animal_registration->annome ?? null) }}" placeholder="Nome do animal">
                                @error('annome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="ananimal" class="form-label">Placa<star>*</star></label>
                                <input type="text" class="form-control @error('ananimal') is-invalid @enderror" id="ananimal" name="ananimal" value="{{ old('ananimal', $animal_registration->ananimal ?? null) }}" placeholder="Placa">
                                @error('ananimal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="sexo_id" class="form-label">Sexo<star>*</star></label>
                                <select class="form-select @error('sexo_id') is-invalid @enderror" aria-label="Sexo" name="sexo_id" id="sexo_id">
                                    <option value="">-Selecione o sexo-</option>
                                    @foreach ($sexos as $sexo)
                                    <option 
                                        {{ set_selected($animal_registration->sexo_id ?? null, $sexo->id) }}
                                        value="{{ $sexo->id }}">{{ $sexo->sxnome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="andnasc" class="form-label">Nascimento<star>*</star></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input autocomplete="off" type="text" class="datepicker date form-control @error('andnasc') is-invalid @enderror" id="andnasc" name="andnasc" value="{{ old('andnasc', $animal_registration->andnasc ?? null) }}" placeholder="00/00/0000">
                                    @error('andnasc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="anentrada" class="form-label">Entrada<star>*</star></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input autocomplete="off" type="text" class="datepicker date form-control @error('anentrada') is-invalid @enderror" id="anentrada" name="anentrada" value="{{ old('anentrada', $animal_registration->anentrada ?? null) }}" placeholder="00/00/0000">
                                    @error('anentrada')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>                                              
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="finalidade_id" class="form-label">Finalidade<star>*</star></label>
                                <select class="form-select" aria-label="Sexo" name="finalidade_id" id="finalidade_id">
                                    <option value="">-Selecione a finalidade-</option>
                                    @foreach ($finalidades as $finalidade)
                                    <option 
                                        {{ set_selected($animal_registration->finalidade_id ?? null, $finalidade->id) }}
                                        value="{{ $finalidade->id }}">{{ $finalidade->fnlnome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="entrada_id" class="form-label">Motivo<star>*</star></label>
                                <select class="form-select" aria-label="Sexo" name="entrada_id" id="entrada_id">
                                    <option value="">-Selecione o motivo-</option>
                                    @foreach ($entradas as $entrada)
                                    <option 
                                        {{ set_selected($animal_registration->entrada_id ?? null, $entrada->id) }}
                                        value="{{ $entrada->id }}">{{ $entrada->ennome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sx-12">
                            <div class="mb-3">
                                <label for="andatasai" class="form-label">Saída</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input autocomplete="off" type="text" class="datepicker date form-control @error('andatasai') is-invalid @enderror" id="andatasai" name="andatasai" value="{{ old('andatasai', $animal_registration->andatasai ?? null) }}" placeholder="00/00/0000">
                                    @error('andatasai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sx-12">
                            <div class="mb-3">
                                <label for="motsaida_id" class="form-label">Motivo da saída</label>
                                <select class="form-select" aria-label="Sexo" name="motsaida_id" id="motsaida_id">
                                    <option value="">-Selecione-</option>
                                    @foreach ($motivos_saida as $motivo)
                                    <option 
                                        {{ set_selected($animal_registration->motsaida_id ?? null, $motivo->id) }}
                                        value="{{ $motivo->id }}">{{ $motivo->msnome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sx-12">
                            <div class="mb-3">
                                <label for="causasaida_id" class="form-label">Causa da saída</label>
                                <select class="form-select" aria-label="Sexo" name="causasaida_id" id="causasaida_id">
                                    <option value="">-Selecione-</option>
                                    @foreach ($causas_saida as $causa)
                                    <option 
                                        {{ set_selected($animal_registration->causasaida_id ?? null, $causa->id) }}
                                        value="{{ $causa->id }}">{{ $causa->csnome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Informações de Parentesco</legend>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="anregpai" class="form-label">Registro do Pai</label>
                                <input type="text" class="form-control" id="anregpai" name="aregpai" value="{{ old('anregpai', $animal_registration->anregpai ?? null) }}" placeholder="Registro do pai">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="anomepai" class="form-label">Nome do Pai</label>
                                <input type="text" class="form-control" id="anomepai" name="anomepai" value="{{ old('anomepai', $animal_registration->anomepai ?? null) }}" placeholder="Nome do pai animal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="aregmae" class="form-label">Registro da Mãe</label>
                                <input type="text" class="form-control" id="aregmae" name="aregpai" value="{{ old('aregmae', $animal_registration->aregmae ?? null) }}" placeholder="Registro da mae do animal">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label for="anomemae" class="form-label">Nome da Mãe</label>
                                <input type="text" class="form-control" id="anomemae" name="anomemae" value="{{ old('anomemae', $animal_registration->anomemae ?? null) }}" placeholder="Nome da mãe animal">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>
                    Informações para Associação
                    </legend>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="anpontua" class="form-label">Pontuação</label>
                                <input type="text" class="form-control" id="anpontua" name="anpontua" value="{{ old('anpontua', $animal_registration->anpontua ?? null) }}" placeholder="Nome da mãe animal">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="indicaregistro_id" class="form-label">Indicação</label>
                                <select class="form-select" aria-label="Sexo" name="indicaregistro_id" id="indicaregistro_id">
                                    <option value="">-Selecione a indicação-</option>
                                    @foreach ($iRegistros as $iRegistro)
                                    <option 
                                        {{ set_selected($animal_registration->indicaregistro_id ?? null, $iRegistro->id) }}
                                        value="{{ $iRegistro->id }}">{{ $iRegistro->irgnome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="raca_id" class="form-label">Raça</label>
                                <select class="form-select" aria-label="Sexo" name="raca_id" id="raca_id">
                                    <option value="">-Selecione a raça-</option>
                                    @foreach ($racas as $raca)
                                    <option 
                                        {{ set_selected($animal_registration->raca_id ?? null, $raca->id) }}
                                        value="{{ $raca->id }}">{{ $raca->ranome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="sangue_id" class="form-label">Composição sanguínea</label>
                                <select class="form-select" aria-label="Sexo" name="sangue_id" id="sangue_id">
                                    <option value="">-Selecione a composição sanguínea-</option>
                                    @foreach ($tiposSangue as $tipo)
                                    <option 
                                        {{ set_selected($animal_registration->sangue_id ?? null, $tipo->id) }}
                                        value="{{ $tipo->id }}">{{ $tipo->sanome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="pelagem_id" class="form-label">Pelagem</label>
                                <select class="form-select" aria-label="Sexo" name="pelagem_id" id="pelagem_id">
                                    <option value="">-Selecione a composição sanguínea-</option>
                                    @foreach ($pelagens as $pelagem)
                                    <option 
                                        {{ set_selected($animal_registration->pelagem_id ?? null, $pelagem->id) }}
                                        value="{{ $pelagem->id }}">{{ $pelagem->penome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="corno_id" class="form-label">Cornos</label>
                                <select class="form-select" aria-label="Sexo" name="corno_id" id="corno_id">
                                    <option value="">-Selecione a composição sanguínea-</option>
                                    @foreach ($cornos as $corno)
                                    <option 
                                        {{ set_selected($animal_registration->corno_id ?? null, $corno->id) }}
                                        value="{{ $corno->id }}">{{ $corno->crnome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="barba_id" class="form-label">Barba</label>
                                <select class="form-select" aria-label="Sexo" name="barba_id" id="barba_id">
                                    <option value="">-Selecione-</option>
                                    @foreach ($barbas as $barba)
                                    <option 
                                        {{ set_selected($animal_registration->barba_id ?? null, $barba->id) }}
                                        value="{{ $barba->id }}">{{ $barba->banome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="brinco_id" class="form-label">Brinco</label>
                                <select class="form-select" aria-label="Brinco" name="brinco_id" id="brinco_id">
                                    <option value="">-Selecione-</option>
                                    @foreach ($brincos as $brinco)
                                    <option 
                                        {{ set_selected($animal_registration->brinco_id ?? null, $brinco->id) }}
                                        value="{{ $brinco->id }}">{{ $brinco->brnome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>
                    Informações para Adicionais
                    </legend>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="andesmama" class="form-label">Desmama</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input type="text" class="datepicker form-control" id="andesmama" name="andesmama" value="{{ old('andesmama', $animal_registration->andesmama ?? null) }}" placeholder="00/00/0000">
                                </div>                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="andcoberta" class="form-label">Primeira cobertura</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                    <input type="text" class="datepicker form-control" id="andcoberta" name="andcoberta" value="{{ old('andcoberta', $animal_registration->andcoberta ?? null) }}" placeholder="00/00/0000">
                                </div>                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="anorigem" class="form-label">Origem</label>
                                <input type="text" class="form-control" id="anorigem" name="anorigem" value="{{ old('anorigem', $animal_registration->anorigem ?? null) }}" placeholder="Origem">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Adicionar em um Lote ou Instalação</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="lote_id" class="form-label">Lote</label>
                                <select class="form-select" aria-label="Lote" name="lote_id" id="lote_id">
                                    <option value="">-Selecione o lote-</option>
                                    @foreach ($lotes as $lote)
                                    <option 
                                        {{ set_selected($animal_registration->lote_id ?? null, $lote->id) }}
                                        value="{{ $lote->id }}">{{ $lote->l1nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="local_id" class="form-label">Local</label>
                                <select class="form-select" aria-label="Lote" name="local_id" id="local_id">
                                    <option value="">-Selecione o local-</option>
                                    @foreach ($locais as $local)
                                    <option 
                                        {{ set_selected($animal_registration->local_id ?? null, $local->id) }}
                                        value="{{ $local->id }}">{{ $local->l2nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-primary">Atualizar</button>
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
