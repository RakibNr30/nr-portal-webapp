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
                            <h3 class="card-title mt-1">Edit Content</h3>
                            <a href="{{ route('backend.cms.content.index') }}" type="button"
                               class="btn btn-success btn-sm text-white float-right">View Content List</a>
                        </div>
                        {!! Form::open(['url' => route('backend.cms.content.update', [$content->id]), 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content_category_id" class="@error('content_category_id') text-danger @enderror">Content Category</label>
                                        <select id="content_category_id" name="content_category_id" class="form-control  @error('content_category_id') is-invalid @enderror">
                                            <option value="">Select a category</option>
                                            @foreach($contentCategories as $contentCategory)
                                                <option value="{{ $contentCategory->id }}" {{ old('content_category_id')
                                                    ? (old('content_category_id') == $contentCategory->id ? 'selected' : '')
                                                    : ($content->content_category_id == $contentCategory->id ? 'selected' : '') }}>
                                                    {{ $contentCategory->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('content_category_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title" class="@error('title') text-danger @enderror">Title</label>
                                        <input id="title" name="title" value="{{ old('title') ?: $content->title }}"
                                               type="text" class="form-control @error('title') is-invalid @enderror"
                                               placeholder="Enter title" autofocus>
                                        @error('title')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="@error('description') text-danger @enderror">Description</label>
                                        <textarea id="description" name="description" class="form-control" rows="3"
                                                  placeholder="Enter description">{{ old('description') ?: $content->description }}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tag" class="@error('tag') text-danger @enderror">Tag</label>
                                        <input id="tag" name="tag" value="{{ old('tag') ?: $content->tag }}" type="text"
                                               class="form-control @error('tag') is-invalid @enderror"
                                               placeholder="Enter tags" autofocus>
                                        @error('tag')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="display_date" class="@error('display_date') text-danger @enderror">Display Date</label>
                                        <input id="display_date" name="display_date" value="{{ old('display_date') ? old('display_date') : $content->display_date }}" type="text" class="form-control datepicker @error('display_date') is-invalid @enderror" placeholder="Enter display date" autofocus>
                                        @error('display_date')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image" class="@error('image') text-danger @enderror">Image</label>
                                        <input id="image" name="image" value="{{ old('image') }}" type="file" class="form-control @error('image') is-invalid @enderror" placeholder="Select File" autofocus>
                                        {{--@if(isset($content->image->file_name))
                                        <span class="invalid-feedback text-dark" role="alert"><strong>Image: {{ $content->image->file_name }}</strong></span>
                                        @endif--}}
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="attachment" class="@error('attachment') text-danger @enderror">Attachment</label>
                                        <input id="attachment" name="attachment" value="{{ old('attachment') }}" type="file" class="form-control @error('attachment') is-invalid @enderror" placeholder="Enter attachment" autofocus>
                                        @if(isset($content->attachment->file_name))
                                            <span class="invalid-feedback text-dark" role="alert"><strong>Attachment: {{ $content->attachment->file_name }}</strong></span>
                                        @endif
                                        @error('attachment')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success float-right ml-1">Submit</button>
                            <a href="{{ route('backend.cms.content.index') }}" type="button"
                               class="btn btn-dark text-white float-right">Cancel</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
