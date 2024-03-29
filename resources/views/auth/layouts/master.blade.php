<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />

    <link rel="shortcut icon" href="{{ $global_site->favicon->file_url ?? config('core.image.default.favicon') }}">
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <style>
        .bg-login-overlay {
            background: #8E8B71;
        }
        .btn-primary {
            background: #8E8B71;
            border-color: #8E8B71;
        }
    </style>

    @yield('style')

</head>

<body>
{{--<div class="home-btn d-none d-sm-block">
    <a href="{{ url('/backend/dashboard') }}" class="text-dark"><i class="fas fa-home h2"></i></a>
</div>--}}
<div class="account-page py-4" style="background: #252627">
    <div class="container">
        <div class="row justify-content-center">

            @yield('content')

        </div>
    </div>
</div>

<script src="{{ asset('common/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('common/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('common/plugins/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('common/plugins/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('common/plugins/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('admin/js/app.js') }}"></script>

@yield('script')

</body>
</html>