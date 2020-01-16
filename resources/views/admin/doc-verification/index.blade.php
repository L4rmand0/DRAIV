@extends('layouts-admin.app')
@section('content')

<style type="text/css">
    /* Customize the label (the container) */
    .container_check {
      display: block;
      position: relative;
      /* padding-left: 35px; */
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      display: flex;
      justify-content: center;
    }
    
    /* Hide the browser's default checkbox */
    .container_check input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
    }
    
    /* Create a custom checkbox */
    .checkmark {
      position: absolute;
      top: 0;
      /* left: 0; */
      height: 25px;
      width: 25px;
      background-color: #A9CAD5;
    }
    
    /* On mouse-over, add a grey background color */
    .container_check:hover input ~ .checkmark {
      background-color: #2C93CE;
    }
    
    /* When the checkbox is checked, add a blue background */
    .container_check input:checked ~ .checkmark {
      background-color: #2196F3;
    }
    
    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }
    
    /* Show the checkmark when checked */
    .container_check input:checked ~ .checkmark:after {
      display: block;
    }
    
    /* Style the checkmark/indicator */
    .container_check .checkmark:after {
      left: 10px;
      top: 6px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg);
    }
    </style>
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
                        <th>Validado</th>
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
@endsection
<!-- End of Main Content -->