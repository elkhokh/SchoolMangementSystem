
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
    @include('layouts.head')
    @livewireStyles
    <style>
        .app-content {
            padding-top: 80px;
        }
        .header-navbar {
            background-color: #1c2526 !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header-navbar .navbar-brand .brand-text {
            font-family: 'Cairo', sans-serif;
            color: white;
            margin-right: 10px;
        }
        .header-navbar .nav-link {
            color: white !important;
            font-family: 'Cairo', sans-serif;
        }
        .header-navbar .nav-link:hover {
            color: #3498db !important;
        }
        .page-header {
            background-color: #1c2526;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            margin-top: 20px;
            font-family: 'Cairo', sans-serif;
        }
        @media (max-width: 767px) {
            .app-content {
                padding-top: 60px;
            }
            .page-header {
                margin-top: 15px;
            }
        }
    </style>
</head>
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar"
    data-open="click" data-menu="vertical-menu" data-col="2-columns">
    @include('layouts.navigation')

    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        @include('layouts.main-sidebar')
    </div>

    <div class="app-content content">
        <div class="container-fluid">
            @yield('page-header')
            @yield('content')
        </div>
    </div>
    @include('layouts.footer')
    @include('layouts.footer-scripts')
    @livewireScripts
</body>
</html>



