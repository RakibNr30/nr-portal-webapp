@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Profile</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">My Profile</a></li>
                            <li class="breadcrumb-item active">Basic Info</li>
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
                                <h4 class="card-title mb-4">Update Basic Info</h4>
                                {!! Form::open(['url' => route('backend.ums.profile-basic-info.update', [$userBasicInfo->id]), 'method' => 'put', 'files' => true]) !!}
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="first_name" class="@error('first_name') text-danger @enderror">First
                                            Name</label>
                                        <input id="first_name" name="first_name"
                                               value="{{ old('first_name') ?: $userBasicInfo->first_name }}"
                                               type="text"
                                               class="form-control @error('first_name') is-invalid @enderror"
                                               placeholder="Enter first name" autofocus required>
                                        @error('first_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="last_name" class="@error('last_name') text-danger @enderror">Last
                                            Name</label>
                                        <input id="last_name" name="last_name"
                                               value="{{ old('last_name') ?: $userBasicInfo->last_name }}"
                                               type="text" class="form-control @error('last_name') is-invalid @enderror"
                                               placeholder="Enter last name" autofocus>
                                        @error('last_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="designation" class="@error('designation') text-danger @enderror">Designation</label>
                                        <input id="designation" name="designation"
                                               value="{{ old('designation') ?: $userBasicInfo->designation }}"
                                               type="text" class="form-control @error('designation') is-invalid @enderror"
                                               placeholder="Enter designation" autofocus>
                                        @error('designation')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    {{--<div class="form-group col-md-12">
                                        <label for="about" class="@error('about') text-danger @enderror">About</label>
                                        <textarea id="about" name="about" rows="3"
                                                  class="form-control @error('about') is-invalid @enderror"
                                                  placeholder="Enter about yourself">{{ old('about') ?: $userBasicInfo->about }}</textarea>
                                        @error('about')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>--}}
                                    <div class="form-group col-md-4">
                                        <label for="personal_email"
                                               class="@error('personal_email') text-danger @enderror">Personal
                                            Email</label>
                                        <input id="personal_email" name="personal_email"
                                               value="{{ old('personal_email') ?: $userBasicInfo->personal_email }}"
                                               type="text"
                                               class="form-control @error('personal_email') is-invalid @enderror"
                                               placeholder="Enter personal email" autofocus>
                                        @error('personal_email')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    {{--<div class="form-group col-md-6">
                                        <label for="professional_email"
                                               class="@error('professional_email') text-danger @enderror">Professional
                                            Email</label>
                                        <input id="professional_email" name="professional_email"
                                               value="{{ old('professional_email') ?: $userBasicInfo->professional_email }}"
                                               type="text"
                                               class="form-control @error('professional_email') is-invalid @enderror"
                                               placeholder="Enter professional email" autofocus>
                                        @error('professional_email')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>--}}
                                    <div class="form-group col-md-4">
                                        <label for="phone_no" class="@error('phone_no') text-danger @enderror">Phone
                                            No</label>
                                        <input id="phone_no" name="phone_no"
                                               value="{{ old('phone_no') ?: $userBasicInfo->phone_no }}"
                                               type="text" class="form-control @error('phone_no') is-invalid @enderror"
                                               placeholder="Enter phone no" autofocus>
                                        @error('phone_no')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="mobile_no" class="@error('mobile_no') text-danger @enderror">Mobile
                                            No</label>
                                        <input id="mobile_no" name="mobile_no"
                                               value="{{ old('mobile_no') ?: $userBasicInfo->mobile_no }}"
                                               type="text" class="form-control @error('mobile_no') is-invalid @enderror"
                                               placeholder="Enter mobile no" autofocus>
                                        @error('mobile_no')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    {{--<div class="form-group col-md-6">
                                        <label for="fax_no" class="@error('fax_no') text-danger @enderror">Fax
                                            No</label>
                                        <input id="fax_no" name="fax_no"
                                               value="{{ old('fax_no') ?: $userBasicInfo->fax_no }}" type="text"
                                               class="form-control @error('fax_no') is-invalid @enderror"
                                               placeholder="Enter fax no" autofocus>
                                        @error('fax_no')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>--}}
                                    {{--<div class="form-group col-md-6">
                                        <label for="website_url" class="@error('website_url') text-danger @enderror">Website Url</label>
                                        <input id="website_url" name="website_url"
                                               value="{{ old('website_url') ?: $userBasicInfo->website_url }}"
                                               type="text" class="form-control @error('website_url') is-invalid @enderror"
                                               placeholder="Enter website url" autofocus>
                                        @error('website_url')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>--}}
                                    <div class="form-group col-md-6">
                                        <label for="dob" class="@error('dob') text-danger @enderror">Date of
                                            Birth</label>
                                        <input id="dob" name="dob" value="{{ old('dob') ?: $userBasicInfo->dob }}"
                                               type="text" class="form-control datepicker @error('dob') is-invalid @enderror"
                                               placeholder="yyyy-mm-dd" data-provide="datepicker" autofocus>
                                        @error('dob')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="gender"
                                               class="@error('gender') text-danger @enderror">Gender</label>
                                        <select id="gender" name="gender"
                                                class="form-control @error('gender') is-invalid @enderror" required>
                                            <option value="">Select Gender</option>
                                            @foreach(config('core.genders') as $gender_key => $gender)
                                                <option
                                                        value="{{ $gender_key }}" {{ $gender_key == $userBasicInfo->gender ? 'selected' : '' }}>{{ $gender }}</option>
                                            @endforeach
                                        </select>
                                        @error('gender')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    {{--<div class="form-group col-md-4">
                                        <label for="blood_group" class="@error('blood_group') text-danger @enderror">Blood
                                            Group</label>
                                        <select id="blood_group" name="blood_group"
                                                class="form-control @error('blood_group') is-invalid @enderror">
                                            <option value="">Select Blood Group</option>
                                            @foreach(config('core.blood_groups') as $blood_group_key => $blood_group)
                                                <option
                                                        value="{{ $blood_group_key }}" {{ $blood_group_key == $userBasicInfo->blood_group ? 'selected' : '' }}>{{ $blood_group }}</option>
                                            @endforeach
                                        </select>
                                        @error('blood_group')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>--}}
                                </div>
                                <div class="button-items float-right">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit
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
