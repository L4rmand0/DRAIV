<div id="card-form-vehicles">
    <div class="card">
        <div class="card-header">
            &PLACA
        </div>
        <div class="card-body">
            @php
            $cont = 1;
            @endphp
            @foreach ($type_images_vehicle as $type_images_key => $item_type_images)
            @if($cont == 1)
            @php $cont++; @endphp
            <div class="row">
                <div class="col-md-4">
                    <label for="customFile" class="text-secondaty ml-2"> {{ $type_images_key }} </label>
                    <div class="custom-file overflow-hidden rounded-pill mb-1">
                        <input id="file{{$item_type_images}}" type="file" name="file[][{{$item_type_images}}]"
                            style="cursor:pointer;" class="custom-file-input rounded-pill input_files_drivers"
                            accept=".jpg, .jpeg" data-key="{{ $item_type_images }}">
                        <label for="file{{$item_type_images}}"
                            class="custom-file-label rounded-pill name_file">Seleccionar
                            ...</label>
                    </div>
                    <div class="d-flex justify-content-center mt-1">
                        <input type="button" value="Cargar" class="btn btn-primary btn_images_vehicle form-dataconductores text-white"
                            data-key="{{ $item_type_images }}" data-index="">
                    </div>
                    <span class="error_file{{ $item_type_images }} ml-2" role="alert" id="file-error"
                        style="color:#B62A2A;">
                    </span>
                </div>
                @if($type_images_key == $last_element_type_images_v)
            </div>
            @endif
            @continue
            @endif
            @if($cont == 2)
            @php $cont++; @endphp
            <div class="col-md-4">
                <label for="customFile" class="text-secondaty ml-2"> {{ $type_images_key }} </label>
                <div class="custom-file overflow-hidden rounded-pill mb-1">
                    <input id="file{{$item_type_images}}" type="file" name="file[][{{$item_type_images}}]"
                        style="cursor:pointer;" class="custom-file-input rounded-pill input_files_drivers"
                        accept=".jpg, .jpeg" data-key="{{ $item_type_images }}">
                    <label for="file{{$item_type_images}}" class="custom-file-label rounded-pill name_file">Seleccionar
                        ...</label>
                </div>
                <div class="d-flex justify-content-center mt-1">
                    <input type="button" value="Cargar" class="btn btn-primary btn_images_vehicle form-dataconductores text-white"
                        data-key="{{ $item_type_images }}" data-index="">
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
                <input id="file{{$item_type_images}}" type="file" name="file[][{{$item_type_images}}]"
                    style="cursor:pointer;" class="custom-file-input rounded-pill input_files_drivers"
                    accept=".jpg, .jpeg" data-key="{{ $item_type_images }}">
                <label for="file{{$item_type_images}}" class="custom-file-label rounded-pill name_file">Seleccionar
                    ...</label>
            </div>
            <div class="d-flex justify-content-center mt-1">
                <input type="button" value="Cargar" class="btn btn-primary btn_images_vehicle form-dataconductores text-white"
                    data-key="{{ $item_type_images }}" data-index="">
            </div>
            <span class="error_file{{ $item_type_images }} ml-2" role="alert" id="file-error" style="color:#B62A2A;">
            </span>
        </div>
    </div>
    @continue
    @endif
    @endforeach
</div>
</div>
</div>
</div>