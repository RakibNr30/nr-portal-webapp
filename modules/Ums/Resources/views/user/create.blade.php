@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">User</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Access Control</a></li>
                            <li class="breadcrumb-item active">User</li>
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
                        <h4 class="card-title mb-4">Create User</h4>
                        <a href="{{ route('backend.ums.user.index') }}" type="button"
                        class="btn btn-success btn-sm text-white float-right">View User List</a>
                        {!! Form::open(['url' => route('backend.ums.user.store'), 'method' => 'user', 'files' => true]) !!}
                        <div class="form-group">
                            <label for="first_name" class="@error('first_name') text-danger @enderror">First Name</label>
                            <input id="first_name" name="first_name" value="{{ old('first_name') }}"
                                   type="text"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   placeholder="Enter first name" autofocus>
                            @error('first_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="@error('last_name') text-danger @enderror">Last Name</label>
                            <input id="last_name" name="last_name" value="{{ old('last_name') }}"
                                   type="text" class="form-control @error('last_name') is-invalid @enderror"
                                   placeholder="Enter last name" autofocus>
                            @error('last_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username"
                                   class="@error('username') text-danger @enderror">Username</label>
                            <input id="username" name="username" value="{{ old('username') }}" type="text"
                                   class="form-control @error('username') is-invalid @enderror"
                                   placeholder="Enter username" autofocus>
                            @error('username')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="@error('email') text-danger @enderror">Email</label>
                            <input id="email" name="email" value="{{ old('email') }}" type="text"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Enter email" autofocus>
                            @error('email')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="@error('phone') text-danger @enderror">Phone</label>
                            <input id="phone" name="phone" value="{{ old('phone') }}" type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="Enter phone" autofocus>
                            @error('phone')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password"
                                   class="@error('password') text-danger @enderror">Password</label>
                            <input id="password" name="password" value="{{ old('password') }}"
                                   type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Enter password" autofocus>
                            @error('password')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation"
                                   class="@error('password_confirmation') text-danger @enderror">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"
                                   type="password"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   placeholder="Re-enter password" autofocus>
                            @error('password_confirmation')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="avatar" class="@error('avatar') text-danger @enderror">Avatar</label>
                            <input id="avatar" name="avatar" value="{{ old('avatar') }}" type="file" class="form-control @error('avatar') is-invalid @enderror" placeholder="Select File" autofocus>
                            @if(isset($user->avatar->name))
                                <span class="invalid-feedback text-dark" role="alert"><strong>avatar: {{ $user->avatar->name }}</strong></span>
                            @endif
                            @error('avatar')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="roles" class="@error('roles') text-danger @enderror">Roles</label>
                            <select id="roles" name="roles[]"
                                    class="form-control select2 select2-multiple @error('roles') is-invalid @enderror" data-placeholder="Select Roles" multiple>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="button-items">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit
                            </button>
                            <a href="{{ route('backend.ums.user.index') }}" type="button"
                               class="btn btn-danger waves-effect waves-light">Cancel</a>
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