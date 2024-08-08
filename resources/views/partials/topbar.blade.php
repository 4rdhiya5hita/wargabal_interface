<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('index') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
                    </span>
                </a>

                <a href="{{ route('index') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="18">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>

            <div class="d-none d-sm-block">
                <!-- <div class="dropdown dropdown-topbar pt-3 mt-1 d-inline-block">
                    <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Create <i class="mdi mdi-chevron-down"></i>
                        </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="d-flex">

            <!-- App Search-->
            <!-- <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="fa fa-search"></span>
                </div>
            </form>

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-search-dropdown">
                    
                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> -->


            <!-- <div class="dropdown d-none d-md-block ms-2">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="me-2" src="assets/images/flags/us_flag.jpg" alt="Header Language" height="16"> English <span class="mdi mdi-chevron-down"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="assets/images/flags/germany_flag.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle"> German </span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="assets/images/flags/italy_flag.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle"> Italian </span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="assets/images/flags/french_flag.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle"> French </span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="assets/images/flags/spain_flag.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle"> Spanish </span>
                    </a>

                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img src="assets/images/flags/russia_flag.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle"> Russian </span>
                    </a>
                </div>
            </div> -->

            @if (isset(session('user')['permission']))
            @if (session('user')['permission'] == "Guest")
            <div class="dropdown d-lg-inline-block align-self-center mx-3">
                <button type="button" class="btn btn-primary waves-effect waves-light">
                    <span class="d-xl-inline-block">Premium</span>
                </button>
            </div>
            @endif
            @else
            <div class="dropdown d-lg-inline-block align-self-center mx-3">
                <button type="button" class="btn btn-primary waves-effect waves-light">
                    <i class="mdi mdi-star"></i>
                    <span class="d-xl-inline-block">Premium</span>
                </button>
            </div>
            @endif

            <div class="dropdown d-none d-lg-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="fa fa-expand-arrows-alt fa-2x"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block ms-1">
                <button type="button" class="btn header-item waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell font-size-24"></i>
                    @if (session('my_pending_payment') == true)
                    <span class="badge text-bg-danger rounded-pill">1</span>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    @if (session('my_pending_payment') == true)
                    <a href="{{ route('pembelian_anda') }}" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <span class="avatar-title border-primary rounded-circle ">
                                        <i class="mdi mdi-cart-outline"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Transaksi</h6>
                                <div class="text-muted">
                                    <p class="mb-1">Anda memiliki transaksi yang belum selesai!</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    @else
                    <a href="javascript:void(0);" class="text-reset notification-item">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Tidak ada notifikasi</h6>
                            </div>
                        </div>
                    </a>
                    @endif
                </div>
            </div>


            <div class="dropdown d-inline-block">
                @if (isset(session('user')['permission']) || isset(session('user')['permission']) == "Admin")
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-circle font-size-24"></i>
                </button>
                <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">{{ session('user')['name'] }} [{{ session('user')['permission'] }}]</span>
                <i class="mdi mdi-chevron-down d-none d-xl-inline-block font-size-15"></i>
                @else
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-circle font-size-24"></i>
                    <span class="d-none d-xl-inline-block ms-1 fw-medium font-size-15">User</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block font-size-15"></i>
                </button>
                @endif
                <div class="dropdown-menu dropdown-menu-end">
                    @if (isset(session('user')['permission']))
                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="mdi mdi-account-circle font-size-17 text-muted align-middle me-1"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('pembelian_anda') }}"><i class="mdi mdi-basket font-size-17 text-muted align-middle me-1"></i> Pembelian Anda</a>
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

            <!-- <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="mdi mdi-spin mdi-cog"></i>
                </button>
            </div> -->
        </div>
    </div>
</header>