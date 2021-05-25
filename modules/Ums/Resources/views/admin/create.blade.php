@extends('admin.layouts.master')
@section('title')
    {{ __('admin/admin/create.create') }} | {{ __('admin/admin/create.admin') }}
@stop
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('admin/admin/create.admin') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('admin/admin/create.user_control') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.ums.admin.index') }}">{{ __('admin/admin/create.admin') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin/admin/create.create') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials._alert')
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{ __('admin/admin/create.create_admin') }}</h4>
                        {!! Form::open(['url' => route('backend.ums.admin.store'), 'method' => 'user', 'files' => true]) !!}
                        <div class="form-group">
                            <label for="first_name" class="@error('first_name') text-danger @enderror">{{ __('admin/admin/create.first_name') }}</label>
                            <input id="first_name" name="first_name" value="{{ old('first_name') }}"
                                   type="text"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   placeholder="{{ __('admin/admin/create.enter_first_name') }}" autofocus required>
                            @error('first_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="@error('last_name') text-danger @enderror">{{ __('admin/admin/create.last_name') }}</label>
                            <input id="last_name" name="last_name" value="{{ old('last_name') }}"
                                   type="text" class="form-control @error('last_name') is-invalid @enderror"
                                   placeholder="{{ __('admin/admin/create.enter_last_name') }}" autofocus>
                            @error('last_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="@error('email') text-danger @enderror">{{ __('admin/admin/create.email') }}</label>
                            <input id="email" name="email" value="{{ old('email') }}" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="{{ __('admin/admin/create.enter_email') }}" autofocus required>
                            @error('email')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="@error('phone') text-danger @enderror">{{ __('admin/admin/create.phone') }}</label>
                            <input id="phone" name="phone" value="{{ old('phone') }}" type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="{{ __('admin/admin/create.enter_phone') }}" autofocus required>
                            @error('phone')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password"
                                   class="@error('password') text-danger @enderror">{{ __('admin/admin/create.password') }}</label>
                            <input id="password" name="password" value="{{ old('password') }}"
                                   type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="{{ __('admin/admin/create.enter_password') }}" autofocus required>
                            @error('password')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation"
                                   class="@error('password_confirmation') text-danger @enderror">{{ __('admin/admin/create.confirm_password') }}</label>
                            <input id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"
                                   type="password"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   placeholder="{{ __('admin/admin/create.re_enter_password') }}" autofocus required>
                            @error('password_confirmation')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="avatar" class="@error('avatar') text-danger @enderror">{{ __('admin/admin/create.avatar') }}</label>
                            <input id="avatar" name="avatar" value="{{ old('avatar') }}" type="file" class="form-control @error('avatar') is-invalid @enderror" placeholder="Select File" autofocus>
                            @if(isset($user->avatar->name))
                                <span class="invalid-feedback text-dark" role="alert"><strong>{{ __('admin/admin/create.avatar') }}: {{ $user->avatar->name }}</strong></span>
                            @endif
                            @error('avatar')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <input type="hidden" name="roles[]" value="admin">
                        <div class="button-items float-right">
                            <a href="{{ route('backend.ums.admin.index') }}" type="button"
                               class="btn btn-danger waves-effect waves-light">{{ __('admin/admin/create.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">{{ __('admin/admin/create.submit') }}
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('style')
    <link href="{{ asset('common/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('script')
    <script src="{{ asset('common/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/form-advanced.init.js') }}"></script>
@stop