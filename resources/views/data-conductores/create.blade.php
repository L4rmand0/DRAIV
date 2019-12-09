@extends('layouts.app')
@section('content')
<small id="pageactive" data-page="#drivers"></small>
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
                                <li id="personal" class="active"><strong>Personal</strong></li>
                                <li id="Licence"><strong>Licencia</strong></li>
                                <li id="vehicle"><strong>Vehículo</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title" style="margin-bottom: 20px">Información de Usuario</h2>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="userInformation[First_name]" id="First_name"
                                                class="form-control form-dataconductores" placeholder="Primer Nombre">
                                            <small class="text-danger small_forms" id="small_f_name"></small>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="userInformation[Second_name]" id="Second_name"
                                                class="form-control form-dataconductores" placeholder="Segundo Nombre">
                                            <small class="text-danger small_forms" id="small_s_name"></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="userInformation[F_last_name]" id="F_last_name"
                                                class="form-control form-dataconductores" placeholder="Primer Apellido">
                                            <small class="text-danger small_forms" id="small_f_lastname"></small>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="userInformation[S_last_name]" id="S_last_name"
                                                class="form-control form-dataconductores"
                                                placeholder="Segundo Apellido">
                                            <small class="text-danger small_forms" id="small_s_lastname"></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="userInformation[DNI_id]" id="DNI_id"
                                                class="form-control form-dataconductores" placeholder="Cédula">
                                            <small class="text-danger small_forms" id="small_dni_id"></small>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="email" name="userInformation[E_mail_address]"
                                                id="E_mail_address" class="form-control form-dataconductores"
                                                placeholder="Correo Electrónico">
                                            <small class="text-danger small_forms" id="small_email"></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form_select_conductores">
                                            <label for="Gender">Género</label>
                                            <select name="userInformation[Gender]"
                                                class="form-control form-dataconductores" id="Gender">
                                                <option value="">Seleccionar</option>
                                                <option value="0">Masculino</option>
                                                <option value="1">Femenino</option>
                                            </select>
                                            <small class="text-danger small_forms" id="small_gender"></small>
                                        </div>
                                        <div class="col-md-6 form_select_conductores">
                                            <label for="Education">Educación</label>
                                            <select name="userInformation[Education]"
                                                class="form-control form-dataconductores" id="Education">
                                                <option value="">Seleccionar</option>
                                                <option value="Ninguno">Ninguno</option>
                                                <option value="Primaria">Primaria</option>
                                                <option value="Secundaria">Secundaria</option>
                                                <option value="Pregrado">Pregrado</option>
                                                <option value="Postgrado">Postgrado</option>
                                            </select>
                                            <small class="text-danger small_forms" id="small_education"></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form_select_conductores">
                                            <label for="Country_born">País</label>
                                            <select name="userInformation[Country_born]"
                                                class="form-control form-dataconductores" id="Country_born">
                                                <option value="">Seleccionar</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Brasil">Brasil</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                            <small class="text-danger small_forms" id="small_country"></small>
                                        </div>
                                        <div class="col-md-6 form_select_conductores">
                                            <label for="Civil_state">Estado Civil</label>
                                            <select name="userInformation[Civil_state]"
                                                class="form-control form-dataconductores" id="Civil_state">
                                                <option value="">Seleccionar</option>
                                                <option value="Soltero">Soltero</option>
                                                <option value="Casado">Casado</option>
                                                <option value="Separado">Separado</option>
                                                <option value="Divorciado">Divorciado</option>
                                                <option value="Viudo">Viudo</option>
                                                <option value="Union libre">Union libre</option>
                                                <option value="Sin información">Sin información</option>
                                            </select>
                                            <small class="text-danger small_forms" id="small_civil_state"></small>
                                        </div>
                                    </div>
                                    <div class="row row_form_input_conductores">
                                        <div class="col-md-6">
                                            <input type="text" name="userInformation[address]"
                                                class="form-control form-dataconductores" id="address"
                                                placeholder="Dirección" />
                                            <small class="text-danger small_forms" id="small_address"></small>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="tel" name="userInformation[phone]"
                                                class="form-control form-dataconductores" id="phone"
                                                placeholder="Teléfono" />
                                            <small class="text-danger small_forms" id="small_phone"></small>
                                        </div>
                                    </div>
                                    <input type="hidden" name="userInformation[Db_user_id]" id="Db_user_id"
                                        value="{{auth()->id()}}">
                                </div>
                                <input type="button" name="next" class="next action-button form-dataconductores"
                                    value="Next Step" id="fieldset_infouser"
                                    data-url="{{ route('user-information.validate') }}" data-error="info_user" />
                            </fieldset>

                            <fieldset>
                        <div class="form-card">
                            <h2 class="fs-title" style="margin-bottom: 20px">Información de Licencia</h2>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="drivingLicence[Licence_num]"
                                        class="form-control form-dataconductores" placeholder="Número de licencia" />
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
                                    <small class="text-danger small_forms" id="small_country_expedition"></small>
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
                                    <input type="date" name="drivingLicence[Expedition_day]" id="Expedition_day" />
                                    <small class="text-danger small_forms" id="small_expidition_day"></small>
                                </div>
                                <div class="col-6 form_select_conductores">
                                    <label for="">Fecha de vencimiento*</label>
                                    <input type="date" name="drivingLicence[Expi_date]" id="Expi_date" />
                                    <small class="text-danger small_forms" id="small_expi_date"></small>
                                </div>
                            </div>
                        </div>
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
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
                                            <input type="date" name="vehicle[Soat_expi_date]" id="Soat_expi_date" />
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
                        {{-- <fieldset>
                            <div class="row">
                                <div class="col-lg-8 mx-auto">
                                    <div class="p-4 bg-white shadow rounded-lg">
                                        <h2 class="fs-title" style="text-align: center">Agregar Imágenes</h2>
                                        <form method="POST" action="{{ route('saveimg') }}" accept-charset="UTF-8"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <button type="submit" class="btn" id="btn_upload_img"
                                                data-function="saveimg" data-url="{{ route('saveimg') }}"><img
                                                    src="https://res.cloudinary.com/mhmd/image/upload/v1557366994/img_epm3iz.png"
                                                    alt="" width="200"
                                                    class="d-block mx-auto mb-4 rounded-pill"></button>
                                            <h5 class="text-center">Click para subir</h5>
                                            <!-- Default bootstrap file upload-->
                                            <h6 class="text-center mb-4 text-muted">
                                                Tu puedes usar esta sección para subir imágenes
                                            </h6>
                                            <div class="custom-file overflow-hidden rounded-pill mb-5">
                                                <input id="customFile" type="file" name="file"
                                                    class="custom-file-input rounded-pill">
                                                <label for="customFile" class="custom-file-label rounded-pill">elegir
                                                    archivo</label>
                                            </div>
                                        </form>
                                        <!-- End -->
                                    </div>
                                </div>
                            </div>
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset> --}}
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
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="{{ asset('css/upload-form.css') }}" rel="stylesheet">
<link href="{{ asset('css/styleinfouser.css') }}" rel="stylesheet">
<script src="{{ asset('js/styleinfouser.js') }}" defer></script>
<script src="{{ asset('js/dataconductores.js') }}" defer></script>
@endsection