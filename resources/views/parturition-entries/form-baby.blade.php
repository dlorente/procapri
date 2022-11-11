
<div class="row">
    <div class="col-sm-3 col-sx-12">
        <div class="mb-3">
            <label for="b_anregistro" class="form-label">Registro<star>*</star></label>
            <input type="text" name="b_anregistro[]" class="b_anregistro form-control" value="{{ $registro }}" required>
        </div>
    </div>
    <div class="col-sm-9 col-sx-12">
        <div class="mb-3">
            <label for="b_annome" class="form-label">Nome<star>*</star></label>
            <input type="text" name="b_annome[]" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3 col-sx-12">
        <div class="mb-3">
            <label for="b_ananimal" class="form-label">Placa<star>*</star></label>
            <input type="text" name="b_ananimal[]" class="form-control" required>
        </div>
    </div>
    <div class="col-sm-3 col-sx-12">
        <div class="mb-3">
            <label for="b_sxcodigo" class="form-label">Sexo<star>*</star></label>
            <select name="b_sxcodigo[]" id="b_sxcodigo" class="form-select" required>
                <option value="">-Selecione-</option>
                @foreach($sexos as $sexo)
                <option value="{{ $sexo->sxcodigo }}">{{ $sexo->sxnome }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3 col-sx-12">
        <div class="mb-3">
            <label for="b_pepeso" class="form-label">Peso nascimento<star>*</star></label>
            <input type="text" name="b_pepeso[]" class="form-control" maxlength="10" required>
        </div>
    </div>
    <div class="col-sm-3 col-sx-12">
        <div class="mb-3">
            <label for="b_finalidade_id" class="form-label">Finalidade<star>*</star></label>
            <select name="b_finalidade_id[]" id="b_finalidade_id" class="form-select" required>
                <option value="">-Selecione-</option>
                @foreach($finalidades as $finalidade)
                <option value="{{ $finalidade->id }}">{{ $finalidade->fnlnome }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
