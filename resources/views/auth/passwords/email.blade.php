@extends('layouts.frontend.app')

@section('content')
<div class="register-photo">
    <div class="form-container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <h2 class="mb-3"><strong>Reset Password</strong></h2>
            <div class="form-group"> 
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">
                    Kirim link reset password
                </button>
            </div>
        </form>
        <div class="image-holder"></div>
    </div>
</div>	
@endsection
