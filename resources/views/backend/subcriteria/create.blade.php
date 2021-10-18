@extends('layouts.backend.app')

@section('title', 'Tambah Kriteria')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __('Tambah Sub Kriteria') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('sub-criteria.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        {{ __('Back to list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- Form Start -->
            <form role="form" id="subcriteriaForm" action="{{ route('sub-criteria.store') }}" method="POST">
                @csrf
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Sub Kriteria</h5>
                        <div class="form-group">
                            <label>Pilih Kriteria</label>
                            <select name="criteria_id" id="criteria_id" class="form-control">
                               <option>Pilih Kriteria</option>
                                @foreach($criteria as $item)
                                <option value="{{$item->id}}">{{$item->criteria_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Kode Sub Kriteria</label>
                            <input type="text" class="form-control" name="subcriteria_code" placeholder="Kode Sub Kriteria">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Sub Kriteria</label>
                            <input type="text" class="form-control" name="name" placeholder="Nama Sub Kriteria">
                        </div>
                        <div class="form-group">
                            <label for="">Nilai Standard</label>
                            <input type="number" name="standard_value" class="form-control" placeholder="Nilai Standard">
                        </div>
                    </div>
                </div>
                <x-forms.button label="Reset" class="btn-danger" icon-class="fas fa-redo" on-click="resetForm('subcriteriaForm')"/>
                <x-forms.button type="submit" label="Tambah" icon-class="fas fa-plus-circle"/>
            </form>
        </div>
    </div>
@endsection
