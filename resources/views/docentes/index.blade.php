@extends('layouts.app')
@section('title', 'Docentes')
@section('content')
    <div class="page-inner">
        <x-breadcrumb title="Docentes" />

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Lista de Docentes</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="teachers_table" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>C.I.</th>
                                        <th>Nombre Completo</th>
                                        <th>Fecha de registro</th>
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
    <script src="{{ asset('js/app/docente.js') }}"></script>
@endpush
