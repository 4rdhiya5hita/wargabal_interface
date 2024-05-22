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
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body">
                                <h5>Data Kelahiran</h5>

                                <div class="row mt-4">
                                    <div class="col-md-12 m-0">
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <div class="card mini-stat bg-danger">
                                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-1.png); background-size: cover;">
                                                    <div class="text-white">
                                                        <div class="row">
                                                            <div class="col">
                                                                @php
                                                                $hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                                                $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                                                $hari = $hari_indonesia[date('N', strtotime($tanggal_lahir_dicari)) - 1];
                                                                $tanggal = date('d', strtotime($tanggal_lahir_dicari)) . ' ' . $bulan_indonesia[date('n', strtotime($tanggal_lahir_dicari)) - 1] . ' ' . date('Y', strtotime($tanggal_lahir_dicari));
                                                                @endphp
                                                                <h5 class="mt-1 mb-2">Lahir pada {{ $hari }}, {{ $tanggal }}</h5>
                                                                <p class="mb-0 font-weight-bold">
                                                                    @foreach ($info_elemen_kalender_bali as $key => $elemen)
                                                                    @foreach ($elemen['kalender'] as $key => $elemen_kalender_bali)
                                                                    @if ($loop->iteration == 11)
                                                                    {{ $elemen_kalender_bali }},
                                                                    @endif
                                                                    @if ($loop->iteration == 7)
                                                                    {{ $elemen_kalender_bali }},
                                                                    @endif
                                                                    @if ($loop->iteration == 9)
                                                                    {{ $elemen_kalender_bali }},
                                                                    @endif
                                                                    @if ($loop->iteration == 15)
                                                                    Wuku {{ $elemen_kalender_bali }}
                                                                    @endif
                                                                    @if ($loop->iteration == 2)
                                                                    sasih {{ $elemen_kalender_bali }},
                                                                    @endif
                                                                    @if ($loop->iteration == 1)
                                                                    Tahun saka {{ $elemen_kalender_bali }}
                                                                    @endif
                                                                    @endforeach
                                                                    @endforeach
                                                                </p>
                                                            </div>
                                                            <div class="col">
                                                                <div id="detail-{{ $tanggal_lahir_dicari }}" class="btn text-white d-flex justify-content-end">
                                                                    <p class="text-xs mt-1 mb-0">klik detail</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 m-0">
                                        <div class="shadow">
                                            <div class="card mini-stat bg-light">
                                                <div class="card-body mini-stat-img">
                                                    <div class="mini-stat-icon">
                                                        <img src="../assets/images/services/servis-vector-danger-04.svg" class="float-end" width="70" height="70">
                                                    </div>
                                                    <h5 class="mb-2">Pancawara: {{ $info_ramalan_sifat['pancawara'] }}</h5>
                                                    <p style="display: none;" id="Pancawara">{{ $info_ramalan_sifat['sifat_pancawara'] }}</p>
                                                    <div class="btn btn-danger" id="btn-Pancawara">lihat penjelasan</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 m-0">
                                        <div class="shadow">
                                            <div class="card mini-stat bg-light">
                                                <div class="card-body mini-stat-img">
                                                    <div class="mini-stat-icon">
                                                        <img src="../assets/images/services/servis-vector-danger-04.svg" class="float-end" width="70" height="70">
                                                    </div>
                                                    <h5 class="mb-2">Saptawara: {{ $info_ramalan_sifat['saptawara'] }}</h5>
                                                    <p style="display: none;" id="Saptawara">{{ $info_ramalan_sifat['sifat_saptawara'] }}</p>
                                                    <div class="btn btn-danger" id="btn-Saptawara">lihat penjelasan</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 m-0">
                                        <div class="shadow">
                                            <div class="card mini-stat bg-light">
                                                <div class="card-body mini-stat-img">
                                                    <div class="mini-stat-icon">
                                                        <img src="../assets/images/services/servis-vector-danger-04.svg" class="float-end" width="70" height="70">
                                                    </div>
                                                    <h5 class="mb-2">Wuku: {{ $info_ramalan_sifat['wuku'] }}</h5>
                                                    <p style="display: none;" id="Wuku">{{ $info_ramalan_sifat['sifat_wuku'] }}</p>
                                                    <div class="btn btn-danger" id="btn-Wuku">lihat penjelasan</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 m-0">
                                        <div class="shadow">
                                            <div class="card mini-stat bg-light">
                                                <div class="card-body mini-stat-img">
                                                    <div class="mini-stat-icon">
                                                        <img src="../assets/images/services/servis-vector-danger-04.svg" class="float-end" width="70" height="70">
                                                    </div>
                                                    <h5 class="mb-2">Zodiak: {{ $info_ramalan_sifat['zodiak'] }}</h5>
                                                    <p style="display: none;" id="Zodiak">{{ $info_ramalan_sifat['sifat_zodiak'] }}</p>
                                                    <div class="btn btn-danger" id="btn-Zodiak">lihat penjelasan</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="elemen_{{ $tanggal_lahir_dicari }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body directory-card">
                                                <div class="directory-bg text-center">
                                                    <div class="directory-overlay" style="background-color: rgba(var(--bs-danger-rgb), 0.7);">
                                                        <h4>
                                                            <span class="text-white font-weight-bold">Detail Elemen Kalender</span>
                                                            <span class="text-white close float-end" data-bs-dismiss="modal" aria-hidden="true">&times;</span>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body p-4">
                                                @foreach ($info_elemen_kalender_bali as $key => $elemen)
                                                @if ($elemen['tanggal'] == $tanggal_lahir_dicari )
                                                <div class="shadow">
                                                    <div class="table-responsive">
                                                        <table class="table align-items-center justify-content-center mb-0">
                                                            @foreach ($elemen['kalender'] as $key => $elemen_kalender_bali)
                                                            @if ($loop->first)
                                                            <tr class="table-danger">
                                                                <th scope="row">Tahun Saka dan Sasih</th>
                                                                <td> </td>
                                                            </tr>
                                                            @elseif ($loop->iteration == 3)
                                                            <tr class="table-danger">
                                                                <th scope="row"> Pengalantaka </th>
                                                                <td> </td>
                                                            </tr>
                                                            @elseif ($loop->iteration == 5)
                                                            <tr class="table-danger">
                                                                <th scope="row"> Wewaran </th>
                                                                <td> </td>
                                                            </tr>
                                                            @elseif ($loop->iteration == 15)
                                                            <tr class="table-danger">
                                                                <th scope="row"> Elemen Lainnya </th>
                                                                <td> </td>
                                                            </tr>
                                                            @endif
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="text-secondary text-xs mt-1 mb-0">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="text-secondary text-xs mt-1 mb-0">{{ $elemen_kalender_bali }}</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                                <div class="modal-body directory-card">
                                                    <div class="row mt-2">
                                                        <button type="button" class="btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mt-3">
                        <a href="{{ route('ramalan_sifat_page') }}" type="button" class="btn btn-danger mb-2">Kembali</a>
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

