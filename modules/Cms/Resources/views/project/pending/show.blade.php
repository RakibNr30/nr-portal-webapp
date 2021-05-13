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
                            <li class="breadcrumb-item"><a href="javascript: void(0)">{{ __('admin/pending_project/show.project') }}</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.cms.project-pending.index') }}">
                                    @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                        {{ config('core.project_paginate.pending.' . $user->getRoleNames()[0]) }}
                                    @else
                                        {{ config('core.project_paginate.pending.' . $user->getRoleNames()[0] . '_dt') }}
                                    @endif
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('admin/pending_project/show.show') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials._alert')
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card border border-primary">
                            <div class="card-header bg-transparent">
                                @if($user->hasRole('client'))
                                    <div class="alert alert-danger text-center" role="alert">
                                        {{ __('admin/pending_project/show.approval_message') }}
                                    </div>
                                @endif
                                <h5 class="my-0 text-primary">
                                    {{ __('admin/pending_project/show.project_id') }} #{{ $project->project_id ?? 'N/A' }}
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
                                    <h4 class="card-title">{{ __('admin/pending_project/show.project_images') }}</h4>
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
                                        <label for="company_id" class="@error('company_id') text-danger @enderror mt-3">{{ __('admin/pending_project/show.assign_companies') }}</label>
                                        <select id="company_id" name="company_id[]"
                                                class="form-control select2 @error('company_id') is-invalid @enderror" data-placeholder="{{ __('admin/pending_project/show.select_companies') }}" multiple required>
                                            @foreach($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->basicInfo->first_name ?? '' }}</option>
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
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">{{ __('admin/pending_project/show.approve') }}
                                            </button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border border-primary">
                            <div class="card-body">
                                <div class="profile-widgets">
                                    <div class="text-center">
                                        <span class="badge badge-success mb-3">{{ __('admin/pending_project/show.project_client') }}</span>
                                        <br>
                                        <div class="">
                                            <img src="{{ $author->avatar->file_url ?? config('core.image.default.avatar') }}" alt="" class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                        </div>

                                        <div class="mt-3">
                                            <a href="javascript:void(0)" class="text-dark font-weight-medium font-size-16">
                                                {{ $author->basicInfo->first_name ?? '' }} {{ $author->basicInfo->last_name ?? '' }}
                                            </a>
                                            <p class="text-body mt-1 mb-1">
                                                {{ $author->basicInfo->designation ?? '' }}
                                            </p>
                                            <a href="{{ route('backend.ums.client-approved.show', [$author->id]) }}" class="badge badge-danger p-1 mt-2">
                                                {{ __('admin/pending_project/show.view_profile') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card border border-primary">
                            <div class="card-header bg-primary">
                                <h6 class="text-center text-white mb-0">
                                    {{ __('admin/pending_project/show.contact_info') }}
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="profile-widgets">
                                    <div class="text-center">
                                        <div class="mt-3">
                                            @if(isset($author->basicInfo->personal_email))
                                                <div class="mt-2">
                                                    <p class="font-size-12 text-muted mb-1">{{ __('admin/pending_project/show.email_address') }}</p>
                                                    <h6 class="">
                                                        <a href="mailto: {{ $author->basicInfo->personal_email }}" style="color: unset">
                                                            {{ $author->basicInfo->personal_email }}
                                                        </a>
                                                    </h6>
                                                </div>
                                            @endif

                                            @if(isset($author->basicInfo->phone_no))
                                                <div class="mt-3">
                                                    <p class="font-size-12 text-muted mb-1">{{ __('admin/pending_project/show.phone_number') }}</p>
                                                    <h6 class="">
                                                        <a href="tel: {{ $author->basicInfo->phone_no }}" style="color: unset">
                                                            {{ $author->basicInfo->phone_no }}
                                                        </a>
                                                    </h6>
                                                </div>
                                            @endif
                                            @if(isset($author->residentialInfo->present_address_line_1))
                                                <div class="mt-3">
                                                    <p class="font-size-12 text-muted mb-1">{{ __('admin/pending_project/show.address') }}</p>
                                                    <h6 class="">
                                                        {{ $author->residentialInfo->present_address_line_1 }}
                                                    </h6>
                                                </div>
                                            @endif
                                            @if(isset($author->residentialInfo->present_city))
                                                <div class="mt-3">
                                                    <p class="font-size-12 text-muted mb-1">{{ __('admin/pending_project/show.city_district') }}</p>
                                                    <h6 class="">
                                                        {{ $author->residentialInfo->present_city }}
                                                    </h6>
                                                </div>
                                            @endif
                                            @if(isset($author->residentialInfo->present_state))
                                                <div class="mt-3">
                                                    <p class="font-size-12 text-muted mb-1">{{ __('admin/pending_project/show.state_division') }}</p>
                                                    <h6 class="">
                                                        {{ $author->residentialInfo->present_state }}
                                                    </h6>
                                                </div>
                                            @endif
                                            @if(isset($author->residentialInfo->present_country))
                                                <div class="mt-3">
                                                    <p class="font-size-12 text-muted mb-1">{{ __('admin/pending_project/show.country') }}</p>
                                                    <h6 class="">
                                                        {{ $author->residentialInfo->present_country }}
                                                    </h6>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

