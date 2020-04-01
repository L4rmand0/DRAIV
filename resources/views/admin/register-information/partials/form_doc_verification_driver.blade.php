<div class="row mb-3 mt-3">
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Licencia Vigente:
    </div>
    <div class="col-md-3"> <input type="text" class="form-control" name="" id="valid_licence" value=""
            data-module="driver-info" readonly>
        <select name="" id="edit_input_valid_licence" class="form-control" hidden>
            <option value="">Seleccionar ...</option>
            <option value="Y">Sí</option>
            <option value="N">No</option>
        </select>
    </div>
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Categoría de Licencia:
    </div>
    <div class="col-md-3"><input type="text" class="form-control" name="" id="category" value=""
            data-module="driver-info" readonly>
        <select name="" class="form-control" style="width: 100%" id="edit_input_category_form" hidden>
            <option value="">Seleccionar ...</option>
            @foreach ($category_list as $category_item)
            <option value="{{ $category_item }}">{{ $category_item }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Estado RUNT:
    </div>
    <div class="col-md-3"> <input type="text" class="form-control" name="" id="runt_state" value=""
            data-module="driver-info" readonly>
        <select name="" class="form-control" style="width: 100%" id="run_state_form" hidden>
            <option value="">Seleccionar ...</option>
            @foreach ($runstate_list as $runstate_item)
            <option value="{{ $runstate_item }}">{{ $runstate_item }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Accidentes Reportados:
    </div>
    <div class="col-md-3"><input type="text" class="form-control" name="" id="accident_rate"
            value="" data-module="driver-info" readonly></div>
</div>
<div class="row mb-3">
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Número de Comparendos:
    </div>
    <div class="col-md-3"> <input type="text" class="form-control" name="" id="penality_record"
            value="" data-module="driver-info" readonly>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Fecha Comparendo 1:</div>
    <div class="col-md-3"> <input type="text" class="form-control" name="" id="date_penality_1"
            value="" data-module="driver-info" readonly>
    </div>
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Código Comparendo 1:</div>
    <div class="col-md-3"><input type="text" class="form-control" name="" id="code_penality_1" value=""
            data-module="driver-info" readonly></div>
</div>
<div class="row mb-3">
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Fecha Comparendo 2:</div>
    <div class="col-md-3"> <input type="text" class="form-control" name="" id="date_penality_2" value=""
            data-module="driver-info" readonly>
    </div>
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Código Comparendo 1:</div>
    <div class="col-md-3"><input type="text" class="form-control" name="" id="code_penality_2" value="" readonly></div>
</div>
<div class="row mb-3">
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Fecha Comparendo 3:</div>
    <div class="col-md-3"><input type="text" class="form-control" name="" id="date_penality_3" value="" readonly>
    </div>
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Código Comparendo 3:</div>
    <div class="col-md-3"> <input type="text" class="form-control" name="" id="code_penality_3" value="" readonly>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Fecha Comparendo 4:</div>
    <div class="col-md-3"><input type="text" class="form-control" name="" id="date_penality_4"
            value="" data-module="driver-info" readonly>
    </div>
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Código Comparendo 4:</div>
    <div class="col-md-3"> <input type="text" class="form-control" name="" id="code_penality_4" value=""
            data-module="driver-info" readonly>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Fecha Comparendo 5:</div>
    <div class="col-md-3"><input type="text" class="form-control" name="" id="date_penality_5"
            value="" data-module="driver-info" readonly>
    </div>
    <div class="col-md-3" style="display: flex;align-items: center;justify-content: center;">Código Comparendo 5:</div>
    <div class="col-md-3"> <input type="text" class="form-control" name="" id="code_penality_5" value=""
            data-module="driver-info" readonly>
    </div>
</div>