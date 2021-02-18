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
                            <h3 class="card-title mt-1">Content Details</h3>
                            <a href="{{ route('backend.cms.content.index') }}" type="button" class="btn btn-success btn-sm text-white float-right">View Content List</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="@error('title') text-danger @enderror">Title</label>
                                        <input id="title" name="title" value="{{ $content->title ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('title')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="slug" class="@error('slug') text-danger @enderror">Slug</label>
                                        <input id="slug" name="slug" value="{{ $content->slug ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('slug')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="@error('description') text-danger @enderror">Description</label>
                                        <input id="description" name="description" value="{{ $content->description ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="image" class="@error('image') text-danger @enderror">Feature Image</label>
                                        <input id="image" name="image" value="{{ $content->image->file_name ?? 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @if(isset($content->image))
                                            <div class="image-output">
                                                <img src="{{ $content->image->file_url }}">
                                            </div>
                                        @endif
                                        @error('image')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="attachment" class="@error('attachment') text-danger @enderror">Attachment</label>
                                        <input id="attachment" name="attachment" value="{{ $content->attachment->file_url ?? 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('attachment')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tag" class="@error('tag') text-danger @enderror">Tag</label>
                                        <input id="tag" name="tag" value="{{ $content->tag ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('tag')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content_category_id" class="@error('content_category_id') text-danger @enderror">Content Category Id</label>
                                        <input id="content_category_id" name="content_category_id" value="{{ $content->content_category_id ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('content_category_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
									<div class="col-md-12">
                                    <div class="form-group">
                                        <label for="display_date" class="@error('display_date') text-danger @enderror">Display Date</label>
                                        <input id="display_date" name="display_date" value="{{ $content->display_date ?: 'N/A'}}" type="text" class="form-control-plaintext" readonly>
                                        @error('display_date')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('backend.cms.content.index') }}" type="button" class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
