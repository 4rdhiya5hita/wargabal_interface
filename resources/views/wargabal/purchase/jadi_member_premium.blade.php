@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Jadi Member Premium"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Pembelian", "title" => "Jadi Member Premium"])

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
                                            <h4 class="text-white ps-3">Halaman Pembelian</h4>
                                            <p class="text-white text-xs px-3">Dapatkan fitur yang lebih lengkap dengan bergabung menjadi Member Premium.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card mini-stat bg-light">
                            <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                <h5 class="card-title">Pilihan Member</h5>
                                <p class="card-desc">Pilihan member Anda akan menentukan jangka waktu Anda dapat menikmati layanan premium kami.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card mini-stat bg-light">
                            <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                <div class="row">
                                    <div class="col" style="max-width:fit-content">
                                        <i class="fas fa-star fa-2x text-primary"></i>
                                        <i class="fas fa-star fa-2x text-primary"></i>
                                    </div>
                                    <div class="col-md-9">
                                        <h5 class="card-title">Member Premium Bulanan</h5>
                                        <p class="card-desc">Menjadi Member Premium selama 1 Bulan</p>
                                    </div>
                                    <div class="col-md-2 align-content-center">
                                        <form action="{{ route('purchase') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product" value="member_premium_bulanan_1">
                                            <button type="submit" class="btn btn-primary w-100">
                                                Rp.5.000
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <hr class="horizontal light pb-3">
                                <div class="row">
                                    <div class="col" style="max-width:fit-content">
                                        <i class="fas fa-crown fa-2x text-primary"></i>
                                        <i class="fas fa-crown fa-2x text-primary"></i>
                                    </div>
                                    <div class="col-md-9">
                                        <h5 class="card-title">Member Premium Tahunan</h5>
                                        <p class="card-desc">Menjadi Member Premium selama 1 Tahun</p>
                                    </div>
                                    <div class="col-md-2 align-content-center">
                                        <form action="{{ route('purchase') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="product" value="member_premium_tahunan_1">
                                            <button type="submit" class="btn btn-primary w-100">
                                                Rp.50.000
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card bg-transparent shadow-none mb-0">
                        <div class="card mini-stat bg-light">
                            <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                <!-- <h5 class="d-flex justify-content-center">Zodiak Bulan Ini</h5> -->
                                <h5 class="d-flex justify-content-center">Keuntungan Menjadi Member</h5>
                                <p class="d-flex justify-content-center">Akses di bawah akan terbuka setelah Anda menjadi membeli akses member kami. </p>
                                <hr class="horizontal light my-3">
                                <div class="col-md-12">
                                    <div class="row mb-3">
                                        <div class="col" style="max-width:fit-content">
                                            <div class="mini-stat">
                                                <i class="fas fa-calendar-alt fa-3x text-primary d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5 class="card-title">Kalender</h5>
                                            <p class="card-desc">Dapatkan akses lengkap untuk melihat Wariga dan Ala Ayuning Dewasa secara langsung dari tanggal dipilih pada menu Kalender</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col" style="max-width:fit-content">
                                            <div class="mini-stat-icon">
                                                <img src="../assets/images/services/servis-vector-primary-07.svg" width="45" height="45" class="float-center">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5 class="card-title">Wariga Personal</h5>
                                            <p class="card-desc">Dapatkan akses lengkap pada menu wariga personal tanpa dibatasi</p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col" style="max-width:fit-content">
                                            <div class="mini-stat-icon">
                                                <img src="../assets/images/services/servis-vector-primary-01.svg" width="45" height="45" class="float-center">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5 class="card-title">Kelola Pura</h5>
                                            <p class="card-desc">Dapatkan akses untuk mengajukan diri sebagai penanggungjawab pura pada menu Kelola Pura</p>
                                        </div>
                                    </div>
                                </div>
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