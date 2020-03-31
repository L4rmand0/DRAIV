<div class="card" id="card_single_vehicle&ID">
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseItem&ID"
                aria-expanded="true" aria-controls="collapseItem">
                FECHA: &FECHA
            </button>
        </h5>
    </div>
    <div id="collapseItem&ID" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion_vehicles">
        <div class="card-body">
            <div class="row mb-3 mt-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Destreza') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control field_driver_info" name="" id="slalom"
                        value="" data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_slalom" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_slalom as $key_val_slalom => $val_slalom)
                        <option value="{{ $key_val_slalom }}">{{ $val_slalom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Proyección') }}:
                </div>
                <div class="col-md-3"><input type="text" class="form-control field_driver_info" name="" id="projection"
                        value="" data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_projection_form" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_projection as $key_val_projection => $val_projection)
                        <option value="{{ $key_val_projection }}">{{ $val_projection }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Frenado') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control field_driver_info" name="" id="braking"
                        value="" data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_braking" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_braking as $key_val_braking => $val_braking)
                        <option value="{{ $key_val_braking }}">{{ $val_braking }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Evasión') }}:
                </div>
                <div class="col-md-3"><input type="text" class="form-control field_driver_info" name="" id="evasion"
                        value="" data-module="driver-info" readonly>
                    <select class="form-control" name="evasion" id="evasion_form" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_evasion as $key_val_evasion => $val_evasion)
                        <option value="{{ $key_val_evasion }}">{{ $val_evasion }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>