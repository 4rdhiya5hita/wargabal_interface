<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-start">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="19">
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="19">
                        </span>
                    </a>
                </div>

                <div class="d-inline-block">
                    <div class="text-white">
                        <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">Kalender Bali</span>
                    </div>
                </div>
            </div>

            <div class="float-end">
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if (session('user')['email_verified_at'] ?? false || session('user') ?? false || session('user')['permission'] == "Admin")
                        <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{ session('user')['name'] }} [{{ session('user')['permission'] }}]</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block font-size-15"></i>
                        @else
                        <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">User</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block font-size-15"></i>
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        @if (session('user')['email_verified_at'] ?? false || session('user') ?? false || session('user')['permission'] == "Admin")
                        <a class="dropdown-item" href="{{ route('profile') }}"><i class="mdi mdi-account-circle font-size-17 text-muted align-middle me-1"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button class="dropdown-item text-danger" type="submit"><i class="mdi mdi-power font-size-17 text-muted align-middle me-1 text-danger"></i> Logout</button>
                        </form>
                        @else
                        <a class="dropdown-item" href="{{ route('login_page') }}"><i class="mdi mdi-account-circle font-size-17 text-muted align-middle me-1"></i> Login</a>
                        <a class="dropdown-item" href="{{ route('register_page') }}"><i class="mdi mdi-account-circle font-size-17 text-muted align-middle me-1"></i> Register</a>
                        @endif
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <!-- <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                            <i class="mdi mdi-spin mdi-cog"></i>
                        </button> -->
                </div>
            </div>
        </div>
    </div>

    <div class="top-navigation">
        <div class="container-fluid">
            <div class="topnav">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('index') }}">
                                    <i class="mdi mdi-view-dashboard"></i>Dashboard
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('calendar') }}">
                                    <i class="mdi mdi-calendar-check"></i>Kalender Bali
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-email" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-feature-search"></i>Layanan
                                </a>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="topnav-email">
                                    <a href="{{ route('hari_raya_page') }}" class="dropdown-item">Hari Raya</a>
                                    <a href="{{ route('ala_ayuning_dewasa_page') }}" class="dropdown-item">Ala Ayuning Dewasa</a>
                                    <a href="{{ route('piodalan_page') }}" class="dropdown-item">Kelola Pura</a>
                                    <a href="{{ route('otonan_page') }}" class="dropdown-item">Otonan</a>
                                    <a href="{{ route('mengatur_kriteria_awal_page') }}" class="dropdown-item">Mengatur Dewasa</a>
                                    <a href="{{ route('wariga_personal_page') }}" class="dropdown-item">Wariga Personal</a>
                                    <a href="{{ route('ramalan_sifat_page') }}" class="dropdown-item">Ramalan Sifat</a>
                                </div>
                            </li>

                            <li class="nav-item">
                                @if (session('user')['email_verified_at'] ?? false || session('user') ?? false || session('user')['permission'] == "Admin")
                                <a class="nav-link" href="{{ route('keterangan_page') }}">
                                    <i class="mdi mdi-information"></i>Keterangan
                                </a>
                                @else
                                <a class="nav-link" href="{{ route('login_page') }}">
                                    <i class="mdi mdi-information"></i>Keterangan
                                </a>
                                @endif
                            </li>

                            <li class="nav-item dropdown">
                                @if (session('user')['permission'] ?? false)
                                @if(session('user')['permission'] == "Admin")
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-email" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-newspaper"></i>Info Kita
                                </a>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="topnav-email">
                                    <a href="{{ route('info_kita_page') }}" class="dropdown-item">Info Kita</a>
                                    <a href="{{ route('manajemen_info_kita_page') }}" class="dropdown-item">Manajemen Info Kita</a>
                                </div>
                                @endif
                                @else
                                <a class="nav-link" href="{{ route('info_kita_page') }}">
                                    <i class="mdi mdi-newspaper"></i>Info Kita
                                </a>
                                @endif

                            </li>

                            @if (session('user')['permission'] ?? false)
                            @if(session('user')['permission'] == "Admin")
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-email" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-account-group"></i>Manajemen User
                                </a>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="topnav-email">
                                    <a href="{{ route('manajemen_user_page') }}" class="dropdown-item">Manajemen User</a>
                                    <a href="{{ route('pengajuan_kontribusi_page') }}" class="dropdown-item">Pengajuan Kontribusi</a>
                                </div>
                            </li>
                            @endif
                            @endif

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-email" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-account-box"></i>Autentikasi
                                </a>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="topnav-email">
                                    <a href="{{ route('login_page') }}" class="dropdown-item">Masuk</a>
                                    <a href="{{ route('register_page') }}" class="dropdown-item">Daftar</a>
                                </div>
                            </li>
                        </ul>

                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>