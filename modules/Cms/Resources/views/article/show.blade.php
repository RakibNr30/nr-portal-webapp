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
                            <h3 class="card-title mt-1">Article Details</h3>
                            <a href="{{ route('backend.cms.article.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Article List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="@error('title') text-danger @enderror">Title</label>
                                        <input id="title" name="title" value="{{ $article->title ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="@error('description') text-danger @enderror">Description</label>
                                        <input id="description" name="description" value="{{ $article->description ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="feature_image" class="@error('feature_image') text-danger @enderror">Feature Image</label>
                                        <input id="feature_image" name="feature_image" value="{{ $article->feature_image ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('feature_image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="approve_status" class="@error('approve_status') text-danger @enderror">Approve Status</label>
                                        <input id="approve_status" name="approve_status" value="{{ $article->approve_status ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('approve_status')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="approved_at" class="@error('approved_at') text-danger @enderror">Approved At</label>
                                        <input id="approved_at" name="approved_at" value="{{ $article->approved_at ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('approved_at')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="approved_by" class="@error('approved_by') text-danger @enderror">Approved By</label>
                                        <input id="approved_by" name="approved_by" value="{{ $article->approved_by ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('approved_by')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="article_category_id" class="@error('article_category_id') text-danger @enderror">Article Category Id</label>
                                        <input id="article_category_id" name="article_category_id" value="{{ $article->article_category_id ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('article_category_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="author_id" class="@error('author_id') text-danger @enderror">Author Id</label>
                                        <input id="author_id" name="author_id" value="{{ $article->author_id ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('author_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.cms.article.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
