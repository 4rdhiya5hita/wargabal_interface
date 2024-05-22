@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Dashboard"])

    @include("partials/head-css")

</head>

@include("partials/body")

<!-- Begin page -->
<div id="layout-wrapper">

    @include("partials/menu")

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Dashboard", "title" => "Dashboard"])

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Hari Raya Berikutnya</h4>
                                <p class="text-muted mb-3">Temukan info hari raya berikutnya dibawah ini</p>
                                <div class="card bg-transparent shadow-none">
                                    <div class="task-board">
                                        @php $hitung = 0; @endphp
                                        @foreach ($info_hari_raya as $key => $item)
                                        @if ($hitung >= 7) @break @endif

                                        @if ($item['hari_raya'] != '-')
                                        @foreach ($item['hari_raya'] as $key => $hari_raya)
                                        @if ($hari_raya != '-')
                                        <div class="task-list">
                                            <div class="card mini-stat bg-primary">
                                                <div class="card-body mini-stat-img">
                                                    <div class="mini-stat-icon">
                                                        <!-- <i class="mdi mdi-cube-outline float-end"></i> -->
                                                        <img src="../assets/images/services/servis-vector-white-09.svg" class="float-end" width="70" height="70">
                                                    </div>
                                                    <div class="text-white">
                                                        <h6 class="text-uppercase mb-3 text-white">{{ $item['tanggal'] }}</h6>
                                                        <h2 class="mb-4 text-white">{{ $hari_raya['nama'] }}</h2>
                                                        <span class="badge bg-warning">
                                                            @php
                                                            $selisih_hari = date_diff(date_create($tanggal_sekarang), date_create($item['tanggal']));
                                                            echo $selisih_hari->format('%a hari lagi');
                                                            @endphp
                                                        </span> <span class="ms-2">Hari Raya Agama Hindu Bali</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php $hitung = $hitung + 1; @endphp
                                        @endif
                                        @endforeach
                                        @endif
                                        
                                        @endforeach
                                        <div class="d-flex align-items-center" style="height: 150px;">
                                            <a href="{{ route('hari_raya_page') }}">
                                                <img src="../assets/images/arrow-right-circle.svg" width="70" height="70">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                    </div>
                </div>
                <!-- end row -->

                <div class="row">

                    <div class="col" style="height: 630px;">
                        <div class="card shadow-none h-100">
                            <div class="card-header bg-transparent border-bottom d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h4 class="card-title mb-0">Ala Ayuning Dewasa <span class="font-size-14 text-muted"></span></h4>
                                    <p class="text-muted mb-0">Temukan info ala ayuning dewasa dibawah ini</p>
                                </div>
                            </div><!-- end card-header -->

                            <div>
                                <div class="text-center p-3">
                                    <a href="{{ route('ala_ayuning_dewasa_page') }}" class="btn btn-warning btn-soft w-100"><i class="mdi mdi-magnify mr-1"></i> Klik untuk mencari lainnya ...</a>
                                </div>

                                <div data-simplebar class="tasklist-content p-3" style="max-height: calc(100vh - 180px);">
                                    <div id="todo-task" class="tasks">
                                        @foreach ($info_ala_ayuning_dewasa as $key => $item)
                                        @if ($item['tanggal'] == $tanggal_sekarang)
                                        @foreach ($item['ala_ayuning_dewasa'] as $key => $ala_ayuning_dewasa)
                                        <div class="card task-box" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                            <div class="card-body mini-stat-img">
                                                <div class="mini-stat-icon">
                                                    <img src="../assets/images/services/servis-vector-warning-05.svg" class="float-end" width="70" height="70">
                                                </div>
                                                <span class="badge bg-primary">Hari ini</span>
                                                <h5 class="font-size-16 mb-2 mt-2 pt-1">{{ $ala_ayuning_dewasa['nama'] }}</h5>
                                                <p class="text-muted mb-0">{{ $ala_ayuning_dewasa['keterangan'] }}</p>
                                            </div>
                                        </div>
                                        <!-- end task card -->
                                        @endforeach
                                        @endif
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col" style="height: 630px;">
                        <div class="card shadow-none h-100">
                            <div class="card-header bg-transparent border-bottom d-flex align-items-start">
                                <div class="flex-grow-1">
                                    <h4 class="card-title mb-0">Piodalan berikutnya <span class="font-size-14 text-muted"></span></h4>
                                    <p class="text-muted mb-0">Temukan info piodalan berikutnya dibawah ini</p>
                                </div>
                            </div><!-- end card-header -->

                            <div class="text-center p-3">
                                <a href="{{ route('piodalan_page') }}" class="btn btn-danger btn-soft w-100"><i class="mdi mdi-magnify mr-1"></i> Klik untuk mencari lainnya ...</a>
                            </div>

                            <div data-simplebar class="tasklist-content p-3" style="max-height: calc(100vh - 180px);">
                                @foreach ($info_piodalan as $key => $piodalan)
                                @if ($piodalan['pura'] != '-')
                                <div class="card task-box">
                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                        <div class="mini-stat-icon">
                                            <img src="../assets/images/services/servis-vector-danger-01.svg" class="float-end" width="70" height="70">
                                        </div>
                                        @if (isset($piodalan['hari']))
                                        <h6 class="text-uppercase mb-3 font-size-16">{{ $piodalan['hari'] }}</h6>
                                        @endif
                                        @foreach ($piodalan['pura'] as $key => $pura)
                                        <span class="badge bg-warning"> </span><span class="mx-2">{{ $pura['nama_pura'] }}</span>
                                        @endforeach
                                        <div class="mt-1">
                                            <span class="badge bg-warning">
                                                @php
                                                $selisih_hari = date_diff(date_create($tanggal_sekarang), date_create($piodalan['tanggal']));
                                                echo $selisih_hari->format('%a hari lagi');
                                                @endphp
                                            </span>
                                            <span class="ms-2">{{ $piodalan['tanggal'] }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>

                        </div>
                    </div>

                    <div class="col">
                        <div class="row mb-0">
                            <div class="card bg-transparent shadow-none mb-0">
                                <div class="card mini-stat bg-primary">
                                    <div class="card-body mini-stat-img">
                                        <div class="text-white">
                                            <h2 class="text-white">Layanan Kami</h2>
                                            <p>Berikut merupakan layanan yang dapat Anda coba</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="card bg-transparent shadow-none mb-0">
                                    <a href="{{ route('mengatur_kriteria_awal_page') }}" class="card mini-stat bg-info">
                                        <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                            <div class="mini-stat-icon">
                                                <img src="../assets/images/services/servis-vector-white-05.svg" width="45" height="45" class="float-end">
                                            </div>
                                            <div class="text-white">
                                                <h5 class="text-white">Mengatur Dewasa</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card bg-transparent shadow-none mb-0">
                                    <a href="{{ route('wariga_personal_page') }}" class="card mini-stat bg-success">
                                        <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                            <div class="mini-stat-icon">
                                                <img src="../assets/images/services/servis-vector-white-07.svg" width="45" height="45" class="float-end">
                                            </div>
                                            <div class="text-white">
                                                <h5 class="">Wariga Personal</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card bg-transparent shadow-none mb-0">
                                    <a href="{{ route('piodalan_page') }}" class="card mini-stat bg-danger">
                                        <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                            <div class="mini-stat-icon">
                                                <img src="../assets/images/services/servis-vector-white-01.svg" width="45" height="45" class="float-end">
                                            </div>
                                            <div class="text-white">
                                                <h5 class="text-white">Kelola Pura</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card bg-transparent shadow-none mb-0">
                                    <a href="{{ route('ala_ayuning_dewasa_page') }}" class="card mini-stat bg-warning">
                                        <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                            <div class="mini-stat-icon">
                                                <img src="../assets/images/services/servis-vector-white-02.svg" width="45" height="45" class="float-end">
                                            </div>
                                            <div class="text-white">
                                                <h5 class="text-white">Ala Ayuning Dewasa</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card bg-transparent shadow-none mb-0">
                                    <a href="{{ route('hari_raya_page') }}" class="card mini-stat bg-primary">
                                        <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                            <div class="mini-stat-icon">
                                                <img src="../assets/images/services/servis-vector-white-09.svg" width="45" height="45" class="float-end">
                                            </div>
                                            <div class="text-white">
                                                <h5 class="text-white">Pencarian Hari Raya</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card bg-transparent shadow-none mb-0">
                                    <a href="{{ route('otonan_page') }}" class="card mini-stat bg-light">
                                        <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                            <div class="mini-stat-icon">
                                                <img src="../assets/images/services/servis-vector-06.svg" width="45" height="45" class="float-end">
                                            </div>
                                            <div class="">
                                                <h5 class="">Otonan</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card bg-transparent shadow-none mb-0">
                                    <a href="{{ route('ramalan_sifat_page') }}" class="card mini-stat bg-light">
                                        <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                            <div class="mini-stat-icon">
                                                <img src="../assets/images/services/servis-vector-danger-04.svg" width="45" height="45" class="float-end">
                                            </div>
                                            <div class="">
                                                <h5 class="">Ramalan Sifat</h5>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end row -->

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        @include("partials/footer")
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

@include("partials/right-sidebar")

@include("partials/vendor-scripts")

<!--Morris Chart-->
<script src="assets/libs/morris.js/morris.min.js"></script>
<script src="assets/libs/raphael/raphael.min.js"></script>

<script src="assets/js/pages/dashboard.init.js"></script>

<script src="assets/js/app.js"></script>

</body>

</html>