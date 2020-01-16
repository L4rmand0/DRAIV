@extends('layouts-admin.app')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" name="doc-verify-list-route" value="{{ route ('admin.doc-verification.list') }}" id="doc-verify-list-route">
    <input type="hidden" name="doc-verify-update" value="{{ route ('admin.doc-verification.update') }}" id="doc-verify-update">
    <!-- Page Heading -->
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h1 class="h5 mb-0 text-gray-800" style="color:#515151 !important;">Validación de Datos</h1>
            </div>
        </div>
        <div class="card-body">
            <table id="doc_verification_datatable" class="table table-bordered table-striped table-hover nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cédula</th>
                        <th>Placa</th>
                        <th>Licencia</th>
                        <th>Verificado</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color:#333 !important;">Usuarios</h1>
    </div> --}}
</div>

<!-- /.container-fluid -->
<script src="{{ asset('js/admin/doc-verification.js') }}" defer></script>
<link href="{{ asset('css/doc-verification.css') }}" rel="stylesheet">
@endsection
<!-- End of Main Content -->