<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>{{ $status_code }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <link rel="shortcut icon" href="{{ $global_site->favicon->file_url ?? config('core.image.default.favicon') }}">
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>
<body>
<div class="account-pages" style="margin-top: 5vh">
    <div class="container">
        <div class="row justify-content-center" style="height: 90vh">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="text-center p-3">
                            <div class="img">
                                <img src="{{ asset('admin/images/error-img.png') }}" class="img-fluid" alt="">
                            </div>
                            <h1 class="error-page mt-5"><span>{{ $status_code }}!</span></h1>
                            <h4 class="mb-4 mt-5">{{ $status }}</h4>
                            <p class="mb-4 mx-auto">{{ $message }}</p>
                            <a class="btn btn-primary mb-4 waves-effect waves-light" href="{{ url('/backend/dashboard') }}">
                                <i class="mdi mdi-home"></i> Back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('common/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('common/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('common/plugins/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('common/plugins/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('common/plugins/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('admin/js/app.js') }}"></script>

</body>
</html>