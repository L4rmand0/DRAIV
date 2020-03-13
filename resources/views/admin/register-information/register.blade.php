@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<input type="hidden" name="url-validate-driver-information" id="url-validate-driver-information" value="">
<input type="hidden" name="url-register-primary-information" id="route-register-primary-information" value="{{ route('register-driver.primary-information') }}">
<input type="hidden" name="url-register-secondary-information" id="route-register-secondary-information" value="{{ route('register-driver.secondary-information') }}">
<input type="hidden" name="index_section" id="index_section">
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-8 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3" style="-webkit-box-shadow: 10px 10px 5px -3px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 5px -3px rgba(0,0,0,0.75);box-shadow: 10px 10px 5px -3px rgba(0,0,0,0.75);">
                <h2><strong>Registro de Información</strong></h2>
                <p>Llene todo los campos del formulario y vaya al siguiente paso</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form action="" method="POST" id="msform" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li id="personal" class="active"><strong>Datos Personales</strong></li>
                                <li id="Licence"><strong>Licencia</strong></li>
                                <li id="photos"><strong>Imágenes</strong></li>
                                <li id="vehicle"><strong>Vehículo</strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset data-endsection="true">
                                @include('admin.partials.register.driver_information')
                            </fieldset>
                            <fieldset data-endsection="true" data-licence="true">
                                @include('admin.partials.register.driving_licence')
                            </fieldset>
                            <fieldset data-endsection="true">
                                @include('admin.partials.register.images')
                            </fieldset>
                            <fieldset data-vehicle="true">
                                @include('admin.partials.register.vehicle')
                            </fieldset> 
                            <fieldset>
                                @include('admin.partials.register.images_vehicle')
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Completado !</h2> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png"
                                                class="fit-image"> </div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5>Has completado el registro de información!</h5>
                                            <a href="{{ route('welcome') }}">Terminar</a>
                                            <a href="{{ route('admin','driver_information') }}">Registrar otro conductor</a>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous"
                                    value="Anterior" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div hidden>
    @include('admin.partials.register.form_vehicle')
</div>
<div hidden>
    @include('admin.partials.register.doc_verification')
</div>
<div hidden>
    @include('admin.partials.register.form_images_vehicle')
</div>

<!-- /.container-fluid -->
<link href="{{ asset('css/upload-form.css') }}" rel="stylesheet">
<link href="{{ asset('css/styleinfouser.css') }}" rel="stylesheet">
<script src="{{ asset('js/dataconductores.js') }}" defer></script>
<script src="{{ asset('js/styleinfouser.js') }}" defer></script>
<script>
</script>
@endsection
<!-- End of Main Content -->