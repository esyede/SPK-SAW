@extends('layouts.backend.app')

@section('title','Halaman: ' . $page->title)

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-lock icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ $page->title }}</div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    {!! $page->body !!}
                </div>
            </div>
        </div>
    </div>
@endsection
