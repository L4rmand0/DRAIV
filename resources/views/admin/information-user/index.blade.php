@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container">
    <input type="hidden" name="driver-info-list-route" value="{{ route ('driver-info-list') }}"
        id="driver-info-list-route">
    <input type="hidden" name="update-driver-info-route" value="{{ route ('driver-info.update') }}"
        id="update-driver-info-route">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Información de Conductores</h1>
    </div>
    <table id="drive_information_datatable" class="table table-bordered table-hover nowrap" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th></th>
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
                <th>Db_user_id</th>
                <th>Company_id</th>
                <th>Registro User</th>
                <th>Compañía</th>
            </tr>
        </thead>
    </table>
    <div class="container text-center">
        <button class="btn btn-dark" type="button" style="margin-top: 17px;" data-toggle="modal"
            data-target="#form_create_driver_information" id="modal_form_drive_info">Registrar Información</button>
    </div>
    <div class="container text-center">
        <button class="btn btn-success" type="button" style="margin-top: 17px;" data-toggle="modal"
            data-target="#form_import_excel" id="modal_form_drive_info"><span class="excel_icon"> </span>Importar Información Masiva</button>
    </div>
</div>

<div class="modal fade" id="form_create_driver_information" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Registrar Información de Conductor</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="form_driver_info_admin" data-url="{{ route('driver-info.store') }}"
                    data-url-delete="{{ route('driver-info.destroy') }}">
                    @csrf
                    <div class="form-card">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="userInformation[First_name]" id="First_name"
                                    class="form-control form-dataconductores" placeholder="Primer Nombre" required>
                                <small class="text-danger small_forms" id="small_f_name"></small>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="userInformation[Second_name]" id="Second_name"
                                    class="form-control form-dataconductores" placeholder="Segundo Nombre" required>
                                <small class="text-danger small_forms" id="small_s_name"></small>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-6">
                                <input type="text" name="userInformation[F_last_name]" id="F_last_name"
                                    class="form-control form-dataconductores" placeholder="Primer Apellido" required>
                                <small class="text-danger small_forms" id="small_f_lastname"></small>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="userInformation[S_last_name]" id="S_last_name"
                                    class="form-control form-dataconductores" placeholder="Segundo Apellido" required>
                                <small class="text-danger small_forms" id="small_s_lastname"></small>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-6">
                                <input type="text" name="userInformation[DNI_id]" id="DNI_id"
                                    class="form-control form-dataconductores" placeholder="Cédula" required>
                                <span class="error_admin input_user_admin" role="alert" id="DNI_id-error">
                                    <strong id="DNI_id-error-strong" class="error-strong"> </strong>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="userInformation[E_mail_address]" id="E_mail_address"
                                    class="form-control form-dataconductores" placeholder="Correo Electrónico" required>
                                <span class="error_admin input_user_admin" role="alert" id="E_mail_address-error">
                                    <strong id="E_mail_address-error-strong" class="error-strong"> </strong>
                                </span>
                            </div>
                        </div>
                        <div class="row row_form_input_conductores" style="margin-top: 15px;">
                            <div class="col-md-6">
                                <input type="text" name="userInformation[address]"
                                    class="form-control form-dataconductores" id="address" placeholder="Dirección" />
                                <small class="text-danger small_forms" id="small_address"></small>
                            </div>
                            <div class="col-md-6">
                                <input type="tel" name="userInformation[phone]"
                                    class="form-control form-dataconductores" id="phone" placeholder="Teléfono"
                                    required />
                                <small class="text-danger small_forms" id="small_phone"></small>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-6 form_select_conductores">
                                <label for="Gender">Género</label>
                                <select name="userInformation[Gender]" class="form-control form-dataconductores"
                                    id="Gender" required>
                                    <option value="">Seleccionar</option>
                                    <option value="0">Masculino</option>
                                    <option value="1">Femenino</option>
                                </select>
                                <small class="text-danger small_forms" id="small_gender"></small>
                            </div>
                            <div class="col-md-6 form_select_conductores">
                                <label for="Education">Educación</label>
                                <select name="userInformation[Education]" class="form-control form-dataconductores"
                                    id="Education" required>
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
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-6 form_select_conductores">
                                <label for="Country_born">País</label>
                                <select name="userInformation[Country_born]" class="form-control form-dataconductores"
                                    id="Country_born" required>
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
                                    id="Civil_state" required>
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
                        <div class="row" style="margin-top: 18px;">
                            <div class="col-md-6 form_select_conductores">
                                <label for="Company_id">Compañía:</label><br>
                                <select name="userInformation[Company_id]" class="form-control form-dataconductores"
                                    id="Company_id" data-url="{{ route('company-select-list') }}" style="width: 100%"
                                    required>
                                </select>
                                <small class="text-danger small_forms" id="small_civil_state"></small>
                            </div>

                            <div class="col-md-6 form_select_conductores">
                                <label for="Department">Departamento:</label><br>
                                <select name="userInformation[Department]" class="form-control form-dataconductores"
                                    id="Department" data-url="{{ route('admin2-select-lists') }}" style="width: 100%"
                                    required>

                                </select>
                                <small class="text-danger small_forms" id="small_civil_state"></small>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 18px;">

                            <div class="col-md-6 form_select_conductores">
                                <label for="City_born">Ciudad de Nacimiento:</label><br>
                                <select name="userInformation[City_born]" class="form-control form-dataconductores"
                                    id="City_born" data-url="{{ route('admin3-select-lists') }}" style="width: 100%"
                                    required>

                                </select>
                                <small class="text-danger small_forms" id="small_civil_state"></small>
                            </div>
                        </div>

                        <input type="hidden" name="userInformation[Db_user_id]" id="Db_user_id"
                            value="{{auth()->id()}}">
                        <div class="d-flex justify-content-center" style="margin-top: 25px;">
                            <input type="submit" value="Registrar" class="btn btn-primary">
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="form_import_excel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Registrar Información de Conductor</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('driver-info.import') }}" id="form_excel_driver_info_admin"
                    data-url="{{ route('driver-info.import') }}" data-url-delete="{{ route('driver-info.destroy') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-card">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">¿A cuál compañía desea cargar?</label>
                            <select class="form-control" name="Company_id" id="Company_id_excel" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file_driver_info">Importar Información de Conductores</label>
                            <input type="file" class="form-control-file" id="file_driver_info" name="file" required>
                            <div class="d-flex justify-content-center" style="margin-top: 25px;">
                                <input type="submit" value="Registrar" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
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