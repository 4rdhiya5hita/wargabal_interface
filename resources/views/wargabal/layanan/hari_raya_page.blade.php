@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Hari Raya"])

    @include("partials/head-css")

    <style>
        /* CSS kustom untuk mengubah warna border */
        .select2-container--default .select2-selection--single,
        .select2-selection__rendered {
            display: block;
            width: 100%;
            font-size: 0.8125rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--bs-body-color);
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-color: var(--bs-secondary-bg);
            background-clip: padding-box;
            border: var(--bs-border-width) solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        }
    </style>

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Hari Raya", "title" => "Hari Raya"])

                <div class="row">
                    <div class="col-md-10">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-primary">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-1.png); background-size: cover;">
                                    <div class="text-white">
                                        <div class="pt-4 pb-3">
                                            <h4 class="text-white ps-3">Halaman Pencarian Hari Raya</h4>
                                            <p class="text-white text-xs px-3">Halaman pencarian ini membantu Anda menemukan dengan mudah beragam informasi terkait perayaan hari raya, seperti tanggal penting berserta detail tanggal tersebut dan disajikan dengan pengaturan yang sederhana.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-primary">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-1.png); background-size: cover;">
                                    <div class="mini-stat-icon">
                                        <img src="../assets/images/services/servis-vector-white-09.svg" class="float-end" width="131" height="131">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="card z-index-2 ">
                            <div class="card-body">
                                <form action="{{ route('cari_hari_raya') }}" method="post">
                                    @csrf
                                    <label class="form-label">Nama Hari Raya</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <!-- make dropdown -->
                                        <select class="form-control" aria-label="Default select example" name="nama_hari_raya_dicari" id="nama_hari_raya_dicari">
                                            @foreach ($hari_raya as $item)
                                            <option value="{{ $item['hari_raya'] }}">{{ $item['hari_raya'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Cari dengan: </label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row mb-3">
                                                <div class="col d-flex justify-content-start">
                                                    <input class="form-check" type="radio" name="cari_dengan" value="bulan" id="bulan" checked>
                                                    <label class="form-check label" for="bulan">Bulan</label>
                                                </div>
                                                <div class="col d-flex justify-content-start">
                                                    <input class="form-check" type="radio" name="cari_dengan" value="tahun" id="tahun">
                                                    <label class="form-check label" for="tahun">Tahun</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="bulan_form">
                                        <label class="form-label">Bulan</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <select class="form-control" aria-label="Default select example" name="bulan_dicari" id="bulan_dicari">
                                                @foreach ($bulan as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div id="tahun_form">
                                        <label class="form-label">Tahun</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <input type="number" name="tahun_dicari" class="form-control" id="tahun_dicari" placeholder="Tahun" aria-label="Tahun" aria-describedby="basic-addon1">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" id="btn-submit" class="btn btn-primary btn-soft w-100 mt-4 mb-0">Cari</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mb-4">
                        <div class="card z-index-2 ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h4>Kalender Hari Raya</h4>
                                    </div>
                                    <div class="col">
                                        <h4 class="d-flex justify-content-end font-weight-normal">{{ $tanggal_sekarang }}</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p class="text-secondary text-uppercase text-xs mt-1 mb-3">{{ $bulan[date('m') - 1] }} {{ date('Y') }}</p>
                                    </div>
                                    <div class="col">
                                        <p class="d-flex justify-content-end text-secondary text-xs mt-1 mb-3">KAPITU/KAWULU 1945</p>
                                    </div>
                                </div>
                                <hr class="horizontal light mt-0 mb-2">
                                <div class="card bg-transparent shadow-none mb-0">
                                    <div class="card mini-stat bg-primary">
                                        <div class="card-body mini-stat-img" style="background: url(assets/images/bg-1.png); background-size: cover;">
                                            <div class="mini-stat-icon">
                                                <img src="../assets/images/services/servis-vector-white-09.svg" class="float-end" width="70" height="70">
                                            </div>
                                            <div class="text-white">
                                                <div class="pt-4 pb-3">
                                                    <h6 class="text-white font-weight-normal ps-3">Hari ini</h6>
                                                    @foreach ($hari_raya_sekarang as $key => $hari_raya)
                                                    @if ($hari_raya != '-')
                                                    <h4 class="text-white ps-3">{{ $hari_raya['nama'] }}</h4>
                                                    <p class="text-white text-xs px-3">{{ $hari_raya['keterangan'] }}</p>
                                                    @else
                                                    <h4 class="text-white ps-3">Tidak ada hari raya saat ini</h4>
                                                    <p class="text-white text-xs px-3">Tidak ada keterangan mengenai hari raya</p>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card z-index-2 ">
                            <div class="card-body">
                                <p>Hari Raya Bulan Ini</p>
                                <ol class="activity-feed mb-0">
                                    @foreach ($info_hari_raya as $key => $item)
                                    @if ($item['hari_raya'] != '-')
                                    @foreach ($item['hari_raya'] as $key => $hari_raya)
                                    @if ($hari_raya != '-')
                                    <li class="feed-item" style="border-left: 4px solid var(--bs-{{ $item['tanggal'] > $tanggal_sekarang ? 'body-bg' : 'primary' }})">
                                        <div class="feed-item-list">
                                            <span class="date">{{ $item['tanggal'] }}</span>
                                            <span class="activity-text">{{ $hari_raya['nama'] }}</span>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                    @endif
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include("partials/footer")
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

@include("partials/right-sidebar")

@include("partials/vendor-scripts")

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="assets/libs/sweetalert2/sweetalert2.all.min.js"></script>

<!--Morris Chart-->
<script src="assets/libs/morris.js/morris.min.js"></script>
<script src="assets/libs/raphael/raphael.min.js"></script>

<script src="assets/js/pages/dashboard.init.js"></script>

<script src="assets/js/app.js"></script>

<script>
    $(document).ready(function() {
        $('input[type=radio]').change(function() {
            if (this.value == 'bulan') {
                $('#bulan_form').show();
            } else if (this.value == 'tahun') {
                $('#tahun_form').show();
                $('#bulan_form').hide();
            }
        });

        $('#nama_hari_raya_dicari').select2({
            placeholder: "Pilih Hari Raya",
        });

        $('#bulan_dicari').select2({
            placeholder: "Pilih Bulan",
        })
    });

    $(function() {
        $(document).on('click', '#btn-submit', function(e) {
            e.preventDefault();
            // console.log('submit');
            var tahun = $('#tahun_dicari').val();

            if (tahun == '') {
                Swal.fire({
                    title: 'Error!',
                    html: '<b>Tahun</b> harus diisi',
                    icon: 'error',
                    confirmButtonText: 'Cancel'
                })
            } else {
                $(this).closest('form').submit();
            }
        });
    });
</script>

</body>

</html>