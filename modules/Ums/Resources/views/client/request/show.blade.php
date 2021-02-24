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
                        <h4 class="card-title mb-4">View Admin</h4>
                        <div class="form-group">
                            <label for="first_name"
                                   class="@error('first_name') text-danger @enderror">First Name</label>
                            <input id="first_name" name="first_name"
                                   value=" → {{ $clientRequest->first_name ?: 'N/A'}}"
                                   type="text" class="form-control-plaintext" readonly>
                            @error('first_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name"
                                   class="@error('last_name') text-danger @enderror">Last Name</label>
                            <input id="last_name" name="last_name"
                                   value=" → {{ $clientRequest->last_name ?: 'N/A'}}"
                                   type="text" class="form-control-plaintext" readonly>
                            @error('last_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username"
                                   class="@error('username') text-danger @enderror">Username</label>
                            <input id="username" name="username" value=" → {{ $clientRequest->username ?: 'N/A'}}"
                                   type="text" class="form-control-plaintext" readonly>
                            @error('username')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="@error('email') text-danger @enderror">Email</label>
                            <input id="email" name="email" value=" → {{ $clientRequest->email ?: 'N/A'}}" type="text"
                                   class="form-control-plaintext" readonly>
                            @error('email')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="@error('phone') text-danger @enderror">Phone</label>
                            <input id="phone" name="phone" value=" → {{ $clientRequest->phone ?: 'N/A'}}" type="text"
                                   class="form-control-plaintext" readonly>
                            @error('phone')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <a href="{{ route('backend.ums.client-request.index') }}" type="button"
                           class="btn btn-danger waves-effect waves-light float-right">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
