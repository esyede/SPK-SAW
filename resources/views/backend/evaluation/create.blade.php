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
                    <i class="pe-7s-note icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Tambah Penilaian</div>
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
            
                <div class="main-card mb-3 card">
                    <div class="card-body">

                        <!-- ============ DATA USERS =========== -->
                        <h5 class="card-title mb-2">Data Pegawai</h5>
                        <section class="users mt-4 mb-5">
                            <div class="row">
                                <div class="col-lg-2">
                                    <img src="{{ Auth::user()->getFirstMediaUrl('avatar', 'thumb') ?? '' }}" alt="employee-profile" width="160px" height="160px">
                                </div>
                                <div class="col-lg-4 ml-4">
                                    <div class="form-group">
                                        <label class="form-label">NIP</label>
                                        <input name="employee_number" class="form-control" value="{{ $employee->registration_code }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nama</label>
                                        <input class="form-control" value="{{ $employee->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label">Username</label>
                                        <input class="form-control" value="{{ $employee->username }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <h5 class="card-title mb-5">Tambah Penilaian</h5>
                        <section class="wizard">
                            <aside class="wizard-nav">
                                @foreach($criteria as $item)
                                <div class="wizard-step" data-type="form">
                                    <span class="dot"></span>
                                    <span>{{ $item->criteria_name }}</span>
                                </div>
                                @endforeach
                            </aside>
                            <aside class="wizard-content container">
                                {{-- @csrf --}}
                                <input name="employee_number" type="hidden" class="form-control" value="{{ $employee->registration_code }}">
                                @foreach($criteria as $item)
                                <div class="wizard-step">
                                    @foreach($item->sub_criteria as $subcriteria)
                                     <div class="form-group row">
                                        <label for="sub_criteria" class="col-sm-2 col-form-label">{{ $subcriteria->name }}</label>
                                        <div class="col-sm-10">
                                        <select class="form-control required fetch-info" name="segment_{{ $subcriteria->subcriteria_code }}">
                                            @foreach(range(1, 5) as $v)
                                            <option value="{{ $v }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </aside>
                        </section>
                    </div>
                </div>
            
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ url('/Wizard-JS/src/wizard.js') }}"></script>
    <script>
        const wizard = new Wizard();
        wizard.init();

        document.addEventListener("submitWizard", function (e) {
            
        });

        $('body').on('click', '.wizard-buttons > .finish', function() {
            var form = $('form.wizard-form');
            form.attr('action', '{{ route('evaluation.store') }}');
            $('form.wizard-form').append('@csrf');
            form.submit();
        });
    </script>
@endpush
