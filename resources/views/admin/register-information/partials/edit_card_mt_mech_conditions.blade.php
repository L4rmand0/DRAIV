<div class="card" id="card_single_vehicle_mtmc&PLACA">
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseItemmtmc&PLACA"
                aria-expanded="true" aria-controls="collapseItem">
                PLACA: &PLACA
            </button>
        </h5>
    </div>
    <div id="collapseItemmtmc&PLACA" class="collapse show" aria-labelledby="headingOne"
        data-parent="#accordion_technology_evaluation">
        <div class="card-body">
            <div class="row mb-3 mt-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Llantas') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control tires" name="" id="tires" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_tires" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_tires as $key_val_tires => $val_tires)
                        <option value="{{ $key_val_tires }}">{{ $val_tires }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Manigueta y Guaya') }}:
                </div>
                <div class="col-md-3"><input type="text" class="form-control manigueta_guaya" name=""
                        id="manigueta_guaya" value="" data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_manigueta_guaya" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_manigueta_guaya as $key_val_manigueta_guaya => $val_manigueta_guaya)
                        <option value="{{ $key_val_manigueta_guaya }}">{{ $val_manigueta_guaya }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Frenos') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control braking_system" name=""
                        id="braking_system" value="" data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_braking_system" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_braking_system as $key_val_braking_system => $val_braking_system)
                        <option value="{{ $key_val_braking_system }}">{{ $val_braking_system }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Kit de Arrastre') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control kit" name="" id="kit" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_kit" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_kit as $key_val_kit => $val_kit)
                        <option value="{{ $key_val_kit }}">{{ $val_kit }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Dirección y Suspensión') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control stee_susp" name="" id="stee_susp" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_stee_susp" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_stee_susp as $key_val_stee_susp => $val_stee_susp)
                        <option value="{{ $key_val_stee_susp }}">{{ $val_stee_susp }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Fuga de Aceite') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control oil_leak" name="" id="oil_leak" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_oil_leak" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_oil_leak as $key_val_oil_leak => $val_oil_leak)
                        <option value="{{ $key_val_oil_leak }}">{{ $val_oil_leak }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Fuga de Aceite') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control other_components" name=""
                        id="other_components" value="" data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_other_components" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_oil_leak as $key_val_oil_leak => $val_oil_leak)
                        <option value="{{ $key_val_oil_leak }}">{{ $val_oil_leak }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Bocina') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control horn" name="" id="horn" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_horn" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_horn as $key_val_horn => $val_horn)
                        <option value="{{ $key_val_horn }}">{{ $val_horn }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Luces') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control lights" name="" id="lights" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="lights" id="edit_input_lights" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_lights as $key_val_lights => $val_lights)
                        <option value="{{ $key_val_lights }}">{{ $val_lights }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- //////////////////////////////// --->