@extends('admin.layouts.master')
@section('title')
    {{ __('admin/profile/basic_info.basic_info') }}
@stop
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('admin/profile/basic_info.profile') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">{{ __('admin/profile/basic_info.my_profile') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin/profile/basic_info.basic_info') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        @include('admin.partials._profile_menu', ['active' => 1])
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        @include('admin.partials._alert')
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">{{ __('admin/profile/basic_info.update_basic_info') }}</h4>
                                {!! Form::open(['url' => route('backend.ums.profile-basic-info.update', [$userBasicInfo->id]), 'method' => 'put', 'files' => true]) !!}
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="first_name" class="@error('first_name') text-danger @enderror">
                                            {{ __('admin/profile/basic_info.first_name') }}
                                        </label>
                                        <input id="first_name" name="first_name"
                                               value="{{ old('first_name') ?: $userBasicInfo->first_name }}"
                                               type="text"
                                               class="form-control @error('first_name') is-invalid @enderror"
                                               placeholder="{{ __('admin/profile/basic_info.enter_first_name') }}" autofocus required>
                                        @error('first_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="last_name" class="@error('last_name') text-danger @enderror">
                                            {{ __('admin/profile/basic_info.last_name') }}
                                        </label>
                                        <input id="last_name" name="last_name"
                                               value="{{ old('last_name') ?: $userBasicInfo->last_name }}"
                                               type="text" class="form-control @error('last_name') is-invalid @enderror"
                                               placeholder="{{ __('admin/profile/basic_info.enter_last_name') }}" autofocus>
                                        @error('last_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="designation" class="@error('designation') text-danger @enderror">{{ __('admin/profile/basic_info.designation') }}</label>
                                        <input id="designation" name="designation"
                                               value="{{ old('designation') ?: $userBasicInfo->designation }}"
                                               type="text" class="form-control @error('designation') is-invalid @enderror"
                                               placeholder="{{ __('admin/profile/basic_info.enter_designation') }}" autofocus>
                                        @error('designation')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="personal_email"
                                               class="@error('personal_email') text-danger @enderror">
                                            {{ __('admin/profile/basic_info.personal_email') }}
                                        </label>
                                        <input id="personal_email" name="personal_email"
                                               value="{{ old('personal_email') ?: $userBasicInfo->personal_email }}"
                                               type="text"
                                               class="form-control @error('personal_email') is-invalid @enderror"
                                               placeholder="{{ __('admin/profile/basic_info.enter_personal_email') }}" autofocus>
                                        @error('personal_email')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="phone_no" class="@error('phone_no') text-danger @enderror">
                                            {{ __('admin/profile/basic_info.phone_no') }}
                                        </label>
                                        <input id="phone_no" name="phone_no"
                                               value="{{ old('phone_no') ?: $userBasicInfo->phone_no }}"
                                               type="text" class="form-control @error('phone_no') is-invalid @enderror"
                                               placeholder="{{ __('admin/profile/basic_info.enter_phone_no') }}" autofocus>
                                        @error('phone_no')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="mobile_no" class="@error('mobile_no') text-danger @enderror">
                                            {{ __('admin/profile/basic_info.mobile_no') }}
                                        </label>
                                        <input id="mobile_no" name="mobile_no"
                                               value="{{ old('mobile_no') ?: $userBasicInfo->mobile_no }}"
                                               type="text" class="form-control @error('mobile_no') is-invalid @enderror"
                                               placeholder="{{ __('admin/profile/basic_info.enter_mobile_no') }}" autofocus>
                                        @error('mobile_no')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    {{--<div class="form-group col-md-6">
                                        <label for="dob" class="@error('dob') text-danger @enderror">
                                            {{ __('admin/profile/basic_info.date_of_birth') }}
                                        </label>
                                        <input id="dob" name="dob" value="{{ old('dob') ?: $userBasicInfo->dob }}"
                                               type="text" class="form-control datepicker @error('dob') is-invalid @enderror"
                                               placeholder="{{ __('admin/profile/basic_info.enter_date_of_birth') }}" data-provide="datepicker" autofocus>
                                        @error('dob')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>--}}
                                </div>
                                <div class="button-items float-right">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        {{ __('admin/profile/basic_info.save_changes') }}
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
