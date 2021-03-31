@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Client</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">User Control</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Client</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.ums.client-request.index') }}">Request</a></li>
                            <li class="breadcrumb-item active">Show</li>
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
                        <h4 class="card-title mb-4">View Client From Request</h4>

                        <h5>Client Information</h5>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="full_name"
                                       class="@error('full_name') text-danger @enderror">Full Name</label>
                                <input id="full_name" name="full_name"
                                       value=" → {{ $clientRequest->full_name ?: 'N/A'}}"
                                       type="text" class="form-control-plaintext" readonly>
                                @error('full_name')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="company_name" class="@error('company_name') text-danger @enderror">Company Name</label>
                                <input id="company_name" name="company_name" value=" → {{ $clientRequest->company_name ?: 'N/A'}}" type="text"
                                       class="form-control-plaintext" readonly>
                                @error('company_name')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="@error('email') text-danger @enderror">Email</label>
                                <input id="email" name="email" value=" → {{ $clientRequest->email ?: 'N/A'}}" type="text"
                                       class="form-control-plaintext" readonly>
                                @error('email')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="@error('phone') text-danger @enderror">Phone</label>
                                <input id="phone" name="phone" value=" → {{ $clientRequest->phone ?: 'N/A'}}" type="text"
                                       class="form-control-plaintext" readonly>
                                @error('phone')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="street_name" class="@error('street_name') text-danger @enderror">Street Name</label>
                                <input id="street_name" name="street_name" value=" → {{ $clientRequest->street_name ?: 'N/A'}}" type="text"
                                       class="form-control-plaintext" readonly>
                                @error('street_name')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="house_number" class="@error('house_number') text-danger @enderror">House Number</label>
                                <input id="house_number" name="house_number" value=" → {{ $clientRequest->house_number ?: 'N/A'}}" type="text"
                                       class="form-control-plaintext" readonly>
                                @error('house_number')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="zip_code" class="@error('zip_code') text-danger @enderror">Zip Code</label>
                                <input id="zip_code" name="zip_code" value=" → {{ $clientRequest->zip_code ?: 'N/A'}}" type="text"
                                       class="form-control-plaintext" readonly>
                                @error('zip_code')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city" class="@error('city') text-danger @enderror">City</label>
                                <input id="city" name="city" value=" → {{ $clientRequest->city ?: 'N/A'}}" type="text"
                                       class="form-control-plaintext" readonly>
                                @error('city')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description" class="@error('description') text-danger @enderror">Description</label>
                                <textarea id="description" name="description"
                                          class="form-control-plaintext" readonly>{{ $clientRequest->description ?: 'N/A'}}</textarea>
                                @error('description')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <h5>Project Information</h5>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="project_title" class="@error('project_title') text-danger @enderror">Project Title</label>
                                <input id="project_title" name="project_title" value=" → {{ $clientRequest->project_title ?: 'N/A'}}" type="text"
                                       class="form-control-plaintext" readonly>
                                @error('project_title')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="project_description" class="@error('project_description') text-danger @enderror">Project Description</label>
                                <textarea id="project_description" name="project_description"
                                          class="form-control-plaintext" readonly>{{ $clientRequest->project_description ?: 'N/A'}}</textarea>
                                @error('project_description')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <a href="{{ route('backend.ums.client-request.index') }}" type="button"
                           class="btn btn-danger waves-effect waves-light float-right">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
