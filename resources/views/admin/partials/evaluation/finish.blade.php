<div class="form-card">
    <h2 class="fs-title text-center">Completado !</h2> <br><br>
    <div class="row justify-content-center">
        <div class="col-3"> <img src="{{ asset('img/done.png') }}"
                class="fit-image"> </div>
    </div> <br><br>
    <div class="row justify-content-center">
        <div class="col-7 text-center">
            <h5>Has completado el registro de información!</h5>
            <a href="{{ route('welcome') }}" class="btn btn-success">Terminar</a>
            <a href="{{ route('admin','register_driver') }}" class="btn btn-info">Registrar conductores</a>
            <a href="{{ route('admin','register_evaluation') }}" class="btn btn-primary">Registrar otra evaluación</a>
        </div>
    </div>
</div>
