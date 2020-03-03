<div id="form_vehicle_driver">
    <section style="width: 100%;">
        <div class="form-card">
            <h4>Vehículo &num_vehicle </h4>
            <div class="row">
                <div class="col-md-6">
                    <input class="form-control form-vehicles" type="text" name="vehicle[plate_id][]" placeholder="Placa"
                        id="plate_id_form" data-check="{{ route('admin.vehicle.checkvehiclebyid') }}" />
                    <span class="error_admin input_user_admin" role="alert" id="plate_id-error">
                        <strong id="plate_id-error-strong" class="error-strong"> </strong>
                    </span>
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="type_v">Tipo</label>
                    <select name="vehicle[type_v][]" class="form-control form-vehicles" id="type_v_form"
                        style="width: 100%">
                        <option value="">Seleccionar...</option>
                        @foreach ($list_type_v as $item_type_v)
                        <option value="{{$item_type_v}}"> {{$item_type_v}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="owner_v">Dueño</label>
                    <select name="vehicle[owner_v][]" class="form-control form-vehicles" id="owner_v_form"
                        style="width: 100%" required>
                        <option value="">Seleccionar...</option>
                        <option value="Y">Si</option>
                        <option value="N">No</option>
                    </select>
                    <span class="error_admin input_user_admin" role="alert" id="owner_v-error">
                        <strong id="owner_v-error-strong" class="error-strong"> </strong>
                    </span>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 form_select_conductores" id="row-taxi-inputs" hidden>
                    <label for="taxi_type">Tipo de Taxi</label>
                    <select name="vehicle[taxi_type][]" class="form-control form-vehicles" id="taxi_type_form"
                        style="width: 100%">
                        <option value="">Seleccionar...</option>
                        @foreach ($list_taxi_type as $item_taxi_type)
                        <option value="{{$item_taxi_type}}"> {{$item_taxi_type}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form_select_conductores">
                    <label for="number_of_drivers_form">Número de conductores</label>
                    <select name="vehicle[number_of_drivers][]" class="form-control form-vehicles"
                        id="number_of_drivers_form" style="width: 100%">
                        <option value="">Seleccionar...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
            <div class="row row_form_input_vehicle mt-2">
                <div class="col-md-6">
                    <label for="soat_expi_date_form">Fecha de vencimiento de soat</label>
                    <input type="date" class="form-control form-vehicles" name="vehicle[soat_expi_date][]"
                        id="soat_expi_date_form" readonly required />
                    <span class="error_admin input_user_admin" role="alert" id="soat_expi_date-error">
                        <strong id="soat_expi_date-error-strong" class="error-strong"> </strong>
                    </span>
                </div>
                <div class="col-md-6">
                    <label for="technomechanical_date_form">Fecha de Tecnomecánica</label>
                    <input type="date" class="form-control form-vehicles" name="vehicle[technomechanical_date][]"
                        id="technomechanical_date_form" readonly />
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 form_select_conductores">
                    <label for="capacity">Cantidad de pasajeros</label>
                    <select name="vehicle[capacity][]" class="form-control form-vehicles" id="capacity_form"
                        style="width: 100%">
                        <option value="">Seleccionar...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="col-md-6 form_select_conductores">
                    <label for="service">Servicio</label>
                    <select name="vehicle[service][]" class="form-control form-vehicles" id="service_form"
                        style="width: 100%">
                        <option value="">Seleccionar...</option>
                        @foreach ($list_service as $item_service)
                        <option value="{{$item_service}}"> {{$item_service}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row row_form_input_conductores mt-2">
                <div class="col-md-6">
                    <input type="text" class="form-control form-vehicles" name="vehicle[cylindrical_cc][]"
                        id=cylindrical_cc_form"" placeholder="Cilindraje" />
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control form-vehicles" name="vehicle[v_class][]" id="v_class_form"
                        placeholder="Clase de Vehículo" />
                </div>
            </div>
            <div class="row row_form_input_conductores mt-2">
                <div class="col-md-6">
                    <input type="number" class="form-control form-vehicles" name="vehicle[model][]" min="1950" max="2030"
                        placeholder="Modelo (año)" id="model_form" />
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control form-vehicles" name="vehicle[line][]" placeholder="Línea"
                        id="line_form" />
                </div>
            </div>
            <div class="row row_form_input_conductores mt-2">
                <div class="col-md-6">
                    <input type="text" class="form-control form-vehicles" name="vehicle[brand][]" placeholder="Marca"
                        id="brand_form" />
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control form-vehicles" name="vehicle[color][]" placeholder="Color"
                        id="color_form" />
                </div>
            </div>
        </div>
    <a class="previous_vehicle" type="button"> <img src="{{ asset('img/back_v_64.png') }}" alt="" data-validate="{{ route('vehicle.validate-register') }}"></a>
    <a class="next_vehicle" type="button" style="position: absolute;right: 0;margin-right: 25px" data-validate="{{ route('vehicle.validate-register') }}"> <img src="{{ asset('img/next_v_64.png') }}" alt=""></a>
    </section>
   
</div>