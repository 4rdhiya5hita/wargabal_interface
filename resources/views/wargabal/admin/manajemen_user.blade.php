@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Manajemen User"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Manajemen User", "title" => "Manajemen User"])

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Manajemen User</h4>
                                <p class="card-title-desc">Halaman ini digunakan untuk mengelola user yang terdaftar.</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-check form-check-inline p-0">
                                    <h4 class="card-title">Ambil hanya data:</h4>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Semua" value="Semua">
                                    <label class="form-check label" for="Semua">Semua</label>
                                </div>

                                <!-- <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Admin" value="Admin">
                                    <label class="form-check label" for="Admin">Admin</label>
                                </div> -->

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Member" value="Member">
                                    <label class="form-check label" for="Member">Member</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="Guest" value="Guest">
                                    <label class="form-check label" for="Guest">Guest</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-container nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Nomor Telepon</th>
                                            <th>Hak Akses</th>
                                            <th>Status Kontribusi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($daftar_user as $key => $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value['name'] }}</td>
                                            <td>{{ $value['email'] }}</td>
                                            <td>{{ $value['phone'] }}</td>
                                            <td style="width: 200px">
                                                @if($value['permission'] == 'Admin')
                                                <a class="btn btn-danger">Admin</a>
                                                @elseif($value['permission'] == 'Member')
                                                <a class="btn btn-success">Member</a>
                                                @else
                                                <a class="btn btn-warning">Guest</a>
                                                @endif
                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editPermission{{ $value['id'] }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                    Edit
                                                </button>
                                            </td>
                                            <td style="width: 250px">
                                                @if($value['contribution_status'] == 1)
                                                <a class="btn btn-success">Sudah berkontribusi</a>
                                                @else
                                                <a class="btn btn-warning">Belum berkontribusi</a>
                                                @endif
                                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editContribution{{ $value['id'] }}">
                                                    <i class="mdi mdi-pencil"></i>
                                                    Edit
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- modal permission -->
                                        <div class="modal fade" id="editPermission{{ $value['id'] }}" tabindex="-1" aria-labelledby="editPermission{{ $value['id'] }}" style="display: none;" aria-modal="true" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editPermission{{ $value['id'] }}">Edit Hak Akses</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <form action="{{ route('edit_permission') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $value['id'] }}">
                                                            <div class="mb-3">
                                                                <label for="permission" class="form-label">Hak Akses</label>
                                                                <select class="form-select" id="permission" name="permission">
                                                                    <option value="Admin" @if($value['permission'] == 'Admin') selected @endif>Admin</option>
                                                                    <option value="Member" @if($value['permission'] == 'Member') selected @endif>Member</option>
                                                                    <option value="Guest" @if($value['permission'] == 'Guest') selected @endif>Guest</option>
                                                                </select>
                                                            </div>
                                                            <!-- input hidden -->
                                                            <input type="hidden" name="id" value="{{ $value['id'] }}">
                                                            <div class="text-end">
                                                                <button type="submit" class="btn btn-primary w-md">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- modal contribution -->
                                        <div class="modal fade" id="editContribution{{ $value['id'] }}" tabindex="-1" aria-labelledby="editContribution{{ $value['id'] }}" style="display: none;" aria-modal="true" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editContribution{{ $value['id'] }}">Edit Status Kontribusi</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4">
                                                        <form action="{{ route('edit_contribution_status') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $value['id'] }}">
                                                            <div class="mb-3">
                                                                <label for="contribution_status" class="form-label">Status Kontribusi</label>
                                                                <select class="form-select" id="contribution_status" name="contribution_status">
                                                                    <option value="1" @if($value['contribution_status'] == 1) selected @endif>Sudah berkontribusi</option>
                                                                    <option value="0" @if($value['contribution_status'] == 0) selected @endif>Belum berkontribusi</option>
                                                                </select>
                                                            </div>
                                                            <input type="hidden" name="id" value="{{ $value['id'] }}">
                                                            <div class="text-end">
                                                                <button type="submit" class="btn btn-primary w-md">Simpan</button>
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
    
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#datatable').DataTable({
            language: dataTablesLanguageSettings
        });

        // Apply the filter
        $('input[type=radio]').change(function() {
            if (this.value == 'Semua') {
                table.column(4).search('').draw();
            } else {
                table.column(4).search(this.value).draw();
            }
        });
    });

    @if(session('success') == 'Hak akses berhasil diubah!' || session('success') == 'Status kontribusi berhasil diubah!')
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Close'
        });
    @elseif (session('error') == 'Gagal mengubah hak akses!' || session('error') == 'Gagal mengubah status kontribusi!')
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