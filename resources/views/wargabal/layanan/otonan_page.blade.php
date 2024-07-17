@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Otonan"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Otonan", "title" => "Otonan"])

                <div class="row">
                    <div class="col-md-10">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-primary">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                    <div class="text-white">
                                        <div class="pt-4 pb-3">
                                            <h4 class="text-white ps-3">Halaman Pencarian Otonan</h4>
                                            <p class="text-white text-xs px-3">Halaman pencarian ini membantu Anda menentukan kapan otonan berikutnya berdasarkan tanggal lahir yang dicari.</p>
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
                                        <img src="../assets/images/services/servis-vector-white-06.svg" class="float-end" width="110" height="110">
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

                                <form action="{{ route('cari_otonan') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="form-label">Cari berdasarkan: </label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row mb-3">
                                                <div class="col d-flex justify-content-start">
                                                    <input class="form-check" type="radio" name="cari_dengan" value="wewaran" id="wewaran" checked>
                                                    <label class="form-check label" for="wewaran">Wewaran</label>
                                                </div>
                                                <div class="col d-flex justify-content-start">
                                                    <input class="form-check" type="radio" name="cari_dengan" value="tanggal_lahir" id="tanggal_lahir">
                                                    <label class="form-check label" for="tanggal_lahir">Tanggal Lahir</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="tanggal_lahir_form" style="display: none;">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <input type="date" name="tanggal_lahir_dicari" id="tanggal_lahir_dicari" class="form-control" placeholder="Tanggal Lahir" aria-label="Tanggal Lahir" aria-describedby="basic-addon1">
                                        </div>
                                    </div>

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

                                    <label class="form-label">Tahun yang ingin dicari</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="number" name="tahun_dicari" class="form-control" id="tahun_dicari" placeholder="Tahun" aria-label="Tahun" aria-describedby="basic-addon1">
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

<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

<!--Morris Chart-->
<script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
    $(document).ready(function() {
        $('input[type=radio]').change(function() {
            if (this.value == 'tanggal_lahir') {
                $('#tanggal_lahir_form').show();
                $('#wewaran_form').hide();
            } else if (this.value == 'wewaran') {
                $('#tanggal_lahir_form').hide();
                $('#wewaran_form').show();
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
            var tanggal_lahir = $('#tanggal_lahir_dicari').val();
            var cari_dengan = $('input[name=cari_dengan]:checked').val();

            if (cari_dengan == 'wewaran' && tahun == '') {
                Swal.fire({
                    title: 'Error!',
                    html: '<b>Tahun</b> harus diisi',
                    icon: 'error',
                    confirmButtonText: 'Cool'
                })
            } else if (cari_dengan == 'tanggal_lahir') {
                if (tahun == '' || tanggal_lahir == '') {
                    Swal.fire({
                        title: 'Error!',
                        html: '<b>Tahun</b> dan <b>Tanggal Lahir</b> harus diisi',
                        icon: 'error',
                        confirmButtonText: 'Cancel'
                    })
                } else {
                    if (new Date(tanggal_lahir) >= new Date()) {
                        Swal.fire({
                            title: 'Error!',
                            html: '<b>Tanggal Lahir</b> tidak boleh lebih dari <b>Tanggal Sekarang</b>',
                            icon: 'error',
                            confirmButtonText: 'Cancel'
                        })
                    } else {
                        var tahun_lahir = new Date(tanggal_lahir).getFullYear().toString();
                        if (tahun < tahun_lahir) {
                            Swal.fire({
                                title: 'Error!',
                                html: '<b>Tahun dicari</b> tidak boleh kurang dari <b>Tanggal Lahir</b>',
                                icon: 'error',
                                confirmButtonText: 'Cancel'
                            })
                        } else {
                            $(this).closest('form').submit();
                        }
                    }
                }
            } else {
                $(this).closest('form').submit();   
            }
        });
    });
</script>

</body>

</html>