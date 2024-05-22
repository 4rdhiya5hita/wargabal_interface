<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('index') }}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="badge rounded-pill bg-primary float-end">2</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('calendar') }}" class=" waves-effect">
                        <i class="mdi mdi-calendar-check"></i>
                        <span>Calendar</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-text-box-multiple-outline"></i>
                        <span> Layanan </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('hari_raya_page') }}">Hari Raya</a></li>
                        <li><a href="{{ route('ala_ayuning_dewasa_page') }}">Ala Ayuning Dewasa</a></li>
                        <li><a href="{{ route('piodalan_page') }}">Kelola Pura</a></li>
                        <li><a href="{{ route('otonan_page') }}">Otonan</a></li>
                        <li><a href="{{ route('mengatur_kriteria_awal_page') }}">Mengatur Dewasa</a></li>
                        <li><a href="{{ route('wariga_personal_page') }}">Wariga Personal</a></li>
                        <li><a href="{{ route('ramalan_sifat_page') }}">Ramalan Sifat</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-account-box"></i>
                        <span> Authentication </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('pages-login') }}">Login</a></li>
                        <li><a href="{{ route('pages-register') }}">Register</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->