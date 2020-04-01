@if ($company)
<div class="container">
    <div class="card-group col-lg-12" style="margin-top:100px !important;">
        <div class="card" id="card_login_register">
            <div id="login_card">
                @include('auth.partials.login_card')
            </div>
            <div id="register_card" hidden>
                @include('auth.partials.register_card')
            </div>
        </div>
        <div class="card col-lg-5" style="background: #EDE6DD;">
            <h2 class="mt-5 text-center" style="color:#4F4F4F; font-weight: 700; font-family: 'Fira Sans', sans-serif;">
                Seleccione
                su plan</h2>
            <div class="card ml-4 mr-4 mt-4 mb-5 border-0">
                {{-- <div class="card-header">c --}}
                <ul class="nav nav-tabs border-0" style="background:#EDE6DD;">
                    <li class="nav-item">
                        <a class="nav-link active" id="btn_free_plan"
                            style="color: #4F4F4F; font-weight: 400 !important; background: #fff; cursor: pointer; ">Free</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="btn_medium_plan"
                            style="color: #4F4F4F; font-weight: 400; background: #EDE6DD; cursor: pointer;">Estandar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="btn_all_plan"
                            style="color: #4F4F4F; font-weight: 400; background: #EDE6DD; cursor: pointer;">Medium</a>
                    </li>
                </ul>
                {{-- </div> --}}
                <div class="card-body" id="free_plan">
                    <p class="mt-5 text-center"
                        style="color:#4F4F4F; font-weight: 600; font-family: 'Fira Sans', sans-serif; font-size: 5em;">
                        0
                        <strong style="font-size: 0.35em; font-weight: 200; color: #C3C3C3;">$/mes</strong> </p>
                    <p class="card-text mt-5" style="text-align: justify;">Gestione y centralice su información.
                        Visualice
                        dato de conductores,
                        vehículos y licencias de conducción.</p>
                    <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Administración
                        de
                        flotas</p>
                    <hr class="mt-0">
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 50 Transacciones
                        (Registro
                        Conductores) por mes.</p>
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1 usuario
                        activo por mes
                    </p>
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1 Tablero de análisis
                        de
                        datos
                        básico. Análisis por persona y empresa.</p>
                    <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Soporte</p>
                    <hr class="mt-0">
                    <p class="mb-5"> Asistencia para controles básicos: agregar, editar y eliminar información.</p>
                </div>
                <div class="card-body" id="medium_plan" hidden>
                    <p class="mt-5 text-center"
                        style="color:#4F4F4F; font-weight: 600; font-family: 'Fira Sans', sans-serif; font-size: 4.5em;">
                        150.000 <strong style="font-size: 0.35em; font-weight: 200; color: #C3C3C3;">$/mes</strong>
                    </p>
                    <p class="card-text mt-5" style="text-align: justify;">Gestione y centralice su información.
                        Visualice
                        datos de conductores, vehículos, licencias de conducción, almacene información documental,
                        valide
                        datos de sus bases de datos vs informacion extraída de sus documentos digilates.</p>
                    <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Administración
                        de
                        flotas</p>
                    <hr class="mt-0">
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 100 Transacciones
                        (Registro
                        Conductores) por mes</p>
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 2 usuarios y 5 editores
                    </p>
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1 Tablero de análisis
                        de
                        datos
                        <strong>intermedio</strong> . Análisis por persona y empresa.</p>
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 20GB en
                        almacenamientos,
                        carga y descarga de documentos digitales en la nube.</p>
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1000 validaciones de
                        documentos digitales
                        contra su base de datos por mes</p>
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> Pague solo por
                        transacción
                        y
                        validación de datos adicional (Registro de conductores)</p>
                    <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Soporte</p>
                    <hr class="mt-0">
                    <p> Asistencia para conductores básicos: agrega, editar y eliminar información.</p>
                    <p class="mb-5"> Asistencia para agregar y editar permisos: solución de problemas</p>
                </div>
                <div class="card-body" id="all_plan" hidden>
                    <p class="mt-5 text-center"
                        style="color:#4F4F4F; font-weight: 600; font-family: 'Fira Sans', sans-serif; font-size: 4.5em;">
                        210.000 <strong style="font-size: 0.35em; font-weight: 200; color: #C3C3C3;">$/mes</strong>
                    </p>
                    <p class="card-text mt-5" style="text-align: justify;">Gestione y centralice su información.
                        Visualice
                        datos de conductores, vehículos, licencias de conducción, almacene información documental,
                        valide
                        datos de sus bases de datos vs información extraída de sus documentos digilates. Consulte datos
                        de
                        terceros en tiempo real (Multas, antecedentes penales).</p>
                    <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Administración
                        de
                        flotas</p>
                    <hr class="mt-0">
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1000 Transacciones
                        (Registro
                        Conductores) por mes.</p>
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 5 usuarios
                        administrador y 15 editores
                    </p>
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1 Tablero de análisis
                        de
                        datos
                        <strong>avanzado</strong> Análisis por persona y empresa.</p>
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 300GB de almacenamiento,
                        carga
                        y descarga de documentos digitales en la nube
                    </p>
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 300 validaciones de
                        documentos
                        digitales contra su base de datos
                    </p>
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 300 consultas de
                        información a
                        bases de terceros (multas, antecendentes penales)
                    </p>
                    <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> Pague solo por
                        transacción
                        y
                        validación de datos adicional (Registro de conductores)</p>
                    <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Soporte</p>
                    <hr class="mt-0">
                    <p class="mb-5"> Asistencia completa</p>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="row justify-content-center">
    <div class="col-md-5 mt-5">
        <div class="card" id="card_login_register">
            <div id="login_card">
                <h2 class="ml-5 mt-5 mr-5"
                    style="color:#4F4F4F; font-weight: 700; font-family: 'Fira Sans', sans-serif;">
                    Iniciar sesión en su cuenta conductor DRAIV</h2>
                <div class="card-body">
                    <label class="text-center mb-2 mt-2 ml-5 mr-5"
                        style="color: #979797; font-size: 1.2em; font-family: 'Fira Sans', sans-serif;" for="">¿No tiene
                        una cuenta de conductor DRAIV? <a
                            style="color:#1A8ED1; cursor: pointer; font-size: 1em; font-family: 'Fira Sans', sans-serif;"
                            id="btn_call_register" class="btn btn-link"> {{ __('Registrarse') }}
                        </a></label>
                    <form method="POST" action="{{ route('login') }}" id="register_form">
                        @csrf
                        <div class="row ml-4">
                            <label for="email"
                                class="col-md-8 col-form-label text-md-left">{{ __('Correo Electrónico') }}</label>
                        </div>
                        <div class="row ml-4 mr-4">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2 ml-4">
                            <label for="password"
                                class="col-md-8 col-form-label text-md-left">{{ __('Contraseña') }}</label>
                        </div>
                        <div class="row ml-4 mr-4">
                            <div class="col-md-12">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="company_id" id="company_id_register" value="111">
                        <div class="row mt-3 ml-4">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordar') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row ml-3">
                            <div class="col-md-12">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidó su contaseña?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 mt-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="register_card" hidden>
                <h2 class="ml-5 mt-5" style="color:#4F4F4F; font-weight: 700; font-family: 'Fira Sans', sans-serif;">
                    Regístrese para una Cuenta DRAIV</h2>
                <div class="card-body">
                    <label class="text-center mb-3 mt-2 ml-5"
                        style="display:flex; align-items:center; justify-content:center; color: #979797; font-size: 1.2em; font-family: 'Fira Sans', sans-serif;"
                        for="">¿Ya tiene
                        una cuenta DRAIV? <a
                            style="color:#1A8ED1; cursor: pointer; font-size: 1em; font-family: 'Fira Sans', sans-serif;"
                            id="btn_call_login" class="btn btn-link">
                            {{ __('Iniciar Sesión') }}
                        </a></label>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-md-4">
                            </div>
                            <div class="custom-control custom-checkbox col-4 col-md-6" style="margin-top: 17px;">
                                <input type="checkbox" name="checkdata"
                                    class="custom-control-input @error('checkdata') is-invalid @enderror"
                                    id="defaultChecked2">
                                @error('checkdata')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label class="custom-control-label" for="defaultChecked2">Aceptar Términos y
                                    condiciones</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-md-4">
                            </div>
                            <a class="" data-toggle="modal" data-target="#data_agree"
                                style="cursor: pointer; text-decoration: underline">Ver política de datos</a>
                        </div>
                        <div class="form-group row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif