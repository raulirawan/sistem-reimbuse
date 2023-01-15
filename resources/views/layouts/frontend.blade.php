<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('frontend') }}/img/core-img/favicon.png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/style.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/pages/sweetalert2.css">

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- /Preloader -->

    <!-- Header Area Start -->
    @include('includes.frontend.header')
    <!-- Header Area End -->

    <!-- Welcome Area Start -->
    @yield('content')

    <!-- Footer Area Start -->
    @include('includes.frontend.footer')
    <!-- Footer Area End -->

    <!-- **** All JS Files ***** -->
    <!-- jQuery 2.2.4 -->
    @stack('up-script')
    <script src="{{ asset('frontend') }}/js/jquery.min.js"></script>
    <!-- Popper -->
    <script src="{{ asset('frontend') }}/js/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('frontend') }}/js/bootstrap.min.js"></script>
    <!-- All Plugins -->
    <script src="{{ asset('frontend') }}/js/roberto.bundle.js"></script>
    <!-- Active -->
    <script src="{{ asset('frontend') }}/js/default-assets/active.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    @include('sweetalert::alert')

    @stack('down-script')
</body>

</html>
