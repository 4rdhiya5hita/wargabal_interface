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
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contribution_desc">Berkontribusi sebagai</label>
                                    @if (session('user')['contribution_desc'] == null)
                                    <input type="contribution_desc" class="form-control" id="contribution_desc" name="contribution_desc" placeholder="-" style="background-color: #f0f0f0;" disabled>
                                    @else
                                    <input type="contribution_desc" class="form-control" id="contribution_desc" name="contribution_desc" placeholder="-" style="background-color: #f0f0f0;" disabled>
                                    @endif
                                </div>
                            </div>
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
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="contribution_status">Status Kontribusi Anda</label>
                                    <input type="text" class="form-control" id="contribution_status" name="contribution_status" placeholder="Tidak ada kontribusi" style="background-color: #f0f0f0;" disabled>
                                </div>
                            </div>
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
<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
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