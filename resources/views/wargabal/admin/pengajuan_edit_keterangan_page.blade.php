@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Pengajuan Edit Keterangan"])

    @include("partials/head-css")

    <style>
        /* CSS kustom untuk mengubah warna border */
        .select2-container--default .select2-selection--single,
        .select2-selection__rendered {
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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Keterangan", "title" => "Pengajuan Edit Keterangan"])

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Pengajuan Edit Keterangan</h4>
                                <p class="card-title-desc">Halaman ini digunakan untuk mengelola pengajuan edit keterangan dari user yang terdaftar.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-check form-check-inline p-0">
                                    <h5 class="card-title">Status Pengajuan:</h5>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Semua" value="Semua">
                                    <label class="form-check label" for="Semua">Semua</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Menunggu" value="Menunggu">
                                    <label class="form-check label" for="Menunggu">Menunggu</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Disetujui" value="Disetujui">
                                    <label class="form-check label" for="Disetujui">Disetujui</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Ditolak" value="Ditolak">
                                    <label class="form-check label" for="Ditolak">Ditolak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="datatable_pengajuan" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Status Pengajuan</th>
                                            <th>Status Keterangan</th>
                                            <th>Key</th>
                                            <th>Item</th>
                                            <th>Pengajuan Edit Keterangan</th>
                                            <th>Tanggal Validasi</th>
                                            <th>Tanggal Pembaruan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($daftar_pengajuan_keterangan as $key => $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            @foreach($daftar_user as $key => $user)
                                            @if($user['id'] == $value['user_web_id'])
                                            <td>{{ $user['name'] }}</td>
                                            @endif
                                            @endforeach
                                            <td>
                                                @if($value['status_pengajuan'] == 0)
                                                <span class="font-size-12 badge bg-warning">Menunggu</span>
                                                @elseif($value['status_pengajuan'] == 1)
                                                <span class="font-size-12 badge bg-success">Disetujui</span>
                                                @elseif($value['status_pengajuan'] == 2)
                                                <span class="font-size-12 badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($value['status_keterangan'] == 0)
                                                <span>-</span>
                                                @elseif ($value['status_keterangan'] == 1)
                                                <span class="font-size-12 badge bg-success">Ditampilkan</span>
                                                @elseif ($value['status_keterangan'] == 2)
                                                <span class="font-size-12 badge bg-info">Diturunkan / Diperbarui</span>
                                                @endif
                                            </td>
                                            <td>{{ $value['key_name'] }}</td>
                                            <td>{{ $value['item_name'] }}</td>
                                            <td>{{ $value['keterangan'] }}</td>
                                            @php
                                            $date = date_create(session('user')['created_at']);
                                            $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                            $tanggal_validasi = date_create($value['tanggal_validasi']); 
                                            $tanggal_validasi = date_format($tanggal_validasi, "d") . " " . $bulan[date_format($tanggal_validasi, "n") - 1] . " " . date_format($tanggal_validasi, "Y");
                                            $tanggal_pembaruan = date_create($value['updated_at']); 
                                            $tanggal_pembaruan = date_format($tanggal_pembaruan, "d") . " " . $bulan[date_format($tanggal_pembaruan, "n") - 1] . " " . date_format($tanggal_pembaruan, "Y");
                                            @endphp
                                            @if($value['tanggal_validasi'] == null)
                                            <td>-</td>
                                            @else
                                            <td>{{ $tanggal_validasi }}</td>
                                            @endif
                                            <td>{{ $tanggal_pembaruan }}</td>
                                            <td> 
                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editPengajuanEditKeterangan{{ $value['id'] }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                    Edit
                                                </button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editPengajuanEditKeterangan{{ $value['id'] }}" tabindex="-1" aria-labelledby="editPengajuanEditKeterangan{{ $value['id'] }}" style="display: none;" aria-modal="true" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editPengajuanEditKeterangan{{ $value['id'] }}">Edit Status Pengajuan Keterangan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-header">
                                                        <p class="modal-title"><b>Peringatan!</b> <b>"Status Pengajuan"</b> hanya bisa disimpan sekali. Pastikan bahwa keterangan akan <b>"disetujui"</b> atau <b>"ditolak"</b>.</p>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <form action="{{ route('edit_pengajuan_keterangan') }}" id="FormSubmit" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $value['id'] }}">
                                                            <div class="mb-3">
                                                                <label for="status_pengajuan" class="form-label">Status Pengajuan</label>
                                                                <select class="form-select" id="status_pengajuan_{{ $value['id'] }}" name="status_pengajuan" required @if($value['status_pengajuan'] != 0) style="background-color: #f0f0f0;" disabled @endif>
                                                                    <option value="1" @if($value['status_pengajuan'] == 1) selected @endif>Disetujui</option>
                                                                    <option value="2" @if($value['status_pengajuan'] == 2) selected @endif>Ditolak</option>
                                                                </select>
                                                                @if($value['status_pengajuan'] != 0)
                                                                <input type="hidden" name="status_pengajuan" value="{{ $value['status_pengajuan'] }}">
                                                                @endif
                                                            </div>
                                                            <div class="mb-3" id="status_keterangan_{{ $value['id'] }}" @if($value['status_pengajuan'] == 2) style="display: none;" @endif>
                                                                <label for="status_keterangan" class="form-label">Status Keterangan</label>
                                                                <select class="form-select" name="status_keterangan" required @if($value['status_keterangan'] == 1) style="background-color: #f0f0f0;" disabled @endif>
                                                                    <option value="1" @if($value['status_keterangan'] == 1) selected @endif>Tampilkan Sekarang</option>
                                                                    <option value="2" @if($value['status_keterangan'] == 2) selected @endif>Tampilkan Nanti</option>
                                                                </select>
                                                                @if($value['status_keterangan'] == 1)
                                                                <input type="hidden" name="status_keterangan" value="{{ $value['status_keterangan'] }}">
                                                                @endif
                                                            </div>
                                                            <input type="hidden" name="key_id" value="{{ $value['key_id'] }}">
                                                            <input type="hidden" name="item_id" value="{{ $value['item_id'] }}">
                                                            <div class="mb-3" @if($value['status_pengajuan'] == 2) style="display:none;" disabled @endif>
                                                                <div class="text-end">
                                                                    <button type="submit" class="btn btn-primary w-md">Simpan</button>
                                                                </div>
                                                            </div>
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
                    <!-- end col -->

                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-check form-check-inline p-0">
                                    <h5 class="card-title">List Keterangan yang Ditampilkan:</h5>
                                </div>
                                <div id="list_keterangan_form">
                                    <p class="card-title-desc">Pilih salah satu untuk melihat list/daftar keterangan yang ditampilkan ke pengguna!</p>
                                    <div class="input-group input-group-outline mb-3">
                                        <select class="form-control" aria-label="Default select example" name="list_keterangan_dicari" id="list_keterangan_dicari">
                                            @foreach($list_keterangan as $key => $value)
                                            <option value="{{ $value['id'] }}">{{ $value['nama'] }}</option>
                                            @endforeach
                                        </select>
                                        <button id="cari_list_keterangan" class="btn btn-primary">
                                            <i class="mdi mdi-search me-1"></i> Cari
                                        </button>
                                    </div>

                                    <table id="datatable_laporan_keterangan" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Jumlah Terisi</th>
                                                <th>Jumlah Kosong</th>
                                                <th>Total Keterangan</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tabel_laporan_keterangan">
                                        </tbody>
                                    </table>

                                    <table id="datatable_list_keterangan" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody id="tabel_list_keterangan">
                                        </tbody>
                                    </table>
                                </div>
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

<!-- Validation js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>

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
        $('#list_keterangan_dicari').select2();
    });

    const dataTablesLanguageSettings = {
        "decimal": "",
        "emptyTable": "Tidak ada data yang tersedia di tabel",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
        "infoFiltered": "(difilter dari _MAX_ total entri)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Tampilkan _MENU_ entri",
        "loadingRecords": "Sedang memuat...",
        "processing": "Sedang memproses...",
        "search": "Cari:",
        "zeroRecords": "Tidak ditemukan catatan yang cocok",
        "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Berikutnya",
            "previous": "Sebelumnya"
        },
        "aria": {
            "sortAscending": ": aktifkan untuk mengurutkan kolom naik",
            "sortDescending": ": aktifkan untuk mengurutkan kolom turun"
        }
    };
    
    // Initialize DataTable
    var table = $('#datatable_pengajuan').DataTable({
            language: dataTablesLanguageSettings
        });

    // Apply the filter
    $('input[type=radio]').change(function() {
        if (this.value == 'Semua') {
            table.columns(2).search('').draw();
        } else {
            table.columns(2).search(this.value).draw();
        }
    });

    $('select[name="status_pengajuan"]').change(function() {
        var id = $(this).attr('id').split('_')[2];
        var status_pengajuan = $(this).val();
        if (status_pengajuan == 1) {
            $('#status_keterangan_' + id).css('display', 'block');
            $('#status_keterangan_' + id + ' select').val(1);
        } else {
            $('#status_keterangan_' + id).css('display', 'none');
            $('#status_keterangan_' + id + ' select').val(2);
        }
    });

    $('#cari_list_keterangan').click(function() {
        var table_list = $('#datatable_list_keterangan').DataTable({
            language: dataTablesLanguageSettings
        });
        var id = $('#list_keterangan_dicari').val();
        var nama = $('#list_keterangan_dicari option:selected').text();       
        var keyFetch = ['fetchKeteranganHariRaya', 'fetchKeteranganAlaAyuningDewasa', 'fetchIngkel', 'fetchJejepan', 'fetchLintang', 'fetchPancaSudha', 'fetchPangarasan', 'fetchRakam', 'fetchWatekMadya', 'fetchWatekAlit', 'fetchNeptu', 'fetchEkajalarsi', 'fetchKeteranganZodiak', 'fetchPratiti', 'fetchEkawara', 'fetchDwiwara', 'fetchTriwara', 'fetchCaturwara', 'fetchPancawara', 'fetchSadwara', 'fetchSaptawara', 'fetchAstawara', 'fetchSangawara', 'fetchDasawara', 'fetchWuku'];
        var key = keyFetch[id - 1];

        var baseUrl = "{{ url('/') }}"; // Get the base URL from Blade
        var url = baseUrl + '/' + key;

        $.ajax({
            url: url,
            type: "GET",
            success: function(data) {
                var html = '';
                for (var i = 0; i < data.length; i++) {
                    html += '<tr>';
                    html += '<td>' + (i + 1) + '</td>';
                    if (key == 'fetchKeteranganHariRaya') {
                        var jumlahTerisi = data.filter(function(item) {
                            return item.hari_raya != null && item.description != "Tidak ada informasi yang tersedia.";
                        }).length;
                        var jumlahKosong = data.filter(function(item) {
                            return item.hari_raya == null || item.description == "Tidak ada informasi yang tersedia.";
                        }).length;
                        let fetchURL = `keterangan_hari_raya_page`;
                        html += '<td>' + data[i].hari_raya + '</td>';
                        html += '<td>' + data[i].description + '</td>';
                        html += `<td> <a href="${fetchURL}" type="button" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-pencil"></i> Edit</a> </td>`;
                    } else if (key == 'fetchKeteranganAlaAyuningDewasa') {
                        var jumlahTerisi = data.filter(function(item) {
                            return item.ala_ayuning_dewasa != null && item.description != "Tidak ada informasi yang tersedia.";
                        }).length;
                        var jumlahKosong = data.filter(function(item) {
                            return item.ala_ayuning_dewasa == null || item.description == "Tidak ada informasi yang tersedia.";
                        }).length;
                        let fetchURL = `keterangan_ala_ayuning_dewasa_page`;
                        html += '<td>' + data[i].ala_ayuning_dewasa + '</td>';
                        html += '<td>' + data[i].description + '</td>';
                        html += `<td> <a href="${fetchURL}" type="button" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-pencil"></i> Edit</a> </td>`;
                    } else {
                        var jumlahTerisi = data.filter(function(item) {
                            return item.nama != null;
                        }).length;
                        var jumlahKosong = data.filter(function(item) {
                            return item.nama == null;
                        }).length;
                        let formattedKey = formatKey(nama);
                        let fetchURL = `keterangan_${formattedKey}_page`;
                        html += '<td>' + data[i].nama + '</td>';
                        html += '<td>' + data[i].keterangan + '</td>';
                        html += `<td> <a href="${fetchURL}" type="button" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-pencil"></i> Edit</a> </td>`;
                    }
                    html += '</tr>';
                }

                table_list.clear().destroy();
                $('#tabel_list_keterangan').html(html);
                table_list = $('#datatable_list_keterangan').DataTable({
                    language: dataTablesLanguageSettings
                });

                $('#tabel_laporan_keterangan').html('<tr><td>' + jumlahTerisi + '</td><td>' + jumlahKosong + '</td><td>' + data.length + '</td></tr>');
            }
        });        
    });

    function formatKey(key) {
        return key.toLowerCase().replace(/ /g, '_');
    }

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
        // form submit dengan sweetalert
    @elseif (session('warning'))
        Swal.fire({
            title: 'Warning!',
            text: "{{ session('warning') }}",
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    @endif
</script>

</body>

</html>