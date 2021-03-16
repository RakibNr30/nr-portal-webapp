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
                            <li class="breadcrumb-item"><a href="{{ route('backend.cms.project-approved.index') }}">Approved</a></li>
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
                        <div class="popup-gallery mt-2">
                            @if($project->image)
                                <a class="float-left-" href="{{ $project->image->file_url }}" title="{{ $project->image->file_name }}">
                                    <div class="img-fluid">
                                        <img src="{{ $project->image->file_url  }}" alt="" width="120">
                                    </div>
                                </a>
                            @endif
                        </div>
                        <div class="mt-3">
                            @if(isset($project->attachment))
                                <a class="btn btn-primary waves-effect waves-light" target="_blank" href="{{ $project->attachment->file_url }}">
                                    Download Attachment
                                </a>
                            @endif
                        </div>

                        @if(count($companies))
                            <div class="row">
                                @foreach($companies as $company)
                                    <div class="col-lg-4">
                                        <div class="card bg-primary text-white-50">
                                            <div class="card-body">
                                                <h5 class="mt-0 mb-4 text-white">
                                                    {{ $company->basicInfo->first_name }}
                                                </h5>
                                                @if(isset($company->basicInfo->about))
                                                    <p class="card-text">
                                                        {!! $company->basicInfo->about !!}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <a href="{{ route('backend.cms.project-approved.index') }}" type="button"
                           class="btn btn-danger waves-effect waves-light float-right">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('style')
    <link href="{{ asset('common/plugins/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css">
@stop

@section('script')
    <script src="{{ asset('common/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/lightbox.init.js') }}"></script>
@stop