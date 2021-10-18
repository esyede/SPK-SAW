@extends('layouts.frontend.app')

@section('content')
<div class="register-photo">
    <div class="form-container">
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <h2 class="mb-3"><strong>Reset Password</strong></h2>
            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">
                    Konfirmasi Password
                </button>
            </div>
            @if (Route::has('password.request'))
                <a class="already" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </form>
        <div class="image-holder"></div>
    </div>
</div
@endsection
