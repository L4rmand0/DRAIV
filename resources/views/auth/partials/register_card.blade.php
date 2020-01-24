<input type="hidden" id="register_validator" value="{{ route('register.validate') }}">
<div class="card-body">
    <form id="msform" action="{{ route('register') }}">
        @csrf
        <!-- progressbar -->
        <ul id="progressbar">
            <li class="active" id="account"></i><strong>Cuenta</strong></li>
            <li id="personal"><strong>Resumen</strong></li>
            <li id="confirm"><strong>Confirmación</strong></li>
        </ul>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0"
                aria-valuemax="100"></div>
        </div>
        <hr> <!-- fieldsets -->
        <h2 id="heading">Regístrese para una Cuenta DRAIV</h2>
        <label class="text-center mb-3 mt-2 ml-5"
            style="color: #979797; font-size: 1.1em; font-family: 'Fira Sans', sans-serif;" for="">¿Ya
            tiene
            una cuenta DRAIV? <a
                style="color:#1A8ED1; cursor: pointer; font-size: 1.1em; font-family: 'Fira Sans', sans-serif;"
                id="btn_call_login" class="btn btn-link">
                {{ __('Iniciar Sesión') }}
            </a></label>
        <fieldset id="account_fieldset">
            <div class="form-card">
                <div class="row">
                    <div class="col-7">
                        <h2 class="fs-title">Información de cuenta:</h2>
                    </div>
                    <div class="col-5">
                        <h2 class="steps">Paso 1 - 3</h2>
                    </div>
                </div>
                <label for="name_register" class="fieldlabels" style="margin-top: 0 !important;" id="label-name">Nombre:
                    *</label>
                <input type="text" name="register[name]" placeholder="nombre" id="name" autocomplete="name" />
                <label for="email_register" class="fieldlabels" id="label-email">Correo Electrónico: *</label>
                <input type="email" name="register[email]" placeholder="correo electrónico" id="email"
                    autocomplete="email" />
                <label for="password" class="fieldlabels" id="label-password">Password: *</label>
                <input type="password" name="register[password]" placeholder="Contraseña" id="password" />
                <label for="password-confirm" class="fieldlabels">Confirm Password:*</label>
                <input type="password" name="register[password_confirmation]" placeholder="Confirmar Contraseña"
                    id="password-confirm" />
                <label for="company_id" class="fieldlabels" id="label-company_id">Nit:*</label>
                <input type="text" name="register[company_id]" placeholder="cédula o nit de la compañía" id="company_id"
                    autocomplete="register[company_id]" />
                <label for="password-confirm" class="fieldlabels" id="label-company_name">Nombre de la
                    compañía:*</label>
                <input type="text" name="register[company_name]" placeholder="nombre de la compañía" id="company_name"
                    autocomplete="register[company_name]" onkeyup="this.value = this.value.toUpperCase();" />
                <div class="form-group row">
                    <div class="col-12 col-md-4">
                    </div>
                    <div class="custom-control custom-checkbox col-4 col-md-6" style="margin-top: 17px;">
                        <input type="checkbox" name="register[checkdata]"
                            class="custom-control-input @error('checkdata') is-invalid @enderror" id="checkdata">
                        <label class="custom-control-label" for="checkdata" id="label-checkdata">Aceptar Términos y
                            condiciones</label>
                        {{-- <span class="error_admin input_user_admin" role="alert" id="checkdata-error">
                            <strong id="checkdata-error-strong" class="error-strong"> </strong>
                        </span> --}}
                    </div>
                </div>
                <div style="display: flexbox; align-items: center; justify-content: center;" class="form-group row">
                    <a class="" data-toggle="modal" data-target="#data_agree"
                        style="cursor: pointer; text-decoration: underline;">Ver política de datos</a>
                </div>
            </div>
            <input type="button" name="next" class="next action-button" value="Siguiente" />
        </fieldset>
        <fieldset id="account_review">
            <div class="form-card">
                <div class="row">
                    <div class="col-7">
                        <h2 class="fs-title">Resumen:</h2>
                    </div>
                    <div class="col-5">
                        <h2 class="steps">Paso 2 - 3</h2>
                    </div>
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col-md-12 text-center">
                        <p style="font-weight: 200; font-size: 1.3em;"> Has seleccionado el plan </p>
                    </div>
                    <div class="col-md-12 text-center">
                        <p style="font-weight: 600; font-size: 1.5em;"> Beta DRAIV </p>
                    </div>
                    <div class="col-md-12 text-center">
                        <p class="mt-0"
                            style="color:#4F4F4F; font-weight: 600; font-family: 'Fira Sans', sans-serif; font-size: 3em;">
                            0
                            <strong style="font-size: 0.25em; font-weight: 200; color: #C3C3C3;">$/mes</strong> </p>
                    </div>
                </div>
            </div>
            <input type="submit" name="next" class="next action-button" value="Registrar" />
            <input type="button" name="previous" class="previous action-button-previous" value="Anterior" />
        </fieldset>
        <fieldset id="final_fieldset">
            <div class="form-card">
                <div class="row">
                    <div class="col-7">
                        <h2 class="fs-title">Final:</h2>
                    </div>
                    <div class="col-5">
                        <h2 class="steps">Step 3 - 3</h2>
                    </div>
                </div> <br><br>
                <h2 class="purple-text text-center"><strong>COMPLETADO !</strong></h2> <br>
                <div class="row justify-content-center">
                    <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image">
                    </div>
                </div> <br><br>
                <div class="row justify-content-center">
                    <div class="col-7 text-center">
                        <h5 class="purple-text text-center">Te has registrado exitosamente</h5>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
</div>