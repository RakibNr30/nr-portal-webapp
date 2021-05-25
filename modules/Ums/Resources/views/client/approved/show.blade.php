@extends('admin.layouts.master')
@section('title')
    {{ __('admin/client/show.show') }} | {{ __('admin/client/show.client') }}
@stop
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('admin/client/show.client') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('backend.ums.client-approved.index') }}">{{ __('admin/client/show.client') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin/client/show.show') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.partials._alert')
                <div class="row">
                    <div class="col-md-12 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="profile-widgets py-3">

                                    <div class="text-center">
                                        <div class="">
                                            <img src="{{ $user->avatar->file_url ?? config('core.image.default.avatar') }}" alt="" class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                        </div>

                                        <div class="mt-3 ">
                                            <a href="javascript:void(0)" class="text-dark font-weight-medium font-size-16">
                                                {{ $user->basicInfo->first_name }} {{ $user->basicInfo->last_name }}
                                            </a>
                                            <p class="text-body mt-1 mb-1">
                                                {{ $user->basicInfo->designation }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">{{ __('admin/client/show.personal_information') }}</h5>

                                @if($user->basicInfo->about)
                                    <p class="card-title-desc text-justify">
                                        {{ $user->basicInfo->about }}
                                    </p>
                                @endif

                                @if($user->basicInfo->personal_email)
                                    <div class="mt-2">
                                        <p class="font-size-12 text-muted mb-1">{{ __('admin/client/show.email_address') }}</p>
                                        <h6 class="">
                                            <a href="mailto: {{ $user->basicInfo->personal_email }}" style="color: unset">
                                                {{ $user->basicInfo->personal_email }}
                                            </a>
                                        </h6>
                                    </div>
                                @endif

                                @if($user->basicInfo->phone_no)
                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">{{ __('admin/client/show.phone_number') }}</p>
                                        <h6 class="">
                                            <a href="tel: {{ $user->basicInfo->phone_no }}" style="color: unset">
                                                {{ $user->basicInfo->phone_no }}
                                            </a>
                                        </h6>
                                    </div>
                                @endif

                                @if($user->residentialInfo->present_address_line_1)
                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">{{ __('admin/client/show.address') }}</p>
                                        <h6 class="">
                                            {{ $user->residentialInfo->present_address_line_1 }}
                                        </h6>
                                    </div>
                                @endif
                                @if($user->residentialInfo->present_city)
                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">{{ __('admin/client/show.city_district') }}</p>
                                        <h6 class="">
                                            {{ $user->residentialInfo->present_city }}
                                        </h6>
                                    </div>
                                @endif
                                @if($user->residentialInfo->present_state)
                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">{{ __('admin/client/show.state_division') }}</p>
                                        <h6 class="">
                                            {{ $user->residentialInfo->present_state }}
                                        </h6>
                                    </div>
                                @endif
                                @if($user->residentialInfo->present_country)
                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">{{ __('admin/client/show.country') }}</p>
                                        <h6 class="">
                                            {{ $user->residentialInfo->present_country }}
                                        </h6>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-9">
                        <div class="row">
                            <div class="col-md-12 col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <p class="mb-2">{{ __('admin/client/show.accepted_projects') }}</p>
                                                <h4 class="mb-0">
                                                    {{ $totalProjects->where('status', 2)->count() }}
                                                </h4>
                                            </div>
                                            <div class="col-4">
                                                <div class="text-right">
                                                    <div class="progress progress-sm mt-3">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <p class="mb-2">{{ __('admin/client/show.in_progress_projects') }}</p>
                                                <h4 class="mb-0">
                                                    {{ $totalProjects->where('status', 1)->count() }}
                                                </h4>
                                            </div>
                                            <div class="col-4">
                                                <div class="text-right">
                                                    <div class="progress progress-sm mt-3">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-8">
                                                <p class="mb-2">{{ __('admin/client/show.pending_projects') }}</p>
                                                <h4 class="mb-0">
                                                    {{ $totalProjects->where('status', 0)->count() }}
                                                </h4>
                                            </div>
                                            <div class="col-4">
                                                <div class="text-right">
                                                    <div class="progress progress-sm mt-3">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">{{ __('admin/client/show.all_projects') }} ({{ $totalProjects->count() }})</h4>
                                @if(count($projects))
                                    <div class="table-responsive">
                                        <table class="table table-centered mb-0">
                                            <thead>
                                            <tr>
                                                <th scope="col">{{ __('admin/client/show.id') }}</th>
                                                <th scope="col">{{ __('admin/client/show.project') }}</th>
                                                <th scope="col">{{ __('admin/client/show.status') }}</th>
                                                <th scope="col">{{ __('admin/client/show.action') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($projects as $index => $project)
                                                <tr>
                                                    <td>
                                                        {{ ($projects->currentPage() - 1) * $projects->perPage() + $index + 1 }}
                                                        {{--{{ $totalProjects->count() - ($projects->currentPage() - 1) * $projects->perPage() - $index }}--}}
                                                    </td>
                                                    <td>
                                                        @if(strlen($project->title) > 40)
                                                            {{ substr($project->title, 0, 40) }}...
                                                        @else
                                                            {{ $project->title }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($project->status == 0)
                                                            <span class="badge badge-soft-warning font-size-12">
                                                                {{ __('admin/client/show.pending') }}
                                                            </span>
                                                        @endif
                                                        @if($project->status == 1)
                                                            <span class="badge badge-soft-info font-size-12">
                                                                {{ __('admin/client/show.in_progress') }}
                                                            </span>
                                                        @endif
                                                        @if($project->status == 2)
                                                            <span class="badge badge-soft-success font-size-12">
                                                                {{ __('admin/client/show.accepted') }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($project->status == 0)
                                                            <a href="{{ route('backend.cms.project-pending.show', [$project->id]) }}" class="btn btn-primary btn-sm">{{ __('admin/client/show.view') }}</a>
                                                        @endif
                                                        @if($project->status == 1)
                                                            <a href="{{ route('backend.cms.project-approved.show', [$project->id]) }}" class="btn btn-primary btn-sm">{{ __('admin/client/show.view') }}</a>
                                                        @endif
                                                        @if($project->status == 2)
                                                            <a href="{{ route('backend.cms.project-accepted.show', [$project->id]) }}" class="btn btn-primary btn-sm">{{ __('admin/client/show.view') }}</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3">
                                        <ul class="pagination pagination-rounded justify-content-center mb-0">
                                            {!! $projects->links() !!}
                                        </ul>
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-centered mb-0">
                                            <thead>
                                            <tr>
                                                <th class="text-center">{{ __('admin/client/show.no_project_found') }}</th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
