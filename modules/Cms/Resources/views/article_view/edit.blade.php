@extends('admin.layouts.master')

@section('content')
    <div class="content-header pt-2"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.partials._alert')
                    <div class="card card-gray-dark card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Edit Article View</h3>
                            <a href="{{ route('backend.cms.article-view.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Article View List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.cms.article-view.update', [$articleView->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="article_id" class="@error('article_id') text-danger @enderror">Article Id</label>
                                            <input id="article_id" name="article_id" value="{{ old('article_id') ?: $articleView->article_id }}" type="text" class="form-control @error('article_id') is-invalid @enderror" placeholder="Enter article id" autofocus>
                                            @error('article_id')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ip_address" class="@error('ip_address') text-danger @enderror">Ip Address</label>
                                            <input id="ip_address" name="ip_address" value="{{ old('ip_address') ?: $articleView->ip_address }}" type="text" class="form-control @error('ip_address') is-invalid @enderror" placeholder="Enter ip address" autofocus>
                                            @error('ip_address')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="mac_address" class="@error('mac_address') text-danger @enderror">Mac Address</label>
                                            <input id="mac_address" name="mac_address" value="{{ old('mac_address') ?: $articleView->mac_address }}" type="text" class="form-control @error('mac_address') is-invalid @enderror" placeholder="Enter mac address" autofocus>
                                            @error('mac_address')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="browser" class="@error('browser') text-danger @enderror">Browser</label>
                                            <input id="browser" name="browser" value="{{ old('browser') ?: $articleView->browser }}" type="text" class="form-control @error('browser') is-invalid @enderror" placeholder="Enter browser" autofocus>
                                            @error('browser')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="latitude" class="@error('latitude') text-danger @enderror">Latitude</label>
                                            <input id="latitude" name="latitude" value="{{ old('latitude') ?: $articleView->latitude }}" type="text" class="form-control @error('latitude') is-invalid @enderror" placeholder="Enter latitude" autofocus>
                                            @error('latitude')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group">
                                            <label for="longitude" class="@error('longitude') text-danger @enderror">Longitude</label>
                                            <input id="longitude" name="longitude" value="{{ old('longitude') ?: $articleView->longitude }}" type="text" class="form-control @error('longitude') is-invalid @enderror" placeholder="Enter longitude" autofocus>
                                            @error('longitude')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                            <a href="{{ route('backend.cms.article-view.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
