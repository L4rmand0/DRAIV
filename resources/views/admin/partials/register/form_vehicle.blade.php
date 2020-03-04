<div id="form_vehicle_driver">
    <section style="width: 100%;">
        <div class="form-card" style="margin-bottom: 50px;">
            <h4>Vehículo &num_vehicle </h4>
            <div class="row">
                <div class="col-md-6">
                    <input class="form-control form-vehicles text-datadrivers" type="text" name="vehicle[plate_id][]" placeholder="Placa"
                        id="plate_id" data-check="{{ route('admin.vehicle.checkvehiclebyid') }}" />
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="type_v" id="label-type_v">Tipo</label>
                    <select name="vehicle[type_v][]" class="form-control form-vehicles text-datadrivers" id="type_v"
                        style="width: 100%">
                        <option value="">Seleccionar...</option>
                        @foreach ($list_type_v as $item_type_v)
                        <option value="{{$item_type_v}}"> {{$item_type_v}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="owner_v" id="label-owner_v">Dueño</label>
                    <select name="vehicle[owner_v][]" class="form-control form-vehicles text-datadrivers" id="owner_v"
                        style="width: 100%" required>
                        <option value="">Seleccionar...</option>
                        <option value="Y">Si</option>
                        <option value="N">No</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 form_select_conductores text-datadrivers" id="row-taxi-inputs" hidden>
                    <label for="taxi_type">Tipo de Taxi</label>
                    <select name="vehicle[taxi_type][]" class="form-control form-vehicles" id="taxi_type"
                        style="width: 100%">
                        <option value="">Seleccionar...</option>
                        @foreach ($list_taxi_type as $item_taxi_type)
                        <option value="{{$item_taxi_type}}"> {{$item_taxi_type}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form_select_conductores">
                    <label for="number_of_drivers_form">Número de conductores</label>
                    <select name="vehicle[number_of_drivers][]" class="form-control form-vehicles text-datadrivers"
                        id="number_of_drivers" style="width: 100%">
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
                    <label for="soat_expi_date" id="label-soat_expi_date">Fecha de vencimiento de soat</label>
                    <input type="date" class="form-control form-vehicles text-datadrivers date_vehicle" name="vehicle[soat_expi_date][]"
                        id="soat_expi_date" readonly/>
                </div>
                <div class="col-md-6">
                    <label for="technomechanical_date_form">Fecha de Tecnomecánica</label>
                    <input type="date" class="form-control form-vehicles text-datadrivers date_vehicle" name="vehicle[technomechanical_date][]"
                        id="technomechanical_date" readonly />
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 form_select_conductores">
                    <label for="capacity" id="label-capacity">Cantidad de pasajeros</label>
                    <select name="vehicle[capacity][]" class="form-control form-vehicles text-datadrivers" id="capacity"
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
                    <label for="service" id="label-service">Servicio</label>
                    <select name="vehicle[service][]" class="form-control form-vehicles text-datadrivers" id="service"
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
                    <input type="text" class="form-control form-vehicles text-datadrivers" name="vehicle[cylindrical_cc][]"
                        id="cylindrical_cc" placeholder="Cilindraje" />
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control form-vehicles text-datadrivers" name="vehicle[v_class][]" id="v_class"
                        placeholder="Clase de Vehículo" />
                </div>
            </div>
            <div class="row row_form_input_conductores mt-2">
                <div class="col-md-6">
                    <input type="number" class="form-control form-vehicles text-datadrivers" name="vehicle[model][]" min="1950" max="2030"
                        placeholder="Modelo (año)" id="model" />
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control form-vehicles text-datadrivers" name="vehicle[line][]" placeholder="Línea"
                        id="line" />
                </div>
            </div>
            <div class="row row_form_input_conductores mt-2">
                <div class="col-md-6">
                    <input type="text" class="form-control form-vehicles text-datadrivers" name="vehicle[brand][]" placeholder="Marca"
                        id="brand" />
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control form-vehicles text-datadrivers" name="vehicle[color][]" placeholder="Color"
                        id="color" />
                </div>
            </div>
        </div>
    <a class="previous_vehicle" type="button" style="position: absolute;left: 40px;bottom: 14px;"> <img src="{{ asset('img/back_v_64.png') }}" alt="" data-validate="{{ route('vehicle.validate-register') }}" style="width: 50px;"></a>
    <a class="next_vehicle" type="button" style="position: absolute;right: 0;margin-right: 40px;bottom: 14px;" data-validate="{{ route('vehicle.validate-register') }}"> <img src="{{ asset('img/next_v_64.png') }}" alt="" style="width: 50px;"></a>
    </section>
   
</div>