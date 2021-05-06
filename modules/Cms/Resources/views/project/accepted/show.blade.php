@extends('admin.layouts.master')
@php
    $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
    $currentCompany = 0;
@endphp
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('admin/accepted_project/show.project') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">{{ __('admin/accepted_project/show.project') }}</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.cms.project-accepted.index') }}">
                                    @if(\Illuminate\Support\Facades\App::getLocale() == 'en')
                                        {{ config('core.project_paginate.accepted.' . $user->getRoleNames()[0]) }}
                                    @else
                                        {{ config('core.project_paginate.accepted.' . $user->getRoleNames()[0] . '_dt') }}
                                    @endif
                                </a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('admin/accepted_project/show.show') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card border border-primary">
                    <div class="card-header bg-transparent border-primary">
                        <h5 class="my-0 text-primary">
                            {{ __('admin/accepted_project/show.project_id') }} #{{ $project->project_id ?? 'N/A' }}
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
                            <h4 class="card-title">{{ __('admin/accepted_project/show.project_images') }}</h4>
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
                    </div>
                </div>

                @include('admin.partials._alert')

                @if($user->hasRole('company'))
                    @if(count($companies))
                        <div class="checkout-tabs mt-5">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card border border-primary">
                                        <div class="card-body">
                                            @foreach($companies as $index => $company)
                                                <div class="faq-box media">
                                                    @if($company->id == $user->id)
                                                        <div class="col-md-12">
                                                            <div class="card-body bg-transparent text-primary">
                                                                <div>
                                                                    @if ($errors->any())
                                                                        <div class="alert alert-danger">
                                                                            <ul>
                                                                                @foreach ($errors->all() as $error)
                                                                                    <li>{{ $error }}</li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    @endif
                                                                    @php
                                                                        $attachment_admin = 'attachment_admin_' . ($project->selected_index + 1);
                                                                        $attachment_company = 'attachment_company_' . ($project->selected_index + 1);
                                                                    @endphp

                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="card border mb-0">
                                                                                <div class="card-header">
                                                                                    <h6 class="my-0 text-black-50 text-center">
                                                                                        {{ __('admin/accepted_project/show.your_attachment') }}
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="card-body bg-transparent text-center">
                                                                                    @if(isset($project->$attachment_company))
                                                                                        <div>
                                                                                            <strong class="font-size-13">
                                                                                                {{ __('admin/accepted_project/show.file_name') }}: {{ $project->$attachment_company->file_name }}
                                                                                            </strong>
                                                                                        </div>
                                                                                        <div class="mt-1">
                                                                                            <strong>
                                                                                                <a target="_blank" class="badge badge-danger p-2 font-size-12 mt-1" href="{{ $project->$attachment_company->file_url }}">
                                                                                                    {{ __('admin/accepted_project/show.project') }}
                                                                                                </a>
                                                                                            </strong>
                                                                                        </div>
                                                                                    @else
                                                                                        <small class="text-danger">{{ __('admin/accepted_project/show.no_attachment_found') }}</small>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if($user->hasRole('admin') || $user->hasRole('super_admin'))
                    @if(count($companies))
                        <div class="checkout-tabs mt-5">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card border border-primary">
                                        <div class="card-body">
                                            @foreach($companies as $index => $company)
                                                <h4 class="card-title text-center">
                                                    <a href="{{ route('backend.ums.company.show', [$company->id]) }}">
                                                        {{ $company->basicInfo->first_name }}
                                                    </a>
                                                </h4>
                                                <hr>
                                                <div class="faq-box media">
                                                    <div class="card-body bg-transparent text-primary">
                                                        <div>
                                                            @php
                                                                $attachment_admin = 'attachment_admin_' . ($project->selected_index + 1);
                                                                $attachment_company = 'attachment_company_' . ($project->selected_index + 1);
                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="card border mb-0">
                                                                        <div class="card-header">
                                                                            <h6 class="my-0 text-black-50 text-center">
                                                                                {{ __('admin/accepted_project/show.attachment_from_company') }}
                                                                            </h6>
                                                                        </div>
                                                                        <div class="card-body bg-transparent text-primary text-center">
                                                                            @if(isset($project->$attachment_company))
                                                                                <div>
                                                                                    <strong class="font-size-13">
                                                                                        {{ __('admin/accepted_project/show.file_name') }}: {{ $project->$attachment_company->file_name }}
                                                                                    </strong>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <strong>
                                                                                        <a target="_blank" class="badge badge-danger p-2 font-size-12 mt-1" href="{{ $project->$attachment_company->file_url }}">
                                                                                            {{ __('admin/accepted_project/show.download') }}
                                                                                        </a>
                                                                                    </strong>
                                                                                </div>
                                                                            @else
                                                                                <small class="text-danger">{{ __('admin/accepted_project/show.no_attachment_found') }}</small>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="card border mb-0">
                                                                        <div class="card-header">
                                                                            <h6 class="my-0 text-black-50 text-center">
                                                                                {{ __('admin/accepted_project/show.attachment_from_admin') }}
                                                                            </h6>
                                                                        </div>
                                                                        <div class="card-body bg-transparent text-primary text-center">
                                                                            @if(isset($project->$attachment_admin))
                                                                                <div>
                                                                                    <strong class="font-size-13">
                                                                                        {{ __('admin/accepted_project/show.file_name') }}: {{ $project->$attachment_admin->file_name }}
                                                                                    </strong>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <strong>
                                                                                        <a target="_blank" class="badge badge-danger p-2 font-size-12 mt-1" href="{{ $project->$attachment_admin->file_url }}">
                                                                                            {{ __('admin/accepted_project/show.download') }}
                                                                                        </a>
                                                                                    </strong>
                                                                                </div>
                                                                            @else
                                                                                <small class="text-danger">{{ __('admin/accepted_project/show.no_attachment_found') }}</small>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if($user->hasRole('client'))
                    @if(count($companies))
                        <div class="checkout-tabs mt-5">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card border border-primary">
                                        <div class="card-body">
                                            @foreach($companies as $index => $company)
                                                <h4 class="card-title text-center">
                                                    <a href="{{ route('backend.ums.company.show', [$company->id]) }}">
                                                        {{ $company->basicInfo->first_name }}
                                                    </a>
                                                </h4>
                                                <hr>
                                                <div class="faq-box media">
                                                    <div class="card-body bg-transparent text-primary">
                                                        <div>
                                                            @php
                                                                $attachment_admin = 'attachment_admin_' . ($project->selected_index + 1);
                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="card border mb-0">
                                                                        <div class="card-header">
                                                                            <h6 class="my-0 text-black-50 text-center">
                                                                                {{ __('admin/accepted_project/show.project_attachment') }}
                                                                            </h6>
                                                                        </div>
                                                                        <div class="card-body bg-transparent text-info text-center">
                                                                            @if(isset($project->$attachment_admin))
                                                                                <div>
                                                                                    <strong class="font-size-13">
                                                                                        {{ __('admin/accepted_project/show.file_name') }}: {{ $project->$attachment_admin->file_name }}
                                                                                    </strong>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <strong>
                                                                                        <a target="_blank" class="badge badge-danger p-2 font-size-12 mt-1" href="{{ $project->$attachment_admin->file_url }}">
                                                                                            {{ __('admin/accepted_project/show.download') }}
                                                                                        </a>
                                                                                    </strong>
                                                                                </div>
                                                                            @else
                                                                                <small class="text-danger">{{ __('admin/accepted_project/show.no_attachment_found') }}</small>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            $contact = DB::table('user_basic_infos')->where('user_id', $company->basicinfo->user_id)->get();
                                                            ?>
                                                            <project-message :contact="{{ collect($contact) }}"></project-message>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@stop
@section('style')
    <link href="{{ asset('common/plugins/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('common/plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css">
    <style>
        .col-md-6 {
            padding-right: 6px;
            padding-left: 6px;
        }
        .popup-gallery a:last-child {
            float: none !important;
        }
    </style>
@stop

@section('script')
    <script src="{{ asset('common/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('common/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/lightbox.init.js') }}"></script>

    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@stop