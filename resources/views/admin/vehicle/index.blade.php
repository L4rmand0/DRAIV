@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container">
    <input type="hidden" name="update-vehicle-route" value="{{ route ('admin.vehicle.update') }}"
        id="update-vehicle-route">
    <input type="hidden" name="company-select-list-route" value="{{ route('company-select-list') }}"
        id="company-select-list-route">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Información de Vehículos</h1>
    </div>
    <table id="vehicle_datatable" class="table table-bordered table-hover nowrap" style="width:100%"
        data-url-list="{{ route ('vehicle-list') }}" data-url-delete="{{ route ('vehicle-admin.destroy') }}">
        <thead class="thead-dark">
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
                <th>Clase v</th>
                <th>modelo</th>
                <th>Línea</th>
                <th>Marca</th>
                <th>Color</th>
                <th>Fecha de Tecnomecánica</th>
                <th>Nombre</th>
                <th>Apellido</th>
            </tr>
        </thead>
    </table>
    <div class="container text-center">
        <button class="btn btn-dark" type="button" style="margin-top: 17px;" data-toggle="modal"
            data-target="#form_create_vehicle" id="modal_form_create_vehicle">Registrar Información</button>
    </div>
    <div class="container text-center">
        <button class="btn btn-success" type="button" style="margin-top: 17px;" data-toggle="modal"
            data-target="#form_import_excel" id="modal_form_drive_info"><span class="excel_icon"> </span>Importar
            Información Masiva</button>
    </div>
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
                        <div class="row mt-1">
                            <div class="col-md-6">
                                <label for=""></label>
                                <input class="form-control" type="text" name="vehicle[Plate_id]" placeholder="Placa"
                                    id="Plate_id_form" />
                                <span class="error_admin input_user_admin" role="alert" id="Plate_id-error">
                                    <strong id="Plate_id-error-strong" class="error-strong"> </strong>
                                </span>
                            </div>
                            <div class="col-md-6">
                                <label for="State">C.C Conductor</label>
                                <select name="vehicle[User_information_DNI_id]" class="form-control"
                                    id="User_information_DNI_id" style="width: 100%; height: 100%;"
                                    data-url="{{ route('drivers-select-lists') }}"
                                    data-url-name="{{ route('drivers-get-name') }}" required>
                                </select>
                                <label class="text-info font-weight-bold" id="name_driver"
                                    style="margin-top: 12px;"></label>
                                <span class="error_admin input_user_admin" role="alert"
                                    id="User_information_DNI_id-error">
                                    <strong id="User_information_DNI_id-error-strong" class="error-strong"> </strong>
                                </span>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="Type_V">Tipo</label>
                                <select name="vehicle[Type_V]" class="form-control" id="Type_V" style="width: 100%">
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
                                <select name="vehicle[Owner_V]" class="form-control" id="Owner_V" style="width: 100%">
                                    <option value="">Seleccionar...</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                                <small class="text-danger small_forms" id="small_owner_v"></small>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 form_select_conductores">
                                <label for="Taxi_type">Tipo de Taxi</label>
                                <select name="vehicle[Taxi_type]" class="form-control" id="Taxi_type"
                                    style="width: 100%">
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
                                    id="taxi_Number_of_drivers" style="width: 100%">
                                    <option value="">Seleccionar...</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                                <small class="text-danger small_forms" id="small_taxi_number"></small>
                            </div>
                        </div>
                        <div class="row row_form_input_vehicle mt-2">
                            <div class="col-md-6">
                                <label for="Soat_expi_date_form">Fecha de vencimiento de soat*</label>
                                <input type="date" class="form-control" name="vehicle[Soat_expi_date]"
                                    id="Soat_expi_date_form" readonly />
                                <small class="text-danger small_forms" id="small_soat_expi_date"></small>
                            </div>
                            <div class="col-md-6">
                                <label for="technomechanical_date_form">Fecha de Tecnomecánica</label>
                                <input type="date" class="form-control" name="vehicle[technomechanical_date]"
                                    id="technomechanical_date_form" readonly />
                                <small class="text-danger small_forms" id="small_capacity"></small>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 form_select_conductores">
                                <label for="Capacity">Cantidad de pasajeros</label>
                                <select name="vehicle[Capacity]" class="form-control" id="Capacity" style="width: 100%">
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
                            <div class="col-md-6 form_select_conductores">
                                <label for="Service">Servicio</label>
                                <select name="vehicle[Service]" class="form-control" id="Service" style="width: 100%">
                                    <option value="">Seleccionar...</option>
                                    <option value="Particular">Particular</option>
                                    <option value="Transporte_mercancia">Transporte Mercancia</option>
                                    <option value="Transporte_publico">Transporte Público</option>
                                    <option value="Otros">Otros</option>
                                    <small class="text-danger small_forms" id="small_service"></small>
                                </select>
                            </div>
                        </div>
                        <div class="row row_form_input_conductores mt-2">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="vehicle[Cylindrical_cc]"
                                    placeholder="Cilindraje" />
                                <small class="text-danger small_forms" id="Cylindrical_cc"></small>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="vehicle[V_class]"
                                    placeholder="Clase de Vehículo" />
                                <small class="text-danger small_forms" id="V_class"></small>
                            </div>
                        </div>
                        <div class="row row_form_input_conductores mt-2">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="vehicle[Model]" placeholder="Modelo" />
                                <small class="text-danger small_forms" id="Model"></small>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="vehicle[Line]" placeholder="Línea" />
                                <small class="text-danger small_forms" id="Line"></small>
                            </div>
                        </div>
                        <div class="row row_form_input_conductores mt-2">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="vehicle[Brand]" placeholder="Marca" />
                                <small class="text-danger small_forms" id="small_capacity"></small>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="vehicle[Color]" placeholder="Color" />
                                <small class="text-danger small_forms" id="small_capacity"></small>
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
                <h4 class="modal-title" id="exampleModalLabel">Registor Masivo de Vehículos</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.vehicle.import') }}" id="form_excel_vehicle_admin"
                    data-url="{{ route('admin.vehicle.import') }}" data-url-delete="{{ route('driver-info.destroy') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-card">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">¿A cuál compañía desea cargar?</label>
                            <select class="form-control" name="Company_id" id="Company_id_excel" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file_driver_info">Importar Información de Vehículos</label>
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
<script src="{{ asset('js/admin/vehicle.js') }}" defer></script>
@endsection
<!-- End of Main Content -->