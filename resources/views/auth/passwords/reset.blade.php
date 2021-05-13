@extends('auth.layouts.master')
@section('title', 'Reset Password')
@section('content')
    <div class="col-md-8 col-lg-6 col-xl-5 mb-4 mt-3">
        <div class="row">
            <div class="col-12 mb-1">
                <img style="width: 100%" src="{{ $global_site->logo->file_url ?? config('core.image.default.logo') }}" alt="logo">
            </div>
        </div>
        <div class="card overflow-hidden">
            <div class="bg-login text-center" style="height: 243px !important;">
                <div class="bg-login-overlay"></div>
                <div class="position-relative" style="top: 18px !important;">
                    <h5 class="text-white font-size-20">Reset uw vergeten wachtwoord</h5>
                </div>
            </div>
            <div class="card-body pt-5">
                <div class="p-2">
                    {!! Form::open(['route' => 'password.update', 'method' => 'post']) !!}
                    <input id="token" name="token" type="hidden" value="{{ $token }}">
                    <div class="input-group mb-3">
                        <input id="email" name="email" placeholder="E-mail" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" required>
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
                        <input id="password" name="password" placeholder="Wachtwoord" type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
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
                        <input id="password_confirmation" name="password_confirmation" placeholder="Voer paswoord opnieuw in" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" required autocomplete="current-password">
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
                            <button type="submit" class="btn btn-primary btn-block">Wachtwoord opnieuw instellen</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
