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
                                                    <form action="#" class="dropzone p-0">
                                                        <div class="fallback">
                                                            <input name="files" type="file" multiple="multiple">
                                                        </div>
                                                        <div class="dz-message needsclick">
                                                            <div class="mb-3">
                                                                <i class="display-4 text-muted mdi mdi-upload-network-outline"></i>
                                                            </div>
                                                            <h6>Drop files here or click to upload.</h6>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="text-center mt-4">
                                                    <button type="button" class="btn btn-primary waves-effect waves-light">Upload Files</button>
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
@stop

@section('script')
    <script src="{{ asset('common/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('common/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/lightbox.init.js') }}"></script>
@stop