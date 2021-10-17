@extends('layouts.frontend.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Selamat datang di {{ setting('site_title') }}</div>

                    <div class="card-body">
                        Buat sesuatu yang luar biasa :)
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
