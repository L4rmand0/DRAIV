<div class="form-card">
    <input type="hidden" id="function_store_image" value="{{ route('images.store') }}">
    <input type="hidden" id="function_update_images" value="{{ route('images.update')}}">
    <h2 class="fs-title" style="margin-bottom: 20px">Imágenes del Vehículo - Vehículo</h2>
    <div id="forms_images_vehicle">
        
    </div>
</div>
<input type="button" name="previous" class="previous action-button-previous form-dataconductores"
    value="Anterior" />
<input type="button" name="next" class="next action-button form-dataconductores" value="Siguiente"
    data-validate="{{ route('images.validate') }}"
    data-error="driving_licence" />