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
                            <li class="breadcrumb-item"><a href="{{ route('backend.cms.project-approved.index') }}">
                                    {{ config('core.project_paginate.approved.' . $user->getRoleNames()[0]) }}
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

                @php
                    $led = 'led-red';
                    $counter = count($project->getMedia('project_attachment_company_1')) + count($project->getMedia('project_attachment_company_2')) + count($project->getMedia('project_attachment_company_3'));
                    if ($counter == 0) $led = 'led-red';
                    if ($counter == 1 || $counter == 2) $led = 'led-yellow';
                    if ($counter == 3) $led = 'led-green';
                @endphp

                <div class="card border border-primary">
                    <div class="card-header bg-transparent border-primary">
                        <h5 class="my-0 text-primary">
                            Project Id #{{ $project->project_id ?? 'N/A' }}
                        </h5>
                        @if($user->hasRole('admin') || $user->hasRole('super_admin'))
                            <div class="{{ $led }}"></div>
                        @endif
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

                        @if($user->hasRole('company'))
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
                                                            {{--@if ($errors->any())
                                                                <div class="alert alert-danger">
                                                                    <ul>
                                                                        @foreach ($errors->all() as $error)
                                                                            <li>{{ $error }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif--}}
                                                            @php
                                                                $attachment_admin = 'attachment_admin_' . ($index + 1);
                                                                $attachment_company = 'attachment_company_' . ($index + 1);
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

                                                            {!! Form::open(['url' => route('backend.cms.project-approved.filesUpdate', [$project->id]), 'class' => '', 'method' => 'put', 'files' => true]) !!}
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="attachment_company_{{ $index + 1 }}" class="@error('attachment_company_{{ $index + 1 }}') text-danger @enderror">Attachment</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input form-control @error('attachment_company_{{ $index + 1 }}') is-invalid @enderror"
                                                                               id="attachment_company_{{ $index + 1 }}"
                                                                               name="attachment_company_{{ $index + 1 }}"
                                                                               value="{{ old("attachment_company_{ $index + 1 }") }}" autofocus required>
                                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                                    </div>

                                                                    @error('attachment_company_{{ $index + 1 }}')
                                                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="text-center mt-4 mb-4">
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Upload Attachment</button>
                                                            </div>
                                                            {!! Form::close() !!}
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
                                                            $attachment_admin = 'attachment_admin_' . ($index + 1);
                                                            $attachment_company = 'attachment_company_' . ($index + 1);
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

                                                        {!! Form::open(['url' => route('backend.cms.project-approved.filesUpdate', [$project->id]), 'class' => '', 'method' => 'put', 'files' => true]) !!}
                                                        <div class="col-md-12">
                                                            <input type="hidden" name="file_company_id" value="{{ $project->company_id[$index] }}">
                                                            <div class="form-group">
                                                                <label for="attachment_admin_{{ $index + 1 }}" class="@error('attachment_admin_{{ $index + 1 }}') text-danger @enderror">Attachment</label>
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input form-control @error('attachment_admin_{{ $index + 1 }}') is-invalid @enderror"
                                                                           id="attachment_admin_{{ $index + 1 }}"
                                                                           name="attachment_admin_{{ $index + 1 }}"
                                                                           value="{{ old("attachment_admin_{ $index + 1 }") }}" autofocus required>
                                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                                </div>
                                                                @error('attachment_admin_{{ $index + 1 }}')
                                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="text-center mt-4 mb-4">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Upload Attachment</button>
                                                        </div>
                                                        {!! Form::close() !!}
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
                                                            $attachment_admin = 'attachment_admin_' . ($index + 1);
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

                                                        {!! Form::open(['url' => route('backend.cms.project-approved.approveByClient', [$project->id]), 'class' => '', 'method' => 'put']) !!}
                                                        <input type="hidden" name="selected_company_id[]" value="{{ $company->id }}">
                                                        <input type="hidden" name="selected_index" value="{{ $index }}">
                                                        <div class="text-center mt-4 mb-4">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Approve Company</button>
                                                        </div>
                                                        {!! Form::close() !!}
                                                        <?php
                                                            $contact = DB::table('user_basic_infos')->where('user_id', $company->basicinfo->user_id)->get();
                                                        ?>
                                                        <project-message :contact="{{ collect($contact) }}"></project-message>
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
                        
                        <div class="col-12">
                            <a href="{{ route('backend.cms.project-approved.index') }}" type="button"
                               class="btn btn-danger waves-effect waves-light float-right">Cancel</a>
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