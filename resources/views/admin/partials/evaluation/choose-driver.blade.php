<div class="form-card">
    <h2 class="fs-title" style="margin-bottom: 20px">Evaluación de Conductores</h2>
    <div class="row mt-2">
        <div class="col-md-6">
            <label for="valid_licence_form">Conductor a evaluar:</label><br>
            @if ($driver_dni_id === false)
            <select name="driver_select_evaluation" id="driver_select_evaluation" class="form-control item_select_evaluation" required>
                <option value="">Seleccionar...</option>
                @foreach ($driver_information_list as $list_item)
                <option value="{{ $list_item->dni_id }}">{{ $list_item->dni_id }}</option>
                @endforeach
            </select>
            @else
                <input type="text" name="driver_select_evaluation" id="driver_select_evaluation" class="form-dataconductores form-control item_input_evaluation" value="{{$driver_dni_id}}" readonly>
            @endif
        </div>
    </div>
</div>
<input type="button" name="next" class="next action-button form-dataconductores" value="Siguiente"
    id="fieldset_infouser" data-validate="{{ route('doc-verification.validate-first') }}" data-error="info_user" />