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
                            <h3 class="card-title mt-1">Create User Work Info</h3>
                            <a href="{{ route('backend.ums.user-work-info.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View User Work Info List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.ums.user-work-info.store'), 'method' => 'user-work-info', 'files' => true]) !!}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="company_name" class="@error('company_name') text-danger @enderror">Company Name</label>
                                            <input id="company_name" name="company_name" value="{{ old('company_name') }}" type="text" class="form-control @error('company_name') is-invalid @enderror" placeholder="Enter company name" autofocus>
                                            @error('company_name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="company_website" class="@error('company_website') text-danger @enderror">Company Website</label>
                                            <input id="company_website" name="company_website" value="{{ old('company_website') }}" type="text" class="form-control @error('company_website') is-invalid @enderror" placeholder="Enter company website" autofocus>
                                            @error('company_website')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="company_address" class="@error('company_address') text-danger @enderror">Company Address</label>
                                            <input id="company_address" name="company_address" value="{{ old('company_address') }}" type="text" class="form-control @error('company_address') is-invalid @enderror" placeholder="Enter company address" autofocus>
                                            @error('company_address')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="department" class="@error('department') text-danger @enderror">Department</label>
                                            <input id="department" name="department" value="{{ old('department') }}" type="text" class="form-control @error('department') is-invalid @enderror" placeholder="Enter department" autofocus>
                                            @error('department')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="designation" class="@error('designation') text-danger @enderror">Designation</label>
                                            <input id="designation" name="designation" value="{{ old('designation') }}" type="text" class="form-control @error('designation') is-invalid @enderror" placeholder="Enter designation" autofocus>
                                            @error('designation')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="start_date" class="@error('start_date') text-danger @enderror">Start Date</label>
                                            <input id="start_date" name="start_date" value="{{ old('start_date') }}" type="date" class="form-control @error('start_date') is-invalid @enderror" placeholder="Enter start_date" autofocus>
                                            @error('start_date')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="end_date" class="@error('end_date') text-danger @enderror">End Date</label>
                                            <input id="end_date" name="end_date" value="{{ old('end_date') }}" type="date" class="form-control @error('end_date') is-invalid @enderror" placeholder="Enter end_date" autofocus>
                                            @error('end_date')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="detail" class="@error('detail') text-danger @enderror">Description</label>
                                            <textarea id="detail" name="detail" class="form-control" rows="3" placeholder="Enter description">{{ old('detail') }}</textarea>
                                            @error('detail')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="user_id" class="@error('user_id') text-danger @enderror">Username</label>
                                            <select id="user_id" name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                                <option value="">Select Username</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                                @endforeach
                                            </select>
                                            @error('user_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                                <a href="{{ route('backend.ums.user-work-info.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
