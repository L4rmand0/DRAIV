@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container">
    <input type="hidden" name="update-driving-licence-route" value="{{ route ('driving_licence.update') }}"
        id="update-driving-licence-route">
    <input type="hidden" name="company-select-list-route" value="{{ route('company-select-list') }}"
        id="company-select-list-route">
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
                <th>Cédula</th>
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
                                <input type="text" name="drivingLicence[licence_num]"
                                    class="form-control form-dataconductores" placeholder="Número de licencia" required/>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 form_select_conductores">
                                <label for="country_expedition">País</label>
                                <select name="drivingLicence[country_expedition]" class="form-control"
                                    id="country_expedition" style="width: 100%; height: 100%;" required>
                                    <option value="">Seleccionar</option>
                                    @foreach ($list_country_expedition as $country_expedition_item)
                                        <option value="{{ $country_expedition_item }}">{{ $country_expedition_item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form_select_conductores">
                                <label for="category">Categoría</label>
                                <select name="drivingLicence[category]" class="form-control" id="category" style="width: 100%; height: 100%;" required>
                                    <option value="">Seleccionar</option>
                                    @foreach ($list_category as $category_item)
                                        <option value="{{ $category_item }}">{{ $category_item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 form_select_conductores">
                                <label for="state">Estado</label>
                                <select name="drivingLicence[state]" class="form-control" id="state" style="width: 100%; height: 100%;" required>
                                    <option value="">Seleccionar</option>
                                    @foreach ($list_state as $state_item)
                                        <option value="{{ $state_item }}">{{ $state_item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="driver_information_dni_id">C.C Conductor</label>
                                <select name="drivingLicence[driver_information_dni_id]" class="form-control" id="driver_information_dni_id" style="width: 100%; height: 100%;" data-url="{{ route('drivers-select-lists')}}" data-url-name="{{ route('drivers-get-name') }}" required>
                                </select> data-url-name="{{ route('drivers-get-name') }}" required>
                                </select>
                                <label class="text-info font-weight-bold" id="name_driver" style="margin-top: 12px;"></label>
                                <span class="error_admin input_user_admin" role="alert" id="driver_information_dni_id-error">
                                    <strong id="driver_information_dni_id-error-strong" class="error-strong"> </strong>
                                </span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6 form_select_conductores">
                                <label for="Expedition_day_form">Fecha de expedición*</label>
                                <input type="text" class="form-control" name="drivingLicence[expedition_day]" id="expedition_day_form" readonly required/>
                            </div>
                            <div class="col-6 form_select_conductores">
                                <label for="expi_date_form">Fecha de vencimiento*</label>
                                <input type="text" class="form-control" name="drivingLicence[expi_date]" id="expi_date_form" readonly required/>
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
                <form method="POST" action="{{ route('driver-info.import') }}" id="form_excel_driving_licence_admin"
                    data-url="{{ route('driving_licence.import') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-card">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">¿A cuál compañía desea cargar?</label>
                            <select class="form-control" name="company_id" id="company_id_excel" required>
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
<script>
    var enum_category = @json($enum_category);
    var enum_country_expedition = @json($enum_country_expedition);
    var enum_state = @json($enum_state);
    var list_country_expedition = @json($list_country_expedition);
    var list_category = @json($list_category);
    var list_state = @json($list_state);
</script>
@endsection
<!-- End of Main Content -->