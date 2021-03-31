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
                            <li class="breadcrumb-item active">Approve</li>
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
                        <h4 class="card-title mb-4">Edit Client From Request</h4>
                        {!! Form::open(['url' => route('backend.ums.client-request.store'), 'method' => 'user']) !!}
                        <h5>Client Information</h5>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="full_name" class="@error('full_name') text-danger @enderror">Full Name</label>
                                <input id="full_name" name="full_name" value="{{ old('full_name') ?: $clientRequest->full_name }}"
                                       type="text"
                                       class="form-control @error('full_name') is-invalid @enderror"
                                       placeholder="Enter first name" autofocus required>
                                @error('full_name')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="company_name" class="@error('company_name') text-danger @enderror">Company Name</label>
                                <input id="company_name" name="company_name" value="{{ old('company_name') ?: $clientRequest->company_name }}" type="text"
                                       class="form-control @error('company_name') is-invalid @enderror"
                                       placeholder="Enter company_name" autofocus>
                                @error('company_name')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="@error('email') text-danger @enderror">Email</label>
                                <input id="email" name="email" value="{{ old('email') ?: $clientRequest->email }}" type="text"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Enter email" autofocus required>
                                @error('email')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="@error('phone') text-danger @enderror">Phone</label>
                                <input id="phone" name="phone" value="{{ old('phone') ?: $clientRequest->phone }}" type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       placeholder="Enter phone" autofocus required>
                                @error('phone')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="street_name" class="@error('street_name') text-danger @enderror">Street Name</label>
                                <input id="street_name" name="street_name" value="{{ old('street_name') ?: $clientRequest->street_name }}" type="text"
                                       class="form-control @error('street_name') is-invalid @enderror"
                                       placeholder="Enter street_name" autofocus required>
                                @error('street_name')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="house_number" class="@error('house_number') text-danger @enderror">House Number</label>
                                <input id="house_number" name="house_number" value="{{ old('house_number') ?: $clientRequest->house_number }}" type="text"
                                       class="form-control @error('house_number') is-invalid @enderror"
                                       placeholder="Enter house_number" autofocus required>
                                @error('house_number')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="zip_code" class="@error('zip_code') text-danger @enderror">Zip Code</label>
                                <input id="zip_code" name="zip_code" value="{{ old('zip_code') ?: $clientRequest->zip_code }}" type="text"
                                       class="form-control @error('zip_code') is-invalid @enderror"
                                       placeholder="Enter zip_code" autofocus required>
                                @error('zip_code')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city" class="@error('city') text-danger @enderror">City</label>
                                <input id="city" name="city" value="{{ old('city') ?: $clientRequest->city }}" type="text"
                                       class="form-control @error('city') is-invalid @enderror"
                                       placeholder="Enter city" autofocus required>
                                @error('city')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description" class="@error('description') text-danger @enderror">Description</label>
                                <textarea id="description" name="description" rows="4"
                                       class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Enter description" autofocus required>{{ old('description') ?: $clientRequest->description }}</textarea>
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
                                <input id="project_title" name="project_title" value="{{ old('project_title') ?: $clientRequest->project_title }}"
                                       type="text"
                                       class="form-control @error('project_title') is-invalid @enderror"
                                       placeholder="Enter project title" autofocus required>
                                @error('project_title')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="project_description" class="@error('project_description') text-danger @enderror">Project Description</label>
                                <textarea id="project_description" name="project_description" rows="4"
                                          class="form-control @error('project_description') is-invalid @enderror"
                                          placeholder="Enter project description" autofocus required>{{ old('project_description') ?: $clientRequest->project_description }}</textarea>
                                @error('project_description')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <h5>Account Information</h5>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="password"
                                       class="@error('password') text-danger @enderror">Password</label>
                                <input id="password" name="password" value="{{ old('password') }}"
                                       type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       placeholder="Enter password" autofocus required>
                                @error('password')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation"
                                       class="@error('password_confirmation') text-danger @enderror">Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"
                                       type="password"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       placeholder="Re-enter password" autofocus required>
                                @error('password_confirmation')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="client_id" value="{{ $clientRequest->id }}">
                        <input type="hidden" name="roles[]" value="client">
                        <div class="button-items float-right">
                            <a href="{{ route('backend.ums.client-request.index') }}" type="button"
                               class="btn btn-danger waves-effect waves-light">Cancel
                            </a>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Approve
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
