@extends('layouts.backend.app')

@section('title', 'Penilaian')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __('Daftar Penilaian') }}</div>
            </div>
        </div>
    </div>

    <!-- ========== Nilai ========== -->
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex mb-2">
                <div class="h6">
                    Nilai
                </div>
                <div class="ml-auto">
                    <button type="button" class="btn btn-primary btn-sm">
                        Salin
                    </button>
                    <button type="button" class="btn btn-success btn-sm">
                        Excel
                    </button>
                    <button type="button" class="btn btn-danger btn-sm">
                        Pdf
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm">
                        Print
                    </button>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table class="datatable align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Karyawan</th>
                                <th class="text-center">Kriteria</th>
                                <th class="text-center">Nilai</th>
                                <th class="text-center">Selisih</th>
                                <th class="text-center">Nilai GAP</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
    
        <!-- ========== Rata - Rata ========== -->
        <div class="col-md-6">
            <div class="d-flex mb-2">
                <div class="h6">
                    Nilai Rata - Rata Per Faktor
                </div>
                <div class="ml-auto">
                    <button type="button" class="btn btn-primary btn-sm">
                        Salin
                    </button>
                    <button type="button" class="btn btn-success btn-sm">
                        Excel
                    </button>
                    <button type="button" class="btn btn-danger btn-sm">
                        Pdf
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm">
                        Print
                    </button>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table class="datatable align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Karyawan</th>
                                <th class="text-center">Kriteria</th>
                                <th class="text-center">Faktor</th>
                                <th class="text-center">Rata - Rata</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ========== Rata - Rata ========== -->
        <div class="col-md-6">
            <div class="d-flex mb-2">
                <div class="h6">
                    Nilai Total & Akhir
                </div>
                <div class="ml-auto">
                    <button type="button" class="btn btn-primary btn-sm">
                        Salin
                    </button>
                    <button type="button" class="btn btn-success btn-sm">
                        Excel
                    </button>
                    <button type="button" class="btn btn-danger btn-sm">
                        Pdf
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm">
                        Print
                    </button>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table class="datatable align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Karyawan</th>
                                <th class="text-center">Kriteria</th>
                                <th class="text-center">Nilai Total</th>
                                <th class="text-center">Nilai Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== Ranking ========== -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="d-flex mb-2">
                <div class="h6">
                    Ranking Karyawan
                </div>
                <div class="ml-auto">
                    <button type="button" class="btn btn-primary btn-sm">
                        Salin
                    </button>
                    <button type="button" class="btn btn-success btn-sm">
                        Excel
                    </button>
                    <button type="button" class="btn btn-danger btn-sm">
                        Pdf
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm">
                        Print
                    </button>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table class="datatable align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nama Karyawan</th>
                                <th class="text-center">Ranking</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Datatable
            $("#datatable").DataTable();
        });
    </script>
@endpush
