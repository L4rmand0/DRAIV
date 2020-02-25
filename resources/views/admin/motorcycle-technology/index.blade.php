@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" name="route-driver-information" value="{{ route ('admin','driver_information') }}"
        id="route-driver-information">
    <input type="hidden" name="data-table-route" value="{{ route ('admin.motorcycle-technology.list') }}" id="data-table-route">
    <input type="hidden" name="register-route" value="{{ route ('admin.motorcycle-technology.store') }}" id="register-route">
    <input type="hidden" name="update-route" value="{{ route ('admin.motorcycle-technology.update') }}" id="update-route">
    <input type="hidden" name="delete-route" value="{{ route ('admin.motorcycle-technology.destroy') }}" id="delete-route">
    <!-- Page Heading -->
    <center>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h5 mb-0 text-gray-800" style="color:#515151 !important;">Evaluación de Tecnología de Motocicleta</h1>
                </div>
            </div>
            <div class="card-body">
                <table id="motorcycle_technology_datatable" class="table table_dashboard table-striped nowrap"
                    style="width:100%;">
                    <thead>
                        <tr>
                            <th></th>
                            <th>m_t_id</th>
                            <th>Tipo Frenos</th>
                            <th>Asistencia Freno</th>
                            <th>Luces</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Cédula</th>
                            <th>Placa Vehículo</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-2" style="display: flex;align-items: center;justify-content: center;">
                        <a href="{{ route('admin','skills_m_t_m') }}"><img src="{{ asset('img/back.png') }}"
                                alt=""></a>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <div class="container text-center">
                            <button class="btn btn-primary" type="button" data-toggle="modal"
                                data-target="#form_create_skills_mtm_modal"><i class="fas fa-plus"></i> Registrar Evaluación de Tecnología</button>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2 text-right" style="display: flex;align-items: center;justify-content: center;">
                        <a href="{{ route('admin','mt_mechanical_condition') }}"><img src="{{ asset('img/next.png') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </center>
</div>

<div class="modal fade" id="form_create_skills_mtm_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar una nueva Tecnología de Moto</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="" id="form_create_skills_mtm">
                    @csrf
                    <div class="form-group row">
                        <label for="user_vehicle_id_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Conductor') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="user_vehicle_id" id="user_vehicle_id_form"
                                data-url="{{ route('motorcyclist-select-lists') }}" style="width:100%;" required>
                            </select>
                            <span class="error_admin" role="alert" id="user_vehicle_id_form-error">
                                <strong id="user_vehicle_id_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brake_type_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Frenado Disco') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="brake_type" id="brake_type_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_type_brake as $key_val_type_brake => $val_type_brake)
                                <option value="{{ $key_val_type_brake }}">{{ $val_type_brake }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="brake_type_form-error">
                                <strong id="brake_type_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="assistence_brake_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Asistencia de Frenos') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="assistence_brake" id="assistence_brake_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_assistence_brake as $key_val_assistence_brake => $val_assistence_brake)
                                <option value="{{ $key_val_assistence_brake }}">{{ $val_assistence_brake }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="assistence_brake_form-error">
                                <strong id="assistence_brake_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="automatic_lights_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Luces') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="automatic_lights" id="automatic_lights_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_automatic_lights as $key_val_automatic_lights => $val_automatic_lights)
                                <option value="{{ $key_val_automatic_lights }}">{{ $val_automatic_lights }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="automatic_lights_form-error">
                                <strong id="automatic_lights_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" data-url="{{ route('register-user') }}"
                                id="btn_admin_user">
                                Registrar
                            </button>
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
<script src="{{ asset('js/admin/motorcycle_technology.js') }}" defer></script>
<script>
    var assistence_type_brake_list = {!! $assistence_type_brake_list !!};
    var assistence_brake_list = {!! $assistence_brake_list !!};
    var automatic_lights_list = {!! $automatic_lights_list !!};
</script>
@endsection
<!-- End of Main Content -->