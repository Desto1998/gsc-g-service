<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GSC-CS-APP') }}</title>
    @yield('css_before')
    <!-- Scripts -->
    <script src="{{ asset('app.js') }}" defer></script>
    <link href="{{asset('template/vendor/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('app.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/logo/logo_gssc.png')}}">

    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>


</head>
<body>

     <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->

    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="/" class="brand-logo">
                <div class=image style="margin-0px,padding-0px">
                <img class="logo-abbr" style="width: 50px;height: 50px" src="/images/logo_gssc.png" alt="hello">
                </div>

            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>

                                    </ul>
                                    <a class="all-notification" href="#">talle <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{ route('user.profile') }}" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profil </span>
                                    </a>

                                    <form action="{{ route('logout') }}" method="post" id="logout-form">
                                        @csrf
                                        <a type="submit" class="dropdown-item" data-toggle="modal"
                                           data-target="#logoutModal">
                                            <i class="icon-key"></i>
                                            <span class="ml-2">Se déconnecter </span>
                                        </a>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">

                    <a href="/"><i class="icon icon-home"></i><span class="nav-text"> <strong>Tableau de bord</strong></span></a>
                    <!-- <li><a href="index.html"><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li> -->
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-database"></i><span class="nav-text">Incidents</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('incident.all') }}">Gestion des incidents</a></li>
                            <li><a href="{{ route('incident.add') }}">ajouter un incident</a></li>

                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-single-04"></i><span class="nav-text">Clients</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route("client.all") }}">Gestion des Clients</a></li>
                    <li><a href="{{ route("client.add") }}">ajouter un Client</a></li>

                </ul>
                    </li>


                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="fa fa-cart-plus"></i><span class="nav-text">Charges</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route("gestion.tache") }}">Gestion des charges</a></li>
                            {{-- <li><a href="./chart-morris.html">Creer une charge</a></li> --}}
                        </ul>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="fa fa-file"></i><span class="nav-text">Rapports</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route("rapport.charge") }}">Rapport des charges</a></li>
                    <li><a href="./chart-morris.html">Rapports d'incident</a></li>
                </ul>
            </li>

                    </li>
                    @if (Auth::user()->is_admin==1)
                    <li class="nav-label">GESTION DES UTILISATEURS</li>
                    <li><a class="has-arrow" href="javascript:void(0);" aria-expanded="false"><i
                                class="icon icon-users-mm"></i><span class="nav-text">Comptes</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('user.all') }}">Utilisateurs</a></li>

                            <li><a href="{{ route('user.add') }}">Ajouter</a></li>
                        </ul>
                    </li>
                @endif

                        </ul>
                    </li>
                </ul>
            </div>


        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div id="app">
                <main class="py-4">
                    @yield('content')

                </main>
            </div>
        </div>
        @include('_partial._modals')
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
       @include('_partial.footer')
        <!--**********************************
            Footer end
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
     <script src="{{asset('template/vendor/plugins/toastr/js/toastr.min.js')}}"></script>
     <script src="{{asset('template/vendor/plugins/toastr/js/toastr.init.js')}}"></script>
    @include('_partial._toastr-message')
    @yield('script')
</body>
</html>
