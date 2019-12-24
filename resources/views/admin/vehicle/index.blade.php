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
    <table id="vehicle_datatable" class="table table-striped table-bordered table-hover nowrap" style="width:100%"
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
                                <input class="form-control" type="text" name="vehicle[plate_id]" placeholder="Placa"
                                    id="plate_id_form" />
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
                                <select name="vehicle[type_v]" class="form-control" id="type_v" style="width: 100%">
                                    <option value="">Seleccionar...</option>
                                    @foreach ($list_type_v as $item_type_v)
                                        <option value="{{$item_type_v}}"> {{$item_type_v}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="owner_v">Dueño</label>
                                <select name="vehicle[owner_v]" class="form-control" id="owner_v" style="width: 100%">
                                    <option value="">Seleccionar...</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 form_select_conductores">
                                <label for="taxi_type">Tipo de Taxi</label>
                                <select name="vehicle[taxi_type]" class="form-control" id="taxi_type"
                                    style="width: 100%">
                                    <option value="">Seleccionar...</option>
                                    @foreach ($list_taxi_type as $item_taxi_type)
                                        <option value="{{$item_taxi_type}}"> {{$item_taxi_type}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form_select_conductores">
                                <label for="taxi_number_of_drivers">Número de conductores Taxi</label>
                                <select name="vehicle[taxi_number_of_drivers]" class="form-control"
                                    id="taxi_number_of_drivers" style="width: 100%">
                                    <option value="">Seleccionar...</option>
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row row_form_input_vehicle mt-2">
                            <div class="col-md-6">
                                <label for="soat_expi_date_form">Fecha de vencimiento de soat*</label>
                                <input type="date" class="form-control" name="vehicle[soat_expi_date]"
                                    id="soat_expi_date_form" readonly />
                            </div>
                            <div class="col-md-6">
                                <label for="technomechanical_date_form">Fecha de Tecnomecánica</label>
                                <input type="date" class="form-control" name="vehicle[technomechanical_date]"
                                    id="technomechanical_date_form" readonly />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6 form_select_conductores">
                                <label for="capacity">Cantidad de pasajeros</label>
                                <select name="vehicle[capacity]" class="form-control" id="capacity" style="width: 100%">
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
                                <select name="vehicle[service]" class="form-control" id="service" style="width: 100%">
                                    <option value="">Seleccionar...</option>
                                    @foreach ($list_service as $item_service)
                                        <option value="{{$item_service}}"> {{$item_service}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row row_form_input_conductores mt-2">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="vehicle[cylindrical_cc]"
                                    placeholder="Cilindraje" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="vehicle[v_class]"
                                    placeholder="Clase de Vehículo" />
                            </div>
                        </div>
                        <div class="row row_form_input_conductores mt-2">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="vehicle[model]" placeholder="Modelo" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="vehicle[line]" placeholder="Línea" />
                            </div>
                        </div>
                        <div class="row row_form_input_conductores mt-2">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="vehicle[brand]" placeholder="Marca" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="vehicle[color]" placeholder="Color" />
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
                            <select class="form-control" name="company_id" id="company_id_excel" required>
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