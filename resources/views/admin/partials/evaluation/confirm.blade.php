<div class="form-card">
    <h2 class="fs-title text-center">Confirmación de Registro</h2> <br><br>
    <div class="row justify-content-center">
        <div class="col-7 text-center">
            <p>¿Desea confirmar el registro o cancerlarlo?</p>
            <a href="{{ route('admin','register_driver') }}" class="btn btn-info">Cancelar</a>
        </div>
    </div>
</div>
<input type="button" name="previous" class="previous action-button-previous form-dataconductores" value="Anterior" />
<input type="button" name="next" class="next action-button form-dataconductores" style="width: 180px;" value="Confirmar Registro"
           data-validate="{{ route('register-evaluation.store') }}" data-error="info_user"/>

