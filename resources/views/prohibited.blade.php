@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:70px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Acceso Denegado</div>
                <div class="card-body">
                    <img src="{{ asset('img/denied.png') }}" alt="Acceso Denegado" style="text-align: center">
                    <p style="margin-top: 20px">Lo sentimos no tienes permisos para acceder a este lugar, por favor comunícate con el administrador.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
