@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Keterangan"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Keterangan", "title" => "Keterangan Pancawara"])

                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-primary">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-1.png); background-size: cover;">
                                    <div class="text-white">
                                        <h4 class="text-white ps-3">Keterangan {{ $keterangan['nama'] }}</h4>
                                        <p class="text-white text-xs px-3">Halaman ini berisikan seluruh keterangan {{ $keterangan['nama'] }} pada website ini.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <h4 class="card-title">{{ $keterangan['nama'] }}</h4>
                                <p class="card-title-desc">{{ $keterangan['keterangan'] }}</p>

                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($info_keterangan as $key => $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value['nama'] }}</td>
                                            <td>{{ $value['keterangan'] }}</td>
                                            <td>
                                                <!-- edit button to open modals -->
                                                @if(isset(session('user')['permission']))
                                                @if(session('user')['permission'] == "Admin")
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $value['id'] }}">
                                                        <i class="mdi mdi-pencil"></i>
                                                        <span class="d-none d-xl-inline-block">Edit</span>
                                                        <!-- Edit -->
                                                    </button>
                                                @elseif(session('user')['contribution_status'] == 1)
                                                    <button type="button" class="btn btn-primary waves-effect" data-bs-toggle="modal" data-bs-target="#ajukanEditModal{{ $value['id'] }}">
                                                        <i class="mdi mdi-pencil"></i>
                                                        <span class="d-none d-xl-inline-block">Ajukan Edit</span>
                                                        <!-- Ajukan Edit -->
                                                    </button>
                                                @elseif(session('user')['contribution_status'] == null && session('user')['permission'] == "Member" || session('user')['permission'] == "Guest")
                                                    <button type="button" class="btn btn-primary waves-effect" data-bs-toggle="modal" data-bs-target="#ajukanKontribusiModal">
                                                        <i class="mdi mdi-pencil"></i>
                                                        <span class="d-none d-xl-inline-block">Pengajuan sebagai Kontributor</span>
                                                        <!-- Pengajuan sebagai Kontributor -->
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-primary waves-effect" id="joinMember">
                                                        <i class="mdi mdi-pencil"></i>
                                                        <span class="d-none d-xl-inline-block">Pengajuan sebagai Kontributor</span>
                                                        <!-- Pengajuan sebagai Kontributor -->
                                                    </button>
                                                @endif
                                                @else
                                                <button type="button" class="btn btn-primary waves-effect" id="joinMember">
                                                    <i class="mdi mdi-pencil"></i>
                                                    <span class="d-none d-xl-inline-block">Pengajuan sebagai Kontributor</span>
                                                    <!-- Pengajuan sebagai Kontributor -->
                                                </button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @foreach($info_keterangan as $key => $value)
                                <!-- Modal -->
                                <div class="modal fade" id="editModal{{ $value['id'] }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Keterangan {{ $keterangan['nama'] }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <form action="{{ route('edit_pancawara', $value['id']) }}" method="POST" class="needs-validation" novalidate>
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama</label>
                                                        <input type="text" class="form-control" id="nama" value="{{ $value['nama'] }}" style="background-color: #f0f0f0;" disabled>
                                                        <input type="hidden" name="nama" value="{{ $value['nama'] }}">
                                                        <div class="valid-feedback">
                                                            Ok!
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Nama harus diisi!
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="keterangan" class="form-label">Keterangan</label>
                                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="8" placeholder="tulis keterangan disini." required>{{ $value['keterangan'] }}</textarea>
                                                        <div class="valid-feedback">
                                                            Ok!
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Keterangan harus diisi!
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ajukan Edit Modal -->
                                <div class="modal fade ajukanEditModal" id="ajukanEditModal{{ $value['id'] }}" tabindex="-1" aria-labelledby="ajukanEditModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ajukanEditModalLabel">Permohonan Edit Keterangan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-header">
                                                <p class="modal-title"><b>Catatan:</b> Setiap keterangan yang diajukan Ahli Dewasa akan dikirimkan ke Admin untuk disetujui.</p>
                                            </div>
                                            <div class="modal-body p-4">
                                                <form action="{{ route('ajukan_edit', $value['id']) }}" method="POST" class="needs-validation" novalidate>
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama</label>
                                                        <input type="text" class="form-control" id="nama" value="{{ $value['nama'] }}" style="background-color: #f0f0f0;" disabled>
                                                        <input type="hidden" name="nama" value="{{ $value['nama'] }}">
                                                        <div class="valid-feedback">
                                                            Ok!
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Nama harus diisi!
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="keterangan" class="form-label">Keterangan</label>
                                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="8" placeholder="tulis keterangan disini." required>{{ $value['keterangan'] }}</textarea>
                                                        <div class="valid-feedback">
                                                            Ok!
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Keterangan harus diisi!
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="key_id" value="{{ $keterangan['id'] }}">
                                                    <input type="hidden" name="key_name" value="{{ $keterangan['nama'] }}">
                                                    <input type="hidden" name="item_id" value="{{ $value['id'] }}">
                                                    <input type="hidden" name="item_name" value="{{ $value['nama'] }}">
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <!-- Ajukan Modal -->
                                <div class="modal fade ajukanKontribusiModal" id="ajukanKontribusiModal" tabindex="-1" aria-labelledby="ajukanKontribusiModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ajukanKontribusiModalLabel">Permohonan Kontributor</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-header">
                                                <p class="modal-title"><b>Catatan:</b> Untuk dapat mengedit keterangan yang ada, Anda perlu mengajukan form untuk menjadi kontributor keterangan Kalender Bali terlebih dahulu.</p>
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
                    <!-- end col -->

                    <div class="d-flex justify-content-start mt-3">
                        <a href="{{ route('keterangan_page') }}" type="button" class="btn btn-primary mb-2">Kembali</a>
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
    @if(session('success') == 'Kontribusi berhasil diajukan! Silahkan lihat status kontribusi pada halaman Profile.')
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Close'
        });
    @elseif(session('success') == 'Sukses')
        Swal.fire({
            title: 'Success!',
            text: 'Data berhasil diedit',
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
    @elseif(session('error') == 'Gagal')
        Swal.fire({
            title: 'Error!',
            text: 'Data gagal diedit',
            icon: 'error',
            confirmButtonText: 'Close'
        });
    @elseif(session('success') == 'Data keterangan berhasil diajukan! Silahkan lihat status pengajuan edit pada halaman Profile.')
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Close'
        });
    @elseif(session('error') == 'Gagal mengajukan data keterangan!')
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'Close'
        });
    @endif

    $(document).on('click', '#joinMember', function(e) {
        Swal.fire({
            title: 'Error!',
            // html: 'Anda belum menjadi <b>Member Premium</b>',
            html: 'Anda belum login',
            icon: 'error',
            confirmButtonText: 'Cancel'
        });
    });
</script>

</body>

</html>