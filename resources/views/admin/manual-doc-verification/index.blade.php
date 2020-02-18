@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" name="users-list-route" value="{{ route ('admin.manual-doc-verification.list') }}"
        id="data-table-route">
    <input type="hidden" name="update-users-route" value="{{ route ('users.update') }}" id="update-users-route">
    <!-- Page Heading -->
    <center>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h1 class="h5 mb-0 text-gray-800" style="color:#515151 !important;">Revisión Documental</h1>
                </div>
            </div>
            <div class="card-body">
                <table id="manual_doc_v_datatable" class="table table_dashboard table-striped nowrap">
                    <thead>
                        <tr>
                            <th></th>
                            <th>doc_id</th>
                            <th>Licencia Válida</th>
                            <th>Categoría</th>
                            <th>Soat Disponible</th>
                            <th>Revión Tecnomecánica</th>
                            <th>Fecha Tecnomecánica</th>
                            <th>Estado Licencia</th>
                            <th>Ratio Accidente</th>
                            <th>Número Comparendos</th>
                            <th>Fecha Comp. 1</th>
                            <th>Fecha Comp. 2</th>
                            <th>Fecha Comp. 3</th>
                            <th>Fecha Comp. 4</th>
                            <th>Fecha Comp. 5</th>
                            <th>Código Comp. 1</th>
                            <th>Código Comp. 2</th>
                            <th>Código Comp. 3</th>
                            <th>Código Comp. 4</th>
                            <th>Código Comp. 5</th>
                            <th>Datos Validados</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Cédula</th>
                            <th>Placa</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-footer">
                <div class="container text-center">
                    <button class="btn btn-primary" type="button" data-toggle="modal"
                        data-target="#form_create_manual_doc_v"><i class="fas fa-plus"></i> Agregar Verificación Documental</button>
                </div>
            </div>
        </div>
    </center>
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color:#333 !important;">Usuarios</h1>
    </div> --}}
</div>

<div class="modal fade" id="form_create_manual_doc_v" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar una nueva verificación documental</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="" id="form_manual_doc_v_admin"
                    data-url-delete="{{ route('user-admin.destroy') }}" class="mb-4">
                    @csrf
                    <div class="form-card">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="valid_licence_form">Licencia Válida</label><br>
                                <select name="valid_licence" id="valid_licence_form" class="form-control" required>
                                    <option value="">Seleccionar ...</option>
                                    <option value="Y">Sí</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                            <div class="col-md-6 form_select_conductores">
                                <label for="category_form">Categoría</label><br>
                                <select name="category" class="form-control" style="width: 100%"
                                    id="category_form" required>
                                    <option value="">Seleccionar ...</option>
                                    @foreach ($category_list as $category_item)
                                    <option value="{{ $category_item }}">{{ $category_item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="soat_available_form">Soat Disponible</label><br>
                                <select name="soat_available" id="soat_available_form" class="form-control" required>
                                    <option value="">Seleccionar ...</option>
                                    <option value="Y">Sí</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="technom_review_form">Revisión Tecnomecánica</label><br>
                                <select name="technom_review" id="technom_review_form" class="form-control" required>
                                    <option value="">Seleccionar ...</option>
                                    <option value="Y">Sí</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="technom_expi_date">Fecha Ven. Tecnomecánica</label><br>
                                <input type="text" name="technom_expi_date" id="technom_expi_date_form" class="form-control" readonly>
                            </div>
                            <div class="col-md-6 form_select_conductores">
                                <label for="run_state_form">Estado Licencia</label><br>
                                <select name="run_state" class="form-control" style="width: 100%"
                                    id="run_state_form" required>
                                    <option value="">Seleccionar ...</option>
                                    @foreach ($runstate_list as $runstate_item)
                                    <option value="{{ $runstate_item }}">{{ $runstate_item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="accident_rate_form">Ratio de Accidente</label><br>
                                <input type="number" name="accident_rate" id="accident_rate_form" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="penality_record_form">Número de Comparendos</label><br>
                                <input type="number" name="penality_record" id="penality_record_form" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="code_penality_1_form">Codigo Comparendo 1</label><br>
                                <input type="number" name="code_penality_1" id="code_penality_1_form" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="date_penality_1_form">Fecha Comparendo 1</label><br>
                                <input type="text" name="date_penality_1" id="date_penality_1_form" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="code_penality_2_form">Codigo Comparendo 2</label><br>
                                <input type="number" name="code_penality_2" id="code_penality_2_form" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="date_penality_2_form">Fecha Comparendo 2</label><br>
                                <input type="text" name="date_penality_2" id="date_penality_2_form" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="code_penality_3_form">Codigo Comparendo 3</label><br>
                                <input type="number" name="code_penality_3" id="code_penality_3_form" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="date_penality_3_form">Fecha Comparendo 3</label><br>
                                <input type="text" name="date_penality_3" id="date_penality_3_form" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="code_penality_4_form">Codigo Comparendo 4</label><br>
                                <input type="number" name="code_penality_4" id="code_penality_4_form" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="date_penality_4_form">Fecha Comparendo 4</label><br>
                                <input type="text" name="date_penality_4" id="date_penality_4_form" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="code_penality_5_form">Codigo Comparendo 5</label><br>
                                <input type="number" name="code_penality_5" id="code_penality_5_form" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="date_penality_5_form">Fecha Comparendo 5</label><br>
                                <input type="text" class="form-control" name="date_penality_5" id="date_penality_5_form" readonly>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="validated_data_form">Datos Validados</label><br>
                                <select name="validated_data" id="validated_data_form" class="form-control" required>
                                    <option value="">Seleccionar ...</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <input type="submit" value="Registrar" class="btn btn-primary">
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<script src="{{ asset('js/admin/manual_doc_verification.js') }}" defer></script>
@endsection
<!-- End of Main Content -->