<!--Morris Chart-->
<script src="assets/libs/morris.js/morris.min.js"></script>
<script src="assets/libs/raphael/raphael.min.js"></script>

<script src="assets/js/pages/dashboard.init.js"></script>

<script src="assets/js/app.js"></script>

<script>
    $(document).ready(function() {
        $('#detail-{{ $tanggal_lahir_dicari }}').click(function() {
            $('#elemen_{{ $tanggal_lahir_dicari }}').modal('show');
        });

        $('#btn-Pancawara').click(function() {
            // ubah style display
            if ($('#Pancawara').css('display') == 'none') {
                $('#btn-Pancawara').text('sembunyikan penjelasan');
                $('#Pancawara').css('display', 'block');
            } else {
                $('#btn-Pancawara').text('lihat penjelasan');
                $('#Pancawara').css('display', 'none');
            }
        });

        $('#btn-Saptawara').click(function() {
            // ubah style display
            if ($('#Saptawara').css('display') == 'none') {
                $('#btn-Saptawara').text('sembunyikan penjelasan');
                $('#Saptawara').css('display', 'block');
            } else {
                $('#btn-Saptawara').text('lihat penjelasan');
                $('#Saptawara').css('display', 'none');
            }
        });

        $('#btn-Wuku').click(function() {
            // ubah style display
            if ($('#Wuku').css('display') == 'none') {
                $('#btn-Wuku').text('sembunyikan penjelasan');
                $('#Wuku').css('display', 'block');
            } else {
                $('#btn-Wuku').text('lihat penjelasan');
                $('#Wuku').css('display', 'none');
            }
        });

        $('#btn-Zodiak').click(function() {
            // ubah style display
            if ($('#Zodiak').css('display') == 'none') {
                $('#btn-Zodiak').text('sembunyikan penjelasan');
                $('#Zodiak').css('display', 'block');
            } else {
                $('#btn-Zodiak').text('lihat penjelasan');
                $('#Zodiak').css('display', 'none');
            }
        });
    });
</script>

</body>

</html>