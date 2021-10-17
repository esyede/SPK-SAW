@extends('layouts.frontend.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verifikasi alamat email anda</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Link verifikasi baru telah dikirim ke alamat email anda.
                        </div>
                    @endif

                    Sebelum melanjutkan, harap periksa email anda untuk link verifikasi.
                    Jika anda tidak menerima email tersebut,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                            klik di sini untuk meminta lagi
                        </button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
