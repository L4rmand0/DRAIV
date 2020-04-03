<div class="tab-pane fade show active" id="nav-driver-information" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="card text-left">
        <h5 class="card-header">Información personal</h5>
        <div class="card-body">
            <div class="row mb-3 mt-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Nombre:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control field_driver_info" name="" id="first_name"
                        value="" data-module="driver-info" readonly>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Segundo
                    Nombre:</div>
                <div class="col-md-3"><input type="text" class="form-control field_driver_info" name="" id="second_name"
                        value="" data-module="driver-info" readonly></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Apellido:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control field_driver_info" name=""
                        id="f_last_name" value="" data-module="driver-info" readonly> </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Segundo
                    Apellido:</div>
                <div class="col-md-3"><input type="text" class="form-control field_driver_info" name="" id="s_last_name"
                        value="" data-module="driver-info" readonly></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Género:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control field_driver_info_select" name=""
                        id="gender" value="" data-module="driver-info" readonly>
                    <select name="" class="form-control" id="edit_input_gender" hidden>
                        <option value="0">Masculino</option>
                        <option value="1">Femenino</option>
                    </select>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Fecha de
                    nacimiento:</div>
                <div class="col-md-3"><input type="text" class="form-control field_driver_info_date" name="" id="born_date"
                        value="" data-module="driver-info" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Educación:</div>
                <div class="col-md-3"> <input type="text" class="form-control field_driver_info_select" name=""
                        id="education" value="" data-module="driver-info" readonly>
                    <select name="" class="form-control" id="edit_input_education" hidden>
                        @foreach ($options_education as $option)
                        <option value="{{$option}}">{{$option}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Correo
                    Electrónico:</div>
                <div class="col-md-3"><input type="text" class="form-control field_driver_info" name=""
                        id="e_mail_address" value="" data-module="driver-info" readonly></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Dirección:</div>
                <div class="col-md-3"> <input type="text" class="form-control field_driver_info" name="" id="address"
                        value="" data-module="driver-info" readonly>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">País de
                    nacimiento:</div>
                <div class="col-md-3"><input type="text" class="form-control" name=""
                        id="country_born" value="" readonly></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Ciudad de
                    Residencia:</div>
                <div class="col-md-3"> <input type="text" class="form-control" name="" id="city_residence_place"
                        value="" readonly>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">
                    Departamento:</div>
                <div class="col-md-3"><input type="text" class="form-control" name="" id="department"
                        value="" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Teléfono:
                </div>
                <div class="col-md-3"> <input type="text" class="form-control field_driver_info" name="" id="phone"
                        value="" data-module="driver-info" readonly>
                </div>
                <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Estado
                    Civil:</div>
                <div class="col-md-3"><input type="text" class="form-control field_driver_info_select" name="" id="civil_state"
                        value="" data-module="driver-info" readonly>
                    <select name="" class="form-control" id="edit_input_education" hidden>
                        @foreach ($options_civil_state as $option)
                        <option value="{{$option}}">{{$option}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
    ...
</div>