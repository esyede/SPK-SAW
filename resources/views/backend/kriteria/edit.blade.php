@extends('layouts.backend.app')

@section('title', 'Criteria')
    
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __('Edit Criteria') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('app.criteria.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="criteriaForm" action="{{ isset($criteria) ? route('app.criterias.update', $criteria->id) : route('app.criterias.store') }}" method="POST">
                @csrf
                @if (isset($criteria))
                    @method('PUT')
                @endif
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Form Criteria</h5>
                        <x-forms.textbox label="Criteria Kode" name="criteria_code" value="{{ $criteria->criteria_code ?? '' }}" field-attributes="required"></x-forms.textbox>
                        <x-forms.textbox label="Criteria Name" name="criteria_name" value="{{ $criteria->criteria_name ?? '' }}" field-attributes="required"></x-forms.textbox>
                    </div>
                </div>

                <x-forms.button label="Reset" class="btn-danger" icon-class="fas fa-redo" on-click="resetForm('criteriaForm')"/>

                @isset($criteria)
                    <x-forms.button type="submit" label="Update" icon-class="fas fa-arrow-circle-up"/>
                @else
                    <x-forms.button type="submit" label="Submit" icon-class="fas fa-plus-circle"/>
                @endisset
            </form>
        </div>
    </div>
@endsection