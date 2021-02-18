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
                            <h3 class="card-title mt-1">Article View Details</h3>
                            <a href="{{ route('backend.cms.article-view.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Article View List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="article_id" class="@error('article_id') text-danger @enderror">Article Id</label>
                                        <input id="article_id" name="article_id" value="{{ $articleView->article_id ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('article_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="ip_address" class="@error('ip_address') text-danger @enderror">Ip Address</label>
                                        <input id="ip_address" name="ip_address" value="{{ $articleView->ip_address ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('ip_address')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mac_address" class="@error('mac_address') text-danger @enderror">Mac Address</label>
                                        <input id="mac_address" name="mac_address" value="{{ $articleView->mac_address ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('mac_address')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="browser" class="@error('browser') text-danger @enderror">Browser</label>
                                        <input id="browser" name="browser" value="{{ $articleView->browser ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('browser')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="latitude" class="@error('latitude') text-danger @enderror">Latitude</label>
                                        <input id="latitude" name="latitude" value="{{ $articleView->latitude ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('latitude')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="longitude" class="@error('longitude') text-danger @enderror">Longitude</label>
                                        <input id="longitude" name="longitude" value="{{ $articleView->longitude ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('longitude')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.cms.article-view.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
