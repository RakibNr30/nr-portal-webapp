<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.ico') }}">

    <link href="{{ asset('admin/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
<div class="home-btn d-none d-sm-block">
    <a href="{{ '' }}" class="text-dark"><i class="fas fa-home h2"></i></a>
</div>
<div class="account-pages my-5 pt-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="text-center p-3">
                            <div class="img">
                                <img src="{{ asset('admin/images/error-img.png') }}" class="img-fluid" alt="">
                            </div>
                            <h1 class="error-page mt-5"><span>404!</span></h1>
                            <h4 class="mb-4 mt-5">Sorry, page not found</h4>
                            <p class="mb-4 w-75 mx-auto">It will be as simple as Occidental in fact, it will Occidental to an English person</p>
                            <a class="btn btn-primary mb-4 waves-effect waves-light" href="#"><i class="mdi mdi-home"></i> Back to Dashboard</a>
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