@extends('auth.layouts.master')
@section('title', 'Reset Password')
@section('content')
    <div class="col-md-8 col-lg-6 col-xl-5 mb-5 mt-5 pt-3 pb-5">
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
                    {!! Form::open(['route' => 'password.email', 'method' => 'post']) !!}
                    @if (session('status'))
                        <div class="input-group mb-3">
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif
                    <div class="input-group mb-3">
                        <input id="email" name="email" placeholder="E-mail" value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" autofocus>
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
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Stuur wachtwoord reset link</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop