@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" name="route-driver-information" value="{{ route ('admin','driver_information') }}" id="route-driver-information">
    <input type="hidden" name="data-table-route" value="{{ route ('admin.skills-m-t-m.list') }}" id="data-table-route">
    <input type="hidden" name="register-route" value="{{ route ('admin.skills-m-t-m.store') }}"
        id="register-route">
    <input type="hidden" name="update-route" value="{{ route ('admin.skills-m-t-m.update') }}" id="update-route">
    <input type="hidden" name="delete-route" value="{{ route ('admin.skills-m-t-m.destroy') }}" id="delete-route">
    <!-- Page Heading -->
    <center>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h5 mb-0 text-gray-800" style="color:#515151 !important;">Evaluación de Habilidades</h1>
                </div>
            </div>
            <div class="card-body">
                <table id="skills_m_t_m_datatable" class="table table_dashboard table-striped nowrap" style="width:100%;">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Reg_id</th>
                            <!-- <th>Fecha de Evaluación</th> -->
                            <th>Destreza</th>
                            <th>Proyección</th>
                            <th>Frenado</th>
                            <th>Evasión</th>
                            <!-- <th>Mobilidad</th>
                            <th>Resultado</th> -->
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Cédula</th>
                            <th>Placa Vehículo</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-footer">
                <div class="container text-center">
                    <button class="btn btn-primary" type="button" data-toggle="modal"
                        data-target="#form_create_skills_mtm_modal"><i class="fas fa-plus"></i> Registrar Habilidades</button>
                </div>
            </div>
        </div>
    </center>
</div>

<div class="modal fade" id="form_create_skills_mtm_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar un nuevo usuario</h5>
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
                        <label for="slalom" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Destreza') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="slalom" id="slalom_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_slalom as $key_val_slalom  => $val_slalom)
                                <option value="{{ $key_val_slalom }}">{{ $val_slalom }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="slalom_form-error">
                                <strong id="slalom_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="projection_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Proyección') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="projection" id="projection_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_projection as $key_val_projection => $val_projection)
                                <option value="{{ $key_val_projection }}">{{ $val_projection }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="projection_form-error">
                                <strong id="projection_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="projection_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Frenado') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="braking" id="braking_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_braking as $key_val_braking => $val_braking) 
                                <option value="{{ $key_val_braking }}">{{ $val_braking }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="braking_form-error">
                                <strong id="braking_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="evasion_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Evasión') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="evasion" id="evasion_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_evasion as $key_val_evasion => $val_evasion)
                                <option value="{{ $key_val_evasion }}">{{ $val_evasion }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="evasion_form-error">
                                <strong id="evasion_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" data-url="{{ route('register-user') }}" id="btn_admin_user">
                                Registrarse
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
<script src="{{ asset('js/admin/skills.js') }}" defer></script>
@endsection
<!-- End of Main Content -->