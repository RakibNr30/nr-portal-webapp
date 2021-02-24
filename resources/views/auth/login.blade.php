@extends('auth.layouts.master')

@section('title')
    Login
@stop

@section('content')
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card overflow-hidden">
            <div class="bg-login text-center">
                <div class="bg-login-overlay"></div>
                <div class="position-relative">
                    <h5 class="text-white font-size-20">Welcome Back !</h5>
                    <p class="text-white-50 mb-0">Sign in to continue to {{ $global_site->title ?? 'Web Portal' }}</p>
                    <a href="{{ url('/backend/dashboard') }}" class="logo logo-admin mt-4">
                        <img src="{{ $global_site->logo_sm->favicon ?? config('core.image.default.favicon') }}" alt="" height="30">
                    </a>
                </div>
            </div>
            <div class="card-body pt-5">
                <div class="p-2">
                    {!! Form::open(['route' => 'login', 'method' => 'post']) !!}
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="Enter email" required autocomplete="email" autofocus>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}" placeholder="Enter password" required autocomplete="password" autofocus>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                        <label class="custom-control-label" for="customControlInline">Remember me</label>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="{{ '' }}" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('style')
@stop

@section('script')
@stop
