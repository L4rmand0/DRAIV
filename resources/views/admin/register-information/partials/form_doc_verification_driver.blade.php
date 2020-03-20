<div class="tab-pane fade show active" id="nav-driver-information" role="tabpanel" aria-labelledby="nav-home-tab"
    style="padding: 2em; border: solid 1px #dddfeb;">
    <div class="card text-left">
        <h5 class="card-header">Información personal</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="code_penality_5_form">Conductor</label><br>
                    <select class="form-control" name="user_vehicle_id" id="user_vehicle_id_form"
                        data-url="{{ route('motorcyclist-select-lists') }}" style="width:100%;" required>
                    </select>
                    <span class="error_admin" role="alert" id="user_vehicle_id_form-error">
                        <strong id="user_vehicle_id_form-error-strong" class="error-strong"></strong>
                    </span>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="valid_licence_form">Licencia Vigente <a href="https://www.runt.com.co/consultaCiudadana/#/consultaPersona" target="_blank"><img src="{{ asset('img/help.png') }}" alt="" srcset="" style="width: 17px;"></a></label><br>
                    <select name="valid_licence" id="valid_licence_form" class="form-control" required>
                        <option value="">Seleccionar ...</option>
                        <option value="Y">Sí</option>
                        <option value="N">No</option>
                    </select>
                </div>
                <div class="col-md-6 form_select_conductores">
                    <label for="category_form">Categoría de Licencia</label><br>
                    <select name="category" class="form-control" style="width: 100%" id="category_form"
                        required>
                        <option value="">Seleccionar ...</option>
                        @foreach ($category_list as $category_item)
                        <option value="{{ $category_item }}">{{ $category_item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="soat_available_form">Soat <a href="https://www.runt.com.co/consultaCiudadana/#/consultaVehiculo" target="_blank"><img src="{{ asset('img/help.png') }}" alt="" srcset="" style="width: 17px;"></a></label><br>
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
                    <input type="text" name="technom_expi_date" id="technom_expi_date_form"
                        class="form-control" readonly>
                </div>
                <div class="col-md-6 form_select_conductores">
                    <label for="run_state_form">Estado RUNT <a href="https://www.runt.com.co/consultaCiudadana/#/consultaPersona" target="_blank"><img src="{{ asset('img/help.png') }}" alt="" srcset="" style="width: 17px;"></a></label><br>
                    <select name="run_state" class="form-control" style="width: 100%" id="run_state_form"
                        required>
                        <option value="">Seleccionar ...</option>
                        @foreach ($runstate_list as $runstate_item)
                        <option value="{{ $runstate_item }}">{{ $runstate_item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="accident_rate_form">Accidentes Reportados <a href="https://fasecolda.com/ramos/automoviles/historial-de-accidentes-de-vehiculos-asegurados/ " target="_blank"><img src="{{ asset('img/help.png') }}" alt="" srcset="" style="width: 17px;"></a></label><br>
                    <input type="number" name="accident_rate" id="accident_rate_form" class="form-control"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="penality_record_form">Número de Comparendos <a href="https://consulta.simit.org.co/Simit/indexA.jsp" target="_blank"><img src="{{ asset('img/help.png') }}" alt="" srcset="" style="width: 17px;"></a></label><br>
                    <input type="number" name="penality_record" id="penality_record_form"
                        class="form-control" required>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="code_penality_1_form">Codigo Comparendo 1</label><br>
                    <input type="number" name="code_penality_1" id="code_penality_1_form"
                        class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="date_penality_1_form">Fecha Comparendo 1</label><br>
                    <input type="text" name="date_penality_1" id="date_penality_1_form" class="form-control"
                        readonly>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="code_penality_2_form">Codigo Comparendo 2</label><br>
                    <input type="number" name="code_penality_2" id="code_penality_2_form"
                        class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="date_penality_2_form">Fecha Comparendo 2</label><br>
                    <input type="text" name="date_penality_2" id="date_penality_2_form" class="form-control"
                        readonly>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="code_penality_3_form">Codigo Comparendo 3</label><br>
                    <input type="number" name="code_penality_3" id="code_penality_3_form"
                        class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="date_penality_3_form">Fecha Comparendo 3</label><br>
                    <input type="text" name="date_penality_3" id="date_penality_3_form" class="form-control"
                        readonly>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="code_penality_4_form">Codigo Comparendo 4</label><br>
                    <input type="number" name="code_penality_4" id="code_penality_4_form"
                        class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="date_penality_4_form">Fecha Comparendo 4</label><br>
                    <input type="text" name="date_penality_4" id="date_penality_4_form" class="form-control"
                        readonly>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="code_penality_5_form">Codigo Comparendo 5</label><br>
                    <input type="number" name="code_penality_5" id="code_penality_5_form"
                        class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="date_penality_5_form">Fecha Comparendo 5</label><br>
                    <input type="text" class="form-control" name="date_penality_5" id="date_penality_5_form"
                        readonly>
                </div>
            </div>
        </div>
    </div>
</div>