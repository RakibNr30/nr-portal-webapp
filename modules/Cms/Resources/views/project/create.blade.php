@extends('admin.layouts.master')
@php
    $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
@endphp
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Project</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Project</a></li>
                            <li class="breadcrumb-item active">Create</li>
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
                        <h4 class="card-title mb-4">Create Project</h4>
                        {!! Form::open(['url' => route('backend.cms.project.store'), 'method' => 'project', 'files' => true, 'class' => '']) !!}
                        <div class="form-group">
                            <label for="title" class="@error('title') text-danger @enderror">Project Title</label>
                            <input id="title" name="title" value="{{ old('title') }}"
                                   type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   placeholder="Enter project title" autofocus required>
                            @error('title')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description" class="@error('description') text-danger @enderror">Project Description</label>
                            <textarea id="description" name="description" class="form-control summernote" rows="3" placeholder="Enter project description">{{ old('description') }}</textarea>
                            @error('description')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="drop-area">
                            <div class="fallback">
                                <input name="images[]" type="file" multiple>
                                @error('image')
                                <span class="invalid-feedback"
                                      role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                           {{-- <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted mdi mdi-upload-network-outline"></i>
                                </div>
                                <h6>Drop images here or click to upload.</h6>
                            </div>--}}
                        </div>
                        {{--<div class="form-group">
                            <label for="image" class="@error('image') text-danger @enderror">Project Feature Image</label>
                            <input id="image" name="image" value="{{ old('image') }}" type="file" class="form-control @error('image') is-invalid @enderror" placeholder="Select File" autofocus>
                            @error('image')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="attachment" class="@error('attachment') text-danger @enderror">Project Attachment</label>
                            <input id="attachment" name="attachment" value="{{ old('attachment') }}" type="file" class="form-control @error('attachment') is-invalid @enderror" placeholder="Select File" autofocus>
                            @error('attachment')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>--}}
                        <input type="hidden" name="author_id" value="{{ $user->id }}">
                        <div class="button-items float-right">
                            <a href="{{ route('backend.cms.dashboard.index') }}" type="button"
                               class="btn btn-danger waves-effect waves-light">Cancel
                            </a>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Submit
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('style')
    <link href="{{ asset('common/plugins/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .dropzone {
            border: unset !important;
            min-height: unset !important;
            padding: unset !important;
        }
        .dropzone .drop-area {
            border: 2px dashed #ced4da;
            margin-bottom: 20px;
        }
    </style>
@stop

@section('script')
    <script src="{{ asset('common/plugins/dropzone/min/dropzone.min.js') }}"></script>

    {{--<script>
        $(".dz-error-mark").click(function(){
            $(this).parent('span').remove();
            $(this).val("");
            $('#thumbnail').val("");
        });
    </script>--}}
@stop