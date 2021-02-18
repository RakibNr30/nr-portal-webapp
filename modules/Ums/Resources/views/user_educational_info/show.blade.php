@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">User Educational Info Details</h3>
                            <a href="{{ route('backend.ums.user-educational-info.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View User Educational Info List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="institute_name" class="@error('institute_name') text-danger @enderror">Institute Name</label>
                                        <input id="institute_name" name="institute_name" value="{{ $userEducationalInfo->institute_name ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('institute_name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="course_name" class="@error('course_name') text-danger @enderror">Course Name</label>
                                        <input id="course_name" name="course_name" value="{{ $userEducationalInfo->course_name ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('course_name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="degree_name" class="@error('degree_name') text-danger @enderror">Degree Name</label>
                                        <input id="degree_name" name="degree_name" value="{{ $userEducationalInfo->degree_name ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('degree_name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="start_date" class="@error('start_date') text-danger @enderror">Start Date</label>
                                        <input id="start_date" name="start_date" value="{{ $userEducationalInfo->start_date ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('start_date')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="end_date" class="@error('end_date') text-danger @enderror">End Date</label>
                                        <input id="end_date" name="end_date" value="{{ $userEducationalInfo->end_date ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('end_date')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="@error('description') text-danger @enderror">Description</label>
                                        <input id="description" name="description" value="{{ $userEducationalInfo->description ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="institute_website" class="@error('institute_website') text-danger @enderror">Institute Website</label>
                                        <input id="institute_website" name="institute_website" value="{{ $userEducationalInfo->institute_website ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('institute_website')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="institute_email" class="@error('institute_email') text-danger @enderror">Institute Email</label>
                                        <input id="institute_email" name="institute_email" value="{{ $userEducationalInfo->institute_email ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('institute_email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="institute_phone" class="@error('institute_phone') text-danger @enderror">Institute Phone</label>
                                        <input id="institute_phone" name="institute_phone" value="{{ $userEducationalInfo->institute_phone ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('institute_phone')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="user_id" class="@error('user_id') text-danger @enderror">User Id</label>
                                        <input id="user_id" name="user_id" value="{{ $userEducationalInfo->user_id ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('user_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.ums.user-educational-info.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
