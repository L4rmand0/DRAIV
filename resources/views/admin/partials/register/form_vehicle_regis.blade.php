<div class="form-card" style="margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-6">
            <input class="form-control form-vehicles text-datadrivers plate_id_input" type="text" name="vehicle[plate_id][&NUMFORM]" placeholder="Placa"
                id="&NUMFORMplate_id" data-check="{{ route('admin.vehicle.checkvehiclebyid') }}" data-index="&NUMFORM" onkeyup="this.value = this.value.toUpperCase();"/>
        </div>
        <div class="col-md-6">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <label for="type_v" id="label-type_v">Tipo</label>
            <select name="vehicle[type_v][&NUMFORM]" class="form-control form-vehicles text-datadrivers" id="&NUMFORMtype_v"
                style="width: 100%">
                <option value="">Seleccionar...</option>
                @foreach ($list_type_v as $item_type_v)
                <option value="{{$item_type_v}}"> {{$item_type_v}} </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="owner_v" id="label-owner_v">Dueño</label>
            <select name="vehicle[owner_v][&NUMFORM]" class="form-control form-vehicles text-datadrivers" id="&NUMFORMowner_v"
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
            <select name="vehicle[taxi_type][&NUMFORM]" class="form-control form-vehicles" id="&NUMFORMtaxi_type"
                style="width: 100%">
                <option value="">Seleccionar...</option>
                @foreach ($list_taxi_type as $item_taxi_type)
                <option value="{{$item_taxi_type}}"> {{$item_taxi_type}} </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 form_select_conductores">
            <label for="number_of_drivers_form">Número de conductores</label>
            <select name="vehicle[number_of_drivers][&NUMFORM]" class="form-control form-vehicles text-datadrivers"
                id="&NUMFORMnumber_of_drivers" style="width: 100%">
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
            <input type="date" class="form-control form-vehicles text-datadrivers date_vehicle" name="vehicle[soat_expi_date][&NUMFORM]"
                id="&NUMFORMsoat_expi_date" readonly/>
        </div>
        <div class="col-md-6">
            <label for="technomechanical_date">Fecha de Tecnomecánica</label>
            <input type="date" class="form-control form-vehicles text-datadrivers date_vehicle" name="vehicle[technomechanical_date][&NUMFORM]"
                id="&NUMFORMtechnomechanical_date" readonly />
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6 form_select_conductores">
            <label for="capacity" id="label-capacity">Cantidad de pasajeros</label>
            <select name="vehicle[capacity][&NUMFORM]" class="form-control form-vehicles text-datadrivers" id="&NUMFORMcapacity"
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
            <select name="vehicle[service][&NUMFORM]" class="form-control form-vehicles text-datadrivers" id="&NUMFORMservice"
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
            <input type="text" class="form-control form-vehicles text-datadrivers" name="vehicle[cylindrical_cc][&NUMFORM]"
                id="&NUMFORMcylindrical_cc" placeholder="Cilindraje" />
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control form-vehicles text-datadrivers" name="vehicle[v_class][&NUMFORM]" id="&NUMFORMv_class"
                placeholder="Clase de Vehículo" />
        </div>
    </div>
    <div class="row row_form_input_conductores mt-2">
        <div class="col-md-6">
            <input type="number" class="form-control form-vehicles text-datadrivers" name="vehicle[model][&NUMFORM]" min="1950" max="2030"
                placeholder="Modelo (año)" id="&NUMFORMmodel" />
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control form-vehicles text-datadrivers" name="vehicle[line][&NUMFORM]" placeholder="Línea"
                id="&NUMFORMline" />
        </div>
    </div>
    <div class="row row_form_input_conductores mt-2">
        <div class="col-md-6">
            <input type="text" class="form-control form-vehicles text-datadrivers" name="vehicle[brand][&NUMFORM]" placeholder="Marca"
                id="&NUMFORMbrand" />
        </div>
        <div class="col-md-6">
            <input type="text" class="form-control form-vehicles text-datadrivers" name="vehicle[color][&NUMFORM]" placeholder="Color"
                id="&NUMFORMcolor" />
        </div>
    </div>
</div>