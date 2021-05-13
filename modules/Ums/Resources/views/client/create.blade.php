@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('admin/client/create.client') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('backend.ums.client-approved.index') }}">{{ __('admin/client/create.client') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin/client/create.create') }}</li>
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
                        <h4 class="card-title mb-4">{{ __('admin/client/create.create_client') }}</h4>
                        {!! Form::open(['url' => route('backend.ums.client.store'),  'method' => 'client', 'files' => 'true']) !!}
                        <div class="form-group">
                            <label for="first_name" class="@error('first_name') text-danger @enderror">{{ __('admin/client/create.first_name') }}</label>
                            <input id="first_name" name="first_name" value="{{ old('first_name') }}"
                                   type="text"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/create.enter_first_name') }}" autofocus required>
                            @error('first_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="@error('last_name') text-danger @enderror">{{ __('admin/client/create.last_name') }}</label>
                            <input id="last_name" name="last_name" value="{{ old('last_name') }}"
                                   type="text"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/create.enter_last_name') }}" autofocus required>
                            @error('last_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="company_name" class="@error('company_name') text-danger @enderror">{{ __('admin/client/create.company_name') }}</label>
                            <input id="company_name" name="company_name" value="{{ old('company_name') }}" type="text"
                                   class="form-control @error('company_name') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/create.enter_company_name') }}" autofocus>
                            @error('company_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="@error('email') text-danger @enderror">{{ __('admin/client/create.email') }}</label>
                            <input id="email" name="email" value="{{ old('email') }}" type="text"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/create.enter_email') }}" autofocus required>
                            @error('email')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="@error('phone') text-danger @enderror">{{ __('admin/client/create.phone') }}</label>
                            <input id="phone" name="phone" value="{{ old('phone') }}" type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/create.enter_phone') }}" autofocus required>
                            @error('phone')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="street_name" class="@error('street_name') text-danger @enderror">{{ __('admin/client/create.street_name') }}</label>
                            <input id="street_name" name="street_name" value="{{ old('street_name') }}" type="text"
                                   class="form-control @error('street_name') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/create.enter_street_name') }}" autofocus required>
                            @error('street_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="house_number" class="@error('house_number') text-danger @enderror">{{ __('admin/client/create.house_number') }}</label>
                            <input id="house_number" name="house_number" value="{{ old('house_number') }}" type="text"
                                   class="form-control @error('house_number') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/create.enter_house_number') }}" autofocus required>
                            @error('house_number')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="zip_code" class="@error('zip_code') text-danger @enderror">{{ __('admin/client/create.zip_code') }}</label>
                            <input id="zip_code" name="zip_code" value="{{ old('zip_code') }}" type="text"
                                   class="form-control @error('zip_code') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/create.enter_zip_code') }}" autofocus required>
                            @error('zip_code')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city" class="@error('city') text-danger @enderror">{{ __('admin/client/create.city') }}</label>
                            <input id="city" name="city" value="{{ old('city') }}" type="text"
                                   class="form-control @error('city') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/create.enter_city') }}" autofocus required>
                            @error('city')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="avatar" class="@error('avatar') text-danger @enderror">{{ __('admin/admin/create.avatar') }}</label>
                            <input id="avatar" name="avatar" value="{{ old('avatar') }}" type="file" class="form-control @error('avatar') is-invalid @enderror" placeholder="Select File" autofocus>
                            @if(isset($user->avatar->name))
                                <span class="invalid-feedback text-dark" role="alert"><strong>{{ __('admin/admin/create.avatar') }}: {{ $user->avatar->name }}</strong></span>
                            @endif
                            @error('avatar')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <input type="hidden" name="roles[]" value="client">
                        <div class="button-items float-right">
                            <a href="{{ route('backend.ums.client-approved.index') }}" type="button"
                               class="btn btn-danger waves-effect waves-light">{{ __('admin/client/create.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">{{ __('admin/client/create.submit') }}
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
