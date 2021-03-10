@extends('admin.layouts.master')

@php
    $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
@endphp
@section('title')
    Dashboard
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
    </div>
    <div>

    </div>
@stop

@section('style')
@stop

@section('script')
@stop