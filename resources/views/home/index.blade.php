@extends('layouts.app')
@section('title', 'Tablero')
@section('content')
    <div class="panel-header bg-danger-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Panel Principal</h2>
                    <h3 class="text-white op-7 mb-2">{{ $greeting }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title">Estadísticas Generales</div>
                        <div class="card-category">Información diaria de actividad en el sistema</div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="usersCount"></div>
                                <h6 class="fw-bold mt-3 mb-0">Usuarios</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Grafica Barras</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Grafica Torta</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const activeUsers = {{ $activeUsers }};
    </script>
    <script src="{{ asset('js/app/home.js') }}"></script>
@endpush
