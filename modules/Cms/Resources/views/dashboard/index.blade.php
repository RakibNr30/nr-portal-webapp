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
                    <h4 class="page-title mb-0 font-size-18">{{ config('core.role.'.$user->getRoleNames()[0]) }} Dashboard</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">Welcome to {{ $global_site->title ?? 'Web Portal' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    

        <div>
            <div class="row">
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="avatar-sm font-size-20 mr-3">
                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                            <i class="mdi mdi-tag-plus-outline"></i>
                                        </span>
                                </div>
                                <div class="media-body">
                                    <div class="font-size-16 mt-2">New Orders</div>
                                </div>
                            </div>
                            <h4 class="mt-4">1,368</h4>
                            <div class="row">
                                <div class="col-7">
                                    <p class="mb-0"><span class="text-success mr-2"> 0.28% <i class="mdi mdi-arrow-up"></i> </span></p>
                                </div>
                                <div class="col-5 align-self-center">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="avatar-sm font-size-20 mr-3">
                                    <span class="avatar-title bg-soft-primary text-primary rounded">
                                            <i class="mdi mdi-account-multiple-outline"></i>
                                        </span>
                                </div>
                                <div class="media-body">
                                    <div class="font-size-16 mt-2">New Users</div>

                                </div>
                            </div>
                            <h4 class="mt-4">2,456</h4>
                            <div class="row">
                                <div class="col-7">
                                    <p class="mb-0"><span class="text-success mr-2"> 0.16% <i class="mdi mdi-arrow-up"></i> </span></p>
                                </div>
                                <div class="col-5 align-self-center">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
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
@stop

@section('script')
@stop