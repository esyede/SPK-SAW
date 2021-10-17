@extends('layouts.backend.app')

@section('title','Pengaturan Tampilan')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Pengaturan Tampilan</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            @include('backend.settings.sidebar')
        </div>
        <!-- left column -->
        <div class="col-md-9">
            {{-- how to use callout --}}
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Panduan:</h5>
                    <p>Anda bisa mendapatkan value dari setiap pengaturan dari mana saja dengan memanggil <code>setting('key')</code></p>
                </div>
            </div>
            <!-- form start -->
            <form id="settingsFrom" autocomplete="off" role="form" method="POST" action="{{ route('settings.appearance.update') }}"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <!-- general form elements -->
                <div class="main-card mb-3 card">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="site_logo">Logo situs <code>{ key: site_logo }</code></label>
                            <input type="file" name="site_logo" id="site_logo"
                                   class="dropify @error('site_logo') is-invalid @enderror"
                                   data-default-file="{{ setting('site_logo') != null ?  Storage::url(setting('site_logo')) : '' }}">
                            @error('site_logo')
                                <span class="text-danger" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="site_favicon">Favicon (saran: 33px x 33px) <code>{ key: site_favicon }</code></label>
                            <input type="file" name="site_favicon" id="site_favicon"
                                   class="dropify @error('site_favicon') is-invalid @enderror"
                                   data-default-file="{{ setting('site_favicon') != null ?  Storage::url(setting('site_favicon')) : '' }}">
                            @error('site_favicon')
                                <span class="text-danger" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                            @enderror
                        </div>

                        <button type="button" class="btn btn-danger" onClick="resetForm('settingsFrom')">
                            <i class="fas fa-redo"></i>
                            <span>Reset</span>
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-arrow-circle-up"></i>
                            <span>Simpan</span>
                        </button>

                    </div>
                </div>
                <!-- /.card -->
            </form>
        </div>
    </div>
    <!-- /.row -->
@endsection
