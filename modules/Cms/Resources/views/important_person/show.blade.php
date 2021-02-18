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
                            <h3 class="card-title mt-1">ImportantPerson Details</h3>
                            <a href="{{ route('backend.cms.important-person.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View ImportantPerson List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name" class="@error('name') text-danger @enderror">Name</label>
                                        <input id="name" name="name" value="{{ $importantPerson->name ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="designation" class="@error('designation') text-danger @enderror">Designation</label>
                                        <input id="designation" name="designation" value="{{ $importantPerson->designation ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('designation')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="company" class="@error('company') text-danger @enderror">Company</label>
                                        <input id="company" name="company" value="{{ $importantPerson->company ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('company')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="avatar" class="@error('avatar') text-danger @enderror">Avatar</label>
                                        <input id="avatar" name="avatar" value="{{ $importantPerson->avatar->file_name ?? 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @if(isset($importantPerson->avatar))
                                            <div class="image-output">
                                                <img src="{{ $importantPerson->avatar->file_url }}">
                                            </div>
                                        @endif
                                        @error('avatar')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="@error('description') text-danger @enderror">Description</label>
                                        <input id="description" name="description" value="{{ $importantPerson->description ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="external_link" class="@error('external_link') text-danger @enderror">ExternalLink</label>
                                        <input id="external_link" name="external_link" value="{{ $importantPerson->external_link ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('external_link')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.cms.important-person.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
