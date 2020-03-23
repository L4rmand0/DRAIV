<div class="card" id="card_form_doc_v_vehicle">
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseItem_&PLACA"
                aria-expanded="true" aria-controls="collapseItem">
                PLACA: &PLACA
            </button>
        </h5>
    </div>
    <div id="collapseItem_&PLACA" class="collapse show" aria-labelledby="headingOne"
        data-parent="#accordion_doc_verification_vehicle">
        <div class="card-body">
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="valid_licence_form">Soat <a
                            href="https://www.runt.com.co/consultaCiudadana/#/consultaPersona" target="_blank"><img
                                src="{{ asset('img/help.png') }}" alt="" srcset="" style="width: 17px;"></a></label><br>
                    <select name="doc_verification_vehicle[&PLACA][soat]" id="&PLACAsoat" class="form-control">
                        <option value="">Seleccionar ...</option>
                        <option value="Y">Sí</option>
                        <option value="N">No</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label for="category_form">Revisión Tecnomecánica</label>
                    <select name="doc_verification_vehicle[&PLACA][technom_review]" id="&PLACAtechnom_review" class="form-control">
                        <option value="">Seleccionar ...</option>
                        <option value="Y">Sí</option>
                        <option value="N">No</option>
                    </select>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 form_select_conductores">
                    <label for="run_state_form">Fecha de Vencimiento<a
                            href="https://www.runt.com.co/consultaCiudadana/#/consultaPersona" target="_blank"><img
                                src="{{ asset('img/help.png') }}" alt="" srcset="" style="width: 17px;"></a></label><br>
                    <select name="doc_verification_vehicle[&PLACA][expi_date]" class="form-control" style="width: 100%"
                        id="&PLACAexpi_date">
                        <option value="">Seleccionar ...</option>
                        @foreach ($runstate_list as $runstate_item)
                        <option value="{{ $runstate_item }}">{{ $runstate_item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>