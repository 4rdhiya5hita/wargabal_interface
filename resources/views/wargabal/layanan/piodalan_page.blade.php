@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Piodalan"])

    @include("partials/head-css")

    <style>
        /* CSS kustom untuk mengubah warna border */
        .select2-container--default .select2-selection--single, .select2-selection__rendered {
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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Piodalan", "title" => "Piodalan"])

                <div class="row">
                    <div class="col-md-10">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-primary">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                    <div class="text-white">
                                        <div class="pt-4 pb-3">
                                            <h4 class="text-white ps-3">Halaman Pencarian Piodalan</h4>
                                            <p class="text-white text-xs px-3">Halaman pencarian ini membantu Anda mencari piodalan pada pura-pura tertentu dengan pengaturan yang mudah.</p>
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
                                        <img src="../assets/images/services/servis-vector-white-01.svg" class="float-end" width="110" height="110">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card z-index-2 ">
                            <div class="card-body">

                                <form action="{{ route('cari_piodalan') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="form-label">Cari berdasarkan: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row mb-3">
                                                <!-- <div class="col d-flex justify-content-start">
                                    <input class="form-check" type="radio" name="cari_dengan" value="pura" id="pura">
                                    <label class="form-check label" for="pura">Pura</label>
                                </div> -->
                                                <div class="col d-flex justify-content-start">
                                                    <input class="form-check" type="radio" name="cari_dengan" value="wewaran" id="wewaran" checked>
                                                    <label class="form-check label" for="wewaran">Wewaran & Wuku</label>
                                                </div>
                                                <div class="col d-flex justify-content-start">
                                                    <input class="form-check" type="radio" name="cari_dengan" value="bulan" id="bulan">
                                                    <label class="form-check label" for="bulan">Bulan</label>
                                                </div>
                                                <div class="col d-flex justify-content-start">
                                                    <input class="form-check" type="radio" name="cari_dengan" value="pura" id="pura">
                                                    <label class="form-check label" for="pura">Pura</label>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div id="pura_form" style="display: none;">
                        <label class="form-label">Pura</label>
                        <div class="input-group input-group-outline">
                            <div class="input-group input-group-outline mb-3">
                                <select class="form-control" aria-label="Default select example" name="pura_dicari">
                                    <option selected>Open this select menu</option>
                                    @foreach ($info_pura as $item)
                                    <option value="{{ $item['name'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> -->

                                    <div id="wewaran_form">
                                        <label class="form-label">Saptawara</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <select class="form-control" aria-label="Default select example" name="saptawara_dicari" id="saptawara_dicari">
                                                @for ($i = 0; $i < count($saptawara); $i++) <option value="{{ $saptawara[$i] }}">{{ $saptawara[$i] }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                        <label class="form-label">Pancawara</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <select class="form-control" aria-label="Default select example" name="pancawara_dicari" id="pancawara_dicari">
                                                @for ($i = 0; $i < count($pancawara); $i++) <option value="{{ $pancawara[$i] }}">{{ $pancawara[$i] }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                        <label class="form-label">Wuku</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <select class="form-control" aria-label="Default select example" name="wuku_dicari" id="wuku_dicari">
                                                @for ($i = 0; $i < count($wuku); $i++) <option value="{{ $wuku[$i] }}">{{ $wuku[$i] }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div id="bulan_form">
                                        <label class="form-label">Bulan</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <select class="form-control" aria-label="Default select example" name="bulan_dicari" id="bulan_dicari">
                                                @for ($i = 0; $i < count($bulan); $i++) <option value="{{ $bulan[$i] }}">{{ $bulan[$i] }}</option>
                                                    @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div id="pura_form">
                                        <label class="form-label">Pura</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <select class="form-control" aria-label="Default select example" name="pura_dicari" id="pura_dicari">
                                                @foreach($info_pura as $key => $pura)
                                                <option value="{{ $pura['name'] }} di {{ $pura['address'] }}">{{ $pura['name'] }} di {{ $pura['address'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <label class="form-label">Tahun</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="number" name="tahun_dicari" id="tahun_dicari" class="form-control" placeholder="Tahun" aria-label="Tahun" aria-describedby="basic-addon1">
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" id="btn-submit" class="btn btn-primary btn-soft w-100 mt-4 mb-0">Cari</button>
                                    </div>
                                </form>
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
        // setelah 1 detik sembunyikan form bulan dan pura
        setTimeout(function() {
            $('#bulan_form').hide();
            $('#pura_form').hide();
        }, 10);

        $('input[type=radio]').change(function() {
            if (this.value == 'pura') {
                $('#pura_form').show();
                $('#wewaran_form').hide();
                $('#bulan_form').hide();
            } else if (this.value == 'wewaran') {
                $('#pura_form').hide();
                $('#wewaran_form').show();
                $('#bulan_form').hide();
            } else if (this.value == 'bulan') {
                $('#pura_form').hide();
                $('#wewaran_form').hide();
                $('#bulan_form').show();
            }
        });

        $('#saptawara_dicari').select2();
        $('#pancawara_dicari').select2();
        $('#wuku_dicari').select2();
        $('#bulan_dicari').select2();
        $('#pura_dicari').select2();
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