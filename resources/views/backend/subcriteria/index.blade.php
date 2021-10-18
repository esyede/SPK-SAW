@extends('layouts.backend.app')

@section('title', 'Sub Kriteria')

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
                <div>{{ __('Daftar Sub Kriteria') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{route('sub-criteria.create')}}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        {{ __('Tambah Sub Kriteria') }}
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
                            <th >Kriteria</th>
                            <th >Nama Sub Kriteria</th>
                            <th >Kode Sub Kriteria</th>
                            <th >Standard nilai</th>
                            <th >Dibuat</th>
                            <th >Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($subcriteria as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->criteria->criteria_name}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->subcriteria_code}}</td>
                                    <td>{{$data->standard_value}}</td>
                                    <td>{{ $data->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="{{ route('sub-criteria.edit', $data->id) }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $data->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <form id="delete-form-{{ $data->id }}" action="{{ route('sub-criteria.destroy', $data->id) }}" method="POST" style="display: none;">
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
