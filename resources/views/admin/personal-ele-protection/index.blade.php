@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" name="route-driver-information" value="{{ route ('admin','driver_information') }}"
        id="route-driver-information">
    <input type="hidden" name="data-table-route" value="{{ route ('admin.personal-ele-protection.list') }}" id="data-table-route">
    <input type="hidden" name="register-route" value="{{ route ('admin.personal-ele-protection.store') }}" id="register-route">
    <input type="hidden" name="update-route" value="{{ route ('admin.personal-ele-protection.update') }}" id="update-route">
    <input type="hidden" name="delete-route" value="{{ route ('admin.personal-ele-protection.destroy') }}" id="delete-route">
    <!-- Page Heading -->
    <center>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h5 mb-0 text-gray-800" style="color:#515151 !important;">Evaluación de Habilidades</h1>
                </div>
            </div>
            <div class="card-body">
                <table id="personal_ele_protection_datatable" class="table table_dashboard table-striped nowrap"
                    style="width:100%;">
                    <thead>
                        <tr>
                            <th></th>
                            <th>epp_id</th>
                            <th>Nombre evaluador</th>
                            <th>Empresa</th>
                            <th>casco</th>
                            <th>Airbag</th>
                            <th>rodilleras</th>
                            <th>coderas</th>
                            <th>Hombreras</th>
                            <th>Protector Espalda</th>
                            <th>Botas</th>
                            <th>Guantes</th>
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
                        <a href="{{ route('admin','mt_mechanical_condition') }}"><img src="{{ asset('img/back.png') }}"
                                alt=""></a>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <div class="container text-center">
                            <button class="btn btn-primary" type="button" data-toggle="modal"
                                data-target="#form_create_mt_ele_protection_modal"><i class="fas fa-plus"></i> Registrar
                                Habilidades</button>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2 text-right" style="display: flex;align-items: center;justify-content: center;">
                        <a href="{{ route('admin','doc_verification') }}"><img src="{{ asset('img/next.png') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </center>
</div>

<div class="modal fade" id="form_create_mt_ele_protection_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar una nueva habilidad</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="" id="form_create_mt_ele_protection">
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
                        <label for="casco_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Casco') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="casco" id="casco_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_casco as $key_val_casco => $val_casco)
                                <option value="{{ $key_val_casco }}">{{ $val_casco }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="casco_form-error">
                                <strong id="casco_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="airbag_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Airbag') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="airbag" id="airbag_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_airbag as $key_val_airbag => $val_airbag)
                                <option value="{{ $key_val_airbag }}">{{ $val_airbag }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="casco_form-error">
                                <strong id="casco_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="rodilleras_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Rodilleras') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="rodilleras" id="rodilleras_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_rodilleras as $key_val_rodilleras => $val_rodilleras)
                                <option value="{{ $key_val_rodilleras }}">{{ $val_rodilleras }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="rodilleras_form-error">
                                <strong id="rodilleras_form-error-strong" class="error-strong"></strong>
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
<script src="{{ asset('js/admin/personal_ele_protection.js') }}" defer></script>
<script>
</script>
@endsection
<!-- End of Main Content -->