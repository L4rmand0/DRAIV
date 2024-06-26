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
                            <ul id="progressbar" style="display: flex;justify-content: center;align-items: center;">
                                <li id="empty" class="active"><strong></strong></li>
                                <li id="personal" class="active"><strong>Datos Personales</strong></li>
                                <li id="vehicle"><strong>Vehículo</strong></li>
                                <li id="empty"><strong></strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset>
                                @include('admin.partials.register.driver_information')
                            </fieldset>
                            <fieldset data-licence="true">
                                @include('admin.partials.register.driving_licence')
                            </fieldset>
                            <fieldset data-endsection="true">
                                @include('admin.partials.register.images')
                            </fieldset>
                            <fieldset data-vehicle="true" id="fs_regis_vehicle">
                                @include('admin.partials.register.vehicle')
                            </fieldset> 
                            <fieldset>
                                @include('admin.partials.register.images_vehicle')
                            </fieldset>
                            <fieldset>
                                @include('admin.partials.register.finish')
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
<div id="example_form_vehicle_regis" hidden>
    @include('admin.partials.register.form_vehicle_regis')
</div>
<div id="example_card_container_vehicle_regis" hidden>
    @include('admin.partials.register.card_container_vehicle_regis')
</div>
<div id="example_select_vehicle_exist" hidden>
    <div class="select_vehicle_exist">
        <label for="plate_id1">Placa:</label>
        <select name="vehicle_exist[plate_id][]" class="form-control form-vehicles text-datadrivers select_plate_vehicle"
            id="plate_id&NUM" style="width: 55%">
            <option value="">Seleccionar...</option>
            @foreach ($select_all_vehicles as $item_vehicle)
            <option value="{{$item_vehicle->plate_id}}" data-type="{{$item_vehicle->type_v}}"> {{$item_vehicle->plate_id}} </option>
            @endforeach
        </select>
    </div>
</div>
<div hidden>
    @include('admin.partials.register.form_images_vehicle')
</div>
<div id="example_col_form_single_image_v" hidden>
    @include('admin.partials.register.form_single_image_vehicle')
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