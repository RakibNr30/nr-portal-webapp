@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Seo</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">App Setting</a></li>
                            <li class="breadcrumb-item active">Seo</li>
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
                        <h4 class="card-title mb-4">Update Seo Info</h4>
                        {!! Form::open(['url' => route('backend.setting.seo.update', [$seo->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="form-group">
                            <label for="meta_title" class="@error('meta_title') text-danger @enderror">Meta Title</label>
                            <input id="meta_title" name="meta_title" value="{{ old('meta_title') ?: $seo->meta_title }}" type="text" class="form-control @error('meta_title') is-invalid @enderror" placeholder="Enter meta title" autofocus>
                            @error('meta_title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="meta_description" class="@error('meta_description') text-danger @enderror">Meta Description</label>
                            <textarea id="meta_description" name="meta_description" class="form-control" rows="3" placeholder="Enter meta description">{{ old('meta_description') ?: $seo->meta_description }}</textarea>
                            @error('meta_description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="meta_type" class="@error('meta_type') text-danger @enderror">Meta Type</label>
                            <input id="meta_type" name="meta_type" value="{{ old('meta_type') ?: $seo->meta_type }}" type="text" class="form-control @error('meta_type') is-invalid @enderror" placeholder="Enter meta type" autofocus>
                            @error('meta_type')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="meta_tags" class="@error('meta_tags') text-danger @enderror">Meta Tags</label>
                            <input id="meta_tags" name="meta_tags" value="{{ old('meta_tags') ?: $seo->meta_tags }}" type="text" class="form-control @error('meta_tags') is-invalid @enderror" placeholder="Enter meta tags" autofocus>
                            @error('meta_tags')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="canonical" class="@error('canonical') text-danger @enderror">Canonical</label>
                            <input id="canonical" name="canonical" value="{{ old('canonical') ?: $seo->canonical }}" type="text" class="form-control @error('canonical') is-invalid @enderror" placeholder="Enter canonical" autofocus>
                            @error('canonical')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Submit</button>
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