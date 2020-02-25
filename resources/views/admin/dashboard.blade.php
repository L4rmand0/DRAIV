@extends('layouts-admin.app') @section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <input type="hidden" id="dashboard_company_id" value="{{ $company_active }}">
    <input type="hidden" id="function_barchart_education" value="{{ route('drivers-info.education-chart') }}">
    <input type="hidden" id="function_barchart_civil_state" value="{{ route('drivers-info.civil-state-chart') }}">
    <input type="hidden" id="function_barchart_category" value="{{ route('drivers-info.category-chart') }}">
    <input type="hidden" id="function_barchart_licence_state" value="{{ route('drivers-info.state-licence-chart') }}">
    <input type="hidden" id="function_barchart_type_v" value="{{ route('admin.vehicle.type-v-chart') }}">
    <input type="hidden" id="function_pie_owner_v" value="{{ route('admin.vehicle.owner-v-chart') }}">
    <input type="hidden" id="function_pie_line_v" value="{{ route('admin.vehicle.line-v-chart') }}">
    <input type="hidden" id="function_pie_brand_v" value="{{ route('admin.vehicle.brand-v-chart') }}">
    <input type="hidden" id="function_pie_model_v" value="{{ route('admin.vehicle.model-v-chart') }}">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="function_total_drivers" value="{{ route('drivers-info.total-drivers') }}">
    <input type="hidden" id="function_total_vehicles" value="{{ route('drivers-info.total-vehicles') }}">
    <input type="hidden" id="function_gender" value="{{ route('drivers-info.gender') }}">
    <input type="hidden" id="function_calification_average" value="{{ route('drivers-info.average-score') }}">
    <input type="hidden" id="function_licence_expiration" value="{{ route('drivers-info.licence-expiration-number') }}">
    <input type="hidden" id="function_licence_expirated" value="{{ route('drivers-info.licence-expirated-number') }}">
    <input type="hidden" id="function_soat_expiration" value="{{ route('drivers-info.soat-expiration-number') }}">
    <input type="hidden" id="function_soat_expirated" value="{{ route('drivers-info.soat-expirated-number') }}">
    <input type="hidden" id="function_technomecanical_expiration"
        value="{{ route('drivers-info.technomecanical-expiration-number') }}">
    <input type="hidden" id="function_technomecanical_expirated"
        value="{{ route('drivers-info.technomecanical-expirated-number') }}">
    <input type="hidden" id="function_drivers_verify"
        value="{{ route('admin.doc-verification.drivers-verify-chart') }}">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" id="name_company_dashboard">Dashboard {{ $company_active_name }}</h1>
        <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="report_generate"><i
                class="fas fa-download"></i> Generar Reporte</a>-->
    </div>
    <div class="row">
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card shadow h-60 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <form action="">
                                <div class="row">
                                    @if ($multiple_admin)
                                    <div class="col-md-4">
                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1 ml-1">
                                            Compañía</div>
                                        <select class="ml-2" name="" class="mt-3" id="select_company_dash"
                                            style="width: 37%;" data-url="{{ route('drivers-select-lists')}}">
                                            @foreach ($child_companies as $company)
                                            @if ($company['id'] == $company_active)
                                            <option value="{{ $company['id'] }}" selected>{{ $company['name'] }}
                                            </option>
                                            @else
                                            <option value="{{ $company['id'] }}">{{ $company['name'] }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif
                                    <div class="col-md-4">
                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1 ml-1">
                                            Cédula Conductor</div>
                                        <select name="" class="mt-3" id="select_cc_driver" style="width: 37%;"
                                            data-url="{{ route('drivers-select-lists')}}" hidden>
                                        </select>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1 ml-1"></div>
                                        <button type="reset" class="btn btn-secondary text-right" data-toggle="modal"
                                            data-target=".sumarize">Exportar Datos</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="mb-3">Información de Conductores</h4>
    <!-- Content Row -->
    <div class="row">

        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
        {{-- <script src="{{ asset('Chartjs/Chart.min.js') }}" defer></script>
        <script src="{{ asset('Chartjs/chartjs-datalabel.js') }}" defer></script> --}}
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Número de Conductores</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="card_driver_number">
                                {{ $total_drivers }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Número de Vehículos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="card_vehicle_number">
                                {{ $total_vehicles }}</div>
                        </div>
                        {{-- <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-0">Hombres:</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-0">mujeres: </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-1">
                                        <span class="h5 mb-0 font-weight-bold text-gray-800"
                                            id="man_number">{{ $total_man }}</span>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="woman_number">
                                            {{ $total_woman }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Calificación Promedio</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="calification_average_number">
                                {{ $score_average }}</div>
                        </div>
                        <div class="col-auto">
                            {{-- <i class="fas fa-comments fa-2x text-gray-300"></i> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-6 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Escolaridad Conductores</h6>
                </div>
                <div class="card-body">
                    <canvas id="education_chart" width="400" height="200"
                        data-url-driver="{{ route('drivers-info.education-chart') }}"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Estado Civil Conductores</h6>
                </div>
                <div class="card-body">
                    <canvas id="civil_state_chart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <h4 class="mb-3">Información de Licencias de Conducir</h4>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Estado De Licencias de Conducir</h6>
                </div>
                <div class="card-body">
                    <canvas id="driving_licence_state_chart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Categoría de Licencias</h6>
                </div>
                <div class="card-body">
                    <canvas id="category_chart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <h4 class="mb-3">Información de Vehículos</h4>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tipos de Vehículo</h6>
                </div>
                <div class="card-body">
                    <canvas id="type_v_chart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Propietarios</h6>
                </div>
                <div class="card-body">
                    <canvas id="owner_v_chart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Marcas Vehículo</h6>
                </div>
                <div class="card-body">
                    <canvas id="brand_v_chart" width="400" height="500"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Línea de Vehículo</h6>
                </div>
                <div class="card-body">
                    <canvas id="line_v_chart" width="400" height="500"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Modelo Vehículo</h6>
                </div>
                <div class="card-body">
                    <canvas id="model_v_chart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Conductores Verificados {{ $company_name }}</h6>
                </div>
                <div class="card-body">
                    <canvas id="drivers_v_chart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display: flex; justify-content: center;">
        <div class="col-lg-12 mb-4">
            <div class="row">
                <div class="col-lg-2 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Licencias Próximas a Vencer
                            <div class="text-white-50 small" id="prox_expi_licences_number">{{ $licences_expiration }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Licencias Vencidas
                            <div class="text-white-50 small" id="card_licence_expirated_number">
                                {{ $licences_expirated }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Soats Próximos a Vencer
                            <div class="text-white-50 small" id="card_soat_expiration_number">{{ $soats_expiration }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Soats Vencidos
                            <div class="text-white-50 small" id="card_soat_expirated_number">{{ $soats_expirated }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mb-4">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Tec. Próximas a Vencer
                            <div class="text-white-50 small" id="card_technomecanical_expiration_number">
                                {{ $technomecanical_expiration }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 mb-4">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Tecnomecánicas Vencidas
                            <div class="text-white-50 small" id="card_technomecanical_expirated_number">
                                {{ $technomecanical_expirated }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade sumarize" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Resumen de Datos de <span
                            id="span_name_company">{{ $company_name }}</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped nowrap" id="table_sumarize"
                        data-url="{{ route('drivers-info.sumarize-view') }}" style="width:100%">
                        <thead>
                            <tr>
                                <th>Primer Nombre</th>
                                <th>Segundo Nombre</th>
                                <th>Primer Apellido</th>
                                <th>Segundo Apellido</th>
                                <th>Licencia</th>
                                <th>Categoría</th>
                                <th>Fecha Exp. Licencia</th>
                                <th>Fecha Vencimiento Licencia</th>
                                <th>País Licencia</th>
                                <th>Placa</th>
                                <th>Tipo Vehículo</th>
                                <th>Propietario</th>
                                <th>Tipo Taxi</th>
                                <th>Num. Conductores</th>
                                <th>Fecha vencimiento soat</th>
                                <th>Capacidad</th>
                                <th>Servicio</th>
                                <th>Cilindraje</th>
                                <th>modelo</th>
                                <th>Línea</th>
                                <th>Marca</th>
                                <th>Color</th>
                                <th>Fecha de Tecnomecánica</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin/dashboard.js') }}" defer></script>

    <!-- /.container-fluid -->

    @endsection
    <!-- End of Main Content -->