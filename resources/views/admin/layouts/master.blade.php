<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
    @endphp

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="description" />

    <link rel="shortcut icon" href="{{ $global_site->favicon->file_url ?? config('core.image.default.favicon') }}">
    <link href="{{ asset('common/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('common/plugins/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('common/plugins/summernote/summernote-bs4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.css" />

    <style type="text/css">
        .not-message {
            color: #495057; 
            font-weight: 450; 
            font-size: 16px;
        }
        
        .not-message:hover {
            color: #3b5de7;
        }
    </style>

    @yield('style')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body data-layout="detached" data-topbar="colored">
    <div id="app">
        @if(Auth::check())
            @if (url()->current() != url('/inbox'))
                <div style="display: none !important;"><chat :user="{{ auth()->user() }}"></chat></div>
            @endif

            <audio id="noty_audio">                    
                <source src="{{ asset('audio/notify.mp3') }}">
                <source src="{{ asset('audio/notify.oog') }}">
                <source src="{{ asset('audio/notify.wav') }}">
            </audio> 
        @endif
        <init></init>

        <div class="container-fluid">
            <div id="layout-wrapper">
                @include('admin.partials._header')

                @include('admin.partials._menubar')

                <div class="main-content">

                    @yield('content')

                    @include('admin.partials._footer')

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('common/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('common/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('common/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('common/plugins/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('common/plugins/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('common/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('common/plugins/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('common/plugins/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>
    <script src="{{ asset('common/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('common/plugins/bs-custom-file/bs-custom-file.min.js') }}"></script>
    <script src="{{ asset('common/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/dashboard.init.js') }}"></script>

    @yield('script')

    <script src="{{ asset('admin/js/app.js') }}"></script>
    <script src="{{ asset('admin/js/custom.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                todayHighlight: false,
                format: 'yyyy-mm-dd',
                changeMonth: true,
                changeYear: true,
                autoclose: true
            });
        });
        

        $(document).ready(function () {
            $('.summernote').summernote({
                height: 200
            });
        });
        
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.js"></script>
    <script>        
        @if(Session::has('noty-success')) new Noty({ 
                type:'success', 
                layout:'bottomLeft', 
                text: '{{ Session::get('noty-success') }}', 
                timeout: 5000
            }).show(); 
        @endif

        @if(Session::has('noty-info')) new Noty({ 
                type:'info', 
                layout:'bottomLeft', 
                text: '{{ Session::get('noty-info') }}', 
                timeout: 5000
            }).show(); 
        @endif

        @if(Session::has('noty-error')) new Noty({ 
                type:'error', 
                layout:'bottomLeft', 
                text: '{{ Session::get('noty-error') }}', 
                timeout: 5000
            }).show(); 
        @endif

        @if(Session::has('noty-warning')) new Noty({ 
                type:'warning', 
                layout:'bottomLeft', 
                text: '{{ Session::get('noty-warning') }}', 
                timeout: 5000
            }).show(); 
        @endif
    </script>

    <script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>