@extends('admin.layouts.master')
@section('title')
    {{ __('admin/profile/change_password.change_password') }}
@stop
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('admin/profile/change_password.profile') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">{{ __('admin/profile/change_password.my_profile') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin/profile/change_password.change_password') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        @include('admin.partials._profile_menu', ['active' => 3])
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        @include('admin.partials._alert')
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">{{ __('admin/profile/change_password.update_security_info') }}</h4>
                                {!! Form::open(['url' => route('backend.ums.profile-change-password.update', [$user->id]), 'method' => 'put']) !!}
                                <div class="form-group">
                                    <label for="old_password" class="@error('old_password') text-danger @enderror">{{ __('admin/profile/change_password.old_password') }}</label>
                                    <input id="old_password" name="old_password"
                                           type="Password"
                                           class="form-control @error('old_password') is-invalid @enderror"
                                           placeholder="{{ __('admin/profile/change_password.old_password') }}" autofocus required>
                                    @error('old_password')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="@error('password') text-danger @enderror">{{ __('admin/profile/change_password.password') }}</label>
                                    <input id="password" name="password"
                                           type="Password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="{{ __('admin/profile/change_password.enter_password') }}" autofocus required>
                                    @error('password')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="repeat_password" class="@error('repeat_password') text-danger @enderror">{{ __('admin/profile/change_password.retype_password') }}</label>
                                    <input id="repeat_password" name="repeat_password"
                                           type="Password" class="form-control @error('repeat_password') is-invalid @enderror"
                                           placeholder="{{ __('admin/profile/change_password.retype_password') }}" autofocus>
                                    @error('repeat_password')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="button-items float-right">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        {{ __('admin/profile/change_password.save_changes') }}
                                    </button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
