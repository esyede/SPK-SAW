@extends('layouts.backend.app')

@section('title', 'Penilaian')
    
@push('css')
    <link rel="stylesheet" href="{{ url('/Wizard-JS/styles/css/main.css') }}" />
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __('Tambah Penilaian') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('users.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-left fa-w-20"></i>
                        </span>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- Form Start -->
            {{-- <form role="form" id="employeeForm" action="{{ route('evaluation.store') }}" method="POST">
                @csrf --}}
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title mb-5">Tambah Penilaian</h5>
                        <section class="wizard">
                            <aside class="wizard-nav">
                                <div class="wizard-step" data-type="form">
                                    <span class="dot"></span>
                                    <span>Karyawan</span>
                                </div>
                                <div class="wizard-step" data-type="form">
                                    <span class="dot"></span>
                                    <span>Kriteria</span>
                                </div>
                                <div class="wizard-step" data-type="form">
                                    <span class="dot"></span>
                                    <span>Destiny</span>
                                </div>
                                <div class="wizard-step" data-type="form">
                                    <span class="dot"></span>
                                    <span>Last Step</span>
                                </div>
                            </aside>
                            <aside class="wizard-content container">
                                @csrf
                                <div class="wizard-step">
                                    <div class="form-group">
                                        <label for="employee_name">Nama Karyawan</label>
                                        <input type="text" name="employee_name" class="form-control required" id="employee_name" value="{{ $employee->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="descCampaign">Description of the campaign</label>
                                        <textarea name="description" class="form-control" id="descCampaign"></textarea>
                                    </div>
                                </div>
                                <div class="wizard-step">
                                    <div class="form-group">
                                        <label for="titleNoti">Kriteria</label>
                                        <input type="text" name="title" class="form-control required banner-info" id="titleNoti" placeholder="Example: Message title">
                                    </div>
                                    <div class="form-group">
                                        <label for="bodyNoti">Body</label>
                                        <input type="text" name="body" class="form-control required banner-info" id="bodyNoti" placeholder="Example: Message body">
                                    </div>
                                    <div class="form-group">
                                        <label for="imageNoti">Image</label>
                                        <input type="file" name="image" class="form-control banner-info" id="imageNoti">
                                    </div>
                                </div>
                                <div class="wizard-step">
                                    <div class="form-group">
                                        <label for="titleNoti">Action</label>
                                        <select class="form-control" name="action">
                                            <option value="">Select one ...</option>
                                            <option value="0">Open bolus configurator</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="bodyNoti">Segment</label>
                                        <select class="form-control required fetch-info" name="segment">
                                            <option value="">Select one ...</option>
                                            <option value="0">País</option>
                                            <option value="1">Language</option>
                                            <option value="2">Diabetes Type</option>
                                            <option value="3">Center</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="wizard-step">
                                    <div class="form-group">
                                        <label for="titleNoti">Action</label>
                                        <textarea class="form-control required fetch-info">🍍</textarea>>
                                    </div>
                                </div>
                            </aside>
                        </section>
                    </div>
                </div>
            {{-- </form> --}}
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ url('/Wizard-JS/src/wizard.js') }}"></script>
    <script>
        const wizard = new Wizard();
        wizard.init();
    </script>
@endpush