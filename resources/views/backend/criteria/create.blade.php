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
                <div>{{ __('Tambah Kriteria') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('criteria.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="criteriaForm" action="{{ route('criteria.store') }}" method="POST">
                @csrf
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Kriteria</h5>
                        <x-forms.textbox label="Kode Kriteria" name="criteria_code" value="{{ $criteria->criteria_code ?? '' }}" field-attributes="required"></x-forms.textbox>
                        <x-forms.textbox label="Nama Kriteria" name="criteria_name" value="{{ $criteria->criteria_name ?? '' }}" field-attributes="required"></x-forms.textbox>
                    </div>
                </div>

                <x-forms.button label="Reset" class="btn-danger" icon-class="fas fa-redo" on-click="resetForm('criteriaForm')"/>
                <x-forms.button type="submit" label="Tambah" icon-class="fas fa-plus-circle"/>
            </form>
        </div>
    </div>
@endsection
