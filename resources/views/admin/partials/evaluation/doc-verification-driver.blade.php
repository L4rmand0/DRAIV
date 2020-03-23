<div class="form-card">
    {{-- <h2 class="fs-title mt-2">Información Del Vehículo</h2> --}}
    <h2 class="fs-title" style="margin-bottom: 20px">Evaluación de Documentación del Conductor</h2>
    <div class="row mt-2">
        <div class="col-md-6">
            <label for="valid_licence_form">Licencia Vigente <a
                    href="https://www.runt.com.co/consultaCiudadana/#/consultaPersona" target="_blank"><img
                        src="{{ asset('img/help.png') }}" alt="" srcset="" style="width: 17px;"></a></label><br>
            <select name="doc_verification_driver[valid_licence]" id="valid_licence" class="form-control" required>
                <option value="">Seleccionar ...</option>
                <option value="Y">Sí</option>
                <option value="N">No</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="category_form">Categoría de Licencia</label>
            <select name="doc_verification_driver[category]" class="form-control" style="width: 100%" id="category" required>
                <option value="">Seleccionar ...</option>
                @foreach ($category_list as $category_item)
                <option value="{{ $category_item }}">{{ $category_item }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6 form_select_conductores">
            <label for="run_state_form">Estado RUNT <a
                    href="https://www.runt.com.co/consultaCiudadana/#/consultaPersona" target="_blank"><img
                        src="{{ asset('img/help.png') }}" alt="" srcset="" style="width: 17px;"></a></label><br>
            <select name="doc_verification_driver[runt_state]" class="form-control" style="width: 100%" id="runt_state" required>
                <option value="">Seleccionar ...</option>
                @foreach ($runstate_list as $runstate_item)
                <option value="{{ $runstate_item }}">{{ $runstate_item }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <label for="accident_rate_form">Accidentes Reportados <a
                    href="https://fasecolda.com/ramos/automoviles/historial-de-accidentes-de-vehiculos-asegurados/ "
                    target="_blank"><img src="{{ asset('img/help.png') }}" alt="" srcset=""
                        style="width: 17px;"></a></label><br>
            <input type="number" name="doc_verification_driver[accident_rate]" id="accident_rate" class="form-control" required>
        </div>
        <div class="col-md-6">
            <label for="penality_record_form">Número de Comparendos <a
                    href="https://consulta.simit.org.co/Simit/indexA.jsp" target="_blank"><img
                        src="{{ asset('img/help.png') }}" alt="" srcset="" style="width: 17px;"></a></label><br>
            <input type="number" name="doc_verification_driver[penality_record]" id="penality_record" class="form-control" required>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <label for="code_penality_1_form">Codigo Comparendo 1</label><br>
            <input type="number" name="doc_verification_driver[code_penality_1]" id="code_penality_1" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="date_penality_1_form">Fecha Comparendo 1</label><br>
            <input type="text" name="doc_verification_driver[date_penality_1]" id="date_penality_1" class="form-control" readonly>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <label for="code_penality_2_form">Codigo Comparendo 2</label><br>
            <input type="number" name="doc_verification_driver[code_penality_2]" id="code_penality_2" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="date_penality_2_form">Fecha Comparendo 2</label><br>
            <input type="text" name="doc_verification_driver[date_penality_2]" id="date_penality_2" class="form-control" readonly>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <label for="code_penality_3_form">Codigo Comparendo 3</label><br>
            <input type="number" name="doc_verification_driver[code_penality_3]" id="code_penality_3" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="date_penality_3_form">Fecha Comparendo 3</label><br>
            <input type="text" name="doc_verification_driver[date_penality_3]" id="date_penality_3" class="form-control" readonly>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <label for="code_penality_4_form">Codigo Comparendo 4</label><br>
            <input type="number" name="doc_verification_driver[code_penality_4]" id="code_penality_4" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="date_penality_4_form">Fecha Comparendo 4</label><br>
            <input type="text" name="doc_verification_driver[date_penality_4]" id="date_penality_4" class="form-control" readonly>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <label for="code_penality_5_form">Codigo Comparendo 5</label><br>
            <input type="number" name="doc_verification_driver[code_penality_5]" id="code_penality_5" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="date_penality_5_form">Fecha Comparendo 5</label><br>
            <input type="text" class="form-control" name="doc_verification_driver[date_penality_5]" id="date_penality_5" readonly>
        </div>
    </div>

</div>
<input type="button" name="previous" class="previous action-button-previous form-dataconductores" value="Anterior" />
<input type="button" name="next" class="next action-button form-dataconductores" value="Siguiente"
    id="fieldset_infouser" data-validate="{{ route('doc-verification-driver.validate-register') }}" data-error="info_user"/>