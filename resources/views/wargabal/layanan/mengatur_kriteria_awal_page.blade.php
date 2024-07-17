@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Mengatur Dewasa"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Mengatur Dewasa", "title" => "Mengatur Dewasa"])

                <div class="row">
                    <div class="col-md-10">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-primary">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                    <div class="text-white">
                                        <div class="pt-4 pb-3">
                                            <h4 class="text-white ps-3">Halaman Mengatur Dewasa</h4>
                                            <p class="text-white text-xs px-3">Halaman pencarian ini membantu Anda mengatur dewasa yang ingin dicari, Anda dapat menambahkan kriteria dewasa yang diinginkan.</p>
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
                                        <img src="../assets/images/services/servis-vector-white-05.svg" class="float-end" width="110" height="110">
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

                                <form action="{{ route('mengatur_kriteria_parameter_page') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label class="form-label">Atur berdasarkan: </label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row mb-3">
                                                <div class="col d-flex justify-content-start">
                                                    <input class="form-check" type="radio" name="cari_dengan" value="kriteria_sendiri" id="kriteria_sendiri" checked>
                                                    <label class="form-check label" for="kriteria_sendiri">Kriteria Sendiri</label>
                                                </div>
                                                <div class="col d-flex justify-content-start">
                                                    <input class="form-check" type="radio" name="cari_dengan" value="template" id="template">
                                                    <label class="form-check label" for="template">Template</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <label class="form-label">Dewasa Ayu</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <select class="form-control" aria-label="Default select example" name="dewasa_ayu" id="dewasa_ayu">
                                            <!-- option yang akan ditampilkan akan diatur melalui JavaScript -->
                                        </select>
                                    </div>


                                    <label class="form-label">Bulan</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <select class="form-control" aria-label="Default select example" name="bulan_dicari" id="bulan_dicari">
                                            @for ($i = 0; $i < count($bulan); $i++) <option value="{{ $bulan[$i] }}">{{ $bulan[$i] }}</option>
                                                @endfor
                                        </select>
                                    </div>

                                    <label class="form-label">Tahun</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <input type="number" name="tahun_dicari" class="form-control" id="tahun_dicari" placeholder="Tahun" aria-label="Tahun" aria-describedby="basic-addon1">
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" id="btn-submit" class="btn btn-primary btn-soft w-100 mt-4 mb-0">Mengatur Parameter</button>
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

    const kriteriaSendiriRadio = document.getElementById('kriteria_sendiri');
    const templateRadio = document.getElementById('template');
    const dewasaAyuSelect = document.getElementById('dewasa_ayu');
    
    // Mendapatkan array dari controller
    const optionDewasa = <?php echo json_encode($template_dewasa); ?>;

    function updateOptions() {
        if (kriteriaSendiriRadio.checked) {
            dewasaAyuSelect.innerHTML = '<option value="sendiri" selected>Sendiri</option>';
        } else if (templateRadio.checked) {
            // Buat option dari array optionDewasa
            const optionsHTML = optionDewasa.map(option => `<option value="${option}">${option}</option>`).join('');
            dewasaAyuSelect.innerHTML = optionsHTML;
        }
    }

    kriteriaSendiriRadio.addEventListener('change', updateOptions);
    templateRadio.addEventListener('change', updateOptions);

    updateOptions();

    $(document).ready(function() {
        $('#bulan_dicari').select2();

        $(function() {
        $(document).on('click', '#btn-submit', function(e) {
            e.preventDefault();
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
    });


</script>

</body>

</html>