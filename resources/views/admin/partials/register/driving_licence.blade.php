<div class="form-card">
    <h2 class="fs-title" style="margin-bottom: 20px">Información de Licencia - Datos Personales</h2>
    <div class="row">
        <div class="col-md-6">
            <input type="text" name="drivingLicence[licence_num]" class="form-control form-dataconductores" autocomplete="false"
                placeholder="Número de licencia" id="licence_num" onkeyup="this.value = this.value.toUpperCase();"/>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6 form_select_conductores">
            <label for="country_expedition" id="label-country_expedition">País de expedición</label>
            <select name="drivingLicence[country_expedition]" class="form-control" id="country_expedition"
                style="width: 100%;" required>
                <option value="">Seleccionar</option>
                @foreach ($list_country_expedition as $country_expedition_item)
                <option value="{{ $country_expedition_item }}">{{ $country_expedition_item }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 form_select_conductores">
            <label for="category" id="label-category">Categoría Licencia</label>
            <select name="drivingLicence[category]" class="form-control" id="category"
                style="width: 100%;" required>
                <option value="">Seleccionar</option>
                @foreach ($list_category as $category_item)
                <option value="{{ $category_item }}">{{ $category_item }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6 form_select_conductores">
            <label for="state" id="label-state">Estado Licencia</label>
            <select name="drivingLicence[state]" class="form-control" id="state" style="width: 100%;"
                required>
                <option value="">Seleccionar</option>
                @foreach ($list_state as $state_item)
                <option value="{{ $state_item }}">{{ $state_item }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6 form_select_conductores">
            <label for="Expedition_day_form" id="label-expedition_day">Fecha de expedición</label>
            <input type="text" class="form-control form-dataconductores" name="drivingLicence[expedition_day]" id="expedition_day"
                readonly required />
        </div>
        <div class="col-6 form_select_conductores">
            <label for="expi_date_form" id="label-expi_date">Fecha de vencimiento</label>
            <input type="text" class="form-control form-dataconductores" name="drivingLicence[expi_date]" id="expi_date" readonly
                required />
        </div>
    </div>
</div>
<input type="button" name="Anterior" class="previous action-button-previous form-dataconductores" value="Anterior" />
<input type="button" name="Siguiente" class="next action-button form-dataconductores" value="Siguiente"
    data-validate="{{ route('driving_licence.validate') }}" data-error="driving_licence" />