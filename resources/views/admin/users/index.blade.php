@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" name="users-list-route" value="{{ route ('users-list') }}" id="users-list-route">
    <input type="hidden" name="update-users-route" value="{{ route ('users.update') }}" id="update-users-route">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
    </div>

    <table id="user_datatable" class="table table-bordered table-hover nowrap" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Perfil</th>
            </tr>
        </thead>
    </table>
    <div class="container text-center">
        <button class="btn btn-dark" type="button" style="margin-top: 17px;" data-toggle="modal"
            data-target="#form_create_user">Agregar Usuario</button>
    </div>
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

                <form method="POST" action="" id="form_user_admin">
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
                                class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                        <label for="Company_id"
                            class="col-md-4 col-form-label text-md-right">{{ __('Compañía') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="Company_id" id="Company_id">
                                <option value="">Seleccionar ...</option>
                                <option value="9013380301">DRAIV</option>
                                <option value="9013380302">Smart</option>
                            </select>
                            <span class="error_admin" role="alert" id="Company_id-error">
                                <strong id="Company_id-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="User_profile" class="col-md-4 col-form-label text-md-right">{{ __('Perfil') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" name="User_profile" id="User_profile">
                                <option value="">Seleccionar ...</option>
                                <option value="Administrator">Administrator</option>
                                <option value="Evaluator">Evaluator</option>
                                <option value="User">User</option>
                            </select>
                            <span class="error_admin" role="alert" id="User_profile-error">
                                <strong id="User_profile-error-strong" class="error-strong"></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12 col-md-4">
                        </div>
                        <div class="custom-control custom-checkbox col-4 col-md-6" style="margin-top: 17px;">
                            <input type="checkbox" name="checkdata" class="custom-control-input" id="defaultChecked2">
                            <label class="custom-control-label" for="defaultChecked2">Aceptar Términos y condiciones</label>
                            <span class="error_admin" role="alert" id="checkdata-error">
                                <strong id="checkdata-error-strong" class="error-strong"></strong>
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
<!-- /.container-fluid -->
<script src="{{ asset('js/admin/users.js') }}" defer></script>
@endsection
<!-- End of Main Content -->