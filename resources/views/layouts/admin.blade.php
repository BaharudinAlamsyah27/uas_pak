<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="dark" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Rental Mobil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link href="{{ asset('assets/libs/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="layout-wrapper">

        <div class="main-menu">
            <div class="logo-box">
                <a href="{{ route('admin.dashboard') }}" class="logo-light">
                    <img src="{{ asset('assets/images/logo-light.png') }}" alt="logo" class="logo-lg" height="22">
                    <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo" class="logo-sm" height="22">
                </a>
                <a href="{{ route('admin.dashboard') }}" class="logo-dark">
                    <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo" class="logo-lg" height="22">
                    <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo" class="logo-sm" height="22">
                </a>
            </div>

            <div data-simplebar>
                <ul class="app-menu">

                    <li class="menu-title">Menu Utama</li>

                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                            <i class="bx bx-home-circle"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="bx bx-car"></i>
                            <span>Data Kendaraan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('kendaraan.index') }}">Daftar Mobil</a></li>
                            <li><a href="{{ route('kendaraan.create') }}">Tambah Mobil</a></li>
                        </ul>
                    </li>
                    
                    <li class="menu-title">Transaksi</li>
                    
                    <li>
                        <a href="#" class="waves-effect">
                            <i class="bx bx-receipt"></i>
                            <span>Riwayat Sewa</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        <div class="page-content">

            <div class="navbar-custom">
                <div class="topbar">
                    <div class="topbar-menu d-flex align-items-center gap-lg-2 gap-1">
                        <div class="logo-box">
                            <a href="{{ route('admin.dashboard') }}" class="logo-light">
                                <img src="{{ asset('assets/images/logo-light.png') }}" alt="logo" class="logo-lg" height="22">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo" class="logo-sm" height="22">
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="logo-dark">
                                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="dark logo" class="logo-lg" height="22">
                                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="small logo" class="logo-sm" height="22">
                            </a>
                        </div>
                        <button class="button-toggle-menu">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </div>

                    <ul class="topbar-menu d-flex align-items-center gap-4">
                        <li class="dropdown d-none d-md-inline-block">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('assets/images/flags/us.jpg') }}" alt="user-image" class="me-0 me-sm-1" height="18">
                            </a>
                        </li>

                        <li class="dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="mdi mdi-bell font-size-24"></i>
                            </a>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('assets/images/users/avatar-4.jpg') }}" alt="user-image" class="rounded-circle">
                                <span class="ms-1 d-none d-md-inline-block">
                                    Admin <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="mdi mdi-logout font-size-16 me-2"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="px-3">
                <div class="container-fluid">
                    
                    <div class="py-3">
                        @yield('content')
                    </div>
                    
                </div> 
            </div> 

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div><script>document.write(new Date().getFullYear())</script> © Rental Mobil</div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>

    </div>

    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    
    <script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

</body>
</html>