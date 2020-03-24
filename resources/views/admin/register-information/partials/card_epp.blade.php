<div class="card" id="card_form_epp">
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseItemEPP_&PLACA"
                aria-expanded="true" aria-controls="collapseItem">
                PLACA: &PLACA
            </button>
        </h5>
    </div>
    <div id="collapseItemEPP_&PLACA" class="collapse show" aria-labelledby="headingOne"
        data-parent="#example_card_motorcycle_technology">
        <div class="card-body">
            <div class="form-group row">
                <label for="&PLACAcasco" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Casco') }} <a href="https://sharp.dft.gov.uk"
                        target="_blank"><img src="{{ asset('img/help.png') }}" alt="" srcset=""
                            style="width: 17px;"></a></label>
                <div class="col-md-6">
                    <select class="form-control" name="epp[&PLACA][casco]" id="&PLACAcasco" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_casco as $key_val_casco => $val_casco)
                        <option value="{{ $key_val_casco }}">{{ $val_casco }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAairbag" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Airbag') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="epp[&PLACA][airbag]" id="&PLACAairbag" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_airbag as $key_val_airbag => $val_airbag)
                        <option value="{{ $key_val_airbag }}">{{ $val_airbag }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAairbagrodilleras" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Rodilleras') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="epp[&PLACA][rodilleras]" id="&PLACArodilleras"
                        style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_rodilleras as $key_val_rodilleras => $val_rodilleras)
                        <option value="{{ $key_val_rodilleras }}">{{ $val_rodilleras }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAairbagcoderas" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Coderas') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="epp[&PLACA][coderas]" id="&PLACAcoderas" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_coderas as $key_val_coderas => $val_coderas)
                        <option value="{{ $key_val_coderas }}">{{ $val_coderas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAairbaghombreras" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Hombreras') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="epp[&PLACA][hombreras]" id="&PLACAhombreras" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_hombreras as $key_val_hombreras => $val_hombreras)
                        <option value="{{ $key_val_hombreras }}">{{ $val_hombreras }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAairbagespalda" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Protector de espalda') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="epp[&PLACA][espalda]" id="&PLACAespalda" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_espalda as $key_val_espalda => $val_espalda)
                        <option value="{{ $key_val_espalda }}">{{ $val_espalda }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAairbagbotas" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Botas') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="epp[&PLACA][botas]" id="&PLACAbotas" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_botas as $key_val_botas => $val_botas)
                        <option value="{{ $key_val_botas }}">{{ $val_botas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="&PLACAairbagguantes" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Guantes') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="epp[&PLACA][guantes]" id="&PLACAguantes" style="width:100%;">
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