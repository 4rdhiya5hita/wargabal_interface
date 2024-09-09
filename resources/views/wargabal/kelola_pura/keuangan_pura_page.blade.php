@include("partials/main")

<head>
    <base href="/">

    @include("partials/title-meta", ["title" => "Keuangan Pura"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Kelola Pura", "title" => "Keuangan Pura"])

                <div class="row">
                    <div class="col-md-10">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-primary">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                    <div class="text-white">
                                        <div class="pt-4 pb-3">
                                            <h4 class="text-white ps-3">{{ $info_pura['name'] }}</h4>
                                            <p class="text-white text-xs px-3">{{ $info_pura['address'] }}, {{ $info_pura['city'] }}, {{ $info_pura['province'] }}, {{ $info_pura['country'] }}</p>
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
                                        <img src="../assets/images/services/servis-vector-white-01.svg" class="float-end" width="110" height="110">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card z-index-2 ">
                            <div class="card-body">
                                <div id="tanggal_piodalan_pura_form">
                                    <label class="form-label">Cari Keuangan Pura</label>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="form-label">item</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <select class="form-select" id="item_keuangan_pura" name="item_keuangan_pura">
                                                    <option value="Semua">Semua</option>
                                                    @foreach($item_keuangan as $key => $value)
                                                        <option value="{{ $value }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label">Tahun</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="number" class="form-control" id="tahun_keuangan_pura" name="tahun_keuangan_pura" value="{{ date('Y') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label text-white">.</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <button id="cari_keuangan_pura" class="btn btn-primary w-100">
                                                    <i class="mdi mdi-search me-1"></i> Cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card z-index-2 ">
                            <div class="card-body">
                                <h5 class="mt-1 mb-3">Daftar Keuangan Pura</h5>
                                <p class="mb-0">Daftar berikut merupakan manajemen keuangan yang dimiliki dan diautr oleh penanggungjawab pura.</p>
                                @if ($cek_pura_user == true)
                                <button type="button" class="btn btn-primary waves-effect waves-light mt-3" data-bs-toggle="modal" data-bs-target="#createKeuanganPuraModal">
                                    <i class="mdi mdi-plus"></i> Tambah Keuangan Pura
                                </button>
                                @elseif ($cek_pura_user == false && isset(session('user')['permission']))
                                <button type="button" class="btn btn-warning waves-effect waves-light mt-3" onclick="isPremium('{{ session('user')['permission'] }}')">
                                    <i class="mdi mdi-pencil"></i> Ajukan Edit Keuangan
                                </button>
                                @else
                                <button type="button" class="btn btn-warning waves-effect waves-light mt-3" onclick="isPremium('User')">
                                    <i class="mdi mdi-pencil"></i> Ajukan Edit Piodalan
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if (count($info_keuangan_pura['finances']) == 0)
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="shadow">
                            <div class="card mini-stat bg-light">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                    <div class="mini-stat-icon">
                                        <img src="../assets/images/services/servis-vector-primary-01.svg" class="float-end" width="70" height="70">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="mt-1 mb-3">Manajemen keuangan untuk pura ini belum diatur</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else


                <div id="tabel_keuangan_dinamis">
                    <div class="card z-index-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table align-items-center justify-content-center mb-5">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Debit</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Kredit</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Saldo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <p class="mb-2 font-size-20">
                                                        <b id="total_debit">Rp {{ number_format($info_keuangan_pura['total_debit'], 0, ',', '.') }}</b>
                                                    </p>
                                                    <p class="mb-0 font-size-14">Banten: 
                                                        <b id="debit_banten">+Rp {{ number_format($debit_banten, 0, ',', '.') }} ({{ $presen_debit_banten }}%)</b>
                                                    </p>
                                                    <p class="mb-0 font-size-14">Sumbangan: 
                                                        <b id="debit_sumbangan">+Rp {{ number_format($debit_sumbangan, 0, ',', '.') }} ({{ $presen_debit_sumbangan }}%)</b>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="mb-2 font-size-20">
                                                        <b id="total_kredit">Rp {{ number_format($info_keuangan_pura['total_kredit'], 0, ',', '.') }}</b>
                                                    </p>
                                                    <p class="mb-0 font-size-14">Banten: 
                                                        <b id="kredit_banten">-Rp {{ number_format($kredit_banten, 0, ',', '.') }} ({{ $presen_kredit_banten }}%)</b>
                                                    </p>
                                                    <p class="mb-0 font-size-14">Sumbangan: 
                                                        <b id="kredit_sumbangan">-Rp {{ number_format($kredit_sumbangan, 0, ',', '.') }} ({{ $presen_kredit_sumbangan }}%)</b>
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 font-size-18">
                                                        <b id="saldo">Rp {{ number_format($info_keuangan_pura['saldo'], 0, ',', '.') }}</b>
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>    

                                    <table id="tabel_keuangan" class="table align-items-center justify-content-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Tanggal</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Debit atau Kredit</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Item</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Jumlah</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Catatan</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reverse_info_keuangan_pura as $key => $value)
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $value['tanggal'] }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        @if ($value['debit_kredit'] == 'Debit')
                                                        <span class="font-size-14 badge bg-success">Debit</span>
                                                        @else
                                                        <span class="font-size-14 badge bg-danger">Kredit</span>
                                                        @endif
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $value['master_item']['name'] }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">Rp {{ number_format($value['jumlah'], 0, ',', '.') }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $value['note'] }}</p>
                                                </td>
                                                <td>
                                                    @if ($cek_pura_user == true)
                                                    <a type="button" class="btn btn-warning font-size-14" data-bs-toggle="modal" data-bs-target="#editKeuanganPura{{ $value['id'] }}">
                                                        <i class="mdi mdi-pencil me-1"></i></a>
                                                    <a type="button" class="btn btn-danger font-size-14" data-bs-toggle="modal" data-bs-target="#hapusKeuanganPura{{ $value['id'] }}">
                                                        <i class="mdi mdi-delete me-1"></i></a>
                                                    @elseif ($cek_pura_user == false && isset(session('user')['permission']))
                                                    <a type="button" class="btn btn-warning font-size-14" onclick="isPremium('{{ session('user')['permission'] }}')">
                                                        <i class="mdi mdi-pencil me-1"></i></a>
                                                    @else
                                                    <a type="button" class="btn btn-warning font-size-14" onclick="isPremium('User')">
                                                        <i class="mdi mdi-pencil me-1"></i></a>
                                                    @endif
                                                </td>
                                            </tr>   

                                            <!-- modal editPiodalan -->
                                            <div class="modal fade" id="editKeuanganPura{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="editKeuanganPuraLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editKeuanganPuraLabel">Edit Keuangan Pura</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('edit_keuangan_pura', $info_pura['id']) }}" method="POST">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="tanggal_keuangan" class="form-label">Tanggal</label>
                                                                    <input type="date" class="form-control" id="tanggal_keuangan" name="tanggal_keuangan" value="{{ $value['tanggal'] }}" required>
                                                                    <div class="valid-feedback">
                                                                        Ok!
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                        tanggal harus diisi!
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="debit_kredit" class="form-label">Debit/Kredit</label>
                                                                    <select class="form-select" id="debit_kredit" name="debit_kredit" required>
                                                                        <option value="Debit" {{ $value['debit_kredit'] == 'Debit' ? 'selected' : '' }}>Debit</option>
                                                                        <option value="Kredit" {{ $value['debit_kredit'] == 'Kredit' ? 'selected' : '' }}>Kredit</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="item_keuangan" class="form-label">Item</label>
                                                                    <select class="form-select" id="item_keuangan" name="item_keuangan" required>
                                                                        @foreach($item_keuangan as $item)
                                                                        <option value="{{ $item == 'Banten' ? 1 : 2 }}" {{ $value['master_item']['name'] == $item ? 'selected' : '' }}>
                                                                            {{ $item }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="jumlah_keuangan" class="form-label">Jumlah</label>
                                                                    <input type="number" class="form-control" id="jumlah_keuangan" name="jumlah_keuangan" value="{{ $value['jumlah'] }}" required>
                                                                    <div class="valid-feedback">
                                                                        Ok!
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                        jumlah harus diisi!
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="catatan_keuangan" class="form-label">Catatan keuangan</label>
                                                                    <textarea class="form-control" id="catatan_keuangan" name="catatan_keuangan" rows="3">{{ $value['note'] }}</textarea>
                                                                </div>
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- modal hapusKeuanganPura -->
                                            <div class="modal fade" id="hapusKeuanganPura{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="hapusKeuanganPuraLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="hapusKeuanganPuraLabel">Hapus Item Keuangan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menghapus item keuangan ini?</p>
                                                            <form action="{{ route('hapus_keuangan_pura', $value['id']) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">Ya, hapus!</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- create acara piodalan pura -->
                <div class="modal fade" id="createKeuanganPuraModal" tabindex="-1" role="dialog" aria-labelledby="createKeuanganPuraLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createkeuanganPuraLabel">Tambah Keuangan Pura</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('create_keuangan_pura', $info_pura['id']) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="tanggal_keuangan" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal_keuangan" name="tanggal_keuangan" required>
                                        <div class="valid-feedback">
                                            Ok!
                                        </div>
                                        <div class="invalid-feedback">
                                            tanggal harus diisi!
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="debit_kredit" class="form-label">Debit/Kredit</label>
                                        <select class="form-select" id="debit_kredit" name="debit_kredit" required>
                                            <option value="Debit">Debit</option>
                                            <option value="Kredit">Kredit</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="item_keuangan" class="form-label">Item</label>
                                        <select class="form-select" id="item_keuangan" name="item_keuangan" required>
                                            @foreach($item_keuangan as $key => $value)
                                            <option value="{{ $item == 'Banten' ? 1 : 2 }}">
                                                {{ $value }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah_keuangan" class="form-label">Jumlah</label>
                                        <input type="number" class="form-control" id="jumlah_keuangan" name="jumlah_keuangan" required>
                                        <div class="valid-feedback">
                                            Ok!
                                        </div>
                                        <div class="invalid-feedback">
                                            jumlah harus diisi!
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="catatan_keuangan" class="form-label">Catatan keuangan</label>
                                        <textarea class="form-control" id="catatan_keuangan" name="catatan_keuangan" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modal ajukan edit keuangan -->
                <div class="modal fade" id="ajukanPuraUserModal" tabindex="-1" role="dialog" aria-labelledby="ajukanPuraUserLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ajukanPuraUserLabel">Ajukan Edit Laporan Keuangan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Anda belum terdaftar sebagai penanggungjawab pura. Silahkan ajukan diri Anda sebagai penanggungjawab pura untuk dapat mengedit keuangan pura. Kirimkan pengajuan Anda melalui email dengan menekan tombol berikut:</p>
                                <a id="emailButton" class="btn btn-primary">Kirim Email</a>
                                <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-start mt-3">
                    <a href="{{ route('kelola_pura_page') }}" type="button" class="btn btn-primary mb-2">Kembali</a>
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

<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#tabel_keuangan').DataTable({
            language: window.dataTablesLanguageSettings
            // "order": [
            //     [0, "desc"]
            // ]
        });

        $('#cari_keuangan_pura').click(function() {
            var item_keuangan_pura = $('#item_keuangan_pura').val();
            var tahun_keuangan_pura = $('#tahun_keuangan_pura').val();
            var info_keuangan_pura = @json($info_keuangan_pura);

            var total_debit_input = document.getElementById('total_debit');
            var debit_banten_input = document.getElementById('debit_banten');
            var debit_sumbangan_input = document.getElementById('debit_sumbangan');
            var total_kredit_input = document.getElementById('total_kredit');
            var kredit_banten_input = document.getElementById('kredit_banten');
            var kredit_sumbangan_input = document.getElementById('kredit_sumbangan');
            var saldo_input = document.getElementById('saldo');
            
            var hasilTanggalKeuanganPura = '';
            var hasilItemKeuanganPura = '';
            var hasilJumlahKeuanganPura = '';
            var hasilCatatanKeuanganPura = '';
            var hasilDebitKreditKeuanganPura = '';
            var hasilMasterItemKeuanganPura = '';
            var hasilReverseInfoKeuanganPura = '';
            var hasilTotalDebit = 0;
            var hasilTotalKredit = 0;
            var hasilSaldo = 0;
            var hasilDebitBanten = 0;
            var hasilDebitSumbangan = 0;
            var hasilKreditBanten = 0;
            var hasilKreditSumbangan = 0;
            var hasilPresenDebitBanten = 0;
            var hasilPresenDebitSumbangan = 0;
            var hasilPresenKreditBanten = 0;
            var hasilPresenKreditSumbangan = 0;

            if (item_keuangan_pura == 'Semua') {
                hasilTanggalKeuanganPura = info_keuangan_pura['finances'].filter(a => a.tanggal.includes(tahun_keuangan_pura)).map(a => a.tanggal);
                hasilItemKeuanganPura = info_keuangan_pura['finances'].filter(a => a.tanggal.includes(tahun_keuangan_pura)).map(a => a.master_item.name);
                hasilJumlahKeuanganPura = info_keuangan_pura['finances'].filter(a => a.tanggal.includes(tahun_keuangan_pura)).map(a => a.jumlah);
                hasilCatatanKeuanganPura = info_keuangan_pura['finances'].filter(a => a.tanggal.includes(tahun_keuangan_pura)).map(a => a.note);
                hasilDebitKreditKeuanganPura = info_keuangan_pura['finances'].filter(a => a.tanggal.includes(tahun_keuangan_pura)).map(a => a.debit_kredit);
                hasilMasterItemKeuanganPura = info_keuangan_pura['finances'].filter(a => a.tanggal.includes(tahun_keuangan_pura)).map(a => a.master_item);
                hasilReverseInfoKeuanganPura = info_keuangan_pura['finances'].filter(a => a.tanggal.includes(tahun_keuangan_pura)).reverse();
                hasilTotalDebit = info_keuangan_pura['finances'].filter(a => a.tanggal.includes(tahun_keuangan_pura) && a.debit_kredit === 'Debit').reduce((a, b) => a + b.jumlah, 0);
                hasilTotalKredit = info_keuangan_pura['finances'].filter(a => a.tanggal.includes(tahun_keuangan_pura) && a.debit_kredit === 'Kredit').reduce((a, b) => a + b.jumlah, 0);
                hasilSaldo = hasilTotalDebit - hasilTotalKredit;
                hasilDebitBanten = info_keuangan_pura['finances'].filter(a => a.tanggal.includes(tahun_keuangan_pura) && a.master_item.name === 'Banten' && a.debit_kredit === 'Debit').reduce((a, b) => a + b.jumlah, 0);
                hasilDebitSumbangan = info_keuangan_pura['finances'].filter(a => a.tanggal.includes(tahun_keuangan_pura) && a.master_item.name === 'Sumbangan' && a.debit_kredit === 'Debit').reduce((a, b) => a + b.jumlah, 0);
                hasilKreditBanten = info_keuangan_pura['finances'].filter(a => a.tanggal.includes(tahun_keuangan_pura) && a.master_item.name === 'Banten' && a.debit_kredit === 'Kredit').reduce((a, b) => a + b.jumlah, 0);
                hasilKreditSumbangan = info_keuangan_pura['finances'].filter(a => a.tanggal.includes(tahun_keuangan_pura) && a.master_item.name === 'Sumbangan' && a.debit_kredit === 'Kredit').reduce((a, b) => a + b.jumlah, 0);
                hasilPresenDebitBanten = (hasilDebitBanten / hasilTotalDebit) * 100;
                hasilPresenDebitSumbangan = (hasilDebitSumbangan / hasilTotalDebit) * 100;
                hasilPresenKreditBanten = (hasilKreditBanten / hasilTotalKredit) * 100;
                hasilPresenKreditSumbangan = (hasilKreditSumbangan / hasilTotalKredit) * 100;

                total_debit_input.innerHTML = '<b>Rp ' + hasilTotalDebit.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '</b>';
                debit_banten_input.innerHTML = '<b>+Rp ' + hasilDebitBanten.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' (' + hasilPresenDebitBanten.toFixed(2) + '%)</b>';
                debit_sumbangan_input.innerHTML = '<b>+Rp ' + hasilDebitSumbangan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' (' + hasilPresenDebitSumbangan.toFixed(2) + '%)</b>';
                total_kredit_input.innerHTML = '<b>Rp ' + hasilTotalKredit.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '</b>';
                kredit_banten_input.innerHTML = '<b>-Rp ' + hasilKreditBanten.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' (' + hasilPresenKreditBanten.toFixed(2) + '%)</b>';
                kredit_sumbangan_input.innerHTML = '<b>-Rp ' + hasilKreditSumbangan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' (' + hasilPresenKreditSumbangan.toFixed(2) + '%)</b>';
                saldo_input.innerHTML = '<b>Rp ' + hasilSaldo.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '</b>';

            } else {
                hasilTanggalKeuanganPura = info_keuangan_pura['finances'].filter(a => a.master_item.name == item_keuangan_pura && a.tanggal.includes(tahun_keuangan_pura)).map(a => a.tanggal);
                hasilItemKeuanganPura = info_keuangan_pura['finances'].filter(a => a.master_item.name == item_keuangan_pura && a.tanggal.includes(tahun_keuangan_pura)).map(a => a.master_item.name);
                hasilJumlahKeuanganPura = info_keuangan_pura['finances'].filter(a => a.master_item.name == item_keuangan_pura && a.tanggal.includes(tahun_keuangan_pura)).map(a => a.jumlah);
                hasilCatatanKeuanganPura = info_keuangan_pura['finances'].filter(a => a.master_item.name == item_keuangan_pura && a.tanggal.includes(tahun_keuangan_pura)).map(a => a.note);
                hasilDebitKreditKeuanganPura = info_keuangan_pura['finances'].filter(a => a.master_item.name == item_keuangan_pura && a.tanggal.includes(tahun_keuangan_pura)).map(a => a.debit_kredit);
                hasilMasterItemKeuanganPura = info_keuangan_pura['finances'].filter(a => a.master_item.name == item_keuangan_pura && a.tanggal.includes(tahun_keuangan_pura)).map(a => a.master_item);
                hasilReverseInfoKeuanganPura = info_keuangan_pura['finances'].filter(a => a.master_item.name == item_keuangan_pura && a.tanggal.includes(tahun_keuangan_pura)).reverse();
                hasilTotalDebit = info_keuangan_pura['finances'].filter(a => a.master_item.name == item_keuangan_pura && a.tanggal.includes(tahun_keuangan_pura) && a.debit_kredit === 'Debit').reduce((a, b) => a + b.jumlah, 0);
                hasilTotalKredit = info_keuangan_pura['finances'].filter(a => a.master_item.name == item_keuangan_pura && a.tanggal.includes(tahun_keuangan_pura) && a.debit_kredit === 'Kredit').reduce((a, b) => a + b.jumlah, 0);
                hasilSaldo = hasilTotalDebit - hasilTotalKredit;
                hasilDebitBanten = info_keuangan_pura['finances'].filter(a => a.master_item.name == item_keuangan_pura && a.tanggal.includes(tahun_keuangan_pura) && a.master_item.name === 'Banten' && a.debit_kredit === 'Debit').reduce((a, b) => a + b.jumlah, 0);
                hasilDebitSumbangan = info_keuangan_pura['finances'].filter(a => a.master_item.name == item_keuangan_pura && a.tanggal.includes(tahun_keuangan_pura) && a.master_item.name === 'Sumbangan' && a.debit_kredit === 'Debit').reduce((a, b) => a + b.jumlah, 0);
                hasilKreditBanten = info_keuangan_pura['finances'].filter(a => a.master_item.name == item_keuangan_pura && a.tanggal.includes(tahun_keuangan_pura) && a.master_item.name === 'Banten' && a.debit_kredit === 'Kredit').reduce((a, b) => a + b.jumlah, 0);
                hasilKreditSumbangan = info_keuangan_pura['finances'].filter(a => a.master_item.name == item_keuangan_pura && a.tanggal.includes(tahun_keuangan_pura) && a.master_item.name === 'Sumbangan' && a.debit_kredit === 'Kredit').reduce((a, b) => a + b.jumlah, 0);
                hasilPresenDebitBanten = (hasilDebitBanten / hasilTotalDebit) * 100;
                hasilPresenDebitSumbangan = (hasilDebitSumbangan / hasilTotalDebit) * 100;
                hasilPresenKreditBanten = (hasilKreditBanten / hasilTotalKredit) * 100;
                hasilPresenKreditSumbangan = (hasilKreditSumbangan / hasilTotalKredit) * 100;
                                
                total_debit_input.innerHTML = '<b>Rp ' + hasilTotalDebit.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '</b>';
                debit_banten_input.innerHTML = '<b>+Rp ' + hasilDebitBanten.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' (' + hasilPresenDebitBanten.toFixed(2) + '%)</b>';
                debit_sumbangan_input.innerHTML = '<b>+Rp ' + hasilDebitSumbangan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' (' + hasilPresenDebitSumbangan.toFixed(2) + '%)</b>';
                total_kredit_input.innerHTML = '<b>Rp ' + hasilTotalKredit.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '</b>';
                kredit_banten_input.innerHTML = '<b>-Rp ' + hasilKreditBanten.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' (' + hasilPresenKreditBanten.toFixed(2) + '%)</b>';
                kredit_sumbangan_input.innerHTML = '<b>-Rp ' + hasilKreditSumbangan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' (' + hasilPresenKreditSumbangan.toFixed(2) + '%)</b>';
                saldo_input.innerHTML = '<b>Rp ' + hasilSaldo.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + '</b>';
            }

            $('#tabel_keuangan').DataTable().destroy();
            $('#tabel_keuangan').DataTable({ 
                "language": window.dataTablesLanguageSettings,
                "paging": false,
                "searching": false,
                "info": false,
                "ordering": false
            });

            $('#tabel_keuangan').DataTable().clear().draw();
            for (var i = 0; i < hasilTanggalKeuanganPura.length; i++) {
                $('#tabel_keuangan').DataTable().row.add([
                    hasilTanggalKeuanganPura[i],
                    hasilDebitKreditKeuanganPura[i] == 'Debit' ? '<span class="font-size-14 badge bg-success">Debit</span>' : '<span class="font-size-14 badge bg-danger">Kredit</span>',
                    hasilItemKeuanganPura[i],
                    hasilJumlahKeuanganPura[i],
                    hasilCatatanKeuanganPura[i],
                    '<a type="button" class="btn btn-warning font-size-14" data-bs-toggle="modal" data-bs-target="#editKeuanganPura' + hasilMasterItemKeuanganPura[i].id + '"><i class="mdi mdi-pencil me-1"></i></a>' +
                    '<a type="button" class="btn btn-danger font-size-14" data-bs-toggle="modal" data-bs-target="#hapusKeuanganPura' + hasilMasterItemKeuanganPura[i].id + '"><i class="mdi mdi-delete me-1"></i></a>'
                ]).draw(false);
            }

            $('#total_debit').html('Rp ' + hasilTotalDebit.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
            $('#total_kredit').html('Rp ' + hasilTotalKredit.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
            $('#saldo').html('Rp ' + hasilSaldo.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
            $('#debit_banten').html('Rp ' + hasilDebitBanten.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' (' + hasilPresenDebitBanten.toFixed(2) + '%)');
            $('#debit_sumbangan').html('Rp ' + hasilDebitSumbangan.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' (' + hasilPresenDebitSumbangan.toFixed(2) + '%)');
            $('#kredit_banten').html('Rp ' + hasilKreditBanten.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' (' + hasilPresenKreditBanten.toFixed(2) + '%)');
            $('#kredit_sumbangan').html('Rp ' + hasilKreditSumbangan.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.') + ' (' + hasilPresenKreditSumbangan.toFixed(2) + '%)');

            // sweet alert toasts
            const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "Data keuangan pura berhasil ditemukan!"
                });
        });
    });

    function createMailtoLink(email, subject, body) {
        var mailtoLink = 'mailto:' + encodeURIComponent(email) +
                        '?subject=' + encodeURIComponent(subject) +
                        '&body=' + encodeURIComponent(body);
        return mailtoLink;
    }

    document.getElementById('emailButton').addEventListener('click', function() {
        var email = 'bali.integrated.solution@gmail.com';
        var subject = 'Ajukan Edit Keuangan Pura';
        var body = 'Halo, saya ingin mengajukan diri sebagai penanggungjawab pura untuk mengedit keuangan pura. \n\n --Silahkan isi detail dari data diri Anda, dan informasi lengkap Pura yang ingin diklaim sebagai pura dibawah tanggungjawab Anda-- \n\nTerima kasih.';
        var mailtoLink = createMailtoLink(email, subject, body);
        window.location.href = mailtoLink;
    });

    @if(session('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Close'
        });
    @elseif (session('error'))
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'Close'
        });
    @endif

    function isPremium($permission) {
        if ($permission == 'Member') {
            // open modal
            $('#ajukanPuraUserModal').modal('show');            
        } else if ($permission == 'Guest') {
            Swal.fire({
                title: 'Error!',
                html: 'Anda belum menjadi <b>Member Premium</b>',
                icon: 'error',
                confirmButtonText: 'Cancel'
            });
        } else {
            Swal.fire({
                title: 'Error!',
                html: 'Anda belum login',
                icon: 'error',
                confirmButtonText: 'Cancel'
            });
        }
        
    }

    // @if(session('success') == 'Data piodalan berhasil diubah!')
    //     Swal.fire({
    //         title: 'Success!',
    //         text: '{{ session('success') }}',
    //         icon: 'success',
    //         confirmButtonText: 'Close'
    //     });
    // @elseif(session('error') == 'Gagal mengubah data piodalan!')
    //     Swal.fire({
    //         title: 'Error!',
    //         text: '{{ session('error') }}',
    //         icon: 'error',
    //         confirmButtonText: 'Close'
    //     });
    // @elseif(session('success') == 'Data piodalan berhasil dihapus!')
    //     Swal.fire({
    //         title: 'Success!',
    //         text: '{{ session('success') }}',
    //         icon: 'success',
    //         confirmButtonText: 'Close'
    //     });
    // @elseif(session('error') == 'Gagal menghapus data piodalan!')
    //     Swal.fire({
    //         title: 'Error!',
    //         text: '{{ session('error') }}',
    //         icon: 'error',
    //         confirmButtonText: 'Close'
    //     });
    // @elseif(session('error') == 'Gagal menghapus data piodalan! Susunan acara piodalan masih ada!')
    //     Swal.fire({
    //         title: 'Error!',
    //         text: '{{ session('error') }}',
    //         icon: 'error',
    //         confirmButtonText: 'Close'
    //     });
    // @endif
</script>

</body>

</html>
