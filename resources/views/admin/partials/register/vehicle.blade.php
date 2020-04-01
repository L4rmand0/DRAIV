<div class="form-card">
    <h2 class="fs-title mt-2">Información de Vehículos del conductor</h2>
    <div id="accordion_vehicles_register">
        <div class="card card_single_vehicle_register">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseItem-V1"
                        aria-expanded="true" aria-controls="collapseItem">
                        VEHÍCULO
                    </button>
                </h5>
            </div>
            <div id="collapseItem-V1" class="collapse show" aria-labelledby="headingOne"
                data-parent="#accordion_vehicles_register">
                <div class="card-body">
                    <p style="font-size: 1.1em;" class="mb-4"> &#8226; ¿Quiere insertar un vehículo o elegir un vehículo
                        ya
                        insertado?</p>
                    <div class="row mb-4">
                        <div class="col-md-1">
                            <input type="radio" name="radio_vehicle0" class="radio_vehicle"
                                style="margin-top: 0 !important" value="new_vehiculo" data-index-form="0">
                        </div>
                        <div class="col-md-5">
                            <label for="" class="label_radio">Vehículo Nuevo</label>
                        </div>
                        <div class="col-md-1">
                            <input type="radio" name="radio_vehicle0" class="radio_vehicle"
                                style="margin-top: 0 !important" value="vehiculo_exist">
                        </div>
                        <div class="col-md-5">
                            <label for="">Vehículo Existente</label>
                        </div>
                    </div>
                    <div class="card_inside_vehicle_type">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="text-align: right;">
        <button type="button" class="btn btn-danger" id="btn_remove_vehicle_form" hidden><i class="fas fa-minus"></i>
            Vehículo</button>
        <button type="button" class="btn btn-primary" id="btn_add_vehicle_form"><i class="fas fa-plus"></i>
            Vehículo</button>
    </div>
</div>
<input type="button" name="previous" class="previous action-button-previous form-dataconductores" value="Anterior" />
<input type="button" name="next" class="next action-button form-dataconductores" value="Siguiente"
    id="fieldset_infouser" data-validate="{{ route('vehicle.validate-register') }}" data-error="info_user" />
<script>
    var arr_all_types_vehicle = @json($arr_type_images_vehicle);
</script>