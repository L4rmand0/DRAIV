@extends('layouts-admin.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <input type="hidden" id="dashboard_company_id" value="{{ auth()->user()->company_id }}">
    <input type="hidden" id="function_barchart_education" value="{{ route('drivers-info.education-chart') }}">
    <input type="hidden" id="function_barchart_civil_state" value="{{ route('drivers-info.civil-state-chart') }}">
    <input type="hidden" id="function_barchart_category" value="{{ route('drivers-info.category-chart') }}">
    <input type="hidden" id="function_barchart_licence_state" value="{{ route('drivers-info.state-licence-chart') }}">
    <input type="hidden" id="function_barchart_type_v" value="{{ route('admin.vehicle.type-v-chart') }}">
    <input type="hidden" id="function_pie_owner_v" value="{{ route('admin.vehicle.owner-v-chart') }}">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard {{ $company_name }}</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="download_icon icons-fa"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <script src="{{ asset('Chartjs/Chart.min.js') }}" defer></script>
        <script src="{{ asset('Chartjs/chartjs-datalabel.js') }}" defer></script>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Número de Conductores</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_drivers }}</div>
                        </div>
                        {{-- <div class="col-auto"> --}}
                        {{-- <i class="truck_icon icons-fa"></i> --}}
                        {{-- </div> --}}
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_vehicles }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
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
                                        <span class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_man }}</span>
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_woman }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $score_average }}</div>
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
                    <canvas id="education_chart" width="400" height="200"></canvas>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Categoría de Licencias</h6>
                </div>
                <div class="card-body">
                    <canvas id="category_chart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Propietarios</h6>
                </div>
                <div class="card-body">
                    <canvas id="owner_v_chart" width="400" height="200"></canvas>
                </div>
            </div>
            <!-- Color System -->
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Licencias Próximas a Vencer
                        <div class="text-white-50 small">{{ $licences_expiration }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Soats Próximos a Vencer
                        <div class="text-white-50 small">{{ $soats_expiration }}</div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-6 mb-4">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Tecnomecánicas Próximas a Vencer
                        <div class="text-white-50 small">{{ $technomecanical_expiration }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            Warning
                            <div class="text-white-50 small">#f6c23e</div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-6 mb-4">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Tecnomecánicas Próximas a Vencer
                            <div class="text-white-50 small">{{ $technomecanical_expiration }}</div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-6 mb-4">
                    <div class="card bg-secondary text-white shadow">
                        <div class="card-body">
                            Secondary
                            <div class="text-white-50 small">#858796</div>
                        </div>
                    </div>
                </div> --}}
            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Estado Civil Conductores</h6>
                </div>
                <div class="card-body">
                    <canvas id="civil_state_chart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Estado De Licencias de Conducir</h6>
                </div>
                <div class="card-body">
                    <canvas id="driving_licence_state_chart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tipos de Vehículo</h6>
                </div>
                <div class="card-body">
                    <canvas id="type_v_chart" width="400" height="200"></canvas>
                </div>
            </div>
            
            <!-- Approach -->
            {{-- <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                    <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to
                        reduce
                        CSS bloat and poor page performance. Custom CSS classes are used to create
                        custom components and custom utility classes.</p>
                    <p class="mb-0">Before working with this theme, you should become familiar with
                        the
                        Bootstrap framework, especially the utility classes.</p>
                </div>
            </div> --}}

        </div>

        <script src="{{ asset('js/admin/dashboard.js') }}" defer></script>
    </div>

    <!-- /.container-fluid -->

    @endsection
    <!-- End of Main Content -->