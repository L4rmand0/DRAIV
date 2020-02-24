@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" name="route-driver-information" value="{{ route ('admin','driver_information') }}"
        id="route-driver-information">
    <input type="hidden" name="data-table-route" value="{{ route ('admin.motorcycle-mechanical-conditions.list') }}" id="data-table-route">
    <input type="hidden" name="register-route" value="{{ route ('admin.motorcycle-mechanical-conditions.store') }}" id="register-route">
    <input type="hidden" name="update-route" value="{{ route ('admin.motorcycle-mechanical-conditions.update') }}" id="update-route">
    <input type="hidden" name="delete-route" value="{{ route ('admin.motorcycle-mechanical-conditions.destroy') }}" id="delete-route">
    <!-- Page Heading -->
    <center>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h5 mb-0 text-gray-800" style="color:#515151 !important;">Evaluación de Condiciones Mecánicas de Motocicleta</h1>
                </div>
            </div>
            <div class="card-body">
                <table id="motorcycle_mechanical_condition_datatable" class="table table_dashboard table-striped nowrap"
                    style="width:100%;">
                    <thead>
                        <tr>
                            <th></th>
                            <th>evaluation_id</th>
                            <th>Llantas</th>
                            <th>Manigueta y Guaya</th>
                            <th>Frenos</th>
                            <th>Kit Arrastre</th>
                            <th>Dirección y Suspensión</th>
                            <th>Fuga de Aceite</th>
                            <th>Chasis, espejos, guardabarros y otros</th>
                            <th>Bocina</th>
                            <th>Luces y Direccionales</th>
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
                                data-target="#form_create_mt_mechanical_condition_modal"><i class="fas fa-plus"></i> Registrar Condiciones Mecánicas</button>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-2 text-right" style="display: flex;align-items: center;justify-content: center;">
                        <a href="{{ route('admin','motorcycle_tecnology') }}"><img src="{{ asset('img/next.png') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </center>
</div>

<div class="modal fade" id="form_create_mt_mechanical_condition_modal" tabindex="-1" role="dialog"
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

                <form method="POST" action="" id="form_create_mt_mechanical_condition">
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
                        <label for="tires_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Llantas') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="tires" id="tires_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_tires as $key_val_tires => $val_tires)
                                <option value="{{ $key_val_tires }}">{{ $val_tires }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="tires_form-error">
                                <strong id="tires_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="manigueta_guaya_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Manigueta y Guaya') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="manigueta_guaya" id="manigueta_guaya_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_manigueta_guaya as $key_val_manigueta_guaya => $val_manigueta_guaya)
                                <option value="{{ $key_val_manigueta_guaya }}">{{ $val_manigueta_guaya }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="manigueta_guaya_form-error">
                                <strong id="manigueta_guaya_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="braking_system_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Frenos') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="braking_system" id="braking_system_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_braking_system as $key_val_braking_system => $val_braking_system)
                                <option value="{{ $key_val_braking_system }}">{{ $val_braking_system }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="braking_system_form-error">
                                <strong id="braking_system_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kit_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Kit de Arrastre') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="kit" id="kit_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_kit as $key_val_kit => $val_kit)
                                <option value="{{ $key_val_kit }}">{{ $val_kit }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="kit_form-error">
                                <strong id="kit_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stee_susp_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Dirección y Suspensión') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="stee_susp" id="stee_susp_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_stee_susp as $key_val_stee_susp => $val_stee_susp)
                                <option value="{{ $key_val_stee_susp }}">{{ $val_stee_susp }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="stee_susp_form-error">
                                <strong id="stee_susp_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="oil_leak_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Fuga de Aceite') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="oil_leak" id="oil_leak_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_oil_leak as $key_val_oil_leak => $val_oil_leak)
                                <option value="{{ $key_val_oil_leak }}">{{ $val_oil_leak }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="oil_leak_form-error">
                                <strong id="oil_leak_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="other_components_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Chasis, espejos, guardabarros y Otros') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="other_components" id="other_components_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_other_components as $key_val_other_components => $val_other_components)
                                <option value="{{ $key_val_other_components }}">{{ $val_other_components }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="other_components_form-error">
                                <strong id="other_components_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="horn_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Bocina') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="horn" id="horn_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_horn as $key_val_horn => $val_horn)
                                <option value="{{ $key_val_horn }}">{{ $val_horn }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="horn_form-error">
                                <strong id="horn_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lights_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Luces') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="lights" id="lights_form" style="width:100%;" required>
                                <option value="">Seleccionar ...</option>
                                @foreach ($values_lights as $key_val_lights => $val_lights)
                                <option value="{{ $key_val_lights }}">{{ $val_lights }}</option>
                                @endforeach
                            </select>
                            <span class="error_admin" role="alert" id="lights_form-error">
                                <strong id="lights_form-error-strong" class="error-strong"></strong>
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
<script src="{{ asset('js/admin/mt_mechanical_condition.js') }}" defer></script>
<script>
    var tires_list = {!! $tires_list !!};
    var automatic_lights_list = {!! $automatic_lights_list !!};
    var braking_system_list = {!! $braking_system_list !!};
    var kit_list = {!! $kit_list !!};
    var stee_susp_list = {!! $stee_susp_list !!};
    var oil_leak_list = {!! $oil_leak_list !!};
    var other_components_list = {!! $other_components_list !!};
    var horn_list = {!! $horn_list !!};
    var lights_list = {!! $lights_list !!};
</script>
@endsection
<!-- End of Main Content -->