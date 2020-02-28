@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<input type="hidden" name="url-validate-driver-information" id="url-validate-driver-information" value="">
<input type="hidden" name="url-validate-driver-information" id="url-validate-driver-information" value="">
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Información Personal</strong></h2>
                <p>Llene todo los campos del formulario y vaya al siguiente paso</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form action="" method="POST" id="msform" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li id="personal" class="active"><strong>Datos Personales</strong></li>
                                <li id="vehicle"><strong>Vehículo</strong></li>
                                <li id="Licence"><strong>Componente Humano</strong></li>
                                <li id="tech_component"><strong>Componente Técnico</strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset>
                                @include('admin.partials.register.driver_information')
                            </fieldset>

                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title" style="margin-bottom: 20px">Información de Licencia</h2>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="text" name="drivingLicence[Licence_num]"
                                                class="form-control form-dataconductores"
                                                placeholder="Número de licencia" />
                                            <small class="text-danger small_forms" id="small_licence_num"></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form_select_conductores">
                                            <label for="Country_expedition">País</label>
                                            <select name="drivingLicence[Country_expedition]" class="form-control"
                                                id="Country_expedition">
                                                <option value="">Seleccionar</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Brasil">Brasil</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                            <small class="text-danger small_forms"
                                                id="small_country_expedition"></small>
                                        </div>
                                        <div class="col-md-6 form_select_conductores">
                                            <label for="Category">Categoría</label>
                                            <select name="drivingLicence[Category]" class="form-control" id="Category">
                                                <option value="">Seleccionar</option>
                                                <option value="A1">A1</option>
                                                <option value="A2">A2</option>
                                                <option value="B1">B1</option>
                                                <option value="B2">B2</option>
                                                <option value="C1">C1</option>
                                                <option value="C2">C2</option>
                                                <option value="C2">C3</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                            <small class="text-danger small_forms" id="small_category"></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 form_select_conductores">
                                            <label for="State">Estado</label>
                                            <select name="drivingLicence[State]" class="form-control" id="State">
                                                <option value="">Seleccionar</option>
                                                <option value="Vigente">Vigente</option>
                                                <option value="Vencida">Vencida</option>
                                                <option value="Suspendida">Suspendida</option>
                                            </select>
                                            <small class="text-danger small_forms" id="small_state"></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 form_select_conductores">
                                            <label for="Expedition_day">Fecha de expedición*</label>
                                            <input type="date" name="drivingLicence[Expedition_day]"
                                                id="Expedition_day" />
                                            <small class="text-danger small_forms" id="small_expidition_day"></small>
                                        </div>
                                        <div class="col-6 form_select_conductores">
                                            <label for="">Fecha de vencimiento*</label>
                                            <input type="date" name="drivingLicence[Expi_date]" id="Expi_date" />
                                            <small class="text-danger small_forms" id="small_expi_date"></small>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous"
                                    value="Previous" />
                                <input type="button" name="next" class="next action-button" value="Next Step"
                                    data-url="{{ route('driving-licence.validate') }}" data-error="driving_licence" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Información Del Vehículo</h2>
                                    <div class="form-group">
                                        <input type="text" name="vehicle[Plate_id]" placeholder="Placa" />
                                        <small class="text-danger small_forms" id="small_plate_id"></small>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="Type_V">Tipo</label>
                                            <select name="vehicle[Type_V]" class="form-control" id="Type_V">
                                                <option value="">Seleccionar...</option>
                                                <option value="Carro">Carro</option>
                                                <option value="Moto">Moto</option>
                                                <option value="Furgón">Furgón</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                            <small class="text-danger small_forms" id="small_type_v"></small>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="Owner_V">Dueño</label>
                                            <select name="vehicle[Owner_V]" class="form-control" id="Owner_V">
                                                <option value="">Seleccionar...</option>
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                            <small class="text-danger small_forms" id="small_owner_v"></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form_select_conductores">
                                            <label for="Taxi_type">Tipo de Taxi</label>
                                            <select name="vehicle[Taxi_type]" class="form-control" id="Taxi_type">
                                                <option value="">Seleccionar...</option>
                                                <option value="Taxi amarillo">Taxi amarillo</option>
                                                <option value="Taxi blanco">Taxi blanco</option>
                                                <option value="NA">NA</option>
                                            </select>
                                            <small class="text-danger small_forms" id="small_taxi_type"></small>
                                        </div>
                                        <div class="col-md-6 form_select_conductores">
                                            <label for="taxi_Number_of_drivers">Número de conductores Taxi</label>
                                            <select name="vehicle[taxi_Number_of_drivers]" class="form-control"
                                                id="taxi_Number_of_drivers">
                                                <option value="">Seleccionar...</option>
                                                <option value="1">Si</option>
                                                <option value="0">No</option>
                                            </select>
                                            <small class="text-danger small_forms" id="small_taxi_number"></small>
                                        </div>
                                    </div>
                                    <div class="row row_form_input_vehicle">
                                        <div class="col-md-8">
                                            <label for="Soat_expi_date">Fecha de vencimiento de soat*</label>
                                            <input type="date" name="vehicle[Soat_expi_date]"
                                                id="user_Soat_expi_date" />
                                            <small class="text-danger small_forms" id="small_soat_expi_date"></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 form_select_conductores">
                                            <label for="Capacity">Cantidad de pasajeros</label>
                                            <select name="vehicle[Capacity]" class="form-control" id="Capacity">
                                                <option value="">Seleccionar...</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                            <small class="text-danger small_forms" id="small_capacity"></small>
                                        </div>
                                        <div class="col-md-8 form_select_conductores">
                                            <label for="Service">Servicio</label>
                                            <select name="vehicle[Service]" class="form-control" id="Service">
                                                <option value="">Seleccionar...</option>
                                                <option value="Particular">Particular</option>
                                                <option value="Transporte_mercancia">Transporte Mercancia</option>
                                                <option value="Transporte_publico">Transporte Público</option>
                                                <option value="Otros">Otros</option>
                                                <small class="text-danger small_forms" id="small_service"></small>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row row_form_input_conductores">
                                        <div class="col-md-6">
                                            <input type="text" name="vehicle[Cylindrical_cc]"
                                                placeholder="Cilindraje" />
                                            <small class="text-danger small_forms" id="Cylindrical_cc"></small>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="vehicle[V_class]"
                                                placeholder="Clase de Vehículo" />
                                            <small class="text-danger small_forms" id="V_class"></small>
                                        </div>
                                    </div>
                                    <div class="row row_form_input_conductores">
                                        <div class="col-md-6">
                                            <input type="text" name="vehicle[Model]" placeholder="Modelo" />
                                            <small class="text-danger small_forms" id="Model"></small>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="vehicle[Line]" placeholder="Línea" />
                                            <small class="text-danger small_forms" id="Line"></small>
                                        </div>
                                    </div>
                                    <div class="row row_form_input_conductores">
                                        <div class="col-md-6">
                                            <input type="text" name="vehicle[Brand]" placeholder="Marca" />
                                            <small class="text-danger small_forms" id="small_capacity"></small>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="vehicle[Color]" placeholder="Color" />
                                            <small class="text-danger small_forms" id="small_capacity"></small>
                                        </div>
                                    </div>
                                    <div class="row row_form_input_conductores">
                                        <div class="col-md-6">
                                            <label for="technomechanical_date">Fecha de Tecnomecánica</label>
                                            <input type="date" name="vehicle[technomechanical_date]"
                                                id="technomechanical_date" />
                                            <small class="text-danger small_forms" id="small_capacity"></small>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous"
                                    value="Previous" />
                                <input type="button" class="next action-button" value="Confirm"
                                    data-url="{{ route('vehicle.validate') }}" data-error="vehicle" />

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
                                            <h5>Has completado el registro de información</h5>
                                            <a href="{{ route('welcome') }}">Terminar</a>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous"
                                    value="Previous" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
<link href="{{ asset('css/upload-form.css') }}" rel="stylesheet">
<link href="{{ asset('css/styleinfouser.css') }}" rel="stylesheet">
<script src="{{ asset('js/styleinfouser.js') }}" defer></script>
<script src="{{ asset('js/dataconductores.js') }}" defer></script>
<script>
</script>
@endsection
<!-- End of Main Content -->