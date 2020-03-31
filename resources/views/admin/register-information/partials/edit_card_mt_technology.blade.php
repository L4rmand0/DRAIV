<div class="card" id="card_single_vehicle_tech&PLACA">
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseItem&PLACA"
                aria-expanded="true" aria-controls="collapseItem">
                PLACA: &PLACA
            </button>
        </h5>
    </div>
    <div id="collapseItem&PLACA" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion_technology_evaluation">
        <div class="card-body">
            <div class="row mb-3 mt-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Frenado Disco') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control brake_type" name="" id="brake_type" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_brake_type" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_type_brake as $key_val_type_brake => $val_type_brake)
                        <option value="{{ $key_val_type_brake }}">{{ $val_type_brake }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Asistencia de Frenos') }}:
                </div>
                <div class="col-md-3"><input type="text" class="form-control assistence_brake" name="" id="assistence_brake" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_assistence_brake" style="width:100%;"
                        hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_assistence_brake as $key_val_assistence_brake => $val_assistence_brake)
                        <option value="{{ $key_val_assistence_brake }}">{{ $val_assistence_brake }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Luces') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control automatic_lights" name="" id="automatic_lights" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_automatic_lights" style="width:100%;"
                        hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_automatic_lights as $key_val_automatic_lights => $val_automatic_lights)
                        <option value="{{ $key_val_automatic_lights }}">{{ $val_automatic_lights }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- //////////////////////////////// --->