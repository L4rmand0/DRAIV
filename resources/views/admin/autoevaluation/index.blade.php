@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" name="users-list-route" value="{{ route ('users-list') }}" id="users-list-route">
    <input type="hidden" name="update-users-route" value="{{ route ('users.update') }}" id="update-users-route">
    <!-- Page Heading -->
    <center>
        <div class="card mb-4" style="width: 70%;">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h5 mb-0 text-gray-800" style="color:#515151 !important;">Usuarios</h1>
                </div>
            </div>
            <div class="card-body">
                <table id="user_datatable" class="table table_dashboard table-striped nowrap">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Perfil</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-footer">
                <div class="container text-center">
                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#form_create_user"><i
                            class="fas fa-plus"></i> Agregar Usuario</button>
                </div>
            </div>
        </div>
    </center>
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color:#333 !important;">Usuarios</h1>
    </div> --}}
</div>

<div class="modal fade" id="form_create_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            <span class="error_admin input_user_admin" role="alert" id="name-error">
                                <strong id="name-error-strong" class="error-strong"> </strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">

                            <span class="error_admin" role="alert" id="email-error">
                                <strong id="email-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password"
                            class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">

                            <span class="error_admin" role="alert" id="password-error">
                                <strong id="password-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                            class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company_id" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Compañía') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="company_id" id="company_id_form"
                                data-url="{{ route('company-select-list') }}" style="width:100%;">
                            </select>
                            <span class="error_admin" role="alert" id="company_id_form-error">
                                <strong id="company_id_form-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="profile_id_form" style="padding-top: calc(0.135rem + 1px);"
                            class="col-md-4 col-form-label text-md-right">{{ __('Perfil') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="profile_id" id="profile_id_form"
                                data-url="{{ route('profile-select-list') }}" style="width:100%;" required>
                            </select>
                            <span class="error_admin" role="alert" id="profile_id-error">
                                <strong id="profile_id-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" data-url="{{ route('register-user') }}"
                                id="btn_admin_user">
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
<script src="{{ asset('js/admin/autoevaluation.js') }}" defer></script>
@endsection
<!-- End of Main Content -->