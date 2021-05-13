@extends('auth.layouts.master')

@section('title')
    Login
@stop

@section('content')
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="row">
            <div class="col-12 mb-1">
                <img style="width: 100%" src="{{ $global_site->logo->file_url ?? config('core.image.default.logo') }}" alt="logo">
            </div>
        </div>
        <div class="card overflow-hidden">
            <div class="bg-login text-center" style="height: 243px !important;">
                <div class="bg-login-overlay"></div>
                <div class="position-relative" style="top: 18px !important;">
                    <h5 class="text-white font-size-20">Welkom terug !</h5>
                    <p class="text-white-50 mb-0">Log in om door te gaan naar {{ $global_site->title ?? 'Chique Wonen' }}</p>

                </div>
            </div>
            <div class="card-body pt-5">
                <div class="p-2">
                    {!! Form::open(['route' => 'login', 'method' => 'post']) !!}
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="E-mail" required autocomplete="email" autofocus>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Wachtwoord</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="{{ old('password') }}" placeholder="******" required autocomplete="password" autofocus>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                        <label class="custom-control-label" for="customControlInline">Onthoud me</label>
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log in</button>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Je wachtwoord vergeten?</a>
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
