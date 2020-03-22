@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<input type="hidden" id="function-list-driver-vehicles" value="{{ route('drivers-info.list-driver-vehicles') }}">
<input type="hidden" name="index_section" id="index_section">
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-8 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3" style="-webkit-box-shadow: 10px 10px 5px -3px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 5px -3px rgba(0,0,0,0.75);box-shadow: 10px 10px 5px -3px rgba(0,0,0,0.75);">
                <h2><strong>Registro de Evaluación</strong></h2>
                <p>Llene todo los campos del formulario y vaya al siguiente paso</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form action="" method="POST" id="msform" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf
                            <!-- progressbar -->
                            <ul id="progressbar" style="display: flex;justify-content: center;align-items: center;">
                                <li id="empty"><strong></strong></li>
                                <li id="personal" class="active"><strong>Componente Humano</strong></li>
                                <li id="Licence"><strong>Componente Técnico</strong></li>
                                <li id="empty"><strong></strong></li>
                                {{-- <li id="photos"><strong>Imágenes</strong></li>
                                <li id="vehicle"><strong>Vehículo</strong></li> --}}
                            </ul> <!-- fieldsets -->
                            <fieldset>
                                @include('admin.partials.evaluation.choose-driver')
                            </fieldset>
                            <fieldset>
                                @include('admin.partials.evaluation.doc-verification-driver')
                            </fieldset>
                            <fieldset data-endsection="true">
                                @include('admin.partials.evaluation.skill-m-t-m-driver')
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="example_card_skill" hidden>
    @include('admin.register-information.partials.card_skill_m_t_m')
</div>

<!-- /.container-fluid -->
<link href="{{ asset('css/upload-form.css') }}" rel="stylesheet">
<link href="{{ asset('css/styleinfouser.css') }}" rel="stylesheet">
<script src="{{ asset('js/dataconductores.js') }}" defer></script>
<script src="{{ asset('js/styleinfouser.js') }}" defer></script>
<script src="{{ asset('js/admin/register-evaluation.js') }}" defer></script>
<script>
</script>
@endsection
<!-- End of Main Content -->