@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Ramalan Sifat"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Ramalan Sifat", "title" => "Ramalan Sifat"])

                <div class="row">
                    <div class="col-md-10">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-danger">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                    <div class="text-white">
                                        <div class="pt-4 pb-3">
                                            <h4 class="text-white ps-3">Halaman Pencarian Ramalan Sifat</h4>
                                            <p class="text-white text-xs px-3">Halaman pencarian ini membantu Anda menentukan watak atau sifat seseorang berdasarkan tanggal lahir yang dicari.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-danger">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                    <div class="mini-stat-icon">
                                        <img src="../assets/images/services/servis-vector-white-04.svg" class="float-end" width="110" height="110">
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

                                <form action="{{ route('cari_ramalan_sifat') }}" method="post">
                                    @csrf

                                    <div id="tanggal_lahir_form">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <div class="input-group input-group-outline mb-3">
                                            <input type="date" name="tanggal_lahir_dicari" class="form-control" id="tanggal_lahir_dicari" placeholder="Tanggal Lahir" aria-label="Tanggal Lahir" aria-describedby="basic-addon1">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" id="btn-submit" class="btn btn-danger btn-soft w-100 mt-4 mb-0">Cari</button>
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
        $(function() {
            $(document).on('click', '#btn-submit', function(e) {
                e.preventDefault();
                var tanggal_lahir = $('#tanggal_lahir_dicari').val();

                if (tanggal_lahir == '') {
                    Swal.fire({
                        title: 'Error!',
                        html: '<b>Tanggal Lahir</b> harus diisi',
                        icon: 'error',
                        confirmButtonText: 'Cancel'
                    })
                } else if (new Date(tanggal_lahir) >= new Date()) {
                    Swal.fire({
                        title: 'Error!',
                        html: '<b>Tanggal Lahir</b> tidak boleh sama atau lebih dari <b>Tanggal Sekarang</b>',
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