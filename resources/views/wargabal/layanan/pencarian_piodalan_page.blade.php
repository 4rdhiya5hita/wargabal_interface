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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Layanan", "title" => "Piodalan"])

                @if($cari_dengan == 'wewaran')

                <div class="row">
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body">

                                <h5 class="mt-3">Data Piodalan Pada {{ $wewaran_dicari }}</h5>
                                <div class="container m-0 p-0">
                                    <div class="row mt-4">
                                        @if ($item_piodalan != null)
                                        @foreach ($item_piodalan as $key => $item)

                                        @php
                                        $hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                        $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        $hari = $hari_indonesia[date('N', strtotime($item['tanggal'])) - 1];
                                        $tanggal = date('d', strtotime($item['tanggal'])) . ' ' . $bulan_indonesia[date('n', strtotime($item['tanggal'])) - 1] . ' ' . date('Y', strtotime($item['tanggal']));
                                        @endphp

                                        <div class="col-md-12 m-0">
                                            <div class="card bg-transparent shadow-none mb-0">
                                                <div class="card mini-stat bg-primary">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                        <div class="mini-stat-icon">
                                                            <img src="../assets/images/services/servis-vector-white-03.svg" class="float-end" width="70" height="70">
                                                        </div>
                                                        <div class="text-white">
                                                            <div>
                                                                <h5 class="mt-1 mb-0">{{ $hari }}, {{ $tanggal }}</h5>
                                                                <p class="mb-3 font-weight-bold">{{ $item['hari'] }}</p>
                                                                
                                                                <!-- @foreach ($item['pura'] as $pura)
                                                                <span class="badge bg-light"> </span><span class="mx-2 font-size-16">{{ $pura['nama_pura'] }}</span>
                                                                @endforeach -->
                                                            </div>
                                                        </div>
                                                        <div id="list-pura-{{ $item['tanggal'] }}" class="btn btn-light">
                                                            <p class="m-0">List Pura</p>
                                                        </div>
                                                        <div id="detail-{{ $item['tanggal'] }}" class="btn btn-light">
                                                            <p class="m-0">Detail Tanggal</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="list-pura-item-{{ $item['tanggal'] }}" class="card bg-transparent shadow-none mb-0" style="display: none;">
                                                <div class="card mini-stat">
                                                    <div class="table-responsive">
                                                        <table class="table align-items-center justify-content-center mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">Nama Pura</th>
                                                                    <th scope="col">Link Halaman Piodalan Pura</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach ($item['pura'] as $pura)
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $pura['nama_pura'] }}</td>
                                                                    @if (isset(session('user')['permission']))
                                                                    <td><a href="{{ route('piodalan_pura_page', ['id' => $pura['id_pura']]) }}" class="btn btn-primary">Piodalan Pura oleh User</a></td>
                                                                    @else
                                                                    <td><a href="{{ route('login_page') }}" class="btn btn-primary">Piodalan Pura oleh User</a></td>
                                                                    @endif
                                                                </tr>
                                                            </tbody>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="elemen_{{ $item['tanggal'] }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body directory-card">
                                                            <div class="directory-bg text-center">
                                                                <div class="directory-overlay" style="background-color: rgba(var(--bs-primary-rgb), 0.7);">
                                                                    <h4>
                                                                        <span class="text-white font-weight-bold">Detail Elemen Kalender</span>
                                                                        <a href="#" class="text-white close float-end icon-close-modal" data-bs-dismiss="modal" aria-hidden="true">
                                                                            <i class="mdi mdi-close"></i>
                                                                        </a>
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
                                                                        <tr class="table-primary">
                                                                            <th scope="row">Tahun Saka dan Sasih</th>
                                                                            <td> </td>
                                                                        </tr>
                                                                        @elseif ($loop->iteration == 3)
                                                                        <tr class="table-primary">
                                                                            <th scope="row"> Pengalantaka </th>
                                                                            <td> </td>
                                                                        </tr>
                                                                        @elseif ($loop->iteration == 5)
                                                                        <tr class="table-primary">
                                                                            <th scope="row"> Wewaran </th>
                                                                            <td> </td>
                                                                        </tr>
                                                                        @elseif ($loop->iteration == 15)
                                                                        <tr class="table-primary">
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
                                                                                <div class="row">
                                                                                    <div class="col d-flex align-items-center">
                                                                                        <span class="text-secondary text-xs mt-1 mb-0">{{ $elemen_kalender_bali }}</span>
                                                                                    </div>
                                                                                    <div class="col d-flex align-items-center justify-content-end">
                                                                                        <a href="#" class="text-primary" data-loop-iteration="{{ $kalender[0]['tanggal'] }}_{{ $key }}">
                                                                                            @foreach($keterangan as $k => $ket)
                                                                                            @if($k == $key && $ket != null)
                                                                                            @foreach($ket as $value)
                                                                                            @if(strtolower($value['nama']) == strtolower($elemen_kalender_bali) && $value['keterangan'] != null)
                                                                                            <i class="mdi mdi-arrow-right"></i>
                                                                                            @endif
                                                                                            @endforeach
                                                                                            @endif
                                                                                            @endforeach
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>

                                                                        <div class="modal fade" id="detail-{{ $kalender[0]['tanggal'] }}_{{ $key }}" tabindex="-1">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-body directory-card">
                                                                                        <div class="directory-bg text-center">
                                                                                            <div class="p-2" style="background-color: rgba(var(--bs-primary-rgb), 0.7);">
                                                                                                <h4 class="mt-2">
                                                                                                    <span class="text-white font-weight-bold">{{ $elemen_kalender_bali }}</span>
                                                                                                    <a href="#" class="text-white close float-end icon-close-detail" data-bs-dismiss="modal" aria-hidden="true">
                                                                                                        <i class="mdi mdi-close"></i>
                                                                                                    </a>
                                                                                                </h4>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-body pt-0">
                                                                                        <div class="shadow p-4">
                                                                                            <div class="table-responsive">
                                                                                                <h5>Penjelasan:</h5>
                                                                                                @foreach($keterangan as $k => $ket)
                                                                                                @if($k == $key && $ket != null)
                                                                                                @foreach($ket as $value)
                                                                                                @if(strtolower($value['nama']) == strtolower($elemen_kalender_bali))
                                                                                                <span class="text-secondary font-size-14 mt-1 mb-0">{{ $value['keterangan'] }}</span>
                                                                                                @endif
                                                                                                @endforeach
                                                                                                @endif
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="modal-body directory-card">
                                                            <div class="row mt-2">
                                                                <button type="button" class="close-all-modal btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
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
                                                <div class="card mini-stat bg-primary">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                        <div class="mini-stat-icon">
                                                            <img src="../assets/images/services/servis-vector-white-03.svg" class="float-end" width="70" height="70">
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
                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{ route('piodalan_page') }}" type="button" class="btn btn-primary mb-2">Kembali</a>
                        </div>

                    </div>
                </div>

                @elseif($cari_dengan == 'bulan')

                <div class="row">
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body">

                                <h5 class="mt-3">Data Piodalan Bulan {{ $bulan }}</h5>
                                <div class="container m-0 p-0">
                                    <div class="row mt-4">
                                        @if ($item_piodalan != null)
                                        @foreach ($item_piodalan as $key => $item)

                                        @php
                                        $hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                        $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        $hari = $hari_indonesia[date('N', strtotime($item['tanggal'])) - 1];
                                        $tanggal = date('d', strtotime($item['tanggal'])) . ' ' . $bulan_indonesia[date('n', strtotime($item['tanggal'])) - 1] . ' ' . date('Y', strtotime($item['tanggal']));
                                        @endphp

                                        <div class="col-md-12 m-0">
                                            <div class="card bg-transparent shadow-none mb-0">
                                                <div class="card mini-stat bg-primary">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                        <div class="mini-stat-icon">
                                                            <img src="../assets/images/services/servis-vector-white-03.svg" class="float-end" width="70" height="70">
                                                        </div>
                                                        <div class="text-white">
                                                            <div>
                                                                <h5 class="mt-1 mb-0">{{ $hari }}, {{ $tanggal }}</h5>
                                                                <p class="mb-3 font-weight-bold">{{ $item['hari'] }}</p>
                                                                <!-- @foreach ($item['pura'] as $pura)
                                                                <span class="badge bg-light"> </span><span class="mx-2 font-size-16">{{ $pura['nama_pura'] }}</span>
                                                                @endforeach -->
                                                            </div>
                                                        </div>
                                                        <div id="list-pura-{{ $item['tanggal'] }}" class="btn btn-light">
                                                            <p class="m-0">List Pura</p>
                                                        </div>
                                                        <div id="detail-{{ $item['tanggal'] }}" class="btn btn-light">
                                                            <p class="m-0">Detail Tanggal</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="list-pura-item-{{ $item['tanggal'] }}" class="card bg-transparent shadow-none mb-0" style="display: none;">
                                                <div class="card mini-stat">
                                                    <div class="table-responsive">
                                                        <table class="table align-items-center justify-content-center mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">Nama Pura</th>
                                                                    <th scope="col">Link Halaman Piodalan Pura</th>
                                                                </tr>
                                                            </thead>
                                                            @foreach ($item['pura'] as $pura)
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $pura['nama_pura'] }}</td>
                                                                    @if (isset(session('user')['permission']))
                                                                    <td><a href="{{ route('piodalan_pura_page', ['id' => $pura['id_pura']]) }}" class="btn btn-primary">Piodalan Pura oleh User</a></td>
                                                                    @else
                                                                    <td><a href="{{ route('login_page') }}" class="btn btn-primary">Piodalan Pura oleh User</a></td>
                                                                    @endif
                                                                </tr>
                                                            </tbody>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="elemen_{{ $item['tanggal'] }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-body directory-card">
                                                            <div class="directory-bg text-center">
                                                                <div class="directory-overlay" style="background-color: rgba(var(--bs-primary-rgb), 0.7);">
                                                                    <h4>
                                                                        <span class="text-white font-weight-bold">Detail Elemen Kalender</span>
                                                                        <a href="#" class="text-white close float-end icon-close-modal" data-bs-dismiss="modal" aria-hidden="true">
                                                                            <i class="mdi mdi-close"></i>
                                                                        </a>
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
                                                                        <tr class="table-primary">
                                                                            <th scope="row">Tahun Saka dan Sasih</th>
                                                                            <td> </td>
                                                                        </tr>
                                                                        @elseif ($loop->iteration == 3)
                                                                        <tr class="table-primary">
                                                                            <th scope="row"> Pengalantaka </th>
                                                                            <td> </td>
                                                                        </tr>
                                                                        @elseif ($loop->iteration == 5)
                                                                        <tr class="table-primary">
                                                                            <th scope="row"> Wewaran </th>
                                                                            <td> </td>
                                                                        </tr>
                                                                        @elseif ($loop->iteration == 15)
                                                                        <tr class="table-primary">
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
                                                                                <div class="row">
                                                                                    <div class="col d-flex align-items-center">
                                                                                        <span class="text-secondary text-xs mt-1 mb-0">{{ $elemen_kalender_bali }}</span>
                                                                                    </div>
                                                                                    <div class="col d-flex align-items-center justify-content-end">
                                                                                        <a href="#" class="text-primary" data-loop-iteration="{{ $kalender[0]['tanggal'] }}_{{ $key }}">
                                                                                            @foreach($keterangan as $k => $ket)
                                                                                            @if($k == $key && $ket != null)
                                                                                            @foreach($ket as $value)
                                                                                            @if(strtolower($value['nama']) == strtolower($elemen_kalender_bali) && $value['keterangan'] != null)
                                                                                            <i class="mdi mdi-arrow-right"></i>
                                                                                            @endif
                                                                                            @endforeach
                                                                                            @endif
                                                                                            @endforeach
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>

                                                                        <div class="modal fade" id="detail-{{ $kalender[0]['tanggal'] }}_{{ $key }}" tabindex="-1">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-body directory-card">
                                                                                        <div class="directory-bg text-center">
                                                                                            <div class="p-2" style="background-color: rgba(var(--bs-primary-rgb), 0.7);">
                                                                                                <h4 class="mt-2">
                                                                                                    <span class="text-white font-weight-bold">{{ $elemen_kalender_bali }}</span>
                                                                                                    <a href="#" class="text-white close float-end icon-close-detail" data-bs-dismiss="modal" aria-hidden="true">
                                                                                                        <i class="mdi mdi-close"></i>
                                                                                                    </a>
                                                                                                </h4>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-body pt-0">
                                                                                        <div class="shadow p-4">
                                                                                            <div class="table-responsive">
                                                                                                <h5>Penjelasan:</h5>
                                                                                                @foreach($keterangan as $k => $ket)
                                                                                                @if($k == $key && $ket != null)
                                                                                                @foreach($ket as $value)
                                                                                                @if(strtolower($value['nama']) == strtolower($elemen_kalender_bali))
                                                                                                <span class="text-secondary font-size-14 mt-1 mb-0">{{ $value['keterangan'] }}</span>
                                                                                                @endif
                                                                                                @endforeach
                                                                                                @endif
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="modal-body directory-card">
                                                            <div class="row mt-2">
                                                                <button type="button" class="close-all-modal btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
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
                                                <div class="card mini-stat bg-primary">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                        <div class="mini-stat-icon">
                                                            <img src="../assets/images/services/servis-vector-white-03.svg" class="float-end" width="70" height="70">
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
                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{ route('piodalan_page') }}" type="button" class="btn btn-primary mb-2">Kembali</a>
                        </div>

                    </div>
                </div>

                @elseif($cari_dengan == 'pura')

                <div class="row">
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body">

                                <h5 class="mt-3">Data Piodalan Berikutnya</h5>
                                <div class="container m-0 p-0">
                                    <div class="row mt-4">
                                        @if ($item_piodalan != null)
                                        @foreach ($item_piodalan as $key => $item)
                                        @if ($item['pura'] != '-')

                                        @php
                                        $hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                        $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        $hari = $hari_indonesia[date('N', strtotime($item['tanggal'])) - 1];
                                        $tanggal = date('d', strtotime($item['tanggal'])) . ' ' . $bulan_indonesia[date('n', strtotime($item['tanggal'])) - 1] . ' ' . date('Y', strtotime($item['tanggal']));
                                        @endphp

                                        <div class="col-md-12">
                                            <div class="card bg-transparent shadow-none mb-0">
                                                <div class="card mini-stat bg-primary">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                        <div class="mini-stat-icon">
                                                            <img src="../assets/images/services/servis-vector-white-03.svg" class="float-end" width="70" height="70">
                                                        </div>
                                                        <div class="text-white mb-3">
                                                            <div>
                                                                <h5 class="mt-1 mb-0">{{ $hari }}, {{ $tanggal }}</h5>
                                                                <p class="mb-3 font-weight-bold">{{ $item['hari'] }}</p>
                                                                <h4 class="mb-0">{{ $pura_dicari }}</h4>
                                                            </div>
                                                        </div>
                                                        <a href="{{ route('piodalan_pura_page', ['id' => $pura_id_dicari]) }}" class="btn btn-light">Piodalan Pura oleh User</a>
                                                        <div id="detail-{{ $item['tanggal'] }}" class="btn btn-light">
                                                            <p class="m-0">Detail Tanggal</p>
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
                                                                <div class="directory-overlay" style="background-color: rgba(var(--bs-primary-rgb), 0.7);">
                                                                    <h4>
                                                                        <span class="text-white font-weight-bold">Detail Elemen Kalender</span>
                                                                        <a href="#" class="text-white close float-end icon-close-modal" data-bs-dismiss="modal" aria-hidden="true">
                                                                            <i class="mdi mdi-close"></i>
                                                                        </a>
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
                                                                        <tr class="table-primary">
                                                                            <th scope="row">Tahun Saka dan Sasih</th>
                                                                            <td> </td>
                                                                        </tr>
                                                                        @elseif ($loop->iteration == 3)
                                                                        <tr class="table-primary">
                                                                            <th scope="row"> Pengalantaka </th>
                                                                            <td> </td>
                                                                        </tr>
                                                                        @elseif ($loop->iteration == 5)
                                                                        <tr class="table-primary">
                                                                            <th scope="row"> Wewaran </th>
                                                                            <td> </td>
                                                                        </tr>
                                                                        @elseif ($loop->iteration == 15)
                                                                        <tr class="table-primary">
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
                                                                                <div class="row">
                                                                                    <div class="col d-flex align-items-center">
                                                                                        <span class="text-secondary text-xs mt-1 mb-0">{{ $elemen_kalender_bali }}</span>
                                                                                    </div>
                                                                                    <div class="col d-flex align-items-center justify-content-end">
                                                                                        <a href="#" class="text-primary" data-loop-iteration="{{ $kalender[0]['tanggal'] }}_{{ $key }}">
                                                                                            @foreach($keterangan as $k => $ket)
                                                                                            @if($k == $key && $ket != null)
                                                                                            @foreach($ket as $value)
                                                                                            @if(strtolower($value['nama']) == strtolower($elemen_kalender_bali) && $value['keterangan'] != null)
                                                                                            <i class="mdi mdi-arrow-right"></i>
                                                                                            @endif
                                                                                            @endforeach
                                                                                            @endif
                                                                                            @endforeach
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>

                                                                        <div class="modal fade" id="detail-{{ $kalender[0]['tanggal'] }}_{{ $key }}" tabindex="-1">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-body directory-card">
                                                                                        <div class="directory-bg text-center">
                                                                                            <div class="p-2" style="background-color: rgba(var(--bs-primary-rgb), 0.7);">
                                                                                                <h4 class="mt-2">
                                                                                                    <span class="text-white font-weight-bold">{{ $elemen_kalender_bali }}</span>
                                                                                                    <a href="#" class="text-white close float-end icon-close-detail" data-bs-dismiss="modal" aria-hidden="true">
                                                                                                        <i class="mdi mdi-close"></i>
                                                                                                    </a>
                                                                                                </h4>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-body pt-0">
                                                                                        <div class="shadow p-4">
                                                                                            <div class="table-responsive">
                                                                                                <h5>Penjelasan:</h5>
                                                                                                @foreach($keterangan as $k => $ket)
                                                                                                @if($k == $key && $ket != null)
                                                                                                @foreach($ket as $value)
                                                                                                @if(strtolower($value['nama']) == strtolower($elemen_kalender_bali))
                                                                                                <span class="text-secondary font-size-14 mt-1 mb-0">{{ $value['keterangan'] }}</span>
                                                                                                @endif
                                                                                                @endforeach
                                                                                                @endif
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="modal-body directory-card">
                                                            <div class="row mt-2">
                                                                <button type="button" class="close-all-modal btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
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
                                                <div class="card mini-stat bg-primary">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                        <div class="mini-stat-icon">
                                                            <img src="../assets/images/services/servis-vector-white-03.svg" class="float-end" width="70" height="70">
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
                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{ route('piodalan_page') }}" type="button" class="btn btn-primary mb-2">Kembali</a>
                        </div>
                        
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
<script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>

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

    var info_piodalan = @json($item_piodalan);
    @foreach($item_piodalan as $key => $item)
        $('#list-pura-{{$item['tanggal']}}').click(function() {
            $('#list-pura-item-{{$item['tanggal']}}').toggle();
        });
    @endforeach

    var openKalendar = ''; // array untuk menyimpan id kalender yang sedang terbuka
    $(document).ready(function() {
        @foreach($item_piodalan as $key => $item)
        $('#detail-{{$item['tanggal']}}').click(function() {
            $('#elemen_{{$item['tanggal']}}').modal('show');
            openKalendar = 'elemen_{{$item['tanggal']}}';
        });
        @endforeach

        // show detail tanggal dicari
        $('#detail-tanggal').click(function() {
            $('#elemen_tanggal').modal('show');
        });
    });

    var openModal = []; // array untuk menyimpan id modal yang sedang terbuka
    $(document).ready(function() {
        $('a[data-loop-iteration]').click(function(event) {
            event.preventDefault(); // Mencegah tindakan default dari anchor link
            var loopIteration = $(this).data('loop-iteration');
            var modalId = 'detail-' + loopIteration;
            openModal.push(modalId); // tambahkan openModal baru ke array

            if (openModal.length > 1) {
                // jika ada lebih dari 1 modal yang terbuka, maka sembunyikan modal yang pertama
                $('#' + openModal[0]).modal('hide');
                openModal.shift(); // hapus openModal pertama dari array
            }
            $('#' + modalId).modal('show');

            // modal pada openKalendar dibuat agar mengecil dengan mengubah style heightnya
            $('#' + openKalendar).css('height', 0);

            // $('.icon-close-modal').hide();
        });

        $('.icon-close-detail').click(function() {
            $('#' + openKalendar).css('height', '100%');
            // $('.icon-close-modal').show();
        });

        // $('.close-all-modal').click(function() {
        //     for (var i = 0; i < openModal.length; i++) {
        //         $('#' + openModal[i]).modal('hide');
        //     }
        //     openModal = [];
        //     $('.icon-close-modal').show();
        // });
    });
</script>

</body>

</html>