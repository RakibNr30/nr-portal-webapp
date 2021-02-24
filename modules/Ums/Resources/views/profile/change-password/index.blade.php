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
                            <li class="breadcrumb-item active">Change Password</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        @include('admin.partials._profile_menu', ['active' => 4])
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-xl-9">
                <div class="row">
                    <div class="col-lg-12">
                        @include('admin.partials._alert')
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Update Account Info</h4>
                                {!! Form::open(['url' => route('backend.ums.profile-change-password.update', [$user->id]), 'method' => 'put']) !!}
                                <div class="form-group">
                                    <label for="old_password" class="@error('old_password') text-danger @enderror">Old Password</label>
                                    <input id="old_password" name="old_password"
                                           type="Password"
                                           class="form-control @error('old_password') is-invalid @enderror"
                                           placeholder="Enter old password" autofocus required>
                                    @error('old_password')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="@error('password') text-danger @enderror">Password</label>
                                    <input id="password" name="password"
                                           type="Password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Enter password" autofocus required>
                                    @error('password')
                                    <span class="invalid-feedback"
                                          role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="repeat_password" class="@error('repeat_password') text-danger @enderror">Re-type Password</label>
                                    <input id="repeat_password" name="repeat_password"
                                           type="Password" class="form-control @error('repeat_password') is-invalid @enderror"
                                           placeholder="Re-type password" autofocus>
                                    @error('repeat_password')
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
