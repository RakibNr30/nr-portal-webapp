@extends('admin.layouts.master')
@php
    $user = \Modules\Ums\Entities\User::find(auth()->user()->id)
@endphp
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Project</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Project</a></li>
                            <li class="breadcrumb-item active">
                                {{ config('core.project_paginate.pending.' . $user->getRoleNames()[0]) }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @include('admin.partials._alert')
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Pending Project List</h4>
                        {!! $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap', 'style' => 'width: 100%;']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('style')
    <link href="{{ asset('common/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('common/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('common/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('script')
    <script src="{{ asset('common/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('common/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('common/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('common/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('common/plugins/datatables-ssr/buttons.server-side.js') }}"></script>
    <script src="{{ asset('common/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('common/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    {!! $dataTable->scripts() !!}

    <script src="{{ asset('admin/js/datatables.init.js') }}"></script>
@stop
