<div class="form-card pt-5 pb-5">
    <h2 class="fs-title" style="margin-bottom: 20px">Información de Conductor - Datos Personales</h2>
    <div class="row">
        <div class="col-md-6">
            <input type="text" name="driverInformation[first_name]" id="first_name"
                class="form-control form-dataconductores" placeholder="Primer Nombre" required>
        </div>
        <div class="col-md-6">
            <input type="text" name="driverInformation[second_name]" id="second_name"
                class="form-control form-dataconductores" placeholder="Segundo Nombre">
        </div>
    </div>
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-6">
            <input type="text" name="driverInformation[f_last_name]" id="f_last_name"
                class="form-control form-dataconductores" placeholder="Primer Apellido" required>
        </div>
        <div class="col-md-6">
            <input type="text" name="driverInformation[s_last_name]" id="s_last_name"
                class="form-control form-dataconductores" placeholder="Segundo Apellido">
        </div>
    </div>
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-6">
            <input type="text" name="driverInformation[dni_id]" id="dni_id" class="form-control form-dataconductores"
                placeholder="Cédula" required>
            <span class="error_admin input_user_admin" role="alert" id="dni_id-error">
                <strong id="dni_id-error-strong" class="error-strong"> </strong>
            </span>
        </div>
        <div class="col-md-6">
            <input type="email" name="driverInformation[e_mail_address]" id="e_mail_address"
                class="form-control form-dataconductores" placeholder="Correo Electrónico" required>
            <span class="error_admin input_user_admin" role="alert" id="e_mail_address-error">
                <strong id="e_mail_address-error-strong" class="error-strong"> </strong>
            </span>
        </div>
    </div>
    <div class="row row_form_input_conductores" style="margin-top: 15px;">
        <div class="col-md-6">
            <input type="text" name="driverInformation[address]" class="form-control form-dataconductores" id="address"
                placeholder="Dirección" />
        </div>
        <div class="col-md-6">
            <input type="tel" name="driverInformation[phone]" class="form-control form-dataconductores" id="phone"
                placeholder="Número Celular" required />
        </div>
    </div>
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-6 form_select_conductores">
            <label for="gender" id="label-gender">Género</label><br>
            <select name="driverInformation[gender]" class="form-control" style="width: 100%" id="gender" required>
                <option value="">Seleccionar</option>
                <option value="0">Masculino</option>
                <option value="1">Femenino</option>
            </select>
        </div>
        <div class="col-md-6 form_select_conductores">
            <label for="education" id="label-education">Educación</label><br>
            <select name="driverInformation[education]" class="form-control" style="width: 100%" id="education"
                required>
                <option value="">Seleccionar</option>
                @foreach ($list_education as $education_item)
                <option value="{{ $education_item }}">{{ $education_item }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-6 form_select_conductores">
            <label for="civil_state" id="label-civil_state">Estado Civil</label><br>
            <select name="driverInformation[civil_state]" class="form-control" style="width: 100%" id="civil_state"
                required>
                <option value="">Seleccionar</option>
                @foreach ($list_civil_state as $civil_state_item)
                <option value="{{ $civil_state_item }}">{{ $civil_state_item }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 form_select_conductores">
            <label for="country_born" id="label-country_born">País</label><br>
            <select name="driverInformation[country_born]" class="form-control" style="width: 100%" id="country_born"
                required>
                <option value="">Seleccionar</option>
                @foreach ($list_country_born as $country_item)
                <option value="{{ $country_item }}">{{ $country_item }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-6 form_select_conductores">
            <label for="department" id="label-department">Departamento</label><br>
            <select name="driverInformation[department]" class="form-control" id="department"
                data-url="{{ route('admin2-select-lists') }}" style="width: 100%" required>
                <option value="">Seleccionar</option>
            </select>
        </div>
        <div class="col-md-6 form_select_conductores">
            <label for="city_residence_place" id="label-city_residence_place">Ciudad de Residencia</label><br>
            <select name="driverInformation[city_residence_place]" class="form-control" id="city_residence_place"
                data-url="{{ route('admin3-select-lists') }}" style="width: 100%" required disabled>
            </select>
        </div>
    </div>
    <div class="row mb-3" style="margin-top: 15px;">
        <div class="col-md-6">
            <input type="number" name="driverInformation[born_day]" class="form-control form-dataconductores" id="born_day"
                placeholder="Edad" required />
        </div>
        <!-- <div class="col-md-6 form_select_conductores">
            <label for="city_born_form">Ciudad de Nacimiento:</label><br>
            <select name="driverInformation[city_born]" class="form-control" id="city_born_form"
                data-url="{{ route('admin3-select-lists') }}" style="width: 100%" required>
            </select>
        </div> -->
        <div class="col-md-6 form_select_conductores">
            <label for="company_id" id="label-company_id">Compañía</label><br>
            @if ($multiple_admin && $dashboard == false)
            <select name="driverInformation[company_id]" class="form-control" id="company_id"
                data-url="{{ route('company-select-list') }}" style="width: 100%" required>
                @foreach ($child_companies as $company)
                    @if ($company['id'] == $company_active)
                    <option value="{{ $company['id'] }}" selected>{{ $company['name'] }}</option>
                    @else
                    <option value="{{ $company['id'] }}">{{ $company['name'] }}</option>
                    @endif
                @endforeach
            </select>
            @else
                <input type="hidden" name="driverInformation[company_id]" value="{{auth()->user()->company_active}}" id="company_id_hidden">
            @endif
        </div>
    </div>
</div>
<input type="button" name="next" class="next action-button form-dataconductores" value="Next Step"
    id="fieldset_infouser" data-validate="{{ route('drivers-info.validate-register') }}" data-error="info_user" />
<script>
    var enum_education = @json($enum_education);
    var enum_country_born = @json($enum_country_born);
    var enum_civil_state = @json($enum_civil_state);
    var list_cities = @json($enum_civil_state);
    var list_admin3 = @json($list_admin3);
</script>