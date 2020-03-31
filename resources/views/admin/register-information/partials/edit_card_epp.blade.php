<div class="card" id="card_single_vehicle_epp&PLACA">
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseItemepp&PLACA"
                aria-expanded="true" aria-controls="collapseItem">
                PLACA: &PLACA
            </button>
        </h5>
    </div>
    <div id="collapseItemepp&PLACA" class="collapse show" aria-labelledby="headingOne"
        data-parent="#accordion_personal_protection_elements">
        <div class="card-body">
            <div class="row mb-3 mt-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Casco') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control casco" name="" id="casco" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_casco" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_casco as $key_val_casco => $val_casco)
                        <option value="{{ $key_val_casco }}">{{ $val_casco }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Airbag') }}:
                </div>
                <div class="col-md-3"><input type="text" class="form-control airbag" name="" id="airbag" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_airbag" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_airbag as $key_val_airbag => $val_airbag)
                        <option value="{{ $key_val_airbag }}">{{ $val_airbag }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Rodilleras') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control rodilleras" name="" id="rodilleras"
                        value="" data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_rodilleras" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_rodilleras as $key_val_rodilleras => $val_rodilleras)
                        <option value="{{ $key_val_rodilleras }}">{{ $val_rodilleras }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Coderas') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control coderas" name="" id="coderas" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_coderas" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_coderas as $key_val_coderas => $val_coderas)
                        <option value="{{ $key_val_coderas }}">{{ $val_coderas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Hombreras') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control hombreras" name="" id="hombreras" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_hombreras" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_hombreras as $key_val_hombreras => $val_hombreras)
                        <option value="{{ $key_val_hombreras }}">{{ $val_hombreras }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Protector de espalda') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control espalda" name="" id="espalda" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_espalda" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_espalda as $key_val_espalda => $val_espalda)
                        <option value="{{ $key_val_espalda }}">{{ $val_espalda }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Botas') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control botas" name="" id="botas" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edi_input_botas" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_botas as $key_val_botas => $val_botas)
                        <option value="{{ $key_val_botas }}">{{ $val_botas }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    {{ __('Guantes') }}:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control guantes" name="" id="guantes" value=""
                        data-module="driver-info" readonly>
                    <select class="form-control" name="" id="edit_input_guantes" style="width:100%;" hidden>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_guantes as $key_val_guantes => $val_guantes)
                        <option value="{{ $key_val_guantes }}">{{ $val_guantes }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- //////////////////////////////// --->