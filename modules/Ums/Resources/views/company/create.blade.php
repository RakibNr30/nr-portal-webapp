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
                            <li class="breadcrumb-item active">Create</li>
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
                        <h4 class="card-title mb-4">Create Company</h4>
                        {!! Form::open(['url' => route('backend.ums.company.store'), 'method' => 'user', 'files' => true]) !!}
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="company_name" class="@error('company_name') text-danger @enderror">Company Name *</label>
                                <input id="company_name" name="company_name" value="{{ old('company_name') }}"
                                       type="text"
                                       class="form-control @error('company_name') is-invalid @enderror"
                                       placeholder="Enter company name" autofocus required>
                                @error('company_name')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="about" class="@error('about') text-danger @enderror">About Company *</label>
                                <textarea id="about" name="about" rows="5"
                                          class="form-control @error('about') is-invalid @enderror"
                                          placeholder="Enter company about" autofocus required>{{ old('about') }}</textarea>
                                @error('about')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="@error('email') text-danger @enderror">Company Email *</label>
                                <input id="email" name="email" value="{{ old('email') }}" type="text"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Enter company email" autofocus required>
                                @error('email')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="@error('phone') text-danger @enderror">Company Phone *</label>
                                <input id="phone" name="phone" value="{{ old('phone') }}" type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       placeholder="Enter company phone" autofocus required>
                                @error('phone')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password"
                                       class="@error('password') text-danger @enderror">Password *</label>
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
                                       class="@error('password_confirmation') text-danger @enderror">Confirm Password *</label>
                                <input id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"
                                       type="password"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       placeholder="Re-enter password" autofocus required>
                                @error('password_confirmation')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="avatar" class="@error('avatar') text-danger @enderror">Company Avatar</label>
                                <input id="avatar" name="avatar" value="{{ old('avatar') }}" type="file" class="form-control @error('avatar') is-invalid @enderror" placeholder="Select File" autofocus>
                                @if(isset($user->avatar->name))
                                    <span class="invalid-feedback text-dark" role="alert"><strong>avatar: {{ $user->avatar->name }}</strong></span>
                                @endif
                                @error('avatar')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <input type="hidden" name="roles[]" value="company">
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

@section('style')
    <link href="{{ asset('common/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('script')
    <script src="{{ asset('common/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/form-advanced.init.js') }}"></script>
@stop