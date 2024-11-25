@include("partials/main")

<head>
    <base href="/">

    @include("partials/title-meta", ["title" => "Acara Piodalan Pura"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Kelola Pura", "title" => "Acara Piodalan Pura"])

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
                            <div class="card bg-transparent shadow-none mb-0">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                    @php
                                    $hari_indonesia = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                                    $bulan_indonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    $hari = $hari_indonesia[date('N', strtotime($info_piodalan_pura['date'])) - 1];
                                    $hari_tanggal_indonesia = $hari . ', ' . date('d', strtotime($info_piodalan_pura['date'])) . ' ' . $bulan_indonesia[date('m', strtotime($info_piodalan_pura['date'])) - 1] . ' ' . date('Y', strtotime($info_piodalan_pura['date']));
                                    @endphp
                                    <h5 class="mt-1 mb-3">Deskripsi Piodalan</h5>
                                    <p class="mb-0">Tanggal Piodalan: {{ $hari_tanggal_indonesia }} </p>
                                    <p class="mb-0">Deskripsi Piodalan: {{ $info_piodalan_pura['description'] }}</p>
                                    <p class="mb-0">Level Piodalan: {{ $info_piodalan_pura['level'] }}</p>
                                    <p class="mb-3"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                                        
                <div class="row">
                    <div class="col-md-12">
                        <div class="card z-index-2 ">
                            <div class="card bg-transparent shadow-none mb-0">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                    <h5 class="mt-1 mb-3">Daftar Acara Piodalan Pura</h5>
                                    <p class="mb-0">Susunan acara dari piodalan pura yang disusun oleh penanggungjawab pura. Penanggungjawab pura telah terverifikasi dan tergabung dalam komunitas Website Kalender Bali. 
                                    Berikut adalah susunan acara piodalan pura yang telah dijadwalkan tersebut:</p>
                                    @if ($cek_pura_user == true)
                                    <button type="button" class="btn btn-primary waves-effect waves-light mt-3" data-bs-toggle="modal" data-bs-target="#createAcaraPiodalanPuraModal">
                                        <i class="mdi mdi-plus"></i> Tambah Acara
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-primary waves-effect waves-light mt-3" data-bs-toggle="modal" data-bs-target="#ajukanPuraUserModal">
                                        <i class="mdi mdi-pencil"></i> Ajukan Edit Piodalan
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- tabel -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card z-index-2">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="susunan_acara" class="table align-items-center justify-content-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Acara</th>
                                                <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Level</th>
                                                <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Nama PIC</th>
                                                <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">No. Telepon PIC</th>
                                                <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($info_acara_piodalan_pura) == 0)
                                            <tr>
                                                <td colspan="4" class="text-center">Acara piodalan belum diatur</td>
                                            </tr>
                                            @else
                                            @foreach($info_acara_piodalan_pura as $key => $value)
                                            <tr>
                                                <td class="text-xs font-weight-bold ps-2">{{ $value['acara'] }}</td>
                                                <td class="text-xs font-weight-bold ps-2">{{ $value['level'] }}</td>
                                                <td class="text-xs font-weight-bold ps-2">{{ $value['pic_name'] }}</td>
                                                <td class="text-xs font-weight-bold ps-2">{{ $value['pic_phone'] }}</td>
                                                @if ($cek_pura_user == true)
                                                <td class="text-xs font-weight-bold ps-2">
                                                    <a type="button" class="btn btn-warning d-flex justify-content-center align-items-center font-size-14 mb-2" data-bs-toggle="modal" data-bs-target="#editAcara{{ $value['id'] }}">
                                                        <i class="mdi mdi-pencil me-1"></i> Edit Acara</a>
                                                    <a type="button" class="btn btn-danger d-flex justify-content-center align-items-center font-size-14 mb-2" data-bs-toggle="modal" data-bs-target="#hapusAcara{{ $value['id'] }}">
                                                        <i class="mdi mdi-delete me-1"></i> Hapus Acara</a>
                                                </td>
                                                @else
                                                <td class="text-xs font-weight-bold ps-2">
                                                    <a type="button" class="btn btn-primary d-flex justify-content-center align-items-center font-size-14" data-bs-toggle="modal" data-bs-target="#ajukanPuraUserModal">
                                                        <i class="mdi mdi-pencil me-1"></i> Ajukan Edit Piodalan</a>
                                                </td>
                                                @endif
                                            </tr>

                                            <!-- modal editAcara -->
                                            <div class="modal fade" id="editAcara{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="editAcaraLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editAcaraLabel">Edit Acara</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('edit_acara_piodalan_pura', $value['id']) }}" method="POST">
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="acara" class="form-label">Acara</label>
                                                                    <input type="text" class="form-control" id="acara_edit" name="acara" value="{{ $value['acara'] }}">
                                                                    <div class="valid-feedback">
                                                                        Ok!
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                        Acara harus diisi!
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="level" class="form-label">Level</label>
                                                                    <select class="form-select" id="level_edit" name="level">
                                                                        <option value="Nista" @if($value['level'] == "Nista") selected @endif>Nista</option>
                                                                        <option value="Madya" @if($value['level'] == "Madya") selected @endif>Madya</option>
                                                                        <option value="Utama" @if($value['level'] == "Utama") selected @endif>Utama</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="pic_name" class="form-label">Nama PIC</label>
                                                                    <input type="text" class="form-control" id="pic_name_edit" name="pic_name" value="{{ $value['pic_name'] }}">
                                                                    <div class="valid-feedback">
                                                                        Ok!
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                        Nama PIC harus diisi!
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="pic_phone" class="form-label">No. Telepon PIC</label>
                                                                    <input type="text" class="form-control" id="pic_phone_edit" name="pic_phone" value="{{ $value['pic_phone'] }}">
                                                                    <div class="valid-feedback">
                                                                        Ok!
                                                                    </div>
                                                                    <div class="invalid-feedback" id="invalid-pic_phone_edit">
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="date" value="{{ $value['date'] }}">
                                                                <button type="submit" id="btn_submit_form_edit" class="btn btn-primary">Simpan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- modal hapusAcara -->
                                            <div class="modal fade" id="hapusAcara{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="hapusAcaraLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="hapusAcaraLabel">Hapus Acara</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menghapus acara ini?</p>
                                                            <form action="{{ route('hapus_acara_piodalan_pura', $value['id']) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">Ya, hapus acara!</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                    <!-- create acara piodalan pura -->
                                    <div class="modal fade" id="createAcaraPiodalanPuraModal" tabindex="-1" role="dialog" aria-labelledby="createAcaraPiodalanPuraLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="createAcaraPiodalanPuraLabel">Tambah Acara Piodalan Pura</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('create_acara_piodalan_pura', $info_piodalan_pura['id']) }}" method="POST">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="acara" class="form-label">Acara</label>
                                                            <input type="text" class="form-control" id="acara_create" name="acara" placeholder="Contoh: Sembahyang Bersama" required>
                                                            <div class="valid-feedback">
                                                                Ok!
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                Acara harus diisi!
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="level" class="form-label">Level</label>
                                                            <select class="form-select" id="level_create" name="level">
                                                                <option value="Pilih Level">Pilih Level</option>
                                                                <option value="Nista">Nista</option>
                                                                <option value="Madya">Madya</option>
                                                                <option value="Utama">Utama</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pic_name" class="form-label">Nama PIC</label>
                                                            <input type="text" class="form-control" id="pic_name_create" name="pic_name" placeholder="Contoh: I Wayan Darma" required>
                                                            <div class="valid-feedback">
                                                                Ok!
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                Nama PIC harus diisi!
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pic_phone" class="form-label">No. Telepon PIC</label>
                                                            <input type="text" class="form-control" id="pic_phone_create" name="pic_phone" placeholder="Contoh: 081234567890" required>
                                                            <div class="valid-feedback">
                                                                Ok!
                                                            </div>
                                                            <div class="invalid-feedback" id="invalid-pic_phone_create">
                                                            </div>
                                                        </div>
                                                        <!-- date -->
                                                        <input type="hidden" name="date" value="{{ $info_piodalan_pura['date'] }}">
                                                        <button type="submit" id="btn_submit_form_create" class="btn btn-primary">Simpan</button>
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
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-start mt-3">
                    <a href="{{ route('piodalan_pura_page', $info_piodalan_pura['pura_id']) }}" type="button" class="btn btn-primary mb-2">Kembali</a>
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
    $error_appear_create = [];
    $('#acara_create').on('input', function() {
        var acara = $('#acara_create').val();
        if (acara.length <= 0) {
            $('#acara_create').addClass('is-invalid');
            $('#acara_create').removeClass('is-valid');
            $('#invalid-acara').html('Acara harus diisi');
            $('#valid-acara').html('');
            $error_appear_create.push('acara');
        } else {
            $('#acara_create').addClass('is-valid');
            $('#acara_create').removeClass('is-invalid');
            $('#invalid-acara').html('');
            $('#valid-acara').html('Ok!');
            $error_appear_create = $error_appear_create.filter(item => item !== 'acara');
        }
    });

    $('#level_create').on('input', function() {
        var level = $('#level_create').val();
        if (level.length <= 0 || level == 'Pilih Level') {
            $('#level_create').addClass('is-invalid');
            $('#level_create').removeClass('is-valid');
            $('#invalid-level').html('Level harus dipilih');
            $('#valid-level').html('');
            $error_appear_create.push('level');
        } else {
            $('#level_create').addClass('is-valid');
            $('#level_create').removeClass('is-invalid');
            $('#invalid-level').html('');
            $('#valid-level').html('Ok!');
            $error_appear_create = $error_appear_create.filter(item => item !== 'level');
        }
    });

    $('#pic_name_create').on('input', function() {
        var pic_name = $('#pic_name_create').val();
        if (pic_name.length <= 0) {
            $('#pic_name_create').addClass('is-invalid');
            $('#pic_name_create').removeClass('is-valid');
            $('#invalid-pic_name').html('Nama PIC harus diisi');
            $('#valid-pic_name').html('');
            $error_appear_create.push('pic_name');
        } else {
            $('#pic_name_create').addClass('is-valid');
            $('#pic_name_create').removeClass('is-invalid');
            $('#invalid-pic_name').html('');
            $('#valid-pic_name').html('Ok!');
            $error_appear_create = $error_appear_create.filter(item => item !== 'pic_name');
        }
    });

    $('#pic_phone_create').on('input', function() {
        var pic_phone = $('#pic_phone_create').val();
        if (pic_phone.length <= 0) {
            $('#pic_phone_create').addClass('is-invalid');
            $('#pic_phone_create').removeClass('is-valid');
            $('#invalid-pic_phone_create').html('No. Telepon PIC harus diisi');
            $('#valid-pic_phone_create').html('');
            $error_appear_create.push('pic_phone');
        } else if (isNaN(pic_phone)) {
            $('#pic_phone_create').addClass('is-invalid');
            $('#pic_phone_create').removeClass('is-valid');
            $('#invalid-pic_phone_create').html('No. Telepon PIC harus berupa angka');
            $('#valid-pic_phone_create').html('');
            $error_appear_create.push('pic_phone');
        } else {
            $('#pic_phone_create').addClass('is-valid');
            $('#pic_phone_create').removeClass('is-invalid');
            $('#invalid-pic_phone').html('');
            $('#valid-pic_phone').html('Ok!');
            $error_appear_create = $error_appear_create.filter(item => item !== 'pic_phone');
        }
    });

    $('#btn_submit_form_create').on('click', function() {
        var acara = $('#acara_create').val();
        var level = $('#level_create').val();
        var pic_name = $('#pic_name_create').val();
        var pic_phone = $('#pic_phone_create').val();
        var check = $error_appear_create.includes('acara') || $error_appear_create.includes('level') || $error_appear_create.includes('pic_name') || $error_appear_create.includes('pic_phone');

        if (acara.length <= 0 || level.length <= 0 || level == "Pilih Level" || pic_name.length <= 0 || pic_phone.length <= 0 || check == true) {
            // ubah type button submit ke button agar tidak submit form
            $('#btn_submit_form_create').attr('type', 'button');
        } else {
            // ubah type button submit ke submit agar bisa submit form
            $('#btn_submit_form_create').attr('type', 'submit');
        }
    });

    $error_appear_edit = [];
    $('#acara_edit').on('input', function() {
        var acara = $('#acara_edit').val();
        if (acara.length <= 0) {
            $('#acara_edit').addClass('is-invalid');
            $('#acara_edit').removeClass('is-valid');
            $('#invalid-acara').html('Acara harus diisi');
            $('#valid-acara').html('');
            $error_appear_edit.push('acara');
        } else {
            $('#acara_edit').addClass('is-valid');
            $('#acara_edit').removeClass('is-invalid');
            $('#invalid-acara').html('');
            $('#valid-acara').html('Ok!');
            $error_appear_edit = $error_appear_edit.filter(item => item !== 'acara');
        }
    });

    $('#level_edit').on('input', function() {
        var level = $('#level_edit').val();
        if (level.length <= 0 || level == 'Pilih Level') {
            $('#level_edit').addClass('is-invalid');
            $('#level_edit').removeClass('is-valid');
            $('#invalid-level').html('Level harus dipilih');
            $('#valid-level').html('');
            $error_appear_edit.push('level');
        } else {
            $('#level_edit').addClass('is-valid');
            $('#level_edit').removeClass('is-invalid');
            $('#invalid-level').html('');
            $('#valid-level').html('Ok!');
            $error_appear_edit = $error_appear_edit.filter(item => item !== 'level');
        }
    });

    $('#pic_name_edit').on('input', function() {
        var pic_name = $('#pic_name_edit').val();
        if (pic_name.length <= 0) {
            $('#pic_name_edit').addClass('is-invalid');
            $('#pic_name_edit').removeClass('is-valid');
            $('#invalid-pic_name').html('Nama PIC harus diisi');
            $('#valid-pic_name').html('');
            $error_appear_edit.push('pic_name');
        } else {
            $('#pic_name_edit').addClass('is-valid');
            $('#pic_name_edit').removeClass('is-invalid');
            $('#invalid-pic_name').html('');
            $('#valid-pic_name').html('Ok!');
            $error_appear_edit = $error_appear_edit.filter(item => item !== 'pic_name');
        }
    });

    $('#pic_phone_edit').on('input', function() {
        var pic_phone = $('#pic_phone_edit').val();
        if (pic_phone.length <= 0) {
            $('#pic_phone_edit').addClass('is-invalid');
            $('#pic_phone_edit').removeClass('is-valid');
            $('#invalid-pic_phone_edit').html('No. Telepon PIC harus diisi');
            $('#valid-pic_phone_edit').html('');
            $error_appear_edit.push('pic_phone');
        } else if (isNaN(pic_phone)) {
            $('#pic_phone_edit').addClass('is-invalid');
            $('#pic_phone_edit').removeClass('is-valid');
            $('#invalid-pic_phone_edit').html('No. Telepon PIC harus berupa angka');
            $('#valid-pic_phone_edit').html('');
            $error_appear_edit.push('pic_phone');
        } else {
            $('#pic_phone_edit').addClass('is-valid');
            $('#pic_phone_edit').removeClass('is-invalid');
            $('#invalid-pic_phone').html('');
            $('#valid-pic_phone').html('Ok!');
            $error_appear_edit = $error_appear_edit.filter(item => item !== 'pic_phone');
        }
    });

    $('#btn_submit_form_edit').on('click', function() {
        var acara = $('#acara_edit').val();
        var level = $('#level_edit').val();
        var pic_name = $('#pic_name_edit').val();
        var pic_phone = $('#pic_phone_edit').val();
        var check = $error_appear_edit.includes('acara') || $error_appear_edit.includes('level') || $error_appear_edit.includes('pic_name') || $error_appear_edit.includes('pic_phone');

        if (acara.length <= 0 || level.length <= 0 || level == "Pilih Level" || pic_name.length <= 0 || pic_phone.length <= 0 || check == true) {
            // ubah type button submit ke button agar tidak submit form
            $('#btn_submit_form_edit').attr('type', 'button');
        } else {
            // ubah type button submit ke submit agar bisa submit form
            $('#btn_submit_form_edit').attr('type', 'submit');
        }
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
        var body = 'Halo, saya ingin mengajukan diri sebagai penanggungjawab pura untuk mengedit susunan acara piodalan pura. \n\n --Silahkan isi detail dari data diri Anda, dan informasi lengkap Pura yang ingin diklaim sebagai pura dibawah tanggungjawab Anda-- \n\nTerima kasih.';
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

    // @if(session('success') == 'Data acara piodalan berhasil diubah!')
    //     Swal.fire({
    //         title: 'Success!',
    //         text: '{{ session('success') }}',
    //         icon: 'success',
    //         confirmButtonText: 'Close'
    //     });
    // @elseif(session('error') == 'Gagal mengubah data acara piodalan!')
    //     Swal.fire({
    //         title: 'Error!',
    //         text: '{{ session('error') }}',
    //         icon: 'error',
    //         confirmButtonText: 'Close'
    //     });
    // @elseif(session('success') == 'Data acara piodalan berhasil dihapus!')
    //     Swal.fire({
    //         title: 'Success!',
    //         text: '{{ session('success') }}',
    //         icon: 'success',
    //         confirmButtonText: 'Close'
    //     });
    // @elseif(session('error') == 'Gagal menghapus data acara piodalan!')
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
