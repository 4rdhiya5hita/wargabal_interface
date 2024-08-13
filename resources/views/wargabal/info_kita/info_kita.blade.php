@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Info Kita"])

    @include("partials/head-css")

</head>

<body class="vertical-collpsed" data-topbar="dark" data-layout="horizontal">

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include("partials/topbar-horizontal")

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

        <div class="main-content">
            <div class="page-content px-5" style="padding-top: 100px;">
                <div class="w-100">

                    <div class="row">
                        <div class="col-xl-7">

                            <div class="row">
                                <div class="card pb-4">
                                    <div class="card-body">

                                        <h4 class="card-title">Info Kita</h4>
                                        <p class="card-title-desc">Informasi terkini terkait Bali dan adat istiadatnya yang dihimpun oleh staf website Kalender Bali</p>

                                        <div class="carousel slide" id="carouselExampleControls" data-bs-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                @for ($i = 0; $i < count($info_kita); $i++) @if ($info_kita[$i]['image'] !='' && $info_kita[$i]['image'] !=null) <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                                    <div id="myPosition_{{$i}}" class="position-relative">
                                                        <a href="{{ route('info_kita_detail_page', ['id' => $info_kita[$i]['id']] ) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Klik untuk melihat informasi lengkap">

                                                            <img id="myImage_{{$i}}" class="d-block w-100 img-fluid" src="https://api.kalenderbali.web.id/storage/{{ $info_kita[$i]['image'] }}" alt="First slide">
                                                            <div id="myCard_{{$i}}" class="card position-absolute start-50 w-100 translate-middle">
                                                                <div class="card-body bottom-0" style="border: 2px solid #fff;">
                                                                    <h4 class="card-title">{{ $info_kita[$i]['title'] }}</h4>
                                                                    @php
                                                                    $formattedContent = substr(nl2br(e($info_kita[$i]['content'])), 0, 250);
                                                                    @endphp
                                                                    <p class="card-title-desc">{!! $formattedContent !!}..</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                            </div>
                                            @endif
                                            @endfor
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="card pb-4">
                                <div class="card-header bg-transparent border-bottom d-flex align-items-start mb-3">
                                    <div class="flex-grow-1">
                                        <h4 class="card-title mb-0">Layanan Kami <span class="font-size-14 text-muted"></span></h4>
                                        <p class="text-muted mb-0">Berikut merupakan layanan yang dapat Anda coba</p>
                                    </div>
                                </div><!-- end card-header -->

                                <div data-simplebar class="tasklist-content p-3" style="max-height: calc(100vh - 170px);">
                                    <div id="todo-task" class="tasks">
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <a href="{{ route('hari_raya_page') }}" class="card mini-stat bg-primary">
                                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                    <div class="mini-stat-icon">
                                                        <img src="../assets/images/services/servis-vector-white-09.svg" width="45" height="45" class="float-end">
                                                    </div>
                                                    <div class="text-white">
                                                        <h5 class="text-white">Fitur Hari Raya</h5>
                                                        <p>Kapan lagi Hari Raya Galungan ya? Temukan jawabannya disini!</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <a href="{{ route('ala_ayuning_dewasa_page') }}" class="card mini-stat bg-primary">
                                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                    <div class="mini-stat-icon">
                                                        <img src="../assets/images/services/servis-vector-white-02.svg" width="45" height="45" class="float-end">
                                                    </div>
                                                    <div class="text-white">
                                                        <h5 class="text-white">Fitur Ala Ayuning Dewasa</h5>
                                                        <p>Dewasa untuk menikah kapan ya? Penasaran? Cek disini!</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>


                                        <div class="card bg-transparent shadow-none mb-0">
                                            <a href="{{ route('otonan_page') }}" class="card mini-stat bg-primary">
                                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                    <div class="mini-stat-icon">
                                                        <img src="../assets/images/services/servis-vector-white-06.svg" width="45" height="45" class="float-end">
                                                    </div>
                                                    <div class="text-white">
                                                        <h5 class="text-white">Fitur Otonan</h5>
                                                        <p>Otonanmu berapa hari lagi? Yuk cari tau!</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <a href="{{ route('ramalan_sifat_page') }}" class="card mini-stat bg-primary">
                                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                    <div class="mini-stat-icon">
                                                        <img src="../assets/images/services/servis-vector-white-04.svg" width="45" height="45" class="float-end">
                                                    </div>
                                                    <div class="text-white">
                                                        <h5 class="text-white">Fitur Ramalan Sifat</h5>
                                                        <p>Perhitungan Kalender Bali bisa meramal sifatmu? Cek disini!</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <a href="{{ route('mengatur_kriteria_awal_page') }}" class="card mini-stat bg-primary">
                                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                    <div class="mini-stat-icon">
                                                        <img src="../assets/images/services/servis-vector-white-05.svg" width="45" height="45" class="float-end">
                                                    </div>
                                                    <div class="text-white">
                                                        <h5 class="text-white">Fitur Mengatur Dewasa</h5>
                                                        <p>Atur dewasamu sendiri, buat atur jadwal kegiatanmu!</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <a href="{{ route('wariga_personal_page') }}" class="card mini-stat bg-primary">
                                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                    <div class="mini-stat-icon">
                                                        <img src="../assets/images/services/servis-vector-white-07.svg" width="45" height="45" class="float-end">
                                                    </div>
                                                    <div class="text-white">
                                                        <h5 class="">Wariga Personal</h5>
                                                        <p>Baik buruk harimu bisa kamu lihat disini!</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <a href="{{ route('piodalan_page') }}" class="card mini-stat bg-primary">
                                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                    <div class="mini-stat-icon">
                                                        <img src="../assets/images/services/servis-vector-white-03.svg" width="45" height="45" class="float-end">
                                                    </div>
                                                    <div class="text-white">
                                                        <h5 class="text-white">Fitur Piodalan</h5>
                                                        <p>Tangkil ke pura mana hari ini? Cek disini yuk!</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End simple-bar -->
                            </div>
                        </div>

                    </div>
                    <!-- end col -->

                    <div class="col-xl-5">
                        <div class="card pb-4">
                            <!-- <div class="card-header bg-transparent border-bottom d-flex align-items-start mb-3">
                                <div class="flex-grow-1">
                                    <h4 class="card-title mb-0">Layanan Kami <span class="font-size-14 text-muted"></span></h4>
                                    <p class="text-muted mb-0">Berikut merupakan layanan yang dapat Anda coba</p>
                                </div>
                            </div> -->

                            <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                <!-- <h5 class="d-flex justify-content-center">Zodiak Bulan Ini</h5> -->
                                <h5 class="d-flex justify-content-center">{{ $info_zodiak['nama'] }}</h5>
                                <p class="d-flex justify-content-center">{{ $info_zodiak['tanggal_mulai'] }}-{{ $info_zodiak['tanggal_selesai'] }}</p>
                                <hr class="horizontal light my-3">
                                <div class="mini-stat-icon">
                                    <img src="../assets/images/zodiak/Asset_{{ $month }}.svg" class="float-start my-3" style="margin-right: 16px;" height="100" width="100">
                                </div>
                                <p class="mb-0">{{ $info_zodiak['keterangan'] }}</p>
                            </div>
                        </div>

                        <div class="card pb-4">
                            <div class="card-header bg-transparent border-bottom d-flex align-items-start mb-3">
                                <div class="flex-grow-1">
                                    <h4 class="card-title mb-0">Kumpulan Berita <span class="font-size-14 text-muted"></span></h4>
                                    <p class="text-muted mb-0">Temukan berita-berita terkini disini</p>
                                </div>
                            </div><!-- end card-header -->

                            <div data-simplebar class="tasklist-content p-3" style="max-height: calc(100vh - 170px);">
                                <div id="todo-task" class="tasks">
                                    @foreach ($info_kita as $key => $item)
                                    @if ($item['title'] != '' && $item['title'] != null)
                                    <div class="card task-box">
                                        <div class="card-body mini-stat-img">
                                            @if ($item['image'] != '' && $item['image'] != null)
                                            <div class="mini-stat-icon">
                                                <img src="https://api.kalenderbali.web.id/storage/{{ $item['image'] }}" class="float-start rounded" style="margin-right: 16px;" width="100" height="70">
                                            </div>
                                            @endif
                                            <h5 class="font-size-16 mb-2 mt-2 pt-1">{{ $item['title'] }}</h5>

                                            @php
                                            $formattedContent = substr(nl2br(e($item['content'])), 0, 300);
                                            @endphp
                                            <p class="text-muted mb-0">{!! $formattedContent !!}..</p>
                                            <a href="{{ route('info_kita_detail_page', ['id' => $item['id']]) }}" class="text-primary">>> Baca selengkapnya</a>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-xl-12 p-0">
                        <div class="card pb-4">
                            <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                <h5 class="d-flex justify-content-center">Ramalan Sifat Hari Ini</h5>
                                <p class="d-flex justify-content-center">{{ $hari_ini }}</p>
                                <hr class="horizontal light my-3">

                                <div class="mb-4">
                                    <h5 class="mb-2">+ Pancawara: {{ $info_ramalan_sifat['pancawara'] }}</h5>
                                    <p class="mb-0" id="Pancawara">{{ substr($info_ramalan_sifat['sifat_pancawara'], 0, 400) }}...</p>
                                    <a href="{{ route('ramalan_sifat_page') }}">cari selengkapnya >></a>
                                </div>

                                <div class="mb-4">
                                    <h5 class="mb-2">+ Saptawara: {{ $info_ramalan_sifat['saptawara'] }}</h5>
                                    <p class="mb-0" id="Saptawara">{{ substr($info_ramalan_sifat['sifat_saptawara'], 0, 400) }}...</p>
                                    <a href="{{ route('ramalan_sifat_page') }}">cari selengkapnya >></a>
                                </div>

                                <div class="mb-4">
                                    <h5 class="mb-2">+ Wuku: {{ $info_ramalan_sifat['wuku'] }}</h5>
                                    <p class="mb-0" id="Wuku">{{ substr($info_ramalan_sifat['sifat_wuku'], 0, 400) }}...</p>
                                    <a href="{{ route('ramalan_sifat_page') }}">cari selengkapnya >></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end row -->

            </div>
        </div>

        @include("partials/footer")
        <!-- end main content-->
    </div>

    </div>
    <!-- End Page-content -->

    @include("partials/vendor-scripts")
    <!-- Validation -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        var card = document.getElementById('myCard');
        var image = document.getElementById('myImage');
        var countInfoKita = {{ count($info_kita) }};
        
        for (var i = 0; i < countInfoKita; i++) {
            var card = document.getElementById('myCard_' + i);
            var image = document.getElementById('myImage_' + i);
            var position = document.getElementById('myPosition_' + i);
            if (window.innerWidth < 500) {
                card.style.height = '185px';
                image.style.maxWidth = '100%';
                image.style.maxHeight = '225px';
                image.style.objectFit = 'cover';
                position.style.height = '250px';
            } else {
                card.style.height = '350px';
                image.style.maxWidth = '100%';
                image.style.maxHeight = '500px';
                image.style.objectFit = 'cover';
                position.style.height = '450px';
            }
        }

        if (window.innerWidth < 992) {
            $('#dropdown-menu-layanan').on('click', function() {
                $('#layanan').toggleClass('show');
            });
        }
    </script>

</body>

</html>