@extends('admin.layouts.master')
@section('title')
    {{ __('admin/admin/edit.update') }} | {{ __('admin/admin/edit.admin') }}
@stop
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('admin/admin/edit.admin') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('admin/admin/edit.user_control') }}</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.ums.admin.index') }}">{{ __('admin/admin/edit.admin') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin/admin/edit.update') }}</li>
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
                        <h4 class="card-title mb-4">{{ __('admin/admin/edit.update_admin') }}</h4>
                        {!! Form::open(['url' => route('backend.ums.admin.update', [$user->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="form-group">
                            <label for="first_name" class="@error('first_name') text-danger @enderror">{{ __('admin/admin/edit.first_name') }}</label>
                            <input id="first_name" name="first_name" value="{{ old('first_name') ?: $user->basicInfo->first_name }}"
                                   type="text"
                                   class="form-control @error('first_name') is-invalid @enderror"
                                   placeholder="{{ __('admin/admin/edit.enter_first_name') }}" autofocus required>
                            @error('first_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="@error('last_name') text-danger @enderror">{{ __('admin/admin/edit.last_name') }}</label>
                            <input id="last_name" name="last_name" value="{{ old('last_name') ?: $user->basicInfo->last_name }}"
                                   type="text" class="form-control @error('last_name') is-invalid @enderror"
                                   placeholder="{{ __('admin/admin/edit.enter_last_name') }}" autofocus>
                            @error('last_name')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        {{--<div class="form-group">
                            <label for="username"
                                   class="@error('username') text-danger @enderror">Username</label>
                            <input id="username" name="username" value="{{ old('username') ?: $user->username }}" type="text"
                                   class="form-control @error('username') is-invalid @enderror"
                                   placeholder="Enter username" autofocus required>
                            @error('username')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>--}}
                        <div class="form-group">
                            <label for="email" class="@error('email') text-danger @enderror">{{ __('admin/admin/edit.email') }}</label>
                            <input id="email" name="email" value="{{ old('email') ?: $user->email }}" type="text"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="{{ __('admin/admin/edit.enter_email') }}" autofocus required>
                            @error('email')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone" class="@error('phone') text-danger @enderror">{{ __('admin/admin/edit.phone') }}</label>
                            <input id="phone" name="phone" value="{{ old('phone') ?: $user->phone }}" type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   placeholder="{{ __('admin/admin/edit.enter_phone') }}" autofocus required>
                            @error('phone')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="avatar" class="@error('avatar') text-danger @enderror">{{ __('admin/admin/edit.avatar') }}</label>
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
                        <div class="button-items float-right">
                            <a href="{{ route('backend.ums.admin.index') }}" type="button"
                               class="btn btn-danger waves-effect waves-light">{{ __('admin/admin/edit.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">{{ __('admin/admin/edit.save_changes') }}
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
