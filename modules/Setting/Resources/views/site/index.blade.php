@extends('admin.layouts.master')
@section('title')
    {{ __('admin/site/index.site') }}
@stop
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('admin/site/index.site') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('admin/site/index.app_setting') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin/site/index.site') }}</li>
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
                        <h4 class="card-title mb-4">{{ __('admin/site/index.update_site_info') }}</h4>
                        {!! Form::open(['url' => route('backend.setting.site.update', [$site->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="title" class="@error('title') text-danger @enderror">{{ __('admin/site/index.title') }}</label>
                                <input id="title" name="title" value="{{ old('title') ?: $site->title }}"
                                       type="text" class="form-control @error('title') is-invalid @enderror"
                                       placeholder="{{ __('admin/site/index.enter_title') }}" autofocus>
                                @error('title')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="description" class="@error('description') text-danger @enderror">{{ __('admin/site/index.description') }}</label>
                                <textarea id="description" name="description" class="form-control" rows="5"
                                          placeholder="{{ __('admin/site/index.enter_description') }}">{{ old('description') ?: $site->description }}</textarea>
                                @error('description')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="logo" class="@error('logo') text-danger @enderror">{{ __('admin/site/index.logo') }}</label>
                                <input id="logo" name="logo" value="{{ old('logo') }}" type="file"
                                       class="form-control @error('logo') is-invalid @enderror"
                                       placeholder="Select File" autofocus>
                                @if(isset($site->logo))
                                    <div class="image-output">
                                        <img src="{{ $site->logo->file_url }}">
                                    </div>
                                @endif
                                @error('logo')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            {{--<div class="form-group col-md-4">
                                <label for="logo_sm" class="@error('logo_sm') text-danger @enderror">{{ __('admin/site/index.logo_small') }}</label>
                                <input id="logo_sm" name="logo_sm" value="{{ old('logo_sm') }}" type="file"
                                       class="form-control @error('logo_sm') is-invalid @enderror"
                                       placeholder="Select File" autofocus>
                                @if(isset($site->logo_sm))
                                    <div class="image-output">
                                        <img src="{{ $site->logo_sm->file_url }}">
                                    </div>
                                @endif
                                @error('logo_sm')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>--}}
                            <div class="form-group col-md-6">
                                <label for="favicon"
                                       class="@error('favicon') text-danger @enderror">{{ __('admin/site/index.favicon') }}</label>
                                <input id="favicon" name="favicon" value="{{ old('favicon') }}" type="file"
                                       class="form-control @error('favicon') is-invalid @enderror"
                                       placeholder="Select File" autofocus>
                                @if(isset($site->favicon))
                                    <div class="image-output">
                                        <img src="{{ $site->favicon->file_url }}">
                                    </div>
                                @endif
                                @error('favicon')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary float-right">{{ __('admin/site/index.save_changes') }}</button>
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
@stop

@section('script')
@stop