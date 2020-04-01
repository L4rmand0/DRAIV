<input type="hidden" name="has_autos" id="has_autos" value="false">
<input type="hidden" name="has_motos" id="has_motos" value="false">
<div class="form-card">
    {{-- <h2 class="fs-title mt-2">Información Del Vehículo</h2> --}}
    <h2 class="fs-title" style="margin-bottom: 20px">Evaluación de Habilidades del Conductor</h2>
    <div id="accordion_skills">
                
    </div>
</div>
<input type="button" name="previous" class="previous action-button-previous form-dataconductores" value="Anterior" />
<input type="button" name="next" class="next action-button form-dataconductores" value="Siguiente"
    id="fieldset_infouser" data-validate="{{ route('skills-m-t-m.validate-register') }}" data-error="info_user"/>