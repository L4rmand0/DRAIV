<h2 class="ml-5 mt-5" style="color:#4F4F4F; font-weight: 700; font-family: 'Fira Sans', sans-serif;">
    Iniciar sesión en su Cuenta DRAIV</h2>
<div class="card-body">
    <label class="text-center mb-2 mt-2 ml-5"
        style="color: #979797; font-size: 1.2em; font-family: 'Fira Sans', sans-serif;" for="">¿No tiene
        una cuenta DRAIV? <a
            style="color:#1A8ED1; cursor: pointer; font-size: 1em; font-family: 'Fira Sans', sans-serif;"
            id="btn_call_register" class="btn btn-link"> {{ __('Registrarse') }}
        </a></label>
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