@extends('layouts.app')
@section('title', 'Estudiantes')
@section('content')
    <div class="page-inner">
        <x-breadcrumb title="Estudiantes" />

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Lista de Estudiantes</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="estudiante_table" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>C.I</th>
                                        <th>Nombre Completo</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/app/estudiante.js') }}"></script>
@endpush
