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
                        <h4 class="card-title mb-4">Edit Client</h4>
                        {!! Form::open(['url' => route('backend.ums.client-request.store'), 'method' => 'user']) !!}
                        <div class="form-group">
                            <label for="first_name" class="@error('first_name') text-danger @enderror">First Name</label>
                            <input id="first_name" name="first_name" value="{{ old('first_name') ?: $clientRequest->first_name }}"
                                   type="text"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   placeholder="Enter first name" autofocus required>
                            @error('first_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="@error('last_name') text-danger @enderror">Last Name</label>
                            <input id="last_name" name="last_name" value="{{ old('last_name') ?: $clientRequest->last_name }}"
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
                            <input id="username" name="username" value="{{ old('username') ?: $clientRequest->username }}" type="text"
                                   class="form-control @error('username') is-invalid @enderror"
                                   placeholder="Enter username" autofocus required>
                            @error('username')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="@error('email') text-danger @enderror">Email</label>
                            <input id="email" name="email" value="{{ old('email') ?: $clientRequest->email }}" type="text"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Enter email" autofocus required>
                            @error('email')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="@error('phone') text-danger @enderror">Phone</label>
                            <input id="phone" name="phone" value="{{ old('phone') ?: $clientRequest->phone }}" type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="Enter phone" autofocus required>
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
                                   placeholder="Enter password" autofocus required>
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
                                   placeholder="Re-enter password" autofocus required>
                            @error('password_confirmation')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
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
