@extends('admin.layouts.master')
@php
    $user = \Modules\Ums\Entities\User::find(auth()->user()->id)
@endphp
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Project</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Project</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.cms.project-pending.index') }}">
                                    {{ config('core.project_paginate.pending.' . $user->getRoleNames()[0]) }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Approve</li>
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
                        <h4 class="card-title mb-4">Edit Client From Approved</h4>
                        {!! Form::open(['url' => route('backend.cms.project-pending.approve', [$project->id]),  'method' => 'put', 'files' => 'true']) !!}
                        <div class="form-group">
                            <label for="title" class="@error('title') text-danger @enderror">Project Title</label>
                            <input id="title" name="title" value="{{ old('title') ?: $project->title }}"
                                   type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   placeholder="Enter first name" autofocus required readonly>
                            @error('title')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="project_id" class="@error('project_id') text-danger @enderror">Project ID</label>
                            <input id="project_id" name="project_id" value="{{ old('project_id') ?: $project->project_id }}" type="text"
                                   class="form-control @error('project_id') is-invalid @enderror"
                                   placeholder="Enter project_id" autofocus readonly>
                            @error('project_id')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image" class="@error('image') text-danger @enderror">Project Feature Image</label>
                            <br>
                            {{--<input id="image" name="image" value="{{ old('image') }}" type="file" class="form-control @error('image') is-invalid @enderror" placeholder="Select Image" autofocus>--}}
                            @if(isset($project->image))
                                <div class="image-output">
                                    <img src="{{ $project->image->file_url }}">
                                </div>
                            @else
                                {{ 'N/A' }}
                            @endif
                            @error('image')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image" class="@error('image') text-danger @enderror">Project Feature Image</label>
                            <br>
                            {{--<input id="image" name="image" value="{{ old('image') }}" type="file" class="form-control @error('image') is-invalid @enderror" placeholder="Select Image" autofocus>--}}
                            @if(isset($project->attachment))
                                <a target="_blank" href="{{ $project->attachment->file_url }}">
                                    → Download
                                </a>
                            @else
                                {{ 'N/A' }}
                            @endif
                            @error('image')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description" class="@error('description') text-danger @enderror">Project Description</label>
                            <br>
                             {!! $project->description ?? 'N/A' !!}
                        </div>
                        <div class="form-group">
                            <label for="company_id" class="@error('company_id') text-danger @enderror">Assign Company</label>
                            <select id="company_id" name="company_id[]"
                                    class="form-control select2 @error('company_id') is-invalid @enderror" data-placeholder="Select Companies" multiple required>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->basicInfo->first_name }}</option>
                                @endforeach
                            </select>
                            @error('company_id')
                            <span class="invalid-feedback"
                                  role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="button-items float-right">
                            <a href="{{ route('backend.cms.project-pending.index') }}" type="button"
                               class="btn btn-danger waves-effect waves-light">Cancel
                            </a>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Approve
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
    <link href="{{ asset('common/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('script')
    <script src="{{ asset('common/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/form-advanced.init.js') }}"></script>
@stop
