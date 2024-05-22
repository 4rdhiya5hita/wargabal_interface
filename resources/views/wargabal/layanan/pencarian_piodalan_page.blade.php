@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Piodalan"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Piodalan", "title" => "Piodalan"])

                @if($cari_dengan == 'wewaran')

                <div class="row">
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body">

                                <h5 class="mt-3">Data Piodalan Pada {{ $wewaran_dicari }}</h5>
                                <div class="container m-0 p-0">
                                    <div class="row">
                                        @if ($item_piodalan != null)
                                        @foreach ($item_piodalan as $key => $item)

                                        @php
                                        $hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                        $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        $hari = $hari_indonesia[date('N', strtotime($item['tanggal'])) - 1];
                                        $tanggal = date('d', strtotime($item['tanggal'])) . ' ' . $bulan_indonesia[date('n', strtotime($item['tanggal'])) - 1] . ' ' . date('Y', strtotime($item['tanggal']));
                                        @endphp

                                        <div class="col-md-6">
                                            <div class="card bg-transparent shadow-none mb-0">
                                                <div class="card mini-stat bg-danger">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                        <div class="mini-stat-icon">
                                                            <img src="../assets/images/services/servis-vector-white-01.svg" class="float-end" width="70" height="70">
                                                        </div>
                                                        <div class="text-white">
                                                            <div class="pt-4 pb-3">
                                                                <h5 class="mt-1 mb-0">{{ $hari }}, {{ $tanggal }}</h5>
                                                                <p class="mb-3 font-weight-bold">{{ $item['hari'] }}</p>
                                                                @foreach ($item['pura'] as $pura)
                                                                <span class="badge bg-light"> </span><span class="mx-2">{{ $pura['nama_pura'] }}</span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div id="detail-{{ $item['tanggal'] }}" class="btn text-white d-flex justify-content-end">
                                                            <p class="text-xs mt-1 mb-0">klik detail</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="elemen_{{ $item['tanggal'] }}" tabindex="-1">
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
                                                            @foreach ($item_kalender as $key => $kalender)
                                                            @if ($kalender[0]['tanggal'] == $item['tanggal'])
                                                            <div class="shadow">
                                                                <div class="table-responsive">
                                                                    <table class="table align-items-center justify-content-center mb-0">
                                                                        @foreach ($kalender[0]['kalender'] as $key => $elemen_kalender_bali)
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
                                                        </div>
                                                        <div class="modal-body directory-card">
                                                            <div class="row mt-2">
                                                                <button type="button" class="btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="col-md-6 my-2">
                                            <div class="card bg-transparent shadow-none mb-0">
                                                <div class="card mini-stat bg-danger">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                        <div class="mini-stat-icon">
                                                            <img src="../assets/images/services/servis-vector-white-01.svg" class="float-end" width="70" height="70">
                                                        </div>
                                                        <div class="text-white">
                                                            <div class="pt-4 pb-3">
                                                                <h5 class="mt-1 mb-0">Tidak ada piodalan</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mt-3">
                        <a href="{{ route('piodalan_page') }}" type="button" class="btn btn-danger mb-2">Kembali</a>
                    </div>
                </div>

                @elseif($cari_dengan == 'bulan')

                <div class="row">
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body">

                                <h5 class="mt-3">Data Piodalan Bulan {{ $bulan }}</h5>
                                <div class="container m-0 p-0">
                                    <div class="row">
                                        @if ($item_piodalan != null)
                                        @foreach ($item_piodalan as $key => $item)

                                        @php
                                        $hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                        $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        $hari = $hari_indonesia[date('N', strtotime($item['tanggal'])) - 1];
                                        $tanggal = date('d', strtotime($item['tanggal'])) . ' ' . $bulan_indonesia[date('n', strtotime($item['tanggal'])) - 1] . ' ' . date('Y', strtotime($item['tanggal']));
                                        @endphp

                                        <div class="col-md-6">
                                            <div class="card bg-transparent shadow-none mb-0">
                                                <div class="card mini-stat bg-danger">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                        <div class="mini-stat-icon">
                                                            <img src="../assets/images/services/servis-vector-white-01.svg" class="float-end" width="70" height="70">
                                                        </div>
                                                        <div class="text-white">
                                                            <div class="pt-4 pb-3">
                                                                <h5 class="mt-1 mb-0">{{ $hari }}, {{ $tanggal }}</h5>
                                                                <p class="mb-3 font-weight-bold">{{ $item['hari'] }}</p>
                                                                @foreach ($item['pura'] as $pura)
                                                                <span class="badge bg-light"> </span><span class="mx-2">{{ $pura['nama_pura'] }}</span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div id="detail-{{ $item['tanggal'] }}" class="btn text-white d-flex justify-content-end">
                                                            <p class="text-xs mt-1 mb-0">klik detail</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="elemen_{{ $item['tanggal'] }}" tabindex="-1">
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
                                                            @foreach ($item_kalender as $key => $kalender)
                                                            @if ($kalender[0]['tanggal'] == $item['tanggal'])
                                                            <div class="shadow">
                                                                <div class="table-responsive">
                                                                    <table class="table align-items-center justify-content-center mb-0">
                                                                        @foreach ($kalender[0]['kalender'] as $key => $elemen_kalender_bali)
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
                                                        </div>
                                                        <div class="modal-body directory-card">
                                                            <div class="row mt-2">
                                                                <button type="button" class="btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="col-md-6 my-2">
                                            <div class="card bg-transparent shadow-none mb-0">
                                                <div class="card mini-stat bg-danger">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                        <div class="mini-stat-icon">
                                                            <img src="../assets/images/services/servis-vector-white-01.svg" class="float-end" width="70" height="70">
                                                        </div>
                                                        <div class="text-white">
                                                            <div class="pt-4 pb-3">
                                                                <h5 class="mt-1 mb-0">Tidak ada piodalan</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mt-3">
                        <a href="{{ route('piodalan_page') }}" type="button" class="btn btn-danger mb-2">Kembali</a>
                    </div>
                </div>

                @elseif($cari_dengan == 'pura')

                <div class="row">
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body">

                                <h5 class="mt-3">Data Piodalan Berikutnya</h5>
                                <div class="container m-0 p-0">
                                    <div class="row">
                                        @if ($item_piodalan != null)
                                        @foreach ($item_piodalan as $key => $item)
                                        @if ($item['pura'] != '-')

                                        @php
                                        $hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                        $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        $hari = $hari_indonesia[date('N', strtotime($item['tanggal'])) - 1];
                                        $tanggal = date('d', strtotime($item['tanggal'])) . ' ' . $bulan_indonesia[date('n', strtotime($item['tanggal'])) - 1] . ' ' . date('Y', strtotime($item['tanggal']));
                                        @endphp

                                        <div class="col-md-6">
                                            <div class="card bg-transparent shadow-none mb-0">
                                                <div class="card mini-stat bg-danger">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                        <div class="mini-stat-icon">
                                                            <img src="../assets/images/services/servis-vector-white-01.svg" class="float-end" width="70" height="70">
                                                        </div>
                                                        <div class="text-white">
                                                            <div class="pt-4 pb-3">
                                                                <h5 class="mt-1 mb-0">{{ $hari }}, {{ $tanggal }}</h5>
                                                                <p class="mb-3 font-weight-bold">{{ $item['hari'] }}</p>
                                                                <h4 class="mb-0">{{ $pura_dicari }}</h4>
                                                            </div>
                                                        </div>
                                                        <div id="detail-{{ $item['tanggal'] }}" class="btn text-white d-flex justify-content-end">
                                                            <p class="text-xs mt-1 mb-0">klik detail</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="modal fade" id="elemen_{{ $item['tanggal'] }}" tabindex="-1">
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
                                                            @foreach ($item_kalender as $key => $kalender)
                                                            @if ($kalender[0]['tanggal'] == $item['tanggal'])
                                                            <div class="shadow">
                                                                <div class="table-responsive">
                                                                    <table class="table align-items-center justify-content-center mb-0">
                                                                        @foreach ($kalender[0]['kalender'] as $key => $elemen_kalender_bali)
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
                                                        </div>
                                                        <div class="modal-body directory-card">
                                                            <div class="row mt-2">
                                                                <button type="button" class="btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="col-md-6 my-2">
                                            <div class="card bg-transparent shadow-none mb-0">
                                                <div class="card mini-stat bg-danger">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                        <div class="mini-stat-icon">
                                                            <img src="../assets/images/services/servis-vector-white-01.svg" class="float-end" width="70" height="70">
                                                        </div>
                                                        <div class="text-white">
                                                            <div class="pt-4 pb-3">
                                                                <h5 class="mt-1 mb-0">Tidak ada piodalan</h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mt-3">
                        <a href="{{ route('piodalan_page') }}" type="button" class="btn btn-danger mb-2">Kembali</a>
                    </div>
                </div>

                @endif

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
    function showElement(tanggal) {
        var elemen = document.getElementById('elemen_' + tanggal);
        if (elemen) {
            if (elemen.hidden) {
                elemen.hidden = false;
            } else {
                elemen.hidden = true;
            }
        }
    }

    function showDetailKeterangan() {
        var detail_keterangan = document.getElementById('detail_keterangan');
        if (detail_keterangan) {
            if (detail_keterangan.hidden) {
                detail_keterangan.hidden = false;
            } else {
                detail_keterangan.hidden = true;
            }
        }
    }

    $(document).ready(function() {
        @foreach($item_piodalan as $key => $item)
        $('#detail-{{$item['tanggal']}}').click(function() {
            $('#elemen_{{$item['tanggal']}}').modal('show');
        });
        @endforeach

        // show detail tanggal dicari
        $('#detail-tanggal').click(function() {
            $('#elemen_tanggal').modal('show');
        });
    });
</script>

</body>

</html>