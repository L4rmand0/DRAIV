<div class="form-card">
    <input type="hidden" id="function_store_image" value="{{ route('images.store') }}">
    <input type="hidden" id="function_update_images" value="{{ route('images.update')}}">
    <h2 class="fs-title" style="margin-bottom: 20px">Imágenes del Conductor - Datos
        Personales</h2>
        @php
         $cont = 1;   
        @endphp
    @foreach ($type_images as $type_images_key => $item_type_images)  
    @if($cont == 1)
        @php $cont++; @endphp
        <div class="row">
            <div class="col-md-4">
                <label for="customFile" class="text-secondaty ml-2"> {{ $type_images_key }} </label>
                <div class="custom-file overflow-hidden rounded-pill mb-1">
                    <input id="file{{$item_type_images}}" type="file" name="file[{{$item_type_images}}]"
                        style="cursor:pointer;"
                        class="custom-file-input rounded-pill input_files_drivers"
                        accept=".jpg, .jpeg" data-key="{{ $item_type_images }}">
                    <label for="file{{$item_type_images}}"
                        class="custom-file-label rounded-pill name_file">Seleccionar
                        ...</label>
                </div>
                <div class="d-flex justify-content-center mt-1">
                    <input type="button" value="Cargar" class="btn btn-primary btn_images_drivers" data-key="{{ $item_type_images }}">
                </div>
                <span class="error_file{{ $item_type_images }} ml-2" role="alert" id="file-error"
                    style="color:#B62A2A;">
                </span>
            </div>
            @if($type_images_key == $last_element_type_images)
            </div>
            @endif
            @continue
    @endif
    @if($cont == 2)
        @php $cont++; @endphp
        <div class="col-md-4">
            <label for="customFile" class="text-secondaty ml-2"> {{ $type_images_key }} </label>
            <div class="custom-file overflow-hidden rounded-pill mb-1">
                <input id="file{{$item_type_images}}" type="file" name="file[{{$item_type_images}}]"
                    style="cursor:pointer;"
                    class="custom-file-input rounded-pill input_files_drivers"
                    accept=".jpg, .jpeg" data-key="{{ $item_type_images }}">
                <label for="file{{$item_type_images}}"
                    class="custom-file-label rounded-pill name_file">Seleccionar
                    ...</label>
            </div>
            <div class="d-flex justify-content-center mt-1">
                <input type="button" value="Cargar" class="btn btn-primary btn_images_drivers" data-key="{{ $item_type_images }}">
            </div>
            <span class="error_file{{ $item_type_images }} ml-2" role="alert" id="file-error"
                style="color:#B62A2A;">
            </span>
        </div>
        @if($type_images_key == $last_element_type_images)
        </div>
        @endif
        @continue
    @endif
    @if ($cont == 3)
        @php $cont = 1; @endphp
            <div class="col-md-4">
                <label for="customFile" class="text-secondaty ml-2"> {{ $type_images_key }} </label>
                <div class="custom-file overflow-hidden rounded-pill mb-1">
                    <input id="file{{$item_type_images}}" type="file" name="file[{{$item_type_images}}]"
                        style="cursor:pointer;"
                        class="custom-file-input rounded-pill input_files_drivers"
                        accept=".jpg, .jpeg" data-key="{{ $item_type_images }}">
                    <label for="file{{$item_type_images}}"
                        class="custom-file-label rounded-pill name_file">Seleccionar
                        ...</label>
                </div>
                <div class="d-flex justify-content-center mt-1">
                    <input type="button" value="Cargar" class="btn btn-primary btn_images_drivers" data-key="{{ $item_type_images }}">
                </div>
                <span class="error_file{{ $item_type_images }} ml-2" role="alert" id="file-error"
                    style="color:#B62A2A;">
                </span>
            </div>
        </div>
        @continue
    @endif
    @endforeach
</div>
<input type="button" name="previous" class="previous action-button-previous form-dataconductores"
    value="Anterior" />
<input type="button" name="next" class="next action-button form-dataconductores" value="Siguiente"
    data-validate="{{ route('images.validate') }}"
    data-error="driving_licence" />