<div class="card" id="card_single_vehicle">
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseItem"
                aria-expanded="true" aria-controls="collapseItem">
                PLACA: &PLACA
            </button>
        </h5>
    </div>
    <div id="collapseItem" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion_vehicles">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Placa:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control plate_id" name="" value="" id="plate_id"
                        data-module="vehicle" data-plate="&PLACA" readonly> </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Tipo Vehículo:</div>
                <div class="col-md-3"><input type="text" class="form-control type_v field_driver_info_select" name=""
                        value="" id="type_v" data-module="vehicle" data-plate="&PLACA" readonly>
                    <select name="]" class="form-control form-vehicles text-datadrivers" style="width: 100%" hidden>
                        <option value="">Seleccionar...</option>
                        @foreach ($list_type_v as $item_type_v)
                        <option value="{{$item_type_v}}"> {{$item_type_v}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Dueño:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control owner_v field_driver_info_select" name=""
                        value="" id="owner_v" data-module="vehicle" data-plate="&PLACA" readonly>
                    <select name="" class="form-control" id="edit_input_gender" hidden>
                        <option value="Y">Sí</option>
                        <option value="N">No</option>
                    </select>
                </div>
                <div class="col-md-3 col-taxi-type" style="display: flex;align-items: center;justify-content: center;">
                    Tipo de taxi:</div>
                <div class="col-md-3 col-taxi-type"><input type="text" class="form-control taxi_type field_driver_info"
                        name="" value="" id="taxi_type" data-module="vehicle" data-plate="&PLACA" readonly></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Número de conductores:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control number_of_drivers field_driver_info"
                        name="" value="" id="number_of_drivers" data-module="vehicle" data-plate="&PLACA" readonly>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Fecha de vencimiento Soat:</div>
                <div class="col-md-3"><input type="text" class="form-control soat_expi_date field_driver_info_date"
                        name="" value="" id="soat_expi_date&PLACA" data-id="soat_expi_date" data-module="vehicle" data-plate="&PLACA" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Capacidad:</div>
                <div class="col-md-3"> <input type="text" class="form-control capacity field_driver_info" name=""
                        value="" id="capacity" data-module="vehicle" data-plate="&PLACA" readonly>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Servicio:</div>
                <div class="col-md-3"><input type="text" class="form-control service field_driver_info_select" name=""
                        value="" id="service" data-module="vehicle" data-plate="&PLACA" readonly>
                    <select name="" class="form-control form-vehicles text-datadrivers"
                        id="service" style="width: 100%" hidden>
                        <option value="">Seleccionar...</option>
                        @foreach ($list_service as $item_service)
                        <option value="{{$item_service}}"> {{$item_service}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Cilindraje:</div>
                <div class="col-md-3"> <input type="text" class="form-control cylindrical_cc field_driver_info" name=""
                        value="" id="cylindrical_cc" data-module="vehicle" data-plate="&PLACA" readonly>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    País de
                    Modelo:</div>
                <div class="col-md-3"><input type="text" class="form-control model field_driver_info" name="" value=""
                        id="model" data-module="vehicle" data-plate="&PLACA" readonly></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Línea:</div>
                <div class="col-md-3"> <input type="text" class="form-control line field_driver_info" name="" value=""
                        id="line" data-module="vehicle" data-plate="&PLACA" readonly>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Marca:</div>
                <div class="col-md-3"><input type="text" class="form-control brand field_driver_info" name="" value=""
                        id="brand" data-module="vehicle" data-plate="&PLACA" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Color:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control color field_driver_info" name="" value=""
                        id="color" data-module="vehicle" data-plate="&PLACA" readonly>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Fecha Tecnomecánica:</div>
                <div class="col-md-3"><input type="text"
                        class="form-control technomechanical_date field_driver_info_date" name="" value=""
                        id="technomechanical_date&PLACA" data-id="technomechanical_date" data-module="vehicle" data-plate="&PLACA" readonly>
                </div>
            </div>
        </div>
    </div>
</div>