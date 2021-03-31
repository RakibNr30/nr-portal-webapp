@extends('admin.layouts.master')
@php
    $user = \Modules\Ums\Entities\User::find(auth()->user()->id)
@endphp
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Project</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Project</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.cms.project-accepted.index') }}">
                                    {{ config('core.project_paginate.accepted.' . $user->getRoleNames()[0]) }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Update</li>
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
                        <h4 class="card-title mb-4">Edit Client From Accepted</h4>
                        {!! Form::open(['url' => route('backend.ums.client-accepted.update', [$user->id]),  'method' => 'put', 'files' => 'true']) !!}
                        <div class="form-group">
                            <label for="full_name" class="@error('full_name') text-danger @enderror">Full Name</label>
                            <input id="full_name" name="full_name" value="{{ old('full_name') ?: $user->basicInfo->first_name }}"
                                   type="text"
                                   class="form-control @error('full_name') is-invalid @enderror"
                                   placeholder="Enter first name" autofocus required>
                            @error('full_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="company_name" class="@error('company_name') text-danger @enderror">Company Name</label>
                            <input id="company_name" name="company_name" value="{{ old('company_name') ?: $user->basicInfo->company_name }}" type="text"
                                   class="form-control @error('company_name') is-invalid @enderror"
                                   placeholder="Enter company_name" autofocus>
                            @error('company_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="@error('email') text-danger @enderror">Email</label>
                            <input id="email" name="email" value="{{ old('email') ?: $user->email }}" type="text"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Enter email" autofocus required>
                            @error('email')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="@error('phone') text-danger @enderror">Phone</label>
                            <input id="phone" name="phone" value="{{ old('phone') ?: $user->phone }}" type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="Enter phone" autofocus required>
                            @error('phone')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="street_name" class="@error('street_name') text-danger @enderror">Street Name</label>
                            <input id="street_name" name="street_name" value="{{ old('street_name') ?: $user->residentialInfo->present_street_name }}" type="text"
                                   class="form-control @error('street_name') is-invalid @enderror"
                                   placeholder="Enter street_name" autofocus required>
                            @error('street_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="house_number" class="@error('house_number') text-danger @enderror">House Number</label>
                            <input id="house_number" name="house_number" value="{{ old('house_number') ?: $user->residentialInfo->present_house_number }}" type="text"
                                   class="form-control @error('house_number') is-invalid @enderror"
                                   placeholder="Enter house_number" autofocus required>
                            @error('house_number')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="zip_code" class="@error('zip_code') text-danger @enderror">Zip Code</label>
                            <input id="zip_code" name="zip_code" value="{{ old('zip_code') ?: $user->residentialInfo->present_zip_code }}" type="text"
                                   class="form-control @error('zip_code') is-invalid @enderror"
                                   placeholder="Enter zip_code" autofocus required>
                            @error('zip_code')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city" class="@error('city') text-danger @enderror">City</label>
                            <input id="city" name="city" value="{{ old('city') ?: $user->residentialInfo->present_city }}" type="text"
                                   class="form-control @error('city') is-invalid @enderror"
                                   placeholder="Enter city" autofocus required>
                            @error('city')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description" class="@error('description') text-danger @enderror">Description</label>
                            <textarea id="description" name="description" rows="4"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Enter description" autofocus required>{{ old('description') ?: $user->basicInfo->about }}</textarea>
                            @error('description')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <input type="hidden" name="roles[]" value="client">
                        <div class="button-items float-right">
                            <a href="{{ route('backend.ums.client-accepted.index') }}" type="button"
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
