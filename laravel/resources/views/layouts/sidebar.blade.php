<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{{Auth::user()->name}} Dashboard</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('pk.png')}}">
    <link rel="icon" href="{{asset('pk.png')}}" type="image/x-icon">

    <!-- vector map CSS -->
    <link href="{{asset('vendors4/vectormap/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" type="text/css" />

    <!-- Toggles CSS -->
    <link href="{{asset('vendors4/jquery-toggles/css/toggles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendors4/jquery-toggles/css/themes/toggles-light.css')}}" rel="stylesheet" type="text/css">

    <!-- Toastr CSS -->
    <link href="{{asset('vendors4/jquery-toast-plugin/dist/jquery.toast.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="{{asset('dist/css/style.css')}}" rel="stylesheet" type="text/css">

    <!-- Data Table CSS -->
    <link href="{{asset('vendors4/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendors4/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body>
<!-- Preloader -->
<div class="preloader-it">
    <div class="loader-pendulums"></div>
</div>
<!-- /Preloader -->

<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
        <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
        <a class="navbar-brand" href="{{route('dashboard')}}">
            <img class="brand-img d-inline-block" src="{{asset('pk.png')}}" alt="brand" />
        </a>
        <ul class="navbar-nav hk-navbar-content">
            <li class="nav-item">
                <a id="navbar_search_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="search"></i></span></a>
            </li>
            <li class="nav-item">
                <a id="settings_toggle_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="settings"></i></span></a>
            </li>
            <li class="nav-item dropdown dropdown-authentication">
                <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <div class="media-img-wrap">
                            <div class="avatar">
                                <img src="{{asset('dist/img/avatar12.jpg')}}" alt="user" class="avatar-img rounded-circle">
                            </div>
                            <span class="badge badge-success badge-indicator"></span>
                        </div>
                        <div class="media-body">
                            <span>{{ Auth::user()->name }}<i class="zmdi zmdi-chevron-down"></i></span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <a class="dropdown-item" href="profile.html"><i class="dropdown-icon zmdi zmdi-account"></i><span>Profile</span></a>
                    <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-card"></i><span>My balance</span></a>
                    <a class="dropdown-item" href="inbox.html"><i class="dropdown-icon zmdi zmdi-email"></i><span>Inbox</span></a>
                    <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-settings"></i><span>Settings</span></a>
                    <div class="dropdown-divider"></div>
                    <div class="sub-dropdown-menu show-on-hover">
                        <a href="#" class="dropdown-toggle dropdown-item no-caret"><i class="zmdi zmdi-check text-success"></i>Online</a>
                        <div class="dropdown-menu open-left-side">
                            <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-check text-success"></i><span>Online</span></a>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-circle-o text-warning"></i><span>Busy</span></a>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-minus-circle-outline text-danger"></i><span>Offline</span></a>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('signout')}}"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                </div>
            </li>
        </ul>
    </nav>
    <form role="search" class="navbar-search">
        <div class="position-relative">
            <a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i data-feather="search"></i></span></a>
            <input type="text" name="example-input1-group2" class="form-control" placeholder="Type here to Search">
            <a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i data-feather="x"></i></span></a>
        </div>
    </form>
    <!-- /Top Navbar -->

    <!-- Vertical Nav -->
    <nav class="hk-nav hk-nav-light">
        <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
        <div class="nicescroll-bar">
            <div class="navbar-nav-wrap">
                <ul class="navbar-nav flex-column">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('dashboard')}}" data-target="#dash_drp">
                            <span class="feather-icon"><i data-feather="activity"></i></span>
                            <span class="nav-link-text">Dashboard</span>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('profile.show')}}"  data-target="#auth_drp">
                            <i class="fa fa-user"></i>
                            <span class="nav-link-text">My Account</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-with-badge" href="{{route('fund')}}"  data-target="#app_drp">
                            <i class="fa fa-money"></i>
                            <span class="nav-link-text">Fund Wallet</span>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('airtime')}}"  data-target="#auth_drp">
                           <i class="fa fa-phone"></i>
                            <span class="nav-link-text">Buy Airtime</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('select')}}"  data-target="#auth_drp">
                            <i class="fa fa-mobile"></i>
                            <span class="nav-link-text">Buy Data</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
    <!-- /Vertical Nav -->






















    <!-- jQuery -->
    <script src="{{asset('vendors4/jquery/dist/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('vendors4/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('vendors4/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    <!-- Slimscroll JavaScript -->
    <script src="{{asset('dist/js/jquery.slimscroll.js')}}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="{{asset('dist/js/feather.min.js')}}"></script>

    <!-- Toggles JavaScript -->
    <script src="{{asset('vendors4/jquery-toggles/toggles.min.js')}}"></script>
    <script src="{{asset('dist/js/toggle-data.js')}}"></script>

    <!-- Counter Animation JavaScript -->
    <script src="{{asset('vendors4/waypoints/lib/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('vendors4/jquery.counterup/jquery.counterup.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{asset('vendors4/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('vendors4/morris.js/morris.min.js')}}"></script>

    <!-- EChartJS JavaScript -->
    <script src="{{asset('vendors4/echarts/dist/echarts-en.min.js')}}"></script>

    <!-- Sparkline JavaScript -->
    <script src="{{asset('vendors4/jquery.sparkline/dist/jquery.sparkline.min.js')}}"></script>

    <!-- Vector Maps JavaScript -->
    <script src="{{asset('vendors4/vectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
    <script src="{{asset('vendors4/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('dist/js/vectormap-data.js')}}"></script>

    <!-- Owl JavaScript -->
    <script src="{{asset('vendors4/owl.carousel/dist/owl.carousel.min.js')}}"></script>

    <!-- Toastr JS -->
    <script src="{{asset('vendors4/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>

    <!-- Init JavaScript -->
    <script src="{{asset('dist/js/init.js')}}"></script>
    <script src="{{asset('dist/js/dashboard-data.js')}}"></script>
    <!-- Data Table JavaScript -->
    <script src="{{asset('vendors4/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors4/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('vendors4/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors4/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('vendors4/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('vendors4/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('vendors4/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('vendors4/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('vendors4/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('vendors4/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('vendors4/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('vendors4/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('dist/js/dataTables-data.js')}}"></script>
    @stack('modals')

    @livewireScripts
</body>


<!-- Mirrored from hencework.com/theme/mintos/dashboard1.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Mar 2022 16:14:28 GMT -->
</html>
