@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Otonan"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Otonan", "title" => "Otonan"])

                @if ($cari_dengan == 'tanggal_lahir')
                <div class="row">
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body">
                                <h5>Data Kelahiran</h5>

                                <div class="row mt-4">
                                    <div class="col-md-12 m-0">
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <div class="card mini-stat bg-primary">
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

                                <div class="modal fade" id="elemen_{{ $tanggal_lahir_dicari }}" tabindex="-1">
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
                                                @foreach ($info_elemen_kalender_bali as $key => $elemen)
                                                @if ($elemen['tanggal'] == $tanggal_lahir_dicari )
                                                <div class="shadow">
                                                    <div class="table-responsive">
                                                        <table class="table align-items-center justify-content-center mb-0">
                                                            @foreach ($elemen['kalender'] as $key => $elemen_kalender_bali)
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
                                                                            <a href="#" class="text-primary" data-loop-iteration="{{ $elemen['tanggal'] }}_{{ $key }}">
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

                                                            <div class="modal fade" id="detail-{{ $elemen['tanggal'] }}_{{ $key }}" tabindex="-1">
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

                                <h5 class="mt-3">Data Otonan Berikutnya</h5>
                                <div class="row mt-4">
                                    <div class="col-md-12 m-0">
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <div class="card mini-stat bg-primary">
                                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-1.png); background-size: cover;">
                                                    <div class="text-white">
                                                        <div class="row">
                                                            <div class="col">
                                                                @php
                                                                $hari = $hari_indonesia[date('N', strtotime($info_otonan['otonan_terdekat_pertama'])) - 1];
                                                                $tanggal = date('d', strtotime($info_otonan['otonan_terdekat_pertama'])) . ' ' . $bulan_indonesia[date('n', strtotime($info_otonan['otonan_terdekat_pertama'])) - 1] . ' ' . date('Y', strtotime($info_otonan['otonan_terdekat_pertama']));
                                                                @endphp
                                                                <h5 class="mt-1 mb-0">{{ $hari }}, {{$tanggal}}</h5>
                                                                <p class="mb-0 font-weight-bold">
                                                                    {{ $info_otonan['perayaan_terdekat_pertama'] }}
                                                                </p>
                                                            </div>
                                                            <div class="col">
                                                                <div id="detail-{{ $info_otonan['otonan_terdekat_pertama'] }}" class="btn text-white d-flex justify-content-end">
                                                                    <p class="text-xs mt-1 mb-0">klik detail</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 m-0">
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <div class="card mini-stat bg-primary">
                                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-1.png); background-size: cover;">
                                                    <div class="text-white">
                                                        <div class="row">
                                                            <div class="col">
                                                                @php
                                                                $hari = $hari_indonesia[date('N', strtotime($info_otonan['otonan_terdekat_kedua'])) - 1];
                                                                $tanggal = date('d', strtotime($info_otonan['otonan_terdekat_kedua'])) . ' ' . $bulan_indonesia[date('n', strtotime($info_otonan['otonan_terdekat_kedua'])) - 1] . ' ' . date('Y', strtotime($info_otonan['otonan_terdekat_kedua']));
                                                                @endphp
                                                                <h5 class="mt-1 mb-0">{{ $hari }}, {{$tanggal}}</h5>
                                                                <p class="mb-0 font-weight-bold">
                                                                    {{ $info_otonan['perayaan_terdekat_kedua'] }}
                                                                </p>
                                                            </div>
                                                            <div class="col">
                                                                <div id="detail-{{ $info_otonan['otonan_terdekat_kedua'] }}" class="btn text-white d-flex justify-content-end">
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

                                <div class="modal fade" id="elemen_{{ $info_otonan['otonan_terdekat_pertama'] }}" tabindex="-1">
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
                                                <div class="shadow">
                                                    <div class="table-responsive">
                                                        <table class="table align-items-center justify-content-center mb-0">
                                                            @foreach ($info_otonan_pertama as $key => $item)
                                                            @foreach ($item['kalender'] as $key => $elemen_kalender_bali)
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
                                                                            <a href="#" class="text-primary" data-loop-iteration="{{ $item['tanggal'] }}_{{ $key }}">
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

                                                            <div class="modal fade" id="detail-{{ $item['tanggal'] }}_{{ $key }}" tabindex="-1">
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
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body directory-card">
                                                <div class="row mt-2">
                                                    <button type="button" class="close-all-modal btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="elemen_{{ $info_otonan['otonan_terdekat_kedua'] }}" tabindex="-1">
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
                                                <div class="shadow">
                                                    <div class="table-responsive">
                                                        <table class="table align-items-center justify-content-center mb-0">
                                                            @foreach ($info_otonan_kedua as $key => $item)
                                                            @foreach ($item['kalender'] as $key => $elemen_kalender_bali)
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
                                                                            <a href="#" class="text-primary" data-loop-iteration="{{ $item['tanggal'] }}_{{ $key }}">
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

                                                            <div class="modal fade" id="detail-{{ $item['tanggal'] }}_{{ $key }}" tabindex="-1">
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
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
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
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mt-3">
                        <a href="{{ route('otonan_page') }}" type="button" class="btn btn-primary mb-2">Kembali</a>
                    </div>
                </div>



                @elseif ($cari_dengan == 'wewaran')
                <div class="row">
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body">

                                <h5 class="mt-3">Data Otonan Berikutnya</h5>
                                <div class="row mt-4">

                                    <div class="col-md-12 m-0">
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <div class="card mini-stat bg-primary">
                                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-1.png); background-size: cover;">
                                                    <div class="text-white">
                                                        <div class="row">
                                                            <div class="col">
                                                                @if ($tanggal_otonan[0] != '-')
                                                                @php
                                                                $hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                                                $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                                                $hari = $hari_indonesia[date('N', strtotime($tanggal_otonan[0])) - 1];
                                                                $tanggal = date('d', strtotime($tanggal_otonan[0])) . ' ' . $bulan_indonesia[date('n', strtotime($tanggal_otonan[0])) - 1] . ' ' . date('Y', strtotime($tanggal_otonan[0]));
                                                                @endphp
                                                                <h5 class="mt-1 mb-2">{{ $hari }}, {{ $tanggal }}</h5>
                                                                <p class="mb-0 font-weight-bold">
                                                                    @foreach ($info_otonan_pertama as $key => $elemen)
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
                                                                <div id="detail-{{ $tanggal_otonan[0] }}" class="btn text-white d-flex justify-content-end">
                                                                    <p class="text-xs mt-1 mb-0">klik detail</p>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <h5 class="mt-1 mb-2">Tidak ada data yang sesuai</h5>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($tanggal_otonan[0] != '-')
                                    @if (count($tanggal_otonan) >= 1)
                                    <div class="col-md-12 m-0">
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <div class="card mini-stat bg-primary">
                                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-1.png); background-size: cover;">
                                                    <div class="text-white">
                                                        <div class="row">
                                                            <div class="col">
                                                                @php
                                                                $hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                                                $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                                                $hari = $hari_indonesia[date('N', strtotime($tanggal_otonan[1])) - 1];
                                                                $tanggal = date('d', strtotime($tanggal_otonan[1])) . ' ' . $bulan_indonesia[date('n', strtotime($tanggal_otonan[1])) - 1] . ' ' . date('Y', strtotime($tanggal_otonan[1]));
                                                                @endphp
                                                                <h5 class="mt-1 mb-2">{{ $hari }}, {{ $tanggal }}</h5>
                                                                <p class="mb-0 font-weight-bold">
                                                                    @foreach ($info_otonan_kedua as $key => $elemen)
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
                                                                <div id="detail-{{ $tanggal_otonan[1] }}" class="btn text-white d-flex justify-content-end">
                                                                    <p class="text-xs mt-1 mb-0">klik detail</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>


                                <div class="modal fade" id="elemen_{{ $tanggal_otonan[0] }}" tabindex="-1">
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
                                                <div class="shadow">
                                                    <div class="table-responsive">
                                                        <table class="table align-items-center justify-content-center mb-0">
                                                            @foreach ($info_otonan_pertama as $key => $item)
                                                            @foreach ($item['kalender'] as $key => $elemen_kalender_bali)
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
                                                                            <a href="#" class="text-primary" data-loop-iteration="{{ $item['tanggal'] }}_{{ $key }}">
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

                                                            <div class="modal fade" id="detail-{{ $item['tanggal'] }}_{{ $key }}" tabindex="-1">
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
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body directory-card">
                                                <div class="row mt-2">
                                                    <button type="button" class="close-all-modal btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="elemen_{{ $tanggal_otonan[1] }}" tabindex="-1">
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
                                                <div class="shadow">
                                                    <div class="table-responsive">
                                                        <table class="table align-items-center justify-content-center mb-0">
                                                            @foreach ($info_otonan_kedua as $key => $item)
                                                            @foreach ($item['kalender'] as $key => $elemen_kalender_bali)
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
                                                                            <a href="#" class="text-primary" data-loop-iteration="{{ $item['tanggal'] }}_{{ $key }}">
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

                                                            <div class="modal fade" id="detail-{{ $item['tanggal'] }}_{{ $key }}" tabindex="-1">
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
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body directory-card">
                                                <div class="row mt-2">
                                                    <button type="button" class="close-all-modal btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{ route('otonan_page') }}" type="button" class="btn btn-primary mb-2">Kembali</a>
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

    var openKalendar = ''; // array untuk menyimpan id kalender yang sedang terbuka
    $(document).ready(function() {
        if ("{{ $cari_dengan }}" == 'wewaran') {
            $('#detail-{{$tanggal_otonan[0] }}').click(function() {
                $('#elemen_{{$tanggal_otonan[0] }}').modal('show');
                openKalendar = 'elemen_{{$tanggal_otonan[0] }}';
            });

            $('#detail-{{$tanggal_otonan[1] }}').click(function() {
                $('#elemen_{{$tanggal_otonan[1] }}').modal('show');
                openKalendar = 'elemen_{{$tanggal_otonan[1] }}';
            });
        } else {
            $('#detail-{{$tanggal_lahir_dicari}}').click(function() {
                $('#elemen_{{$tanggal_lahir_dicari}}').modal('show');
                openKalendar = 'elemen_{{$tanggal_lahir_dicari}}';
            });
            $('#detail-{{ $info_otonan['otonan_terdekat_pertama'] }}').click(function() {
                $('#elemen_{{$info_otonan['otonan_terdekat_pertama'] }}').modal('show');
                openKalendar = 'elemen_{{$info_otonan['otonan_terdekat_pertama'] }}';
            });
            $('#detail-{{$info_otonan['otonan_terdekat_kedua'] }}').click(function() {
                $('#elemen_{{$info_otonan['otonan_terdekat_kedua'] }}').modal('show');
                openKalendar = 'elemen_{{$info_otonan['otonan_terdekat_kedua'] }}';
            });
        }
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