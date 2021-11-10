@extends('layouts.backend.app')

@section('title','Pegawai')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ (isset($user) ? 'Edit' : 'Tambah') . ' Anggota' }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
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
        <div class="col-12">
            <!-- form start -->
            <form role="form" id="userFrom" method="POST"
                  action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
                  enctype="multipart/form-data">
                @csrf
                @if (isset($user))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Info Anggota</h5>
                                <div class="form-group">
                                    <label class="form-label">NIP Pegawai</label>
                                    <input type="text" class="form-control" name="registration_code" value="{{ $user->registration_code ?? '' }}" placeholder="NIP Pegawai" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="name" value="{{ $user->name ?? '' }}" placeholder="Nama user" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="username" class="form-control" name="username" value="{{ $user->username ?? '' }}" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="******">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Ulangi Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="******">
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-4">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Role & Status</h5>
                                <div class="form-group">
                                    <label class="form-label">Role</label>
                                    <select class="form-control required fetch-info" name="role">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" selected="{{ $user->role->id ?? null }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <select class="form-control required fetch-info" name="status">
                                        <option value="0" {{ (isset($user->status) && (int) $user->status === 0) ? 'selected' : '' }}>Nonaktif</option>
                                        <option value="1" {{ (isset($user->status) && (int) $user->status === 1) ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-danger" onclick="resetForm('userForm')">
                                    <i class="fas fa-redo"></i> Reset
                                </button>
                                @isset($user)
                                    <button type="submit" class="btn btn-info ml-3">
                                    <i class="fas fa-arrow-circle-up"></i> Perbarui
                                </button>
                                @else
                                    <button type="submit" class="btn btn-info ml-3">
                                        <i class="fas fa-plus-circle"></i> Simpan
                                    </button>
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
