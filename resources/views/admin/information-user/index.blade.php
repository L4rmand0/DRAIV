@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container">
    <input type="hidden" name="driver-info-list-route" value="{{ route ('driver-info-list') }}"
        id="driver-info-list-route">
    <input type="hidden" name="update-driver-info-route" value="{{ route ('driver-info.update') }}" id="update-driver-info-route">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Información de Conductores</h1>
    </div>
    <table id="drive_information_datatable" class="table table-bordered table-hover nowrap" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th>Cédula</th>
                <th>Primer Nombre</th>
                <th>Segundo Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Género</th>
                <th>Educación</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>País</th>
                <th>Ciudad</th>
                <th>Ciudad Res</th>
                <th>Departamento</th>
                <th>Teléfono</th>
                <th>Estado Civil</th>
                <th>Puntaje</th>
                <th>User</th>
                <th>Compañía</th>
            </tr>
        </thead>
    </table>
    <div class="container text-center">
        <button class="btn btn-dark" type="button" style="margin-top: 17px;" data-toggle="modal"
            data-target="#form_create_driver_information">Registrar Información</button>
    </div>
</div>

<div class="modal fade" id="form_create_driver_information" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar un nuevo usuario</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="" id="form_user_admin">
                    @csrf
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
                                    class="form-control form-dataconductores" placeholder="Segundo Apellido">
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
                                <input type="email" name="userInformation[E_mail_address]" id="E_mail_address"
                                    class="form-control form-dataconductores" placeholder="Correo Electrónico">
                                <small class="text-danger small_forms" id="small_email"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form_select_conductores">
                                <label for="Gender">Género</label>
                                <select name="userInformation[Gender]" class="form-control form-dataconductores"
                                    id="Gender">
                                    <option value="">Seleccionar</option>
                                    <option value="0">Masculino</option>
                                    <option value="1">Femenino</option>
                                </select>
                                <small class="text-danger small_forms" id="small_gender"></small>
                            </div>
                            <div class="col-md-6 form_select_conductores">
                                <label for="Education">Educación</label>
                                <select name="userInformation[Education]" class="form-control form-dataconductores"
                                    id="Education">
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
                                <select name="userInformation[Country_born]" class="form-control form-dataconductores"
                                    id="Country_born">
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
                                <select name="userInformation[Civil_state]" class="form-control form-dataconductores"
                                    id="Civil_state">
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
                                    class="form-control form-dataconductores" id="address" placeholder="Dirección" />
                                <small class="text-danger small_forms" id="small_address"></small>
                            </div>
                            <div class="col-md-6">
                                <input type="tel" name="userInformation[phone]"
                                    class="form-control form-dataconductores" id="phone" placeholder="Teléfono" />
                                <small class="text-danger small_forms" id="small_phone"></small>
                            </div>
                        </div>
                        <input type="hidden" name="userInformation[Db_user_id]" id="Db_user_id"
                            value="{{auth()->id()}}">
                    </div>
                    <input type="button" name="next" class="next action-button form-dataconductores" value="Next Step"
                        id="fieldset_infouser" data-url="{{ route('user-information.validate') }}"
                        data-error="info_user" />
                    <!-- Button trigger modal -->

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<script src="{{ asset('js/admin/drive-information.js') }}" defer></script>
@endsection
<!-- End of Main Content -->