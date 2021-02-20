<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    {!! SEO::generate(true) !!}

    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.ico') }}">
    <link href="{{ asset('common/plugins/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet" type="text/css" />

    @yield('style')

</head>

<body data-layout="detached" data-topbar="colored">
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

    <script src="{{ asset('common/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('common/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('common/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('common/plugins/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('common/plugins/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('common/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('common/plugins/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('common/plugins/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js') }}"></script>
    <script src="{{ asset('admin/js/pages/dashboard.init.js') }}"></script>

    @yield('script')

    <script src="{{ asset('admin/js/app.js') }}"></script>

</body>
</html>