@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Riwayat Pembelian"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Riwayat Pembelian", "title" => "Riwayat Pembelian"])

                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-primary">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-1.png); background-size: cover;">
                                    <div class="mini-stat-icon">
                                        <img src="../assets/images/services/servis-vector-white-01.svg" class="float-end" width="100" height="100">
                                    </div>
                                    <div class="text-white">
                                        <div class="pt-4 pb-3">
                                            <h4 class="text-white ps-3">Halaman Riwayat Pembelian</h4>
                                            <p class="text-white text-xs px-3">Halaman ini menampilkan riwayat pembelian Anda. Anda dapat melihat status pembelian Anda di sini.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Produk Aktif -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card z-index-2">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <h5>Produk Aktif</h5>
                                    <p>Berikut adalah produk yang aktif pada akun Anda</p>
                                </div>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table align-items-center justify-content-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Produk</th>
                                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Pembelian</th>
                                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Kadaluarsa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                                @endphp
                                                @if (count($my_active_product) == 0)
                                                <tr>
                                                    <td colspan="5" class="text-center">Anda Belum Membeli Apapun</td>
                                                </tr>
                                                @else
                                                <tr>
                                                    <td>{{ $my_active_product[0]['product_name'] }}</td>
                                                    @php $date_pembelian = date_create($my_active_product[0]['created_at']); $date_pembelian = date_format($date_pembelian, "d") . " " . $bulan[date_format($date_pembelian, "n") - 1] . " " . date_format($date_pembelian, "Y"); @endphp
                                                    <td>{{ $date_pembelian }}</td>
                                                    @php $date_kadaluarsa = date_create($my_active_product[0]['expired_at']); $date_kadaluarsa = date_format($date_kadaluarsa, "d") . " " . $bulan[date_format($date_kadaluarsa, "n") - 1] . " " . date_format($date_kadaluarsa, "Y"); @endphp
                                                    <td>{{ $date_kadaluarsa }}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card z-index-2">
                    <div class="card-body">
                        <div class="row mb-3">
                            <h5>Riwayat Pembelian Anda</h5>
                            <p>Berikut adalah riwayat pembelian Anda</p>
                        </div>
                        <div class="row">
                        <div class="table-responsive">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Produk</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Harga</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Pembelian</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Status Pembelian</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($my_purchases) == 0)
                                    <tr>
                                        <td colspan="5" class="text-center">Anda Belum Membeli Apapun</td>
                                    </tr>
                                    @else
                                    @foreach ($my_purchases as $key => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['product_name'] }}</td>
                                        @if ($item['product_id'] == "member_premium_bulanan_1")
                                        <td>Rp. 5.000</td>
                                        @elseif ($item['product_id'] == "member_premium_tahunan_1")
                                        <td>Rp. 50.000</td>
                                        @endif

                                        @php $date_pembelian = date_create($item['created_at']); $date_pembelian = date_format($date_pembelian, "d") . " " . $bulan[date_format($date_pembelian, "n") - 1] . " " . date_format($date_pembelian, "Y"); @endphp
                                        <td>{{ $date_pembelian }}</td>

                                        <!-- status: authorize, capture, settlement, deny, pending, cancel, refund, partial_refund, chargeback, partial_chargeback, expire, failure -->
                                        @if ($item['status'] == "authorize")
                                        <td><span class="badge bg-warning font-size-12">Sedang Memverifikasi Pembayaran</span></td>
                                        @elseif ($item['status'] == "capture")
                                        <td><span class="badge bg-info font-size-12">Pembayaran Berhasil</span></td>
                                        @elseif ($item['status'] == "settlement")
                                        <td><span class="badge bg-success font-size-12">Transaksi Selesai</span></td>
                                        @elseif ($item['status'] == "deny")
                                        <td><span class="badge bg-danger font-size-12">Transaksi Ditolak</span></td>
                                        @elseif ($item['status'] == "pending")
                                        <td><span class="badge bg-warning font-size-12">Menunggu Pembayaran</span></td>
                                        @elseif ($item['status'] == "cancel")
                                        <td><span class="badge bg-danger font-size-12">Pembelian Dibatalkan</span></td>
                                        @elseif ($item['status'] == "refund")
                                        <td><span class="badge bg-danger font-size-12">Dana Dikembalikan</span></td>
                                        @elseif ($item['status'] == "partial_refund")
                                        <td><span class="badge bg-danger font-size-12">Dana Dikembalikan Sebagian</span></td>
                                        @elseif ($item['status'] == "chargeback")
                                        <td><span class="badge bg-danger font-size-12">Pembelian Dibatalkan. Dana Dikembalikan</span></td>
                                        @elseif ($item['status'] == "partial_chargeback")
                                        <td><span class="badge bg-danger font-size-12">Pembelian Dibatalkan. Dana Dikembalikan Sebagian</span></td>
                                        @elseif ($item['status'] == "expire")
                                        <td><span class="badge bg-danger font-size-12">Link Pembayaran Kadaluarsa</span></td>
                                        @elseif ($item['status'] == "failure")
                                        <td><span class="badge bg-danger font-size-12">Transaksi Gagal</span></td>
                                        @endif

                                        <td>
                                            <a href="https://app.midtrans.com/snap/v4/redirection/{{ $item['purchase_token'] }}" target="_blank" class="btn btn-primary btn-sm">Link Anda</a>
                                        </td>

                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include("partials/vendor-scripts")
<!-- Validation -->
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
    @if(session('success'))
    Swal.fire({
        title: 'Success!',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'Close'
    });
    @elseif(session('error'))
    Swal.fire({
        title: 'Error!',
        text: '{{ session('error') }}',
        icon: 'error',
        confirmButtonText: 'Close'
    });
    @endif
</script>

</body>

</html>