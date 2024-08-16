@include("partials/main")

<head>
    <base href="/">

    @include("partials/title-meta", ["title" => "Piodalan Pura"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Kelola Pura", "title" => "Piodalan Pura"])

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
                                    <label class="form-label">Cari Tanggal Piodalan Pura</label>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <label class="form-label">Bulan</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <select class="form-select" id="bulan_piodalan_pura" name="bulan_piodalan_pura">
                                                    @if ($bulan == null)
                                                    <option value="">Tidak ada data</option>
                                                    @else
                                                    @foreach($bulan as $key => $value)
                                                    @php
                                                    $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                                    @endphp
                                                    <option value="{{ $value }}">{{ $bulan_indonesia[$value - 1] }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label">Tahun</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <select class="form-select" id="tahun_piodalan_pura" name="tahun_piodalan_pura">
                                                    @if ($tahun == null)
                                                    <option value="">Tidak ada data</option>
                                                    @else
                                                    @foreach($tahun as $key => $value)
                                                    <option value="{{ $value }}">{{ $value }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label text-white">.</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <button id="cari_tanggal_piodalan_pura" class="btn btn-primary w-100">
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
                                <h5 class="mt-1 mb-3">Daftar Piodalan Pura</h5>
                                <p class="mb-0">Daftar piodalan yang tertulis di bawah ini adalah piodalan pura yang disusun oleh penanggungjawab pura. Penanggungjawab pura telah terverifikasi dan tergabung dalam komunitas Website Kalender Bali. 
                                Berikut adalah daftar piodalan pura yang telah dijadwalkan tersebut:</p>
                                @if ($cek_pura_user == true)
                                <button type="button" class="btn btn-primary waves-effect waves-light mt-3" data-bs-toggle="modal" data-bs-target="#createPiodalanPuraModal">
                                    <i class="mdi mdi-plus"></i> Tambah Acara
                                </button>
                                @elseif ($cek_pura_user == false && isset(session('user')['permission']))
                                <button type="button" class="btn btn-warning waves-effect waves-light mt-3" onclick="isPremium('{{ session('user')['permission'] }}')">
                                    <i class="mdi mdi-pencil"></i> Ajukan Edit Piodalan
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

                <div id="hasilTanggalPiodalanPura">

                    @if (count($info_piodalan_pura) == 0)
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
                                                <h5 class="mt-1 mb-3">Piodalan untuk pura ini belum diatur</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
    
                    @foreach($info_piodalan_pura as $key => $value)
                    @php
                    $hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                    $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    $hari = $hari_indonesia[date('N', strtotime($value['date'])) - 1];
                    $hari_tanggal_indonesia = $hari . ', ' . date('d', strtotime($value['date'])) . ' ' . $bulan_indonesia[date('m', strtotime($value['date'])) - 1] . ' ' . date('Y', strtotime($value['date']));
                    @endphp
                    <div class="row mt-2">
                        <div class="col-md-10">
                            <div class="shadow">
                                <div class="card mini-stat bg-light">
                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                        <div class="mini-stat-icon">
                                            <img src="../assets/images/services/servis-vector-primary-01.svg" class="float-end" width="70" height="70">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <h5 class="mt-1 mb-3">{{ $hari_tanggal_indonesia }}</h5>
                                                <p class="mb-0"><b>Deskripsi: </b>{{ $value['description'] }}</p>
                                                <p class="mb-0"><b>Level Piodalan: </b>{{ $value['level'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="row mb-2">
                                <a href="{{ route('acara_piodalan_pura', ['piodalan_id' => $value['id'], 'pura_id' => $value['pura_id']]) }}" type="button" class="btn btn-primary d-flex justify-content-center align-items-center font-size-14">
                                    <i class="mdi mdi-eye me-1"></i> Susunan Acara</a>
                            </div>
                            @if ($cek_pura_user == true)
                            <div class="row mb-2">
                                <a type="button" class="btn btn-warning d-flex justify-content-center align-items-center font-size-14" data-bs-toggle="modal" data-bs-target="#editPiodalan{{ $value['id'] }}">
                                    <i class="mdi mdi-pencil me-1"></i> Edit Piodalan</a>
                            </div>
                            <div class="row mb-2">
                                <a type="button" class="btn btn-danger d-flex justify-content-center align-items-center font-size-14" data-bs-toggle="modal" data-bs-target="#hapusPiodalan{{ $value['id'] }}">
                                    <i class="mdi mdi-delete me-1"></i> Hapus Piodalan</a>
                            </div>
                            @elseif ($cek_pura_user == false && isset(session('user')['permission']))
                            <div class="row mb-2">
                                <a type="button" class="btn btn-warning d-flex justify-content-center align-items-center font-size-14" onclick="isPremium('{{ session('user')['permission'] }}')">
                                    <i class="mdi mdi-pencil me-1"></i> Ajukan Edit Piodalan</a>
                            </div>
                            @else
                            <div class="row mb-2">
                                <a type="button" class="btn btn-warning d-flex justify-content-center align-items-center font-size-14" onclick="isPremium('User')">
                                    <i class="mdi mdi-pencil me-1"></i> Ajukan Edit Piodalan</a>
                            @endif
                        </div>
                    </div>

                    <!-- modal editPiodalan -->
                    <div class="modal fade" id="editPiodalan{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="editPiodalanLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPiodalanLabel">Edit Piodalan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('edit_piodalan_pura', $value['id']) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="tanggal_piodalan" class="form-label">Tanggal Piodalan</label>
                                            <input type="date" class="form-control" id="tanggal_piodalan" name="tanggal_piodalan" value="{{ $value['date'] }}">
                                            <div class="valid-feedback">
                                                Ok!
                                            </div>
                                            <div class="invalid-feedback">
                                                tanggal harus diisi!
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi_piodalan" class="form-label">Deskripsi Piodalan</label>
                                            <textarea class="form-control" id="deskripsi_piodalan" name="deskripsi_piodalan" rows="3">{{ $value['description'] }}</textarea>
                                            <div class="valid-feedback">
                                                Ok!
                                            </div>
                                            <div class="invalid-feedback">
                                                deskripsi harus diisi!
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="level_piodalan" class="form-label">Level Piodalan</label>
                                            <select class="form-select" id="level_piodalan" name="level_piodalan">
                                                <option value="Nista" @if($value['level'] == "Nista") selected @endif>Nista</option>
                                                <option value="Madya" @if($value['level'] == "Madya") selected @endif>Madya</option>
                                                <option value="Utama" @if($value['level'] == "Utama") selected @endif>Utama</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="pura_id" value="{{ $value['pura_id'] }}">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- modal hapusPiodalan -->
                    <div class="modal fade" id="hapusPiodalan{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="hapusPiodalanLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusPiodalanLabel">Hapus Piodalan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus piodalan ini?</p>
                                    <form action="{{ route('hapus_piodalan_pura', $value['id']) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Ya, hapus piodalan!</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    @endif

                    <!-- create acara piodalan pura -->
                    <div class="modal fade" id="createPiodalanPuraModal" tabindex="-1" role="dialog" aria-labelledby="createPiodalanPuraLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createPiodalanPuraLabel">Tambah Piodalan Pura</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('create_piodalan_pura', $info_pura['id']) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="tanggal_piodalan" class="form-label">Tanggal Piodalan</label>
                                            <input type="date" class="form-control" id="tanggal_piodalan" name="tanggal_piodalan" required>
                                            <div class="valid-feedback">
                                                Ok!
                                            </div>
                                            <div class="invalid-feedback">
                                                tanggal harus diisi!
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi_piodalan" class="form-label">Deskripsi Piodalan</label>
                                            <textarea class="form-control" id="deskripsi_piodalan" name="deskripsi_piodalan" rows="3" required></textarea>
                                            <div class="valid-feedback">
                                                Ok!
                                            </div>
                                            <div class="invalid-feedback">
                                                deskripsi harus diisi!
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="level_piodalan" class="form-label">Level Piodalan</label>
                                            <select class="form-select" id="level_piodalan" name="level_piodalan" required>
                                                <option value="Pilih Level">Pilih Level</option>
                                                <option value="Nista">Nista</option>
                                                <option value="Madya">Madya</option>
                                                <option value="Utama">Utama</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- modal ajukan edit piodalan -->
                    <div class="modal fade" id="ajukanPuraUserModal" tabindex="-1" role="dialog" aria-labelledby="ajukanPuraUserLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ajukanPuraUserLabel">Ajukan Edit Piodalan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Anda belum terdaftar sebagai penanggungjawab pura. Silahkan ajukan diri Anda sebagai penanggungjawab pura untuk dapat mengedit piodalan pura. Kirimkan pengajuan Anda melalui email dengan menekan tombol berikut:</p>
                                    <a id="emailButton" class="btn btn-primary">Kirim Email</a>
                                    <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button> -->
                                </div>
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

<!--Morris Chart-->
<script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#cari_tanggal_piodalan_pura').click(function() {
            var bulan_piodalan_pura = $('#bulan_piodalan_pura').val();
            var tahun_piodalan_pura = $('#tahun_piodalan_pura').val();
            var info_piodalan_pura = @json($info_piodalan_pura);
            
            var hasilTanggalPiodalanPura = '';
            var count = 0;
            for (var i = 0; i < info_piodalan_pura.length; i++) {
                var date = new Date(info_piodalan_pura[i].date);
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                if (month == bulan_piodalan_pura && year == tahun_piodalan_pura) {
                    count++;
                    var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    var tanggal = date.getDate();
                    var bulan = date.getMonth();
                    var tahun = date.getFullYear();
                    var hari_indonesia = hari[date.getDay()];
                    var bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    var bulan = bulan_indonesia[bulan];
                    hasilTanggalPiodalanPura += '<div class="row mt-2"><div class="col-md-10"><div class="shadow"><div class="card mini-stat bg-light"><div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;"><div class="mini-stat-icon"><img src="../assets/images/services/servis-vector-primary-01.svg" class="float-end" width="70" height="70"></div><div class="row"><div class="col-md-10"><h5 class="mt-1 mb-3">' + hari_indonesia + ', ' + tanggal + ' ' + bulan + ' ' + tahun + '</h5><p class="mb-0"><b>Deskripsi: </b>' + info_piodalan_pura[i].description + '</p><p class="mb-0"><b>Level Piodalan: </b>' + info_piodalan_pura[i].level + '</p></div></div></div></div></div></div><div class="col-md-2"><div class="row mb-2"><a type="button" class="btn btn-primary d-flex justify-content-center align-items-center font-size-14" onclick="detailPuraModal(' + info_piodalan_pura[i].id + ')"><i class="mdi mdi-eye me-1"></i> Susunan Acara</a></div><div class="row mb-2"><a type="button" class="btn btn-warning d-flex justify-content-center align-items-center font-size-14" onclick="detailPuraModal(' + info_piodalan_pura[i].id + ')"><i class="mdi mdi-pencil me-1"></i> Edit Piodalan</a></div><div class="row mb-2"><a type="button" class="btn btn-danger d-flex justify-content-center align-items-center font-size-14" onclick="detailPuraModal(' + info_piodalan_pura[i].id + ')"><i class="mdi mdi-delete me-1"></i> Hapus Piodalan</a></div></div></div>';
                }
            }

            if (count == 0) {
                hasilTanggalPiodalanPura = '<div class="row mt-2"><div class="col-md-12"><div class="shadow"><div class="card mini-stat bg-light"><div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;"><div class="mini-stat-icon"><img src="../assets/images/services/servis-vector-primary-01.svg" class="float-end" width="70" height="70"></div><div class="row"><div class="col-md-10"><h5 class="mt-1 mb-3">Piodalan untuk pura ini belum diatur</h5></div></div></div></div></div></div>';
            }

            $('#hasilTanggalPiodalanPura').html(hasilTanggalPiodalanPura);
            
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
        var subject = 'Ajukan Edit Piodalan Pura';
        var body = 'Halo, saya ingin mengajukan diri sebagai penanggungjawab pura untuk mengedit piodalan pura. \n\n --Silahkan isi detail dari data diri Anda, dan informasi lengkap Pura yang ingin diklaim sebagai pura dibawah tanggungjawab Anda-- \n\nTerima kasih.';
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
