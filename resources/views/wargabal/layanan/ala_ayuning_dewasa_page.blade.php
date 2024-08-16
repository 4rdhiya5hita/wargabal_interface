@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Ala Ayuning Dewasa"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Layanan", "title" => "Ala Ayuning Dewasa"])

                <div class="row">
                    <div class="col-md-10">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-primary">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                    <div class="text-white">
                                        <div class="pt-4 pb-3">
                                            <h4 class="text-white ps-3">Halaman Pencarian Ala Ayuning Dewasa</h4>
                                            <p class="text-white text-xs px-3">Halaman pencarian ini membantu Anda menemukan dengan mudah beragam informasi terkait Ala Ayuning Dewasa didasarkan pada penanggalan atau kalender Bali yang biasanya digunakan dalam banyak hal seperti penentuan hari yang cocok untuk upacara-upacara Hindu.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-primary">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                    <div class="mini-stat-icon">
                                        <img src="../assets/images/services/servis-vector-white-02.svg" class="float-end" width="131" height="131">
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
                                <form action="{{ route('cari_ala_ayuning_dewasa') }}" method="post">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label class="form-label">Cari dengan: </label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col d-flex justify-content-start">
                                                    <input class="form-check" type="radio" name="cari_dengan" value="nama" checked>
                                                    <label class="form-check label" for="nama">Nama Ala Ayuning Dewasa</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex justify-content-start">
                                                    <input class="form-check" type="radio" name="cari_dengan" value="tanggal">
                                                    <label class="form-check label" for="tanggal">Tanggal</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="nama_form">
                                        <label class="form-label">Nama Ala Ayuning Dewasa</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <!-- make dropdown -->
                                            <select class="form-control" aria-label="Default select example" name="nama_ala_ayuning_dewasa_dicari" id="nama_ala_ayuning_dewasa_dicari">
                                                @foreach ($ala_ayuning_dewasa as $item)
                                                <option value="{{ $item['ala_ayuning_dewasa'] }}">{{ $item['ala_ayuning_dewasa'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <label class="form-label">Bulan</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <select class="form-control" aria-label="Default select example" name="bulan_dicari" id="bulan_dicari">
                                                @foreach ($bulan as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <label class="form-label">Tahun</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <input type="number" name="tahun_dicari" class="form-control" id="tahun_dicari" placeholder="Tahun" aria-label="Tahun" aria-describedby="basic-addon1">
                                        </div>
                                    </div>

                                    <div id="tanggal_form" style="display: none;">
                                        <label class="form-label">Tanggal</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <input type="date" name="tanggal_dicari" class="form-control" id="tanggal_dicari" placeholder="Tanggal" aria-label="Tanggal" aria-describedby="basic-addon1">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" id="btn-submit" class="btn btn-primary btn-soft w-100 mt-4 mb-0">Cari</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="card z-index-2 ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h4>Ala Ayuning Dewasa</h4>
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
                                @foreach ($info_ala_ayuning_dewasa as $key => $item)
                                @if ($item['tanggal'] == $tanggal_sekarang)
                                @foreach ($item['ala_ayuning_dewasa'] as $key => $ala_ayuning_dewasa)
                                <div class="card bg-transparent shadow-none mb-0">
                                    <div class="card mini-stat bg-primary">
                                        <div class="card-body mini-stat-img p-2" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                            <div class="mini-stat-icon">
                                                <img src="../assets/images/services/servis-vector-white-02.svg" class="float-end" width="60" height="60">
                                            </div>
                                            <div class="text-white">
                                                <div class="pt-3">
                                                    <h6 class="text-white font-weight-normal ps-3">Hari ini</h6>
                                                    <h4 class="text-white ps-3">{{ $ala_ayuning_dewasa['nama'] }}</h4>
                                                    <p class="text-white text-xs px-3">{{ $ala_ayuning_dewasa['keterangan'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                @endforeach
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

<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

<!--Morris Chart-->
<script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
    $(document).ready(function() {
        $('input[type=radio]').change(function() {
            if (this.value == 'nama') {
                $('#nama_form').show();
                $('#tanggal_form').hide();
            } else if (this.value == 'tanggal') {
                $('#nama_form').hide();
                $('#tanggal_form').show();
            }
        });

        $('#nama_ala_ayuning_dewasa_dicari').select2({
            placeholder: "Pilih Ala Ayuning Dewasa",
        });

        $('#bulan_dicari').select2({
            placeholder: "Pilih Bulan",
        });


        $(function() {
            $(document).on('click', '#btn-submit', function(e) {
                e.preventDefault();
                // console.log('submit');
                var tahun = $('#tahun_dicari').val();
                var tanggal = $('#tanggal_dicari').val();
                var cari_dengan = $('input[name=cari_dengan]:checked').val();

                if (cari_dengan == 'nama' && tahun == '') {
                    Swal.fire({
                        title: 'Error!',
                        html: '<b>Tahun</b> harus diisi',
                        icon: 'error',
                        confirmButtonText: 'Cancel'
                    })
                } else if (cari_dengan == 'tanggal' && tanggal == '') {
                    Swal.fire({
                        title: 'Error!',
                        html: '<b>Tanggal</b> harus diisi',
                        icon: 'error',
                        confirmButtonText: 'Cancel'
                    })
                } else {
                    $(this).closest('form').submit();
                }
            });
        });
    });
</script>

</body>

</html>