@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" name="data-table-route" value="{{ route ('skills-m-t-m-list') }}" id="data-table-route">
    <input type="hidden" name="update-users-route" value="{{ route ('users.update') }}" id="update-users-route">
    <!-- Page Heading -->
    <center>
        <div class="card mb-4" style="width: 70%;">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h5 mb-0 text-gray-800" style="color:#515151 !important;">Evaluación de Habilidades</h1>
                </div>
            </div>
            <div class="card-body">
                <table id="skills_m_t_m_datatable" class="table table_dashboard table-striped nowrap">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Reg_id</th>
                            <th>Fecha de Evaluación</th>
                            <th>Slalom</th>
                            <th>Proyección</th>
                            <th>Frenado</th>
                            <th>Evasión</th>
                            <th>Mobilidad</th>
                            <th>Resultado</th>
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
                        data-target="#form_create_skills_mtm"><i class="fas fa-plus"></i> Registrar Habilidades</button>
                </div>
            </div>
        </div>
    </center>
</div>

<div class="modal fade" id="form_create_skills_mtm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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

                <form method="POST" action="" id="form_user_admin" data-url-delete="{{ route('user-admin.destroy') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="slalom" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Slalom') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="slalom" id="slalom_form" style="width:100%;">
                                @foreach ($values_slalom as $val_slalom)
                                <option value="{{ $val_slalom }}">{{ $val_slalom }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="slalom_form-error">
                                <strong id="slalom_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="projection_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Slalom') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="projection" id="projection_form" style="width:100%;">
                                @foreach ($values_projection as $val_projection)
                                <option value="{{ $val_projection }}">{{ $val_projection }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="projection_form-error">
                                <strong id="projection_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="projection_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Proyección') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="braking" id="braking_form" style="width:100%;">
                                @foreach ($values_braking as $val_braking)
                                <option value="{{ $val_braking }}">{{ $val_braking }}</option>
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
                            <select class="form-control" name="evasion" id="evasion_form" style="width:100%;">
                                @foreach ($values_evasion as $val_evasion)
                                <option value="{{ $val_evasion }}">{{ $val_evasion }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="evasion_form-error">
                                <strong id="evasion_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobility_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Mobilidad') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="mobility" id="mobility_form" style="width:100%;">
                                @foreach ($values_mobility as $val_mobility)
                                <option value="{{ $val_mobility }}">{{ $val_mobility }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="mobility_form-error">
                                <strong id="mobility_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="result_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Resultado') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="result" id="result_form" style="width:100%;">
                                @foreach ($values_evasion as $val_evasion)
                                <option value="{{ $val_evasion }}">{{ $val_evasion }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="result_form-error">
                                <strong id="result_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="user_vehicle_id_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Conductor') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="user_vehicle_id" id="user_vehicle_id_form"
                                data-url="{{ route('motorcyclist-select-lists') }}" style="width:100%;">
                            </select>
                            <span class="error_admin" role="alert" id="user_vehicle_id_form-error">
                                <strong id="user_vehicle_id_form-error-strong" class="error-strong"></strong>
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