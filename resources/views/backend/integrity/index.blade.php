@extends('layouts.backend.app')

@section('title', 'Pembobotan Nilai')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph3 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Daftar Pembobotan Nilai</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('integrity.create') }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        Tambah
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="datatable" class="mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Deskripsi</th>
                            <th>Bobot</th>
                            <th>Gap</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($integrities as $integrity)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>{{ $integrity->description }}</td>
                                    <td>{{ $integrity->integrity }}</td>
                                    <td>{{ $integrity->difference_value }}</td>
                                    <td>{{ $integrity->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm" data-toggle="tooltip" title="Edit" href="{{ route('integrity.edit', $integrity->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Hapus" onclick="deleteData({{ $integrity->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <form id="delete-form-{{ $integrity->id }}" action="{{ route('integrity.destroy', $integrity->id) }}" method="POST" style="display: none;">
                                            @csrf()
                                            @method('DELETE')
                                        </form>
                                    </td>
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

            let table = $('#datatable').DataTable({
                dom: 'Bfrtip',
                lengthChange: false,
                buttons: buttons,
                language: {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Indonesian.json"}
            });

            table.buttons().container().appendTo('#datatable_wrapper .col-sm-6:eq(0)');

            let tooltip = $('.tooltip');
            if (tooltip.length) tooltip.tooltip();
        });
    </script>
@endpush
