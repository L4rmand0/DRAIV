@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container">
    <input type="hidden" name="update-driver-info-route" value="{{ route ('driver-info.update') }}"
        id="update-driver-info-route">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Licencia de Conducir</h1>
    </div>
    <table id="driving_licence_datatable" class="table table-bordered table-hover nowrap" style="width:100%"
        data-url-list="{{ route ('driving-licence-list') }}" data-url-delete="{{ route ('driving_licence.destroy') }}">
        <thead class="thead-dark">
            <tr>
                <th></th>
                <th>Licence_id</th>
                <th>Número de Licencia</th>
                <th>User_information_DNI_id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>País de Expedición</th>
                <th>Categoría</th>
                <th>Estado</th>
                <th>Fecha de Expedición</th>
                <th>Fecha de Vencimiento</th>
            </tr>
        </thead>
    </table>
    <div class="container text-center">
        <button class="btn btn-dark" type="button" style="margin-top: 17px;" data-toggle="modal"
            data-target="#form_create_driving_licence" id="modal_form_create_driving_licence">Registrar
            Información</button>
    </div>
    <div class="container text-center">
        <button class="btn btn-success" type="button" style="margin-top: 17px;" data-toggle="modal"
            data-target="#form_import_excel" id="modal_form_drive_info"><span class="excel_icon"> </span>Importar
            Información Masiva</button>
    </div>
</div>

<div class="modal fade" id="form_create_driving_licence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Registrar Información de Licencia</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="form_driving_licence_admin" data-url="{{ route('driving_licence.store') }}">
                    @csrf
                    <div class="form-card">
                        <div class="row mt-1">
                            <div class="col-md-6">
                                <input type="text" name="drivingLicence[Licence_num]"
                                    class="form-control form-dataconductores" placeholder="Número de licencia" required/>
                                <small class="text-danger small_forms" id="small_licence_num"></small>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 form_select_conductores">
                                <label for="Country_expedition">País</label>
                                <select name="drivingLicence[Country_expedition]" class="form-control"
                                    id="Country_expedition" style="width: 100%; height: 100%;" required>
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
                                <select name="drivingLicence[Category]" class="form-control" id="Category" style="width: 100%; height: 100%;" required>
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
                        <div class="row mt-2">
                            <div class="col-md-6 form_select_conductores">
                                <label for="State">Estado</label>
                                <select name="drivingLicence[State]" class="form-control" id="State" style="width: 100%; height: 100%;" required>
                                    <option value="">Seleccionar</option>
                                    <option value="Vigente">Vigente</option>
                                    <option value="Vencida">Vencida</option>
                                    <option value="Suspendida">Suspendida</option>
                                </select>
                                <small class="text-danger small_forms" id="small_state"></small>
                            </div>
                            <div class="col-md-6">
                                <label for="State">Conductor</label>
                                <select name="drivingLicence[User_information_DNI_id]" class="form-control" id="User_information_DNI_id" style="width: 100%; height: 100%;" data-url="{{ route('drivers-select-lists') }}" data-url-name="{{ route('drivers-get-name') }}" required>
                                </select>
                                <label class="text-info font-weight-bold" id="name_driver" style="margin-top: 12px;"></label>
                                <span class="error_admin input_user_admin" role="alert" id="User_information_DNI_id-error">
                                    <strong id="User_information_DNI_id-error-strong" class="error-strong"> </strong>
                                </span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 form_select_conductores">
                                <label for="Expedition_day">Fecha de expedición*</label>
                                <input type="text" class="form-control" name="drivingLicence[Expedition_day]" id="Expedition_day" readonly required/>
                                <small class="text-danger small_forms" id="small_expidition_day"></small>
                            </div>
                            <div class="col-6 form_select_conductores">
                                <label for="">Fecha de vencimiento*</label>
                                <input type="text" class="form-control" name="drivingLicence[Expi_date]" id="Expi_date" readonly required/>
                                <small class="text-danger small_forms" id="small_expi_date"></small>
                            </div>
                        </div>
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
                    data-url="{{ route('driver-info.import') }}" enctype="multipart/form-data">
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
<script src="{{ asset('js/admin/driving-licence.js') }}" defer></script>
@endsection
<!-- End of Main Content -->