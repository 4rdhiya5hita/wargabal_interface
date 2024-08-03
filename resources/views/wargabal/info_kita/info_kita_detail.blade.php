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
            <div class="page-content px-5" style="padding-top: 130px;">
                <div class="w-100">

                    <div class="row">
                        <div class="col-xl-9">

                            <div class="row">
                                <div class="card pb-4">
                                    <div class="card-body">

                                        <h4 class="card-title font-size-22">{{ ucwords($info_kita_detail['title']) }}</h4>
                                        <p class="card-title-desc mb-0">Penulis: {{ $info_kita_detail['user']['name'] }}</p>
                                        <p class="card-title-desc">Email penulis: {{ $info_kita_detail['user']['email'] }}</p>
                                        <hr class="horizontal light my-3">

                                        @if ($info_kita_detail['image'] != '' && $info_kita_detail['image'] != null)
                                        <div class="carousel slide" id="carouselExampleControls">
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item active">
                                                    <div class="d-flex justify-content-center">
                                                        <img class="w-50 img-fluid img-thumbnail" src="https://api.kalenderbali.web.id/storage/{{ $info_kita_detail['image'] }}" alt="First slide">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        
                                        @php
                                        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        $tanggal_terbit_info_kita_detail = explode(" ", $info_kita_detail['created_at']);
                                        $tanggal_terbit_info_kita_detail = explode("-", $tanggal_terbit_info_kita_detail[0]);
                                        $tanggal_terbit_info_kita_detail = $tanggal_terbit_info_kita_detail[2] . " " . $bulan[(int)$tanggal_terbit_info_kita_detail[1] - 1] . " " . $tanggal_terbit_info_kita_detail[0];
                                        @endphp
                                        <div class="card mt-3 w-100">
                                            <div class="card-body bottom-0" style="border: 2px solid #fff;">
                                                <p>Tanggal terbit: {{ $tanggal_terbit_info_kita_detail }}</p>
                                                <!-- <h4 class="card-title">{{ $info_kita_detail['title'] }}</h4> -->
                                                @php
                                                $formattedContent = nl2br(e($info_kita_detail['content']));
                                                @endphp
                                                <p class="card-title-desc">{!! $formattedContent !!}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-xl-3">
                            <div class="card pb-4">
                                <div class="card-header bg-transparent border-bottom d-flex align-items-start mb-3">
                                    <div class="flex-grow-1">
                                        <h4 class="card-title mb-0">Kumpulan Berita <span class="font-size-14 text-muted"></span></h4>
                                        <p class="text-muted mb-0">Temukan berita-berita terkini disini</p>
                                    </div>
                                </div><!-- end card-header -->

                                <div data-simplebar class="tasklist-content p-3" style="max-height: calc(170vh - 170px);">
                                    <div id="todo-task" class="tasks">
                                        @foreach ($info_kita as $key => $item)
                                        @if ($item['title'] != '' && $item['title'] != null)
                                        <div class="card border task-box">
                                            <div class="card-body mini-stat-img">
                                                @if ($item['image'] != '' && $item['image'] != null)
                                                <div class="mini-stat-icon">
                                                    <img src="https://api.kalenderbali.web.id/storage/{{ $item['image'] }}" class="float-start rounded" style="margin-right: 16px;" width="100" height="70">
                                                </div>
                                                @endif
                                                <h5 class="font-size-16 mb-2 mt-2 pt-1">{{ $item['title'] }}</h5>

                                                @php
                                                $formattedContent = substr(nl2br(e($item['content'])), 0, 250);
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

                    </div>
                    <!-- end row -->

                </div>
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

</body>

</html>