@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->

<div class="container-fluid">
    <input type="hidden" name="update-vehicle-route" value="{{ route ('admin.vehicle.update') }}"
        id="update-vehicle-route">
    <input type="hidden" name="company-select-list-route" value="{{ route('company-select-list') }}"
        id="company-select-list-route">
    <input type="hidden" name="drivers-select-list-route" value="{{ route('drivers-select-lists') }}"
        id="drivers-select-list-route">
    <!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h1 class="h5 mb-0 text-gray-800" style="color:#515151 !important;">Información de Vehículos</h1>
            </div>
        </div>
        <div class="card-body">
            <table id="vehicle_datatable" class="table table_dashboard table-striped"
                style="width:100%;" data-url-list="{{ route ('vehicle-list') }}"
                data-url-delete="{{ route ('vehicle-admin.destroy') }}">
                <thead>
                    <tr>
                        <th></th>
                        <th>Placa</th>
                        <th>Tipo</th>
                        <th>Propietario</th>
                        <th>Tipo de Taxi</th>
                        <th>Número de Conductores</th>
                        <th>Fecha de Vencimiento Soat</th>
                        <th>Capacidad</th>
                        <th>Servicio</th>
                        <th>Cilindraje</th>
                        <th>Clase Vehículo</th>
                        <th>modelo</th>
                        <th>Línea</th>
                        <th>Marca</th>
                        <th>Color</th>
                        <th>Fecha de Tecnomecánica</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="card-footer">
            <div class="container text-center">
                <button class="btn btn-primary" type="button" style="margin-top: 17px;" data-toggle="modal"
                    data-target="#form_create_vehicle" id="modal_form_create_vehicle"><i class="fas fa-plus"></i> Agregar Registro</button>
                <div class="container text-center">
                    <button class="btn btn-success" type="button" style="margin-top: 17px;" data-toggle="modal"
                        data-target="#form_import_excel" id="modal_form_drive_info"><i class="fas fa-file-excel"></i> Importar
                        Información Masiva</button>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Información de Vehículos</h1>
    </div> --}}
    <div id="div-table-relation-vehicle-driver" class="mt-3 mb-5" hidden>
        <div class="card">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h5 mb-0 text-gray-800" style="color:#515151 !important;">Conductores del Vehículo
                    </h1>
                </div>
            </div>
            <div class="card-body">
                <table id="relation_driver_vehicle_datatable"
                    class="table table-striped table-bordered table-hover nowrap" style="width:100%"
                    data-url-list="{{ route ('driver-vehicle-list') }}"
                    data-url-delete="{{ route ('admin.driver-vehicle.destroy') }}">
                    <thead>
                        <tr>
                            <th></th>
                            <th>id</th>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Placa</th>
                            <th>Tipo Vehículo</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-footer">
                {{-- <div class="container text-center">
                        <button class="btn btn-primary" type="button" data-toggle="modal"
                            data-target="#form_create_user"><span class="plus_icon icons-fa"></span> Agregar
                            Registro</button>
                    </div> --}}
                <div class="text-center">
                    <center><button type="button" id="add_driver_vehicle" class="btn btn-primary" data-toggle="modal"
                            data-target="#add_driver_vehicle_modal"><i class="fas fa-plus"></i> Agregar
                            Registro</button>
                    </center>
                </div>
            </div>
        </div>
        {{-- <h4 class="text-primary d-flex justify-content-center">Conductores del Vehículo</h4> --}}
        {{-- <div class="text-center">
                <center><button type="button" id="add_driver_vehicle" class="btn btn-primary" data-toggle="modal"
                        data-target="#add_driver_vehicle_modal"><span class="plus_icon"></span> Agregar</button>
                </center>
            </div> --}}
    </div>


    <div class="modal fade" id="form_create_vehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Registrar Información del Vehículo</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="form_vehicle_admin" data-url="{{ route('admin.vehicle.store') }}"
                        data-url-delete="{{ route('driver-info.destroy') }}">
                        @csrf
                        <div class="form-card">
                            <div class="row">
                                <div class="col-md-6">
                                    <input class="form-control form-vehicles" type="text" name="vehicle[plate_id]"
                                        placeholder="Placa" id="plate_id_form"
                                        data-check="{{ route('admin.vehicle.checkvehiclebyid') }}" />
                                    <span class="error_admin input_user_admin" role="alert" id="plate_id-error">
                                        <strong id="plate_id-error-strong" class="error-strong"> </strong>
                                    </span>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label for="type_v">Tipo</label>
                                    <select name="vehicle[type_v]" class="form-control form-vehicles" id="type_v_form"
                                        style="width: 100%">
                                        <option value="">Seleccionar...</option>
                                        @foreach ($list_type_v as $item_type_v)
                                        <option value="{{$item_type_v}}"> {{$item_type_v}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="owner_v">Dueño</label>
                                    <select name="vehicle[owner_v]" class="form-control form-vehicles" id="owner_v_form"
                                        style="width: 100%" required>
                                        <option value="">Seleccionar...</option>
                                        <option value="Y">Si</option>
                                        <option value="N">No</option>
                                    </select>
                                    <span class="error_admin input_user_admin" role="alert" id="owner_v-error">
                                        <strong id="owner_v-error-strong" class="error-strong"> </strong>
                                    </span>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6 form_select_conductores" id="row-taxi-inputs" hidden>
                                    <label for="taxi_type">Tipo de Taxi</label>
                                    <select name="vehicle[taxi_type]" class="form-control form-vehicles"
                                        id="taxi_type_form" style="width: 100%">
                                        <option value="">Seleccionar...</option>
                                        @foreach ($list_taxi_type as $item_taxi_type)
                                        <option value="{{$item_taxi_type}}"> {{$item_taxi_type}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 form_select_conductores">
                                    <label for="number_of_drivers_form">Número de conductores</label>
                                    <select name="vehicle[number_of_drivers]" class="form-control form-vehicles"
                                        id="number_of_drivers_form" style="width: 100%">
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
                                    </select>
                                </div>
                            </div>
                            <div class="row row_form_input_vehicle mt-2">
                                <div class="col-md-6">
                                    <label for="soat_expi_date_form">Fecha de vencimiento de soat</label>
                                    <input type="date" class="form-control form-vehicles" name="vehicle[soat_expi_date]"
                                        id="soat_expi_date_form" readonly required />
                                    <span class="error_admin input_user_admin" role="alert" id="soat_expi_date-error">
                                        <strong id="soat_expi_date-error-strong" class="error-strong"> </strong>
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <label for="technomechanical_date_form">Fecha de Tecnomecánica</label>
                                    <input type="date" class="form-control form-vehicles"
                                        name="vehicle[technomechanical_date]" id="technomechanical_date_form"
                                        readonly />
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6 form_select_conductores">
                                    <label for="capacity">Cantidad de pasajeros</label>
                                    <select name="vehicle[capacity]" class="form-control form-vehicles"
                                        id="capacity_form" style="width: 100%">
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
                                </div>
                                <div class="col-md-6 form_select_conductores">
                                    <label for="service">Servicio</label>
                                    <select name="vehicle[service]" class="form-control form-vehicles" id="service_form"
                                        style="width: 100%">
                                        <option value="">Seleccionar...</option>
                                        @foreach ($list_service as $item_service)
                                        <option value="{{$item_service}}"> {{$item_service}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row row_form_input_conductores mt-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-vehicles" name="vehicle[cylindrical_cc]"
                                        id=cylindrical_cc_form"" placeholder="Cilindraje" />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-vehicles" name="vehicle[v_class]"
                                        id="v_class_form" placeholder="Clase de Vehículo" />
                                </div>
                            </div>
                            <div class="row row_form_input_conductores mt-2">
                                <div class="col-md-6">
                                    <input type="number" class="form-control form-vehicles" name="vehicle[model]"
                                        min="1950" max="2030" placeholder="Modelo (año)" id="model_form" />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-vehicles" name="vehicle[line]"
                                        placeholder="Línea" id="line_form" />
                                </div>
                            </div>
                            <div class="row row_form_input_conductores mt-2">
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-vehicles" name="vehicle[brand]"
                                        placeholder="Marca" id="brand_form" />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control form-vehicles" name="vehicle[color]"
                                        placeholder="Color" id="color_form" />
                                </div>
                            </div>
                            <div id="vehicle_drivers_relation" hidden>
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
                    <h4 class="modal-title" id="exampleModalLabel">Registor Masivo de Vehículos</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.vehicle.import') }}" id="form_excel_vehicle_admin"
                        data-url="{{ route('admin.vehicle.import') }}"
                        data-url-delete="{{ route('driver-info.destroy') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-card">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">¿A cuál compañía desea cargar?</label>
                                <select class="form-control" name="company_id" id="company_id_excel" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="file_driver_info">Importar Información de Vehículos</label>
                                <input type="file" class="form-control-file" id="file_driver_info" name="file"
                                    style="margin-bottom: 7px;" required>
                                <a href="{{ asset('formats/formato_vehiculo.xlsx') }}" target="_blank"
                                    style="color:green;">
                                    <span class="excel_icon"></span> Descargar Formato</a>
                                <div class="d-flex justify-content-center" style="margin-top: 22px;">
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


    <div class="modal fade" id="add_driver_vehicle_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Asignar conductor al vehículo</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.vehicle.add-driver-vehicle') }}"
                        id="form_add_vehicle_driver" data-url="{{ route('admin.vehicle.add-driver-vehicle') }}"
                        data-url-delete="{{ route('driver-info.destroy') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="vehicle_plate_id" id="vehicle_plate_id_add">
                        <div class="form-card">
                            <div class="form-group">
                                <label for="driver_information_dni_id">C.C Conductor</label>
                                <select name="driver_information_dni_id" class="form-control"
                                    id="driver_information_dni_id_form" style="width: 100%; height: 100%;"
                                    data-url="{{ route('drivers-select-lists')}}"
                                    data-url-name="{{ route('drivers-get-name') }}" required>
                                </select>
                                <label class="text-info font-weight-bold" id="name_driver"
                                    style="margin-top: 12px;"></label>
                                <span class="error_admin input_user_admin" role="alert"
                                    id="driver_information_dni_id-error">
                                    <strong id="driver_information_dni_id-error-strong" class="error-strong"> </strong>
                                </span>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-secondary" type="submit">Agregar</button>
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
    <script src="{{ asset('js/admin/vehicle.js') }}" defer></script>
    <script>
        var enum_type_v = @json($enum_type_v);
    var enum_service = @json($enum_service);
    var enum_taxi_type = @json($enum_taxi_type); 
    var list_type_v = @json($list_type_v); 
    var list_service = @json($list_service); 
    var list_taxi_type = @json($list_taxi_type); 
    </script>
    @endsection
    <!-- End of Main Content -->