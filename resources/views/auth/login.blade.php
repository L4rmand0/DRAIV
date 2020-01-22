@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-group col-lg-12" style="margin-top:90px;">
        <div class="card" id="card_login_register">
            {{-- <div class="card-header">{{ __('Login') }}</div> --}}
        <h3 class="ml-5 mt-5" style="color:#4F4F4F; font-weight: 700; font-family: 'Fira Sans', sans-serif;">Regístrese
            acá para una Cuenta DRAIV</h3>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
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
                    <label for="password" class="col-md-8 col-form-label text-md-left">{{ __('Contraseña') }}</label>
                </div>
                <div class="row ml-4 mr-4">
                    <div class="col-md-12">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

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
                <div class="form-group row mb-0 mt-4">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>


                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card col-lg-5" style="background: #EDE6DD;">
        <h3 class="mt-5 text-center" style="color:#4F4F4F; font-weight: 700; font-family: 'Fira Sans', sans-serif;">
            Seleccione
            su plan</h3>
        <div class="card ml-4 mr-4 mt-4 mb-5 border-0">
            {{-- <div class="card-header">c --}}
            <ul class="nav nav-tabs border-0" style="background:#EDE6DD;">
                <li class="nav-item">
                    <a class="nav-link active" id="btn_free_plan"
                        style="color: #4F4F4F; font-weight: 600; background: #EDE6DD; cursor: pointer;">Gratis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btn_medium_plan"
                        style="color: #4F4F4F; font-weight: 600; background: #EDE6DD; cursor: pointer;">Intermedio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btn_all_plan"
                        style="color: #4F4F4F; font-weight: 600; background: #EDE6DD; cursor: pointer;">Completo</a>
                </li>
            </ul>
            {{-- </div> --}}
            <div class="card-body" id="free_plan">
                <p class="mt-5 text-center" style="color:#4F4F4F; font-weight: 600; font-family: 'Fira Sans', sans-serif; font-size: 5em;">0 <strong style="font-size: 0.35em; font-weight: 200; color: #C3C3C3;">$/mes</strong> </p>
                <p class="card-text mt-5">Gestione y centralice su información. Visualice dato de conductores, vehículos y licencias de conducción.</p>
                <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Administración de flotas</p>
                <hr class="mt-0">
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 50 Transacciones (Registro Conductores) por mes.</p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1 usuario administrador</p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1 Tablero de análisis de datos básico. Análisis por persona y empresa.</p>
                <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Soporte</p>
                <hr class="mt-0">
                <p class="mb-5"> Asistencia para controles básicos: agregar, editar y eliminar información.</p>
            </div>
            <div class="card-body" id="medium_plan" hidden>
                <p class="mt-5 text-center" style="color:#4F4F4F; font-weight: 600; font-family: 'Fira Sans', sans-serif; font-size: 5em;">0 <strong style="font-size: 0.35em; font-weight: 200; color: #C3C3C3;">$/mes</strong> </p>
                <p class="card-text mt-5">Gestione y centralice su información. Visualice dato de conductores, vehículos y licencias de conducción, almacene información documental, valide datos de sus bases de datos vs información extraída de sus documentos digitales.</p>
                <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Administración de flotas</p>
                <hr class="mt-0">
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 50 Transacciones (Registro Conductores) por mes.</p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1 usuario administrador</p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1 Tablero de análisis de datos básico. Análisis por persona y empresa.</p>
                <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Soporte</p>
                <hr class="mt-0">
                <p class="mb-5"> Asistencia para controles básicos: agregar, editar y eliminar información.</p>
            </div>
            <div class="card-body" id="all_plan" hidden>
                <p class="mt-5 text-center" style="color:#4F4F4F; font-weight: 600; font-family: 'Fira Sans', sans-serif; font-size: 5em;">0 <strong style="font-size: 0.35em; font-weight: 200; color: #C3C3C3;">$/mes</strong> </p>
                <p class="card-text mt-5">Gestione y centralice su información. Visualice dato de conductores, vehículos y licencias de conducción, almacene información documental, valide datos de sus bases de datos vs información extraída de sus documentos digitales. Consulte datos de terceros en tiempo real (Multas, antecedentes penales)</p>
                <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Administración de flotas</p>
                <hr class="mt-0">
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 50 Transacciones (Registro Conductores) por mes.</p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1 usuario administrador</p>
                <p><i class="fas fa-check" style="color: #4BB996; font-size: 0.8em;"></i> 1 Tablero de análisis de datos básico. Análisis por persona y empresa.</p>
                <p class="text-left mt-5" style="margin-bottom: 0 !important; font-weight: 600;">Soporte</p>
                <hr class="mt-0">
                <p class="mb-5"> Asistencia para controles básicos: agregar, editar y eliminar información.</p>
            </div>
        </div>
    </div>
</div>
</div>
@endsection