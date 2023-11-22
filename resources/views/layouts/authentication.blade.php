<!-- GIAO DIỆN CỦA TRANG ĐĂNG KÝ VÀ ĐĂNG NHẬP -->
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="salelqvt">
    <meta name="description"
        content="salelqvt">
    <meta name="robots" content="noindex,nofollow">
    <title>{{$title}}</title>
    <!-- Favicon icon -->
    <link rel="icon" style="max-height:50px" type="image/png" sizes="16x16" href="{{ asset('themes/admin/images/logolqvt1.png') }}">
    <!-- Custom CSS -->
    <link href="{{ asset('themes/admin/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{ asset('themes/admin/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('themes/admin/css/style.min.css')}}" rel="stylesheet">
    @yield('css')
</head>
<body>
    @yield('content')
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('themes/admin/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('themes/admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('themes/admin/js/app-style-switcher.js')}}"></script>
</body>
</html>