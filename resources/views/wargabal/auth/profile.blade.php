@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Profile"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Profile", "title" => "Profile"])

                @if (session('user')['is_premium'] == 0)
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
                                            <h4 class="text-white ps-3">Yuk Bergabung Member Premium! Nikmati seluruh keuntungannya!</h4>
                                            <p class="text-white text-xs px-3">Dapatkan fitur yang lebih lengkap dengan bergabung menjadi Member Premium.</p>
                                            <a href="{{ route('login') }}" class="btn btn-light mx-3">Bergabung Sekarang</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
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
                                            <h4 class="text-white ps-3">Selamat! Anda sudah menjadi Member Premium!</h4>
                                            <p class="text-white text-xs px-3">Nikmati seluruh keuntungan yang ada dengan menjadi Member Premium.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="card z-index-2 ">
                    <div class="card-body">
                        <div class="row mb-3">
                            <h5>Profile User</h5>
                            <p>Data milik Anda dapat dilihat dibawah ini:</p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ session('user')['name'] }}" placeholder="Masukkan nama" style="background-color: #f0f0f0;" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ session('user')['email'] }}" placeholder="Masukkan email" style="background-color: #f0f0f0;" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="phone">No. Telepon</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ session('user')['phone'] }}" placeholder="Masukkan nomor telepon" style="background-color: #f0f0f0;" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="premium">Status Premium</label>
                                    <input type="text" class="form-control" id="premium" name="premium" value="{{ session('user')['is_premium'] == 1 ? 'Ya' : 'Tidak' }}" style="background-color: #f0f0f0;" disabled>
                                </div>

                                <div class="mb-3">
                                    <label for="role">Hak Akses</label>
                                    <input type="text" class="form-control" id="role" name="role" value="{{ session('user')['permission'] }}" style="background-color: #f0f0f0;" disabled>
                                </div>

                                <div class="mb-3">
                                    @php
                                    $date = date_create(session('user')['created_at']);
                                    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    $date = date_format($date, "d") . " " . $bulan[date_format($date, "n") - 1] . " " . date_format($date, "Y");
                                    @endphp
                                    <label for="created_at">Bergabung Sejak</label>
                                    <input type="text" class="form-control" id="created_at" name="created_at" value="{{ $date }}" style="background-color: #f0f0f0;" disabled>
                                </div>

                                <!-- <div class="mb-3 row mt-4">
                                    <div class="col-12 text-end">
                                        <button class="btn btn-primary w-md waves-effect waves-light" id="register_button" type="submit">Register</button>
                                    </div>
                                </div> -->
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card z-index-2 ">
                    <div class="card-body">
                        <div class="row mb-3">
                            <h5>Kontribusi Anda</h5>
                            <p>Data kontribusi milik Anda dapat dilihat dibawah ini:</p>
                        </div>
                        <div class="row">
                            <div @if(session('user')['contribution_status'] == 0) class="col-md-6" @else class="col-md-12" @endif>
                                <div class="mb-3">
                                    <label for="contribution_desc">Berkontribusi sebagai</label>
                                    @if (session('user')['contribution_desc'] == null)
                                    <input type="contribution_desc" class="form-control" id="contribution_desc" name="contribution_desc" placeholder="-" style="background-color: #f0f0f0;" disabled>
                                    @else
                                    <input type="contribution_desc" class="form-control" id="contribution_desc" name="contribution_desc" placeholder="-" style="background-color: #f0f0f0;" disabled>
                                    @endif
                                </div>
                            </div>
                            @if (session('user')['contribution_status'] == 0)
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contribution_date" style="color: #ffff;">Form Pengajuan Disini</label>
                                    @if (session('user')['contribution_desc'] == null)
                                    <button type="button" class="btn btn-primary waves-effect waves-light form-control" data-bs-toggle="modal" data-bs-target="#ajukanKontribusiModal">
                                        <i class="mdi mdi-pencil"></i>
                                        Klik disini untuk ajukan kontribusi
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-primary waves-effect waves-light form-control" data-bs-toggle="modal" data-bs-target="#ajukanKontribusiModal">
                                        <i class="mdi mdi-pencil"></i>
                                        Edit kontribusi
                                    </button>
                                    @endif
                                </div>
                            </div>
                            @endif
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="contribution_status">Status Kontribusi Anda</label>
                                    <input type="text" class="form-control" id="contribution_status" name="contribution_status" placeholder="Tidak ada kontribusi" style="background-color: #f0f0f0;" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card z-index-2">
                    <div class="card-body">
                        <div class="row mb-3">
                            <h5>Pengajuan Edit Anda</h5>
                            <p>Data pengajuan edit keterangan pada Wariga milik Anda dapat dilihat dibawah ini:</p>
                        </div>
                        <div class="row">
                        <div class="table-responsive">
                            <table id="ajukan_edit" class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7">No</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Key</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Item</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Pengajuan Edit Keterangan</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Status Pengajuan</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Status Keterangan</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Disetujui</th>
                                        <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Pengajuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($info_pengajuan_keterangan) == 0)
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @else
                                    @foreach ($info_pengajuan_keterangan as $key => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item['key_name'] }}</td>
                                        <td>{{ $item['item_name'] }}</td>
                                        <td>{{ $item['keterangan'] }}</td>
                                        <td class="text-center">
                                            @if ($item['status_pengajuan'] == 0)
                                            <span class="badge bg-warning font-size-12">Menunggu</span>
                                            @elseif ($item['status_pengajuan'] == 1)
                                            <span class="badge bg-success font-size-12">Disetujui</span>
                                            @elseif ($item['status_pengajuan'] == 2)
                                            <span class="badge bg-danger font-size-12">Ditolak</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($item['status_keterangan'] == 0)
                                            <span class="font-size-12">-</span>
                                            @elseif ($item['status_keterangan'] == 1)
                                            <span class="badge bg-success font-size-12">Ditampilkan</span>
                                            @elseif ($item['status_keterangan'] == 2)
                                            <span class="badge bg-info font-size-12">Diturunkan / Diperbarui</span>
                                            @endif
                                        </td>
                                        @if ($item['tanggal_validasi'] == null)
                                        <td>-</td>
                                        @else
                                        @php $date_disetujui = date_create($item['tanggal_validasi']); $date_disetujui = date_format($date_disetujui, "d") . " " . $bulan[date_format($date_disetujui, "n") - 1] . " " . date_format($date_disetujui, "Y"); @endphp
                                        <td>{{ $date_disetujui }}</td>
                                        @endif
                                        
                                        @php $date_pengajuan = date_create($item['created_at']); $date_pengajuan = date_format($date_pengajuan, "d") . " " . $bulan[date_format($date_pengajuan, "n") - 1] . " " . date_format($date_pengajuan, "Y"); @endphp
                                        <td>{{ $date_pengajuan }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Ajukan Modal -->
                <div class="modal fade ajukanKontribusiModal" id="ajukanKontribusiModal" tabindex="-1" aria-labelledby="ajukanKontribusiModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ajukanKontribusiModalLabel">Permohonan Kontributor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-header">
                                <p class="modal-title"><b>Catatan:</b> Kontributor merupakan ahli dewasa yang terverifikasi sehingga memungkinkan user untuk memberikan kontribusi di dalam website Kalender Bali ini .</p>
                            </div>
                            <div class="modal-body p-4">
                                <form action="{{ route('ajukan_kontribusi') }}" method="POST" class="needs-validation" novalidate>
                                    @csrf
                                    <div class="mb-3">
                                        <label for="kontribusi" class="form-label">Deskripsi Kontribusi</label>
                                        <input type="text" class="form-control" id="kontribusi" name="kontribusi" placeholder="Coba: ahli padewasan">
                                        <div class="valid-feedback">
                                            Ok!
                                        </div>
                                        <div class="invalid-feedback">
                                            kontribusi harus diisi!
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                </form>
                            </div>
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
        $('#ajukan_edit').DataTable({
            language: window.dataTablesLanguageSettings
            // "order": [
            //     [0, "desc"]
            // ]
        });
    });

    @if(session('success') == 'Kontribusi berhasil diajukan!')
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Close'
        });
    @elseif(session('error') == 'Gagal mengajukan kontribusi!')
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'Close'
        });
    @endif

    $(document).ready(function() {
        // fetch contribution data
        fetchContribution();
    });

    function fetchContribution() {
        $.ajax({
            url: '/fetch_contribution',
            type: 'GET',
            success: function(response) {
                if (response) {
                    if (response.contribution_desc == null) {
                        // placeholder
                    } else {
                        $('#kontribusi').val(response.contribution_desc);
                        $('#contribution_desc').val(response.contribution_desc);
                    }

                    if (response.contribution_status == 1) {
                        $('#contribution_status').val("Sudah berkontribusi");
                    } else if (response.contribution_status == 0) {
                        $('#contribution_status').val("Belum berkontribusi");
                    }
                }
            }
        });
    }
</script>

</body>

</html>