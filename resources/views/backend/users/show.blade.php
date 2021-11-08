@extends('layouts.backend.app')

@section('title','Detail Karyawan')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Detail Aggota</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-edit fa-w-20"></i>
                        </span>
                        {{ __('Edit') }}
                    </a>
                    <a href="{{ route('users.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <img src="{{ isset($user) ? $user->getFirstMediaUrl('avatar','thumb') : ''  }}" class="img-fluid img-thumbnail" alt="avatar">
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-10">
            <div class="main-card card">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <tbody>
                        <tr>
                            <th scope="row">Nama:</th>
                            <td>{{ $user->name }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Username:</th>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Role:</th>
                            <td>
                                @if ($user->role)
                                    <span class="badge badge-info">{{ $user->role->name }}</span>
                                @else
                                    <span class="badge badge-danger">-</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Status:</th>
                            <td>
                                @if ($user->status)
                                    <div class="badge badge-success">Aktif</div>
                                @else
                                    <div class="badge badge-danger">Nonaktif</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Terdaftar:</th>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Aktivitas terakhir:</th>
                            <td>{{ $user->updated_at->diffForHumans() }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Login terakhir:</th>
                            <td>{{ $user->last_login_at }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
