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
                                <div class="form-group">
                                    <label for="present_country"
                                           class="@error('present_country') text-danger @enderror">Present
                                        Country</label>
                                    <input id="present_country" name="present_country"
                                           value="{{ old('present_country') ?: $userResidentialInfo->present_country }}"
                                           type="text"
                                           class="form-control @error('present_country') is-invalid @enderror"
                                           placeholder="Enter present country" autofocus required>
                                    @error('present_country')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="present_city" class="@error('present_city') text-danger @enderror">Present
                                        City</label>
                                    <input id="present_city" name="present_city"
                                           value="{{ old('present_city') ?: $userResidentialInfo->present_city }}"
                                           type="text"
                                           class="form-control @error('present_city') is-invalid @enderror"
                                           placeholder="Enter present city" autofocus required>
                                    @error('present_city')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="present_state"
                                           class="@error('present_state') text-danger @enderror">Present
                                        State</label>
                                    <input id="present_state" name="present_state"
                                           value="{{ old('present_state') ?: $userResidentialInfo->present_state }}"
                                           type="text"
                                           class="form-control @error('present_state') is-invalid @enderror"
                                           placeholder="Enter present state" autofocus required>
                                    @error('present_state')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="present_address_line_1"
                                           class="@error('present_address_line_1') text-danger @enderror">Present
                                        Address Line 1</label>
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
                                <div class="form-group">
                                    <label for="present_address_line_2"
                                           class="@error('present_address_line_2') text-danger @enderror">Present
                                        Address Line 2</label>
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
                                <div class="form-group">
                                    <label for="permanent_country"
                                           class="@error('permanent_country') text-danger @enderror">Permanent
                                        Country</label>
                                    <input id="permanent_country" name="permanent_country"
                                           value="{{ old('permanent_country') ?: $userResidentialInfo->permanent_country }}"
                                           type="text"
                                           class="form-control @error('permanent_country') is-invalid @enderror"
                                           placeholder="Enter permanent country" autofocus required>
                                    @error('permanent_country')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="permanent_city"
                                           class="@error('permanent_city') text-danger @enderror">Permanent
                                        City</label>
                                    <input id="permanent_city" name="permanent_city"
                                           value="{{ old('permanent_city') ?: $userResidentialInfo->permanent_city }}"
                                           type="text"
                                           class="form-control @error('permanent_city') is-invalid @enderror"
                                           placeholder="Enter permanent city" autofocus required>
                                    @error('permanent_city')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="permanent_state"
                                           class="@error('permanent_state') text-danger @enderror">Permanent
                                        State</label>
                                    <input id="permanent_state" name="permanent_state"
                                           value="{{ old('permanent_state') ?: $userResidentialInfo->permanent_state }}"
                                           type="text"
                                           class="form-control @error('permanent_state') is-invalid @enderror"
                                           placeholder="Enter permanent state" autofocus required>
                                    @error('permanent_state')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="permanent_address_line_1"
                                           class="@error('permanent_address_line_1') text-danger @enderror">Permanent
                                        Address Line 1</label>
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
                                <div class="form-group">
                                    <label for="permanent_address_line_2"
                                           class="@error('permanent_address_line_2') text-danger @enderror">Permanent
                                        Address Line 2</label>
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
                                <div class="form-group">
                                    <label for="google_map_url"
                                           class="@error('google_map_url') text-danger @enderror">Google Map Url</label>
                                    <input id="google_map_url" name="google_map_url"
                                           value="{{ old('google_map_url') ?: $userResidentialInfo->google_map_url }}"
                                           type="text"
                                           class="form-control @error('google_map_url') is-invalid @enderror"
                                           placeholder="Enter google map url" autofocus>
                                    @error('google_map_url')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="longitude"
                                           class="@error('longitude') text-danger @enderror">Longitude</label>
                                    <input id="longitude" name="longitude"
                                           value="{{ old('longitude') ?: $userResidentialInfo->longitude }}"
                                           type="text"
                                           class="form-control @error('longitude') is-invalid @enderror"
                                           placeholder="Enter longitude" autofocus>
                                    @error('longitude')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="longitude"
                                           class="@error('latitude') text-danger @enderror">Latitude</label>
                                    <input id="latitude" name="latitude"
                                           value="{{ old('latitude') ?: $userResidentialInfo->latitude }}"
                                           type="text"
                                           class="form-control @error('latitude') is-invalid @enderror"
                                           placeholder="Enter latitude" autofocus>
                                    @error('longitude')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
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
