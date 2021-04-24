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
                    <h4 class="page-title mb-0 font-size-18">Project</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Project</a></li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('backend.cms.project-accepted.index') }}">
                                    {{ config('core.project_paginate.accepted.' . $user->getRoleNames()[0]) }}
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
                <div class="card border border-primary">
                    <div class="card-header bg-transparent border-primary">
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

                        {{--@if($user->hasRole('company'))
                            @if(count($companies))
                                <div class="row mt-4">
                                    @foreach($companies as $index => $company)
                                        @if($company->id == auth()->user()->id)
                                            <div class="col-md-12">
                                                <div class="card border border-primary">
                                                    <div class="card-header bg-primary border-primary">
                                                        <h5 class="my-0 text-white text-center">
                                                        <span style="cursor: pointer" data-toggle="modal" data-target="#exampleModalScrollable{{ $index }}">
                                                            {{ $company->basicInfo->first_name }}
                                                        </span>
                                                        </h5>
                                                    </div>
                                                    <div class="card-body bg-transparent text-primary">
                                                        <div>
                                                            @php
                                                                $attachment_admin = 'attachment_admin_' . ($project->selected_index + 1);
                                                                $attachment_company = 'attachment_company_' . ($project->selected_index + 1);
                                                            @endphp

                                                            <div class="row">
                                                                <div class="col-md-6 mb-4">
                                                                    <div class="card border border-secondary">
                                                                        <div class="card-header bg-secondary border-secondary">
                                                                            <h6 class="my-0 text-white text-center">
                                                                                Your Attachment
                                                                            </h6>
                                                                        </div>
                                                                        <div class="card-body bg-transparent text-secondary text-center">
                                                                            @if(isset($project->$attachment_company))
                                                                                <div>
                                                                                    <strong>
                                                                                        Attachment Name: {{ $project->$attachment_company->file_name }}
                                                                                    </strong>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <strong>
                                                                                        <a target="_blank" class="btn btn-secondary" href="{{ $project->$attachment_company->file_url }}">
                                                                                            Download Attachment
                                                                                        </a>
                                                                                    </strong>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-4">
                                                                    <div class="card border border-info">
                                                                        <div class="card-header bg-info border-info">
                                                                            <h6 class="my-0 text-white text-center">
                                                                                Attachment From Admin
                                                                            </h6>
                                                                        </div>
                                                                        <div class="card-body bg-transparent text-info text-center">
                                                                            @if(isset($project->$attachment_admin))
                                                                                <div>
                                                                                    <strong>
                                                                                        Attachment Name: {{ $project->$attachment_admin->file_name }}
                                                                                    </strong>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <strong>
                                                                                        <a target="_blank" class="btn btn-info" href="{{ $project->$attachment_admin->file_url }}">
                                                                                            Download Attachment
                                                                                        </a>
                                                                                    </strong>
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
                                            <div class="modal fade" id="exampleModalScrollable{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mt-0" id="exampleModalScrollableTitle">{{ $company->basicInfo->first_name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ $company->basicInfo->about }}
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        @endif

                        @if($user->hasRole('admin') || $user->hasRole('super_admin'))
                            @if(count($companies))
                                <div class="row mt-4">
                                    @foreach($companies as $index => $company)
                                        <div class="col-md-12">
                                            <div class="card border border-primary">
                                                <div class="card-header bg-primary border-primary">
                                                    <h5 class="my-0 text-white text-center">
                                                    <span style="cursor: pointer" data-toggle="modal" data-target="#exampleModalScrollable{{ $index }}">
                                                        {{ $company->basicInfo->first_name }}
                                                    </span>
                                                    </h5>
                                                </div>
                                                <div class="card-body bg-transparent text-primary">
                                                    <div>
                                                        @php
                                                            $attachment_admin = 'attachment_admin_' . ($project->selected_index + 1);
                                                            $attachment_company = 'attachment_company_' . ($project->selected_index + 1);
                                                        @endphp

                                                        <div class="row">
                                                            <div class="col-md-6 mb-4">
                                                                <div class="card border border-secondary">
                                                                    <div class="card-header bg-secondary border-secondary">
                                                                        <h6 class="my-0 text-white text-center">
                                                                            Attachment From Company
                                                                        </h6>
                                                                    </div>
                                                                    <div class="card-body bg-transparent text-secondary text-center">
                                                                        @if(isset($project->$attachment_company))
                                                                            <div>
                                                                                <strong>
                                                                                    Attachment Name: {{ $project->$attachment_company->file_name }}
                                                                                </strong>
                                                                            </div>
                                                                            <div class="mt-1">
                                                                                <strong>
                                                                                    <a target="_blank" class="btn btn-secondary" href="{{ $project->$attachment_company->file_url }}">
                                                                                        Download Attachment
                                                                                    </a>
                                                                                </strong>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 mb-4">
                                                                <div class="card border border-info">
                                                                    <div class="card-header bg-info border-info">
                                                                        <h6 class="my-0 text-white text-center">
                                                                            Your Attachment
                                                                        </h6>
                                                                    </div>
                                                                    <div class="card-body bg-transparent text-info text-center">
                                                                        @if(isset($project->$attachment_admin))
                                                                            <div>
                                                                                <strong>
                                                                                    Attachment Name: {{ $project->$attachment_admin->file_name }}
                                                                                </strong>
                                                                            </div>
                                                                            <div class="mt-1">
                                                                                <strong>
                                                                                    <a target="_blank" class="btn btn-info" href="{{ $project->$attachment_admin->file_url }}">
                                                                                        Download Attachment
                                                                                    </a>
                                                                                </strong>
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
                                        <div class="modal fade" id="exampleModalScrollable{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="exampleModalScrollableTitle">{{ $company->basicInfo->first_name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $company->basicInfo->about }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endif

                        @if($user->hasRole('client'))
                            @if(count($companies))
                                <div class="row mt-4">
                                    @foreach($companies as $index => $company)
                                        <div class="col-md-12">
                                            <div class="card border border-primary">
                                                <div class="card-header bg-primary border-primary">
                                                    <h5 class="my-0 text-white text-center">
                                                    <span style="cursor: pointer" data-toggle="modal" data-target="#exampleModalScrollable{{ $index }}">
                                                        {{ $company->basicInfo->first_name }}
                                                    </span>
                                                    </h5>
                                                </div>
                                                <div class="card-body bg-transparent text-primary">
                                                    <div>
                                                        @php
                                                            $attachment_admin = 'attachment_admin_' . ($project->selected_index + 1);
                                                        @endphp

                                                        <div class="row">
                                                            <div class="col-12 mb-4">
                                                                <div class="card border border-info">
                                                                    <div class="card-header bg-info border-info">
                                                                        <h6 class="my-0 text-white text-center">
                                                                            Attachment From Admin
                                                                        </h6>
                                                                    </div>
                                                                    <div class="card-body bg-transparent text-info text-center">
                                                                        @if(isset($project->$attachment_admin))
                                                                            <div>
                                                                                <strong>
                                                                                    Attachment Name: {{ $project->$attachment_admin->file_name }}
                                                                                </strong>
                                                                            </div>
                                                                            <div class="mt-1">
                                                                                <strong>
                                                                                    <a target="_blank" class="btn btn-info" href="{{ $project->$attachment_admin->file_url }}">
                                                                                        Download Attachment
                                                                                    </a>
                                                                                </strong>
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
                                        <div class="modal fade" id="exampleModalScrollable{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="exampleModalScrollableTitle">{{ $company->basicInfo->first_name }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $company->basicInfo->about }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endif--}}
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
                                                {{--@if($company->id == $user->id)
                                                    <h4 class="card-title text-center">
                                                        --}}{{--<a href="{{ route('backend.ums.company.show', [$company->id]) }}">--}}{{--
                                                            {{ $company->basicInfo->first_name }}
                                                        --}}{{--</a>--}}{{--
                                                    </h4>
                                                @endif
                                                <hr>--}}
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
                                                                                        Your Attachment
                                                                                    </h6>
                                                                                </div>
                                                                                <div class="card-body bg-transparent text-center">
                                                                                    @if(isset($project->$attachment_company))
                                                                                        <div>
                                                                                            <strong class="font-size-13">
                                                                                                File Name: {{ $project->$attachment_company->file_name }}
                                                                                            </strong>
                                                                                        </div>
                                                                                        <div class="mt-1">
                                                                                            <strong>
                                                                                                <a target="_blank" class="badge badge-danger p-2 font-size-12 mt-1" href="{{ $project->$attachment_company->file_url }}">
                                                                                                    Download
                                                                                                </a>
                                                                                            </strong>
                                                                                        </div>
                                                                                    @else
                                                                                        <small class="text-danger">No Attachment Found</small>
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
                                                                                Attachment from Company
                                                                            </h6>
                                                                        </div>
                                                                        <div class="card-body bg-transparent text-primary text-center">
                                                                            @if(isset($project->$attachment_company))
                                                                                <div>
                                                                                    <strong class="font-size-13">
                                                                                        File Name: {{ $project->$attachment_company->file_name }}
                                                                                    </strong>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <strong>
                                                                                        <a target="_blank" class="badge badge-danger p-2 font-size-12 mt-1" href="{{ $project->$attachment_company->file_url }}">
                                                                                            Download
                                                                                        </a>
                                                                                    </strong>
                                                                                </div>
                                                                            @else
                                                                                <small class="text-danger">No Attachment Found</small>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="card border mb-0">
                                                                        <div class="card-header">
                                                                            <h6 class="my-0 text-black-50 text-center">
                                                                                Attachment from Admin
                                                                            </h6>
                                                                        </div>
                                                                        <div class="card-body bg-transparent text-primary text-center">
                                                                            @if(isset($project->$attachment_admin))
                                                                                <div>
                                                                                    <strong class="font-size-13">
                                                                                        File Name: {{ $project->$attachment_admin->file_name }}
                                                                                    </strong>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <strong>
                                                                                        <a target="_blank" class="badge badge-danger p-2 font-size-12 mt-1" href="{{ $project->$attachment_admin->file_url }}">
                                                                                            Download
                                                                                        </a>
                                                                                    </strong>
                                                                                </div>
                                                                            @else
                                                                                <small class="text-danger">No Attachment Found</small>
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
                                                                                Project Attachment
                                                                            </h6>
                                                                        </div>
                                                                        <div class="card-body bg-transparent text-info text-center">
                                                                            @if(isset($project->$attachment_admin))
                                                                                <div>
                                                                                    <strong class="font-size-13">
                                                                                        File Name: {{ $project->$attachment_admin->file_name }}
                                                                                    </strong>
                                                                                </div>
                                                                                <div class="mt-1">
                                                                                    <strong>
                                                                                        <a target="_blank" class="badge badge-danger p-2 font-size-12 mt-1" href="{{ $project->$attachment_admin->file_url }}">
                                                                                            Download
                                                                                        </a>
                                                                                    </strong>
                                                                                </div>
                                                                            @else
                                                                                <small class="text-danger">No Attachment Found</small>
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