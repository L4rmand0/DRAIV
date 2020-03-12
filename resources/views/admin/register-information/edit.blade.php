@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<input type="hidden" name="route-search-information" id="route-search-information"
    value="{{ route('edit-driver.search') }}">
<input type="hidden" name="url-validate-driver-information" id="url-validate-driver-information" value="">
<input type="hidden" name="url-validate-driver-information" id="url-validate-driver-information" value="">
<input type="hidden" name="index_section" id="index_section">
<div class="container-fluid">
    <div class="row justify-content-center mt-0">
        <div class="card col-md-8"
            style="-webkit-box-shadow: 10px 10px 5px -3px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 5px -3px rgba(0,0,0,0.75);box-shadow: 10px 10px 5px -3px rgba(0,0,0,0.75);">
            <div class="card-body">
                <div class="active-pink-3 active-pink-4 mb-4">
                    <form id="form_search_information" action="">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Párametro de búsqueda: </label>
                                    <select name="search_param" id="" class="form-control">
                                        <option value="">Seleccionar ...</option>
                                        <option value="dni_id">Cédula</option>
                                        <option value="plate_id">Placa</option>
                                        <option value="first_name">Nombre</option>
                                        <option value="f_last_name">Apellido</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">&nbsp;</label>
                                    <input class="form-control" type="text" placeholder="Valor de búqueda ..."
                                        aria-label="Search" name="value_param">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <input type="submit" class="btn btn-primary" value="Buscar">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-0" id="container_card_driver" hidden>
        <div class="col-11 col-sm-9 col-md-9 col-lg-8 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3"
                style="-webkit-box-shadow: 10px 10px 5px -3px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 5px -3px rgba(0,0,0,0.75);box-shadow: 10px 10px 5px -3px rgba(0,0,0,0.75);">
                <div class="card-body">
                    <div class="container-profile mb-4">
                        <div class="item-pic" style="display: flex;align-items: center;justify-content: center;"><img
                                src="{{ asset('img/profile-admin.png') }}" alt="" style="width: 100%;"></div>
                        <div class="item-name" style="display: flex;align-items: center;justify-content: center;">
                            <h1 style="margin-bottom:0.3em;margin-top: 0.3em; font-size: 5em;" id="title_name_driver">
                                NOMBRE APELLIDO</h1>
                        </div>
                        <div class="item-id" style="display: flex;align-items: center;justify-content: center;">
                            <p class="p-profile"><strong>ID:</strong> <span id="title_dni_id"></span></p>
                        </div>
                        <div class="item-tel" style="display: flex;align-items: center;justify-content: center;">
                            <p class="p-profile"><strong>Teléfono:</strong> <span id="title_phone"></span></p>
                        </div>
                        <div class="item-contact" style="display: flex;align-items: center;justify-content: center;">
                            <p class="p-profile" style="margin-bottom: 1.2em !important;"><strong>Contacto de
                                    Emergencia:</strong> <span id="title_phone"></span></p>
                        </div>
                        <div class="item-alert" style="background-color: #EAFF71; border-top-right-radius: 1.3em;">
                            <p style="font-size: 2em;font-size:1.6em;margin-top: 0.2em;"><strong>Alertas:</strong></p>
                        </div>
                        <div class="item-soat" style="background-color: #EAFF71;">
                            <div class="box-text" style="margin-right: 0.9em; margin-left: 1.5em;font-size: 0.8em;">
                                <p id="title_expired_soat">Soat Vencido</p>
                            </div>
                        </div>
                        <div class="item-comp"
                            style="background-color: #EAFF71;display: flex;align-items: center;justify-content: center;font-size: 0.8em;">
                            <div class="box-text" style="margin-bottom:1em;">
                                <p>0</p>
                                <p>comparendos</p>
                            </div>
                        </div>
                        <div class="item-ex" style="background-color: #EAFF71; border-bottom-right-radius: 1.3em;">
                            <div class="box-text" style="margin-right:1.5em; margin-left: 0.9em;font-size: 0.8em;">
                                <p>Sin examen</p>
                            </div>
                        </div>
                    </div>
                    <nav>
                        <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link a-profile active" id="nav-home-tab" data-toggle="tab"
                                href="#nav-driver-information" role="tab" aria-controls="nav-home"
                                aria-selected="true"><i class="fas fa-user-circle"></i>
                                Datos personales</a>
                            <a class="nav-item nav-link a-profile" id="nav-profile-tab" data-toggle="tab"
                                href="#nav-vehicle" role="tab" aria-controls="nav-profile" aria-selected="false"><i
                                    class="fas fa-car"></i>
                                Vehículo</a>
                            <a class="nav-item nav-link a-profile" id="nav-contact-tab" data-toggle="tab"
                                href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><i
                                    class="fas fa-users-cog"></i> Componente Humano</a>
                            <a class="nav-item nav-link a-profile" id="nav-contact-tab" data-toggle="tab"
                                href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><i
                                    class="fas fa-tools"></i>
                                Componente Técnico</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        @include('admin.register-information.partials.edit_form_driver_information')
                        @include('admin.register-information.partials.edit_form_vehicle')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
<link href="{{ asset('css/profile-admin.css') }}" rel="stylesheet">
<script src="{{ asset('js/admin/edit_driver.js') }}" defer></script>
<script>
</script>
@endsection
<!-- End of Main Content -->