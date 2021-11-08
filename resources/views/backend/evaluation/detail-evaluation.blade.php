@extends('layouts.backend.app')

@section('title', 'Penilaian')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-note icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Daftar Penilaian</div>
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
            </div>
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="score-datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Karyawan</th>
                                <th>Kriteria</th>
                                <th>Sub Kriteria</th>
                                <th>Standard Nilai Sub Kriteria</th>
                                <th>Nilai Atribut</th>
                                <th>Selisih</th>
                                <th>Konversi Nilai GAP</th>
                                @if (Auth::user()->role_id == 1)
                                <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($evaluates as $evaluate)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $evaluate->users->name }}</td>
                                    <td>{{ $evaluate->criteria->criteria_name }}</td>
                                    <td>{{ $evaluate->subcriteria->name }}</td>
                                    <td>{{ $evaluate->subcriteria_standard_value }}</td>
                                    <td>{{ $evaluate->attribute_value }}</td>
                                    <td>{{ $evaluate->gap }}</td>
                                    <td>{{ $evaluate->convertion_value }}</td>
                                    @if (Auth::user()->role_id == 1)
                                    <td>
                                        <a href="" class="btn btn-info btn-sm" id="editEvaluate" title="Edit Data" data-toggle="modal" data-target="#evaluateModal" data-attr="{{ url('evaluation/detail/edit', $evaluate->subcriteria_code) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
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
            </div>
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="mean-datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Karyawan</th>
                                <th>Kriteria</th>
                                <th>Core Faktor</th>
                                <th>Secondary Factor</th>
                                <th>Rata - Rata</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($factors as $factor)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $factor->user->name }}</td>
                                    <td>{{ $factor->criteria->criteria_name }}</td>
                                    <td>{{ $factor->core_factor_value }}</td>
                                    <td>{{ $factor->secondary_factor_value }}</td>
                                    <td>{{ $factor->total_value }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
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
            </div>
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="total-datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Karyawan</th>
                                <th>Nilai Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($grades as $grade)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $grade->user->name }}</td>
                                    <td>{{ $grade->total_grade_value }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
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
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function () {
            let buttons = [
                { "extend": 'copy', "text":'Salin',"className": 'btn btn-light btn-xs btn-copy' },
                { "extend": 'excel', "text":'Excel',"className": 'btn btn-light btn-xs btn-excel' },
                { "extend": 'pdf', "text":'PDF',"className": 'btn btn-light btn-xs btn-pdf' },
                { "extend": 'print', "text":'Print',"className": 'btn btn-light btn-xs btn-print' }
            ];

            let scoreTable = $('#score-datatable').DataTable({
                dom: 'Bfrtip',
                lengthChange: false,
                buttons: buttons
            });

            scoreTable.buttons().container().appendTo('#score_wrapper .col-sm-6:eq(0)');

            let meanTable = $('#mean-datatable').DataTable({
                dom: 'Bfrtip',
                lengthChange: false,
                buttons: buttons
            });

            meanTable.buttons().container().appendTo('#mean_wrapper .col-sm-6:eq(0)');

            let totalTable = $('#total-datatable').DataTable({
                dom: 'Bfrtip',
                lengthChange: false,
                buttons: buttons
            });

            totalTable.buttons().container().appendTo('#total_wrapper .col-sm-6:eq(0)');
        });
    </script>
@endpush
