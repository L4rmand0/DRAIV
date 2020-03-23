<div class="card" id="card_form_skill_&TYPE_VEHICLE">
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseItem_skills&TYPE_VEHICLE" aria-expanded="true"
                aria-controls="collapseItem">
                &TYPE_VEHICLE
            </button>
        </h5>
    </div>
    <div id="collapseItem_skills&TYPE_VEHICLE" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion_skills">
        <div class="card-body">
            <div class="form-group row">
                <label for="slalom" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Destreza') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="skillmtm[&TYPE_VEHICLE][slalom]" id="&TYPE_VEHICLEslalom" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_slalom as $key_val_slalom => $val_slalom)
                        <option value="{{ $key_val_slalom }}">{{ $val_slalom }}</option>
                        @endforeach
                    </select>
                    {{-- <span class="error_admin" role="alert" id="slalom_form-error">
                        <strong id="slalom_form-error-strong" class="error-strong"></strong>
                    </span> --}}
                </div>
            </div>
            <div class="form-group row">
                <label for="projection_form" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Proyección') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="skillmtm[&TYPE_VEHICLE][projection]" id="&TYPE_VEHICLEprojection" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_projection as $key_val_projection => $val_projection)
                        <option value="{{ $key_val_projection }}">{{ $val_projection }}</option>
                        @endforeach
                    </select>
                    {{-- <span class="error_admin" role="alert" id="projection_form-error">
                        <strong id="projection_form-error-strong" class="error-strong"></strong>
                    </span> --}}
                </div>
            </div>
            <div class="form-group row">
                <label for="projection_form" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Frenado') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="skillmtm[&TYPE_VEHICLE][braking]" id="&TYPE_VEHICLEbraking" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_braking as $key_val_braking => $val_braking)
                        <option value="{{ $key_val_braking }}">{{ $val_braking }}</option>
                        @endforeach
                    </select>
                    {{-- <span class="error_admin" role="alert" id="braking_form-error">
                        <strong id="braking_form-error-strong" class="error-strong"></strong>
                    </span> --}}
                </div>
            </div>
            <div class="form-group row">
                <label for="evasion_form" style="padding-top: calc(0.135rem + 1px);"
                    class="col-md-4 col-form-label text-md-right">{{ __('Evasión') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="skillmtm[&TYPE_VEHICLE][evasion]" id="&TYPE_VEHICLEevasion" style="width:100%;">
                        <option value="">Seleccionar ...</option>
                        @foreach ($values_evasion as $key_val_evasion => $val_evasion)
                        <option value="{{ $key_val_evasion }}">{{ $val_evasion }}</option>
                        @endforeach
                    </select>
                    {{-- <span class="error_admin" role="alert" id="evasion_form-error">
                        <strong id="evasion_form-error-strong" class="error-strong"></strong>
                    </span> --}}
                </div>
            </div>
        </div>
    </div>
</div>