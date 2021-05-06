@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('admin/company/edit.company') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('backend.ums.company.index') }}">{{ __('admin/company/edit.company') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin/company/edit.update') }}</li>
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
                        <h4 class="card-title mb-4">{{ __('admin/company/edit.update_company') }}</h4>
                        {!! Form::open(['url' => route('backend.ums.company.update', [$user->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="company_name" class="@error('company_name') text-danger @enderror">{{ __('admin/company/edit.company_name') }}</label>
                                <input id="company_name" name="company_name" value="{{ old('company_name') ?: $user->basicInfo->first_name }}"
                                       type="text"
                                       class="form-control @error('company_name') is-invalid @enderror"
                                       placeholder="{{ __('admin/company/edit.enter_company_name') }}" autofocus required>
                                @error('company_name')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="about"
                                       class="@error('about') text-danger @enderror">{{ __('admin/company/edit.company_about') }}</label>
                                <textarea id="about" name="about" rows="5"
                                          class="form-control @error('about') is-invalid @enderror"
                                          placeholder="{{ __('admin/company/edit.enter_company_about') }}" autofocus required>{{ old('about') ?: $user->basicInfo->about }}</textarea>
                                @error('about')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="@error('email') text-danger @enderror">{{ __('admin/company/edit.company_email') }}</label>
                                <input id="email" name="email" value="{{ old('email') ?: $user->email }}" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="{{ __('admin/company/edit.enter_company_email') }}" autofocus required>
                                @error('email')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" class="@error('phone') text-danger @enderror">{{ __('admin/company/edit.company_phone') }}</label>
                                <input id="phone" name="phone" value="{{ old('phone') ?: $user->phone }}" type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       placeholder="{{ __('admin/company/edit.enter_company_phone') }}" autofocus required>
                                @error('phone')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="avatar" class="@error('avatar') text-danger @enderror">{{ __('admin/company/edit.company_avatar') }}</label>
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
                                       class="btn btn-danger waves-effect waves-light">{{ __('admin/company/edit.cancel') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">{{ __('admin/company/edit.save_changes') }}
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
