@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    @include('admin.partials._profile_menu', ['active' => 3])
                </div>
                <div class="col-md-9">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">User Work Info Details</h3>
                            <a href="{{ route('backend.ums.profile-work-info.index') }}" type="button"
                               class="btn btn-success btn-sm text-white float-right">View User Work Info List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="company_name" class="@error('company_name') text-danger @enderror">Company
                                            Name</label>
                                        <input id="company_name" name="company_name"
                                               value="{{ $userWorkInfo->company_name ?: 'N/A'}}" type="text"
                                               class="form-control-plaintext" readonly>
                                        @error('company_name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="company_website"
                                               class="@error('company_website') text-danger @enderror">Company
                                            Website</label>
                                        <input id="company_website" name="company_website"
                                               value="{{ $userWorkInfo->company_website ?: 'N/A'}}" type="text"
                                               class="form-control-plaintext" readonly>
                                        @error('company_website')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="company_address"
                                               class="@error('company_address') text-danger @enderror">Company
                                            Address</label>
                                        <input id="company_address" name="company_address"
                                               value="{{ $userWorkInfo->company_address ?: 'N/A'}}" type="text"
                                               class="form-control-plaintext" readonly>
                                        @error('company_address')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="department" class="@error('department') text-danger @enderror">Department</label>
                                        <input id="department" name="department"
                                               value="{{ $userWorkInfo->department ?: 'N/A'}}" type="text"
                                               class="form-control-plaintext" readonly>
                                        @error('department')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="designation" class="@error('designation') text-danger @enderror">Designation</label>
                                        <input id="designation" name="designation"
                                               value="{{ $userWorkInfo->designation ?: 'N/A'}}" type="text"
                                               class="form-control-plaintext" readonly>
                                        @error('designation')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="start_date" class="@error('start_date') text-danger @enderror">Start
                                            Date</label>
                                        <input id="start_date" name="start_date"
                                               value="{{ $userWorkInfo->start_date ?: 'N/A'}}" type="text"
                                               class="form-control-plaintext" readonly>
                                        @error('start_date')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="end_date" class="@error('end_date') text-danger @enderror">End
                                            Date</label>
                                        <input id="end_date" name="end_date"
                                               value="{{ $userWorkInfo->end_date ?: 'N/A'}}" type="text"
                                               class="form-control-plaintext" readonly>
                                        @error('end_date')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description"
                                               class="@error('description') text-danger @enderror">Description</label>
                                        <input id="description" name="description" value="{{ $userWorkInfo->description ?: 'N/A'}}"
                                               type="text" class="form-control-plaintext" readonly>
                                        @error('description')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.ums.profile-work-info.index') }}" type="button"
                               class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
