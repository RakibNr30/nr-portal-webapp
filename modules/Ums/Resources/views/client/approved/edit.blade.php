@extends('admin.layouts.master')
@section('title')
    {{ __('admin/client/edit.update') }} | {{ __('admin/client/edit.client') }}
@stop
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('admin/client/edit.client') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('backend.ums.client-approved.index') }}">{{ __('admin/client/edit.client') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin/client/edit.update') }}</li>
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
                        <h4 class="card-title mb-4">{{ __('admin/client/edit.update_client') }}</h4>
                        {!! Form::open(['url' => route('backend.ums.client-approved.update', [$user->id]),  'method' => 'put', 'files' => 'true']) !!}
                        <div class="form-group">
                            <label for="full_name" class="@error('full_name') text-danger @enderror">{{ __('admin/client/edit.full_name') }}</label>
                            <input id="full_name" name="full_name" value="{{ old('full_name') ?: $user->basicInfo->first_name }}"
                                   type="text"
                                   class="form-control @error('full_name') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/edit.enter_full_name') }}" autofocus required>
                            @error('full_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="company_name" class="@error('company_name') text-danger @enderror">{{ __('admin/client/edit.company_name') }}</label>
                            <input id="company_name" name="company_name" value="{{ old('company_name') ?: $user->basicInfo->company_name }}" type="text"
                                   class="form-control @error('company_name') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/edit.enter_company_name') }}" autofocus>
                            @error('company_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="@error('email') text-danger @enderror">{{ __('admin/client/edit.email') }}</label>
                            <input id="email" name="email" value="{{ old('email') ?: $user->email }}" type="text"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/edit.enter_email') }}" autofocus required>
                            @error('email')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="@error('phone') text-danger @enderror">{{ __('admin/client/edit.phone') }}</label>
                            <input id="phone" name="phone" value="{{ old('phone') ?: $user->phone }}" type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/edit.enter_phone') }}" autofocus required>
                            @error('phone')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="street_name" class="@error('street_name') text-danger @enderror">{{ __('admin/client/edit.street_name') }}</label>
                            <input id="street_name" name="street_name" value="{{ old('street_name') ?: $user->residentialInfo->present_street_name }}" type="text"
                                   class="form-control @error('street_name') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/edit.enter_street_name') }}" autofocus required>
                            @error('street_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="house_number" class="@error('house_number') text-danger @enderror">{{ __('admin/client/edit.house_number') }}</label>
                            <input id="house_number" name="house_number" value="{{ old('house_number') ?: $user->residentialInfo->present_house_number }}" type="text"
                                   class="form-control @error('house_number') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/edit.enter_house_number') }}" autofocus required>
                            @error('house_number')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="zip_code" class="@error('zip_code') text-danger @enderror">{{ __('admin/client/edit.zip_code') }}</label>
                            <input id="zip_code" name="zip_code" value="{{ old('zip_code') ?: $user->residentialInfo->present_zip_code }}" type="text"
                                   class="form-control @error('zip_code') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/edit.enter_zip_code') }}" autofocus required>
                            @error('zip_code')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="city" class="@error('city') text-danger @enderror">{{ __('admin/client/edit.city') }}</label>
                            <input id="city" name="city" value="{{ old('city') ?: $user->residentialInfo->present_city }}" type="text"
                                   class="form-control @error('city') is-invalid @enderror"
                                   placeholder="{{ __('admin/client/edit.enter_city') }}" autofocus required>
                            @error('city')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description" class="@error('description') text-danger @enderror">{{ __('admin/client/edit.description') }}</label>
                            <textarea id="description" name="description" rows="4"
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="{{ __('admin/client/edit.enter_description') }}" autofocus>{{ old('description') ?: $user->basicInfo->about }}</textarea>
                            @error('description')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <input type="hidden" name="roles[]" value="client">
                        <div class="button-items float-right">
                            <a href="{{ route('backend.ums.client-approved.index') }}" type="button"
                               class="btn btn-danger waves-effect waves-light">{{ __('admin/client/edit.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">{{ __('admin/client/edit.save_changes') }}
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
