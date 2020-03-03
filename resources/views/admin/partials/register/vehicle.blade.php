<div class="form-card">
    <h2 class="fs-title mt-2">Información Del Vehículo</h2>
    <div class="row mt-2 mb-5">
        <div class="col-md-6 form_select_conductores">
            <label for="capacity">Número de vehículos de este conductor:</label>
            <select class="form-control form-vehicles"
                id="number_of_vehicles_form" style="width: 100%">
                <option value="">Seleccionar...</option>
                @for ($i = 0; $i <= 10; $i++)
                <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="row mt-2" id="forms_vehicles">
    </div>
</div>
<input type="button" name="previous" class="previous action-button-previous form-dataconductores"
value="Previous" />
<input type="button" name="next" class="next action-button form-dataconductores" value="Siguiente"
    id="fieldset_infouser" data-validate="{{ route('vehicle.validate-register') }}" data-error="info_user" />
