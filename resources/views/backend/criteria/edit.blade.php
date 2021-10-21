@extends('layouts.backend.app')

@section('title', 'Edit Kriteria')
    
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Edit Kriteria</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('criteria.index') }}" class="btn-shadow btn btn-danger">
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
        <div class="col-md-12">
            <form role="form" id="criteriaForm" action="{{ route('criteria.update', $criteria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Kriteria</h5>
                        <div class="form-group">
                            <label class="form-label">Kode Kriteria</label>
                            <input type="text" class="form-control" name="criteria_code" value="{{ $criteria->criteria_code ?? '' }}" placeholder="Kode kriteria" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Kriteria</label>
                            <input type="text" class="form-control" name="criteria_name" value="{{ $criteria->criteria_name ?? '' }}" placeholder="Kode kriteria" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-danger" onclick="resetForm('criteriaForm')">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-info ml-2">
                            <i class="fas fa-plus-circle"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
