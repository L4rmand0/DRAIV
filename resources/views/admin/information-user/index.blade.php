@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" name="driver-info-list-route" value="{{ route ('driver-info-list') }}"
        id="driver-info-list-route">
    <input type="hidden" name="update-driver-info-route" value="{{ route ('driver-info.update') }}"
        id="update-driver-info-route">
    <!-- Page Heading -->
    <div class="card mb-4" style="width: 100%;">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h1 class="h5 mb-0 text-gray-800" style="color:#515151 !important;">Información de Conductores</h1>
            </div>
        </div>
        <div class="card-body">
            <table id="drive_information_datatable" class="table table_dashboard table-striped nowrap" style="width:100%;">
            {{-- <table id="drive_information_datatable" class="table table-sm table-striped table-bordered table-hover nowrap"
                style="width:100%"> --}}
                <thead>
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
                        <th>Departamento</th>
                        <th>Ciudad Residencia</th>
                        <th>Número Celular</th>
                        <th>Estado Civil</th>
                        <th>Puntaje</th>
                        <th>Db_user_id</th>
                        <th>Company_id</th>
                        <th>Registro User</th>
                        <th>Compañía</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="card-footer">
            <div class="container text-center">
                <button class="btn btn-primary" type="button" style="margin-top: 17px;" data-toggle="modal"
                    data-target="#form_create_driver_information" id="modal_form_drive_info"><i class="fas fa-plus"></i> Agregar Registro</button>
            </div>
            <div class="container text-center">
                <button class="btn btn-success" type="button" style="margin-top: 17px;" data-toggle="modal"
                    data-target="#form_import_excel" id="modal_form_drive_info"><i class="fas fa-file-excel"></i> Importar Información Masiva</button>
            </div>
        </div>
    </div>
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Información de Conductores</h1>
    </div> --}}
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
                                <input type="text" name="driverInformation[first_name]" id="first_name"
                                    class="form-control form-dataconductores" placeholder="Primer Nombre" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="driverInformation[second_name]" id="second_name"
                                    class="form-control form-dataconductores" placeholder="Segundo Nombre">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-6">
                                <input type="text" name="driverInformation[f_last_name]" id="f_last_name"
                                    class="form-control form-dataconductores" placeholder="Primer Apellido" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="driverInformation[s_last_name]" id="s_last_name"
                                    class="form-control form-dataconductores" placeholder="Segundo Apellido">
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-6">
                                <input type="text" name="driverInformation[dni_id]" id="dni_id"
                                    class="form-control form-dataconductores" placeholder="Cédula" required>
                                <span class="error_admin input_user_admin" role="alert" id="dni_id-error">
                                    <strong id="dni_id-error-strong" class="error-strong"> </strong>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="driverInformation[e_mail_address]" id="e_mail_address"
                                    class="form-control form-dataconductores" placeholder="Correo Electrónico" required>
                                <span class="error_admin input_user_admin" role="alert" id="e_mail_address-error">
                                    <strong id="e_mail_address-error-strong" class="error-strong"> </strong>
                                </span>
                            </div>
                        </div>
                        <div class="row row_form_input_conductores" style="margin-top: 15px;">
                            <div class="col-md-6">
                                <input type="text" name="driverInformation[address]"
                                    class="form-control form-dataconductores" id="address" placeholder="Dirección" />
                            </div>
                            <div class="col-md-6">
                                <input type="tel" name="driverInformation[phone]"
                                    class="form-control form-dataconductores" id="phone" placeholder="Número Celular"
                                    required />
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-6 form_select_conductores">
                                <label for="gender">Género</label><br>
                                <select name="driverInformation[gender]" class="form-control" style="width: 100%"
                                    id="gender_form" required>
                                    <option value="">Seleccionar</option>
                                    <option value="0">Masculino</option>
                                    <option value="1">Femenino</option>
                                </select>
                            </div>
                            <div class="col-md-6 form_select_conductores">
                                <label for="education">Educación</label><br>
                                <select name="driverInformation[education]" class="form-control" style="width: 100%"
                                    id="education_form" required>
                                    <option value="">Seleccionar</option>
                                    @foreach ($list_education as $education_item)
                                    <option value="{{ $education_item }}">{{ $education_item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-6 form_select_conductores">
                                <label for="company_id">Compañía:</label><br>
                                <select name="driverInformation[company_id]" class="form-control" id="company_id_form"
                                    data-url="{{ route('company-select-list') }}" style="width: 100%" required>
                                </select>
                            </div>
                            <div class="col-md-6 form_select_conductores">
                                <label for="civil_state">Estado Civil</label><br>
                                <select name="driverInformation[civil_state]" class="form-control" style="width: 100%"
                                    id="civil_state_form" required>
                                    <option value="">Seleccionar</option>
                                    @foreach ($list_civil_state as $civil_state_item)
                                    <option value="{{ $civil_state_item }}">{{ $civil_state_item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 18px;">
                            <div class="col-md-6 form_select_conductores">
                                <label for="country_born">País</label><br>
                                <select name="driverInformation[country_born]" class="form-control" style="width: 100%"
                                    id="country_born" required>
                                    <option value="">Seleccionar</option>
                                    @foreach ($list_country_born as $country_item)
                                    <option value="{{ $country_item }}">{{ $country_item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form_select_conductores">
                                <label for="department_form">Departamento:</label><br>
                                <select name="driverInformation[department]" class="form-control" id="department_form"
                                    data-url="{{ route('admin2-select-lists') }}" style="width: 100%" required>
                                    <option value="">Seleccionar</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 18px;">
                            <div class="col-md-6 form_select_conductores">
                                <label for="city_born_form">Ciudad de Nacimiento:</label><br>
                                <select name="driverInformation[city_born]" class="form-control" id="city_born_form"
                                    data-url="{{ route('admin3-select-lists') }}" style="width: 100%" required>
                                </select>
                            </div>
                            <div class="col-md-6 form_select_conductores">
                                <label for="city_residence_place_form">Ciudad de Residencia:</label><br>
                                <select name="driverInformation[city_residence_place]" class="form-control"
                                    id="city_residence_place_form" data-url="{{ route('admin3-select-lists') }}"
                                    style="width: 100%" required disabled>
                                </select>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 18px;">
                            <div class="col-md-6 form_select_conductores">
                                <input type="text" name="driverInformation[score]" id="score_form"
                                    class="form-control form-dataconductores" placeholder="Puntaje" required>
                                <span class="error_admin input_user_admin" role="alert" id="score-error">
                                    <strong id="score-error-strong" class="error-strong"> </strong>
                                </span>
                            </div>
                        </div>

                        <input type="hidden" name="driverInformation[db_user_id]" id="db_user_id"
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
                            <select class="form-control" name="company_id" id="company_id_excel" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file_driver_info">Importar Información de Conductores</label>
                            <input type="file" class="form-control-file" id="file_driver_info" name="file"
                                style="margin-bottom: 7px;" required>
                            <a href="{{ asset('formats/formato_informacion_conductor.xlsx') }}" target="_blank"
                                style="color:green;"> <span class="excel_icon"></span> Descargar Formato</a>
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
<script>
    var enum_education = @json($enum_education);
    var enum_country_born = @json($enum_country_born);
    var enum_civil_state = @json($enum_civil_state);
    var list_cities = @json($enum_civil_state);
    var list_admin3 = @json($list_admin3);
</script>
@endsection
<!-- End of Main Content -->