<h2 class="ml-5 mt-5" style="color:#4F4F4F; font-weight: 700; font-family: 'Fira Sans', sans-serif;">
    Regístrese para una Cuenta DRAIV</h2>
<div class="card-body">
    <label class="text-center mb-3 mt-2 ml-5"
        style="color: #979797; font-size: 1.2em; font-family: 'Fira Sans', sans-serif;" for="">¿Ya tiene
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
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>

    </form>
</div>