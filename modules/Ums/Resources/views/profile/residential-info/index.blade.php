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
                            <li class="breadcrumb-item active">Residential Info</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        @include('admin.partials._profile_menu', ['active' => 2])
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        @include('admin.partials._alert')
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Update Residential Info</h4>
                                {!! Form::open(['url' => route('backend.ums.profile-residential-info.update', [$userResidentialInfo->id]), 'method' => 'put', 'files' => true]) !!}
                                <h5>Present Address</h5>
                                <hr>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="present_country"
                                               class="@error('present_country') text-danger @enderror">Country</label>
                                        <input id="present_country" name="present_country"
                                               value="{{ old('present_country') ?: $userResidentialInfo->present_country }}"
                                               type="text"
                                               class="form-control @error('present_country') is-invalid @enderror"
                                               placeholder="Enter present country" autofocus >
                                        @error('present_country')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="present_state"
                                               class="@error('present_state') text-danger @enderror">State</label>
                                        <input id="present_state" name="present_state"
                                               value="{{ old('present_state') ?: $userResidentialInfo->present_state }}"
                                               type="text"
                                               class="form-control @error('present_state') is-invalid @enderror"
                                               placeholder="Enter present state" autofocus >
                                        @error('present_state')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="present_city" class="@error('present_city') text-danger @enderror">Present</label>
                                        <input id="present_city" name="present_city"
                                               value="{{ old('present_city') ?: $userResidentialInfo->present_city }}"
                                               type="text"
                                               class="form-control @error('present_city') is-invalid @enderror"
                                               placeholder="Enter present city" autofocus >
                                        @error('present_city')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="present_zip_code" class="@error('present_zip_code') text-danger @enderror">Zip Code</label>
                                        <input id="present_zip_code" name="present_zip_code"
                                               value="{{ old('present_zip_code') ?: $userResidentialInfo->present_zip_code }}"
                                               type="text"
                                               class="form-control @error('present_zip_code') is-invalid @enderror"
                                               placeholder="Enter present city" autofocus >
                                        @error('present_zip_code')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="present_street_name" class="@error('present_street_name') text-danger @enderror">Street Name</label>
                                        <input id="present_street_name" name="present_street_name"
                                               value="{{ old('present_street_name') ?: $userResidentialInfo->present_street_name }}"
                                               type="text"
                                               class="form-control @error('present_street_name') is-invalid @enderror"
                                               placeholder="Enter present city" autofocus >
                                        @error('present_street_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="present_house_number" class="@error('present_house_number') text-danger @enderror">House Number</label>
                                        <input id="present_house_number" name="present_house_number"
                                               value="{{ old('present_house_number') ?: $userResidentialInfo->present_house_number }}"
                                               type="text"
                                               class="form-control @error('present_house_number') is-invalid @enderror"
                                               placeholder="Enter present city" autofocus >
                                        @error('present_house_number')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="present_address_line_1"
                                               class="@error('present_address_line_1') text-danger @enderror">Address Line 1</label>
                                        <input id="present_address_line_1" name="present_address_line_1"
                                               value="{{ old('present_address_line_1') ?: $userResidentialInfo->present_address_line_1 }}"
                                               type="text"
                                               class="form-control @error('present_address_line_1') is-invalid @enderror"
                                               placeholder="Enter present address line 1" autofocus>
                                        @error('present_address_line_1')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="present_address_line_2"
                                               class="@error('present_address_line_2') text-danger @enderror">Address Line 2</label>
                                        <input id="present_address_line_2" name="present_address_line_2"
                                               value="{{ old('present_address_line_2') ?: $userResidentialInfo->present_address_line_2 }}"
                                               type="text"
                                               class="form-control @error('present_address_line_2') is-invalid @enderror"
                                               placeholder="Enter present address line 2" autofocus>
                                        @error('present_address_line_2')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <h5 style="margin-top: 10px">Permanent Address</h5>
                                <hr>

                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="permanent_country"
                                               class="@error('permanent_country') text-danger @enderror">Country</label>
                                        <input id="permanent_country" name="permanent_country"
                                               value="{{ old('permanent_country') ?: $userResidentialInfo->permanent_country }}"
                                               type="text"
                                               class="form-control @error('permanent_country') is-invalid @enderror"
                                               placeholder="Enter permanent country" autofocus >
                                        @error('permanent_country')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="permanent_state"
                                               class="@error('permanent_state') text-danger @enderror">State</label>
                                        <input id="permanent_state" name="permanent_state"
                                               value="{{ old('permanent_state') ?: $userResidentialInfo->permanent_state }}"
                                               type="text"
                                               class="form-control @error('permanent_state') is-invalid @enderror"
                                               placeholder="Enter permanent state" autofocus >
                                        @error('permanent_state')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="permanent_city"
                                               class="@error('permanent_city') text-danger @enderror">City</label>
                                        <input id="permanent_city" name="permanent_city"
                                               value="{{ old('permanent_city') ?: $userResidentialInfo->permanent_city }}"
                                               type="text"
                                               class="form-control @error('permanent_city') is-invalid @enderror"
                                               placeholder="Enter permanent city" autofocus >
                                        @error('permanent_city')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="permanent_zip_code" class="@error('permanent_zip_code') text-danger @enderror">Zip Code</label>
                                        <input id="permanent_zip_code" name="permanent_zip_code"
                                               value="{{ old('permanent_zip_code') ?: $userResidentialInfo->permanent_zip_code }}"
                                               type="text"
                                               class="form-control @error('permanent_zip_code') is-invalid @enderror"
                                               placeholder="Enter present city" autofocus >
                                        @error('permanent_zip_code')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="permanent_street_name" class="@error('permanent_street_name') text-danger @enderror">Street Name</label>
                                        <input id="permanent_street_name" name="permanent_street_name"
                                               value="{{ old('permanent_street_name') ?: $userResidentialInfo->permanent_street_name }}"
                                               type="text"
                                               class="form-control @error('permanent_street_name') is-invalid @enderror"
                                               placeholder="Enter present city" autofocus >
                                        @error('permanent_street_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="permanent_house_number" class="@error('permanent_house_number') text-danger @enderror">House Number</label>
                                        <input id="permanent_house_number" name="permanent_house_number"
                                               value="{{ old('permanent_house_number') ?: $userResidentialInfo->permanent_house_number }}"
                                               type="text"
                                               class="form-control @error('permanent_house_number') is-invalid @enderror"
                                               placeholder="Enter present city" autofocus >
                                        @error('permanent_house_number')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="permanent_address_line_1"
                                               class="@error('permanent_address_line_1') text-danger @enderror">Address Line 1</label>
                                        <input id="permanent_address_line_1" name="permanent_address_line_1"
                                               value="{{ old('permanent_address_line_1') ?: $userResidentialInfo->permanent_address_line_1 }}"
                                               type="text"
                                               class="form-control @error('permanent_address_line_1') is-invalid @enderror"
                                               placeholder="Enter permanent address line 1" autofocus>
                                        @error('permanent_address_line_1')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="permanent_address_line_2"
                                               class="@error('permanent_address_line_2') text-danger @enderror">Address Line 2</label>
                                        <input id="permanent_address_line_2" name="permanent_address_line_2"
                                               value="{{ old('permanent_address_line_2') ?: $userResidentialInfo->permanent_address_line_2 }}"
                                               type="text"
                                               class="form-control @error('permanent_address_line_2') is-invalid @enderror"
                                               placeholder="Enter permanent address line 2" autofocus>
                                        @error('permanent_address_line_2')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
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
