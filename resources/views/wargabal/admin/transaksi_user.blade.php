@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Transaksi User"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Transaksi User", "title" => "Transaksi User"])

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
                                            <h4 class="text-white ps-3">Halaman Transaksi User</h4>
                                            <p class="text-white text-xs px-3">Halaman ini berisi informasi transaksi yang dilakukan oleh user</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card z-index-2">
                    <div class="card-body">
                        <div class="row mb-3">
                            <h5>Daftar Transaksi User</h5>
                            <p>Berikut adalah daftar transaksi yang telah dilakukan oleh user</p>
                        </div>

                        <hr class="horizontal light m-0">
                        <div class="row">
                            <div class="card-body">
                                <div class="form-check p-0 mb-3">
                                    <h4 class="card-title">Ambil data pembelian:</h4>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Semua" value="Semua">
                                    <label for="Semua">Semua</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="pending" value="pending">
                                    <label for="pending">Menunggu Pembayaran</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="capture" value="capture">
                                    <label for="capture">Pembayaran Berhasil</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="settlement" value="settlement">
                                    <label for="settlement">Transaksi Selesai</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="expired" value="expired">
                                    <label for="expired">Link Pembayaran Kadaluarsa</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="failure" value="failure">
                                    <label for="failure">Transaksi Gagal</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="cancel" value="cancel">
                                    <label for="cancel">Pembelian Dibatalkan</label>
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal light m-0">

                        <div class="row mt-3">
                        <div class="table-responsive">
                            <table id="datatable" class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Nama User</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Produk</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Harga</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Pembelian</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Status Pembelian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    @endphp

                                    @if (count($daftar_transaksi_user) == 0)
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada transaksi</td>
                                    </tr>
                                    @else
                                    @foreach ($daftar_transaksi_user as $key => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['user']['name'] }}</td>
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
                                        <td id="authorize"><span class="badge bg-warning font-size-12">Sedang Memverifikasi Pembayaran</span></td>
                                        @elseif ($item['status'] == "capture")
                                        <td id="capture"><span class="badge bg-info font-size-12">Pembayaran Berhasil</span></td>
                                        @elseif ($item['status'] == "settlement")
                                        <td id="settlement"><span class="badge bg-success font-size-12">Transaksi Selesai</span></td>
                                        @elseif ($item['status'] == "deny")
                                        <td id="deny"><span class="badge bg-danger font-size-12">Transaksi Ditolak</span></td>
                                        @elseif ($item['status'] == "pending")
                                        <td id="pending"><span class="badge bg-warning font-size-12">Menunggu Pembayaran</span></td>
                                        @elseif ($item['status'] == "cancel")
                                        <td id="cancel"><span class="badge bg-danger font-size-12">Pembelian Dibatalkan</span></td>
                                        @elseif ($item['status'] == "refund")
                                        <td id="refund"><span class="badge bg-danger font-size-12">Dana Dikembalikan</span></td>
                                        @elseif ($item['status'] == "partial_refund")
                                        <td id="partial_refund"><span class="badge bg-danger font-size-12">Dana Dikembalikan Sebagian</span></td>
                                        @elseif ($item['status'] == "chargeback")
                                        <td id="chargeback"><span class="badge bg-danger font-size-12">Pembelian Dibatalkan. Dana Dikembalikan</span></td>
                                        @elseif ($item['status'] == "partial_chargeback")
                                        <td id="partial_chargeback"><span class="badge bg-danger font-size-12">Pembelian Dibatalkan. Dana Dikembalikan Sebagian</span></td>
                                        @elseif ($item['status'] == "expire")
                                        <td id="expire"><span class="badge bg-danger font-size-12">Link Pembayaran Kadaluarsa</span></td>
                                        @elseif ($item['status'] == "failure")
                                        <td id="failure"><span class="badge bg-danger font-size-12">Transaksi Gagal</span></td>
                                        @endif
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
    $(document).ready(function() {
        $("#datatable").DataTable();

        $('input[type=radio][name=inlineRadioOptions]').change(function() {
            if (this.value == 'Semua') {
                $('#datatable').DataTable().search('').draw();
            } else if (this.value == 'pending') {
                $('#datatable').DataTable().search('Menunggu Pembayaran').draw();
            } else if (this.value == 'capture') {
                $('#datatable').DataTable().search('Pembayaran Berhasil').draw();
            } else if (this.value == 'settlement') {
                $('#datatable').DataTable().search('Transaksi Selesai').draw();
            } else if (this.value == 'expired') {
                $('#datatable').DataTable().search('Link Pembayaran Kadaluarsa').draw();
            } else if (this.value == 'failure') {
                $('#datatable').DataTable().search('Transaksi Gagal').draw();
            } else if (this.value == 'cancel') {
                $('#datatable').DataTable().search('Pembelian Dibatalkan').draw();
            }
        });
    });

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