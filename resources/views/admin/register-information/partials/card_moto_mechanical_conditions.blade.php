<div class="card" id="card_form_moto_mechanical_conditions">
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseItemMT_&PLACA"
                aria-expanded="true" aria-controls="collapseItem">
                PLACA: &PLACA
            </button>
        </h5>
    </div>
    <div id="collapseItemMT_&PLACA" class="collapse show" aria-labelledby="headingOne"
        data-parent="#example_card_motorcycle_technology">
        <div class="card-body">
            <div class="form-group row">
                <label for="&PLACAtires" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Llantas') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="motorcycle_mechanical_conditions[&PLACA][tires]" id="&PLACAtires"
                        style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_tires as $key_val_tires => $val_tires)
                        <option value="{{ $key_val_tires }}">{{ $val_tires }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAmanigueta_guaya" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Manigueta y Guaya') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="motorcycle_mechanical_conditions[&PLACA][manigueta_guaya]"
                        id="&PLACAmanigueta_guaya" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_manigueta_guaya as $key_val_manigueta_guaya => $val_manigueta_guaya)
                        <option value="{{ $key_val_manigueta_guaya }}">{{ $val_manigueta_guaya }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAbraking_system" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Frenos') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="motorcycle_mechanical_conditions[&PLACA][braking_system]"
                        id="&PLACAbraking_system" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_braking_system as $key_val_braking_system => $val_braking_system)
                        <option value="{{ $key_val_braking_system }}">{{ $val_braking_system }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAkit" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Kit de Arrastre') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="motorcycle_mechanical_conditions[&PLACA][kit]"
                        id="&PLACAkit" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_kit as $key_val_kit => $val_kit)
                        <option value="{{ $key_val_kit }}">{{ $val_kit }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAstee_susp" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Dirección y Suspensión') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="motorcycle_mechanical_conditions[&PLACA][stee_susp]"
                        id="&PLACAstee_susp" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_stee_susp as $key_val_stee_susp => $val_stee_susp)
                        <option value="{{ $key_val_stee_susp }}">{{ $val_stee_susp }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAoil_leak" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Fuga de Aceite') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="motorcycle_mechanical_conditions[&PLACA][oil_leak]"
                        id="&PLACAoil_leak" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_oil_leak as $key_val_oil_leak => $val_oil_leak)
                        <option value="{{ $key_val_oil_leak }}">{{ $val_oil_leak }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAother_components" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Chasis, espejos, guardabarros y Otros') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="motorcycle_mechanical_conditions[&PLACA][other_components]"
                        id="&PLACAother_components" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_other_components as $key_val_other_components => $val_other_components)
                        <option value="{{ $key_val_other_components }}">{{ $val_other_components }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAhorn" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Bocina') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="motorcycle_mechanical_conditions[&PLACA][horn]" id="&PLACAhorn"
                        style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_horn as $key_val_horn => $val_horn)
                        <option value="{{ $key_val_horn }}">{{ $val_horn }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAlights" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Luces') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="motorcycle_mechanical_conditions[&PLACA][lights]"
                        id="&PLACAlights" style="width:100%;">
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