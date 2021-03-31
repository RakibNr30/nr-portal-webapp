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
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Project</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('backend.cms.project-pending.index') }}">
                                    {{ config('core.project_paginate.pending.' . $user->getRoleNames()[0]) }}
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Show</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials._alert')
                <div class="card border border-primary">
                    <div class="card-header bg-transparent border-primary">
                        @if($user->hasRole('client'))
                            <div class="alert alert-danger text-center" role="alert">
                                Hello! Please wait for approval.
                            </div>
                        @endif
                        <h5 class="my-0 text-primary">
                            Project Id #{{ $project->project_id ?? 'N/A' }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mt-0">
                            {{ $project->title ?? 'N/A' }}
                        </h5>
                        <p class="card-tex mt-1">
                            {!! $project->description !!}
                        </p>

                        @if(count($project->getMedia('client_project_image')))
                            <h4 class="card-title">Project Images</h4>
                            <div class="popup-gallery">
                                @foreach($project->getMedia('client_project_image') as $image)
                                    <a class="float-left" href="{{ $image->getUrl() }}" title="{{ $image->file_name }}">
                                        <div class="img-fluid" style="margin-right: 3px">
                                            <img src="{{ $image->getUrl() }}" alt="" height="130">
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif

                        @if($user->hasRole('admin') || $user->hasRole('super_admin'))
                            {!! Form::open(['url' => route('backend.cms.project-pending.approve', [$project->id]),  'method' => 'put', 'files' => 'true']) !!}
                            <div class="form-group">
                                <label for="company_id" class="@error('company_id') text-danger @enderror mt-3">Assign Company</label>
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
                            <div class="col-12">
                                <div class="button-items float-right">
                                    <a href="{{ route('backend.cms.project-pending.index') }}" type="button"
                                       class="btn btn-danger waves-effect waves-light">Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Approve
                                    </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('style')
    <link href="{{ asset('common/plugins/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('common/plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('common/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .popup-gallery a:last-child {
            float: none !important;
        }
    </style>
@stop

@section('script')
    <script src="{{ asset('common/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/lightbox.init.js') }}"></script>
    <script src="{{ asset('common/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/form-advanced.init.js') }}"></script>
@stop

