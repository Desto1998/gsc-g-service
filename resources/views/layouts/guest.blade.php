<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('app.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('template/images/favicon.png')}}">
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">

</head>
    <body class="h-100 auth-page">
     <!--*******************
        Preloader start
    ********************-->
    {{-- <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div> --}}
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
    
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div id="app">
                <main class="">
                    <div class="container">
                        @yield('content')
                    </div>
                    {{-- @yield('content') --}}
                </main>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('template/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('template/js/quixnav-init.js')}}"></script>
    <script src="{{asset('template/js/custom.min.js')}}"></script>
    <!--removeIf(production)-->
    <!-- Demo scripts -->
    <script src="{{asset('template/js/styleSwitcher.js')}}"></script>


</body>
</html>
