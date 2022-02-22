@extends('admin.layouts.master')

@php
    $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
@endphp
@section('title')
    {{ config('core.role.'.$user->getRoleNames()[0]) }} Dashboard
@stop

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{--{{ config('core.role.'.$user->getRoleNames()[0]) }} --}}{{ __('admin/dashboard/index.dashboard') }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">{{ __('admin/master.welcome_to') }} {{ $global_site->title ?? 'Web Portal' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="row">
                @if($user->hasRole('client'))
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar-sm font-size-20 mr-3">
                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                            <i class="mdi mdi-account-multiple-outline"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-size-16 mt-2">
                                            <a href="{{ route('backend.cms.project-pending.index') }}">{{ __('admin/dashboard/index.pending_projects') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-4">{{ $data->totalPendingProject }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar-sm font-size-20 mr-3">
                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                            <i class="mdi mdi-account-multiple-outline"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-size-16 mt-2">
                                            <a href="{{ route('backend.cms.project-approved.index') }}">{{ __('admin/dashboard/index.in_progress_projects') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-4">{{ $data->totalInProgressProject }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar-sm font-size-20 mr-3">
                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                            <i class="mdi mdi-account-multiple-outline"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-size-16 mt-2">
                                            <a href="{{ route('backend.cms.project-accepted.index') }}">{{ __('admin/dashboard/index.accepted_projects') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-4">{{ $data->totalAcceptedProject }}</h4>
                            </div>
                        </div>
                    </div>
                @endif
                @if($user->hasRole('company'))
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar-sm font-size-20 mr-3">
                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                        <i class="mdi mdi-account-multiple-outline"></i>
                                    </span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-size-16 mt-2">
                                            <a href="{{ route('backend.cms.project-approved.index') }}">{{ __('admin/dashboard/index.assigned_projects') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-4">{{ $data->totalAssignedProject }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar-sm font-size-20 mr-3">
                                <span class="avatar-title bg-soft-primary text-primary rounded">
                                        <i class="mdi mdi-account-multiple-outline"></i>
                                    </span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-size-16 mt-2">
                                            <a href="{{ route('backend.cms.project-accepted.index') }}">{{ __('admin/dashboard/index.in_progress_projects') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-4">{{ $data->totalInProgressProject }}</h4>
                            </div>
                        </div>
                    </div>
                @endif
                @if($user->hasRole('admin') || $user->hasRole('super_admin'))
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar-sm font-size-20 mr-3">
                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                            <i class="mdi mdi-account-multiple-outline"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-size-16 mt-2">
                                            <a href="{{ route('backend.ums.client-request.index') }}">{{ __('admin/dashboard/index.client_request') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-4">{{ $data->totalPendingClient }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar-sm font-size-20 mr-3">
                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                            <i class="mdi mdi-account-multiple-outline"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-size-16 mt-2">
                                            <a href="{{ route('backend.ums.client-approved.index') }}">{{ __('admin/dashboard/index.clients') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-4">{{ $data->totalApprovedClient }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar-sm font-size-20 mr-3">
                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                            <i class="mdi mdi-account-multiple-outline"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-size-16 mt-2">
                                            <a href="{{ route('backend.ums.company.index') }}">{{ __('admin/dashboard/index.companies') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-4">{{ $data->totalCompany }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar-sm font-size-20 mr-3">
                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                            <i class="mdi mdi-account-multiple-outline"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-size-16 mt-2">
                                            <a href="{{ route('backend.cms.project-pending.index') }}">{{ __('admin/dashboard/index.pending_projects') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-4">{{ $data->totalPendingProject }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar-sm font-size-20 mr-3">
                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                            <i class="mdi mdi-account-multiple-outline"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-size-16 mt-2">
                                            <a href="{{ route('backend.cms.project-approved.index') }}">{{ __('admin/dashboard/index.in_progress_projects') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-4">{{ $data->totalInProgressProject }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="avatar-sm font-size-20 mr-3">
                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                            <i class="mdi mdi-account-multiple-outline"></i>
                                        </span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-size-16 mt-2">
                                            <a href="{{ route('backend.cms.project-accepted.index') }}">{{ __('admin/dashboard/index.accepted_projects') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="mt-4">{{ $data->totalAcceptedProject }}</h4>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>


    </div>
@stop

@section('style')
    <style>
        .card .card-body h4 {
            text-align: center;
        }
    </style>
@stop

@section('script')
@stop
