<div class="card" id="card_form_motorcycle_technology">
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseItemMT_&PLACA" aria-expanded="true"
                aria-controls="collapseItem">
                PLACA: &PLACA
            </button>
        </h5>
    </div>
    <div id="collapseItemMT_&PLACA" class="collapse show" aria-labelledby="headingOne"
        data-parent="#example_card_motorcycle_technology">
        <div class="card-body">
            <div class="form-group row">
                <label for="&PLACAbrake_type" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Frenado Disco') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="motorcycle_technology[&PLACA][brake_type]" id="&PLACAbrake_type" style="width:100%;" required>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_type_brake as $key_val_type_brake => $val_type_brake)
                        <option value="{{ $key_val_type_brake }}">{{ $val_type_brake }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAassistence_brake" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Asistencia de Frenos') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="motorcycle_technology[&PLACA][assistence_brake]" id="&PLACAassistence_brake" style="width:100%;"
                        required>
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_assistence_brake as $key_val_assistence_brake => $val_assistence_brake)
                        <option value="{{ $key_val_assistence_brake }}">{{ $val_assistence_brake }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAautomatic_lights" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Luces') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="motorcycle_technology[&PLACA][automatic_lights]" id="&PLACAautomatic_lights" style="width:100%;"
                        required>
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