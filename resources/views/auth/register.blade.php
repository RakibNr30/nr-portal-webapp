@extends('auth.layouts.master')
@section('title', 'Register')
@section('content')
    {{--
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign up account</p>
            {!! Form::open(['route' => 'register', 'method' => 'post']) !!}
            <div class="input-group mb-3">
                <input id="first_name" name="first_name" placeholder="Enter first name" value="{{ old('first_name') }}" type="text" class="form-control @error('first_name') is-invalid @enderror" required autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="last_name" name="last_name" placeholder="Enter last name" value="{{ old('last_name') }}" type="text" class="form-control @error('last_name') is-invalid @enderror" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="username" name="username" placeholder="Enter username" value="{{ old('username') }}" type="text" class="form-control @error('username') is-invalid @enderror" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-key"></span>
                    </div>
                </div>
                @error('username')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="phone" name="phone" placeholder="Enter phone" value="{{ old('phone') }}" type="text" class="form-control @error('phone') is-invalid @enderror" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                    </div>
                </div>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="password" name="password" placeholder="Enter password" type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="password_confirmation" name="password_confirmation" placeholder="Re-enter password" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" required autocomplete="current-password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                </div>
            </div>
            {!! Form::close() !!}
            <div class="social-auth-links text-center mb-3">
                <p class="mb-1">- OR -</p>
                <p class="mb-0">
                    Already registered? <a href="{{ route('login') }}" class="text-center">Login Here</a>
                </p>
            </div>
        </div>
    </div>
    --}}
@endsection
