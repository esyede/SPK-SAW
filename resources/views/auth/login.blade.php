@extends('layouts.frontend.app')

@section('content')
<div class="register-photo">
    <div class="form-container">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <h2 class="text-center">
                Sistem Pendukung Keputusan Pemberian Gaji Karyawan
            </h2>
            <h2 class="mb-3"><strong>Login</strong></h2>
            <div class="form-group">
                <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <input id="password" placeholder="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember" style="padding-top: 0.1rem;">Ingat saya</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">
                    {{ __('Login') }}
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
</div>	
@endsection
