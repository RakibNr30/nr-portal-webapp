@extends('admin.layouts.master')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Project</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Project</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.cms.project-pending.index') }}">Pending</a></li>
                            <li class="breadcrumb-item active">Show</li>
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
                        <h4 class="card-title mb-4">View Pending Project</h4>
                        <div class="form-group">
                            <label for="title"
                                   class="@error('title') text-danger @enderror">Project Title</label>
                            <input id="title" name="title"
                                   value=" → {{ $project->title ?: 'N/A'}}"
                                   type="text" class="form-control-plaintext" readonly>
                            @error('title')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="project_id"
                                   class="@error('project_id') text-danger @enderror">Project ID</label>
                            <input id="project_id" name="project_id" value=" → {{ $project->project_id ?: 'N/A'}}"
                                   type="text" class="form-control-plaintext" readonly>
                            @error('project_id')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image"
                                   class="@error('image') text-danger @enderror">Project Feature Image</label>
                            <input id="image" name="image" value=" → {{ $project->image ? $project->image->file_name : 'N/A'}}" type="text"
                                   class="form-control-plaintext" readonly>
                            @if(isset($project->image))
                                <div class="image-output">
                                    <img src="{{ $project->image->file_url }}">
                                </div>
                            @endif
                            @error('image')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="attachment"
                                   class="@error('attachment') text-danger @enderror">Project Attachment</label>
                            <br>
                            @if(isset($project->attachment))
                                <a target="_blank" href="{{ $project->attachment->file_url }}">
                                    → Download
                                </a>
                            @else
                                {{ 'N/A' }}
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description"
                                   class="@error('description') text-danger @enderror">Project Description</label>
                            <br>
                            {!! $project->description ?: 'N/A' !!}
                        </div>
                        <a href="{{ route('backend.cms.project-pending.index') }}" type="button"
                           class="btn btn-danger waves-effect waves-light float-right">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
