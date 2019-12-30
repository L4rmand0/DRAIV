@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Imágenes</h1>
    </div>

    <!-- Content Row -->
    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-md-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4" id="card_choose_driver">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Elegir Conductor</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="" id="form_images" data-url="{{ route('admin.vehicle.store') }}"
                        data-url-delete="{{ route('driver-info.destroy') }}">
                        @csrf
                        <div class="form-card">
                            <div class="row mt-2">
                                <div class="col-md-12 form_select_conductores" id="row-taxi-inputs">
                                    <label for="driver_information_dni_id_images" style="width: 100%">C.C Conductor</label>
                                    <select name="drivers_image" class="form-control form-vehicles" id="driver_information_dni_id_images" data-url="{{ route('images.get-documents-driver')}}" style="width: 80%">
                                        <option value="">Seleccionar</option>
                                        @foreach ($list_drivers as $list_drivers_item)
                                        <option value="{{ $list_drivers_item->dni_id }}">
                                            {{ $list_drivers_item->dni_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Button trigger modal -->
                    </form>
                </div>
            </div>
            <div class="card shadow mb-4" id="card_choose_driver">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-secondary">Lista de Archivos</h6>
                </div>
                <div class="card-body" id="card_body_list_documents">
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4" id="card_upload_images">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Archivos</h6>
                </div>
                <div class="card-body">
                    @foreach ($type_images as $type_images_key => $item_type_images)
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('images.store') }}" class="form_upload_image"
                                accept-charset="UTF-8" enctype="multipart/form-data" data-key="{{ $item_type_images }}">
                                @csrf
                                <label for="customFile" class="text-secondaty ml-2"> {{ $type_images_key }} </label>
                                <div class="custom-file overflow-hidden rounded-pill mb-1">
                                    <input id="file{{$item_type_images}}" class="input_files_drivers" type="file"
                                        name="file" class="custom-file-input rounded-pill">
                                    <label for="file{{$item_type_images}}"
                                        class="custom-file-label rounded-pill name_file">Seleccionar ...</label>
                                </div>
                                <span class="error_file ml-2" role="alert" id="file-error" style="color:#B62A2A;">
                                    
                                </span>
                                <div class="d-flex justify-content-center mt-2">
                                    <input type="submit" value="Subir" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="col-md-6 mb-4">
        </div>

    </div>
    <script src="{{ asset('js/admin/images.js') }}" defer></script>
    <!-- /.container-fluid -->

    @endsection
    <!-- End of Main Content -->