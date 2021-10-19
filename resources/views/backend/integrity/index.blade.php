@extends('layouts.backend.app')

@section('title', 'Pembobotan Nilai')

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
                    <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">Bobot</th>
                            <th class="text-center">Gap</th>
                            <th class="text-center">Dibuat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($integrities as $integrity)
                                <tr>
                                    <td class="text-center text-muted">#{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $integrity->description }}</td>
                                    <td class="text-center">{{ $integrity->integrity }}</td>
                                    <td class="text-center">{{ $integrity->difference_value }}</td>
                                    <td class="text-center">{{ $integrity->created_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info btn-sm" href="{{ route('integrity.edit', $integrity->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $integrity->id }})">
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
                                    <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
