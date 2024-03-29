@extends('admin.layouts.master')
@section('title')
    {{ __('admin/profile/account_info.account_info') }}
@stop
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('admin/profile/account_info.profile') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">{{ __('admin/profile/account_info.my_profile') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin/profile/account_info.account_info') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        @include('admin.partials._profile_menu', ['active' => 0])
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        @include('admin.partials._alert')
                        <div class="card">
                            <div class="card-body">
                            <h4 class="card-title mb-4">{{ __('admin/profile/account_info.update_account_info') }}</h4>
                            {!! Form::open(['url' => route('backend.ums.profile-account-info.update', [$user->id]), 'method' => 'put', 'files' => true]) !!}
                                <div class="form-group">
                                    <label for="avatar" class="@error('avatar') text-danger @enderror">{{ __('admin/profile/account_info.avatar') }}</label>
                                    <input id="avatar" name="avatar" value="{{ old('avatar') }}" type="file" class="form-control @error('avatar') is-invalid @enderror" placeholder="Select File" autofocus>
                                    @if(isset($user->avatar))
                                        <div class="image-output">
                                            <img src="{{ $user->avatar->file_url }}">
                                        </div>
                                    @endif
                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="@error('phone') text-danger @enderror">{{ __('admin/profile/account_info.phone') }}</label>
                                    <input id="phone" name="phone"
                                           value="{{ old('phone') ?: $user->phone }}"
                                           type="text"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           placeholder="{{ __('admin/profile/account_info.enter_phone_no') }}" autofocus>
                                    @error('phone')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="@error('email') text-danger @enderror">{{ __('admin/profile/account_info.email') }}</label>
                                    <input id="email" name="email"
                                           value="{{ old('email') ?: $user->email }}"
                                           type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="{{ __('admin/profile/account_info.enter_email_address') }}" autofocus required readonly>
                                    @error('email')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="button-items float-right">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">{{ __('admin/profile/account_info.save_changes') }}
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
