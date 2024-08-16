@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Keterangan"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Keterangan"])

                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-primary">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-1.png); background-size: cover;">
                                    <div class="text-white">
                                        <h4 class="text-white ps-3">Halaman Keterangan</h4>
                                        <p class="text-white text-xs px-3">Halaman ini berisikan seluruh keterangan dari setiap Elemen Kalender Bali, Ala Ayuning Dewasa, dan Hari Raya.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <!-- <div class="card">
                            <div class="card-body">

                                <h4 class="card-title"></h4>
                                <p class="card-title-desc">Klik tombol untuk melihat keterangan</p> -->

                                @foreach($keterangan as $key => $keterangan)

                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-3">{{ ucwords(str_replace('_', ' ', $key)) }}</h6>
                                        <p class="card-title-desc">Berikut list keterangan dari Kalender Bali. Klik tombol untuk melihat keterangan</p>
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-3">
                                                <tbody>
                                                    @foreach($keterangan as $value)
                                                    <tr>
                                                        <th style="width: 10%;" scope="row">{{ $loop->iteration }}</th>
                                                        <td style="width: 30%;">{{ ucwords(str_replace('_', ' ', $value)) }}</td>
                                                        <td style="width: 80%;">
                                                            <div class="d-flex flex-wrap">
                                                                <div class="me-2">
                                                                    <a href="{{ route('keterangan_' . $value . '_page') }}" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-plus me-1"></i>Klik Disini Untuk Melihat Keterangan</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            <!-- </div>
                        </div> -->
                    </div>
                    <!-- end col -->

                    <div class="d-flex justify-content-start mt-3">
                        <a href="{{ route('keterangan_page') }}" type="button" class="btn btn-primary mb-2">Kembali</a>
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

<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

<!-- Required datatable js -->
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
    // $(function() {
    //     $(document).on('click', '#btn-submit', function(e) {
    //         e.preventDefault(); // cancel submission
    //         // console.log('submit');
    //         var tahun = $('#tahun_dicari').val();

    //         if (tahun == '') {
    //             Swal.fire({
    //                 title: 'Error!',
    //                 html: '<b>Tahun</b> harus diisi',
    //                 icon: 'error',
    //                 confirmButtonText: 'Cancel'
    //             })
    //         } else {
    //             $(this).closest('form').submit();
    //         }
    //     });
    // });
</script>

</body>

</html>