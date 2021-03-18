@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Company</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">User Control</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.ums.company.index') }}">Company</a></li>
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
                        <h4 class="card-title mb-4">Edit Company</h4>
                        {!! Form::open(['url' => route('backend.ums.company.update', [$user->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="company_name" class="@error('company_name') text-danger @enderror">Company Name</label>
                                <input id="company_name" name="company_name" value="{{ old('company_name') ?: $user->basicInfo->first_name }}"
                                       type="text"
                                       class="form-control @error('company_name') is-invalid @enderror"
                                       placeholder="Enter company name" autofocus required>
                                @error('company_name')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="about"
                                       class="@error('about') text-danger @enderror">Company About</label>
                                <textarea id="about" name="about" rows="5"
                                          class="form-control @error('about') is-invalid @enderror"
                                          placeholder="Enter company about" autofocus required>{{ old('about') ?: $user->basicInfo->about }}</textarea>
                                @error('about')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="@error('email') text-danger @enderror">Company Email</label>
                                <input id="email" name="email" value="{{ old('email') ?: $user->email }}" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Enter company email" autofocus required>
                                @error('email')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="@error('phone') text-danger @enderror">Company Phone</label>
                                <input id="phone" name="phone" value="{{ old('phone') ?: $user->phone }}" type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       placeholder="Enter company phone" autofocus required>
                                @error('phone')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="avatar" class="@error('avatar') text-danger @enderror">Company Avatar</label>
                                <input id="avatar" name="avatar" value="{{ old('avatar') }}" type="file" class="form-control @error('avatar') is-invalid @enderror" placeholder="Enter avatar" autofocus>
                                @if(isset($user->avatar))
                                    <div class="image-output">
                                        <img src="{{ $user->avatar->file_url }}">
                                    </div>
                                @endif
                                @error('avatar')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="button-items float-right">
                                    <a href="{{ route('backend.ums.company.index') }}" type="button"
                                       class="btn btn-danger waves-effect waves-light">Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
