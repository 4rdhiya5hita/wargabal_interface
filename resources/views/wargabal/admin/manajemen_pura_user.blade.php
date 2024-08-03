@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Manajemen Pura User"])

    @include("partials/head-css")

    <style>
        /* CSS kustom untuk mengubah warna border */
        .select2-container--default .select2-selection--single,
        .select2-selection__rendered {
            display: block;
            width: 100%;
            z-index: 1;
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
        
        .select2-container {
            z-index: 1051 !important; /* Higher than Bootstrap modal z-index (1050) */
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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Manajemen Pura User", "title" => "Manajemen Pura User"])

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Manajemen Pura User</h4>
                                <p class="card-title-desc">Halaman ini digunakan untuk mengelola penanggungjawab pura yang terdaftar.</p>
                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="createPuraUser()">
                                    <i class="mdi mdi-plus"></i> Tambah Penanggungjawab Pura
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pura</th>
                                            <th>Penanggungjawab</th>
                                            <th>Email</th>
                                            <th>Nomor Telepon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody id="tablePuraUser">
                                    </tbody>
                                </table>

                                <!-- modal create Pura User -->
                                <div id="addModal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered container">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah Pura User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <form action="{{ route('create_pura_user') }}" method="POST">
                                                    @csrf
                                                    <label for="pura_id" class="form-label">Pura</label>
                                                    <div class="input-group input-group-outline mb-3">
                                                        <select class="form-select pura_id" id="pura_id" name="pura_id" required>
                                                            <option value="">Pilih Pura</option>
                                                            @foreach($daftar_pura as $key => $value)
                                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="text-success" id="valid-pura_id"></div>
                                                        <div class="text-danger" id="invalid-pura_id"></div>
                                                    </div>
                                                    <label for="user_id" class="form-label">Penanggungjawab</label>
                                                    <div class="input-group input-group-outline mb-3">
                                                        <select class="form-select user_id" id="user_id" name="user_id" required>
                                                            <option value="">Pilih Penanggungjawab</option>
                                                            @foreach($daftar_user as $key => $value)
                                                            <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="text-success" id="valid-user_id"></div>
                                                        <div class="text-danger" id="invalid-user_id"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="btn_submit_form">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                </div>

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

<!--tinymce js-->
<!-- <script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script> -->

<!-- init js -->
<!-- <script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script> -->

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
    var pura_user = [];
    var daftar_pura = @json($daftar_pura);
    var daftar_user = @json($daftar_user);

    $(document).ready(function() {
        $('#addModal').on('shown.bs.modal', function() {
            // Initialize Select2
            $('#pura_id').select2({
                dropdownParent: $('#addModal')
            });
            $('#user_id').select2({
                dropdownParent: $('#addModal')
            });
        });
        showPuraUser();
    });

    function showPuraUser() {    
        var htmlTabelPuraUser = "";
        $.ajax({
            url: "{{ route('fetch_pura_user') }}",
            type: "GET",
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    pura_user.push(data[i]);
                }
                htmlTabelPuraUser = "";

                data.forEach((value, index) => {
                    htmlTabelPuraUser += "<tr>";
                    htmlTabelPuraUser += "<td>" + (index + 1) + "</td>";
                    htmlTabelPuraUser += "<td>" + value.pura.name + "</td>";
                    htmlTabelPuraUser += "<td>" + value.user.name + "</td>";
                    htmlTabelPuraUser += "<td>" + value.user.email + "</td>";
                    htmlTabelPuraUser += "<td>" + value.user.phone + "</td>";
                    htmlTabelPuraUser += "<td>";
                    htmlTabelPuraUser += "<button type='button' class='btn btn-primary waves-effect waves-light m-1' value='" + value.id + "' onclick='editPuraUser(" + value.id + ")'>";
                    htmlTabelPuraUser += "<i class='mdi mdi-pencil'></i>";
                    htmlTabelPuraUser += "Edit";
                    htmlTabelPuraUser += "</button>";
                    htmlTabelPuraUser += "<button type='button' class='btn btn-danger waves-effect waves-light m-1' value='" + value.id + "' onclick='deletePuraUser(" + value.id + ")'>";
                    htmlTabelPuraUser += "<i class='mdi mdi-pencil'></i>";
                    htmlTabelPuraUser += "Delete";
                    htmlTabelPuraUser += "</button>";
                    htmlTabelPuraUser += "</td>";
                    htmlTabelPuraUser += "</tr>";
                });

                $("#tablePuraUser").html(htmlTabelPuraUser);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function createPuraUser() {
        $("#addModal").modal("show");
        applyValidation();
    }

    function editPuraUser(id) {
        var htmlEditModal = "";
        for (var i = 0; i < pura_user.length; i++) {
            if (pura_user[i]['id'] == id) {
                htmlEditModal += "<div class='modal-dialog modal-dialog-centered container'>";
                htmlEditModal += "<div class='modal-content'>";
                htmlEditModal += "<div class='modal-header'>";
                htmlEditModal += "<h5 class='modal-title'>Edit Pura User</h5>";
                htmlEditModal += "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                htmlEditModal += "</div>";
                htmlEditModal += "<div class='modal-body p-4'>";
                htmlEditModal += "<form action='{{ route('edit_pura_user') }}' method='POST'>";
                htmlEditModal += "<input type='hidden' name='_token' value='{{ csrf_token() }}'>";
                htmlEditModal += "<input type='hidden' name='id' value='" + pura_user[i]['id'] + "'>";
                htmlEditModal += "<label for='pura_id' class='form-label'>Pura</label>";
                htmlEditModal += "<div class='input-group input-group-outline mb-3'>";
                htmlEditModal += "<select class='form-select' id='pura_id' name='pura_id' required>";
                htmlEditModal += "<option value=''>Pilih Pura</option>";
                for (var j = 0; j < daftar_pura.length; j++) {
                    if (daftar_pura[j]['id'] == pura_user[i]['pura_id']) {
                        htmlEditModal += "<option value='" + daftar_pura[j]['id'] + "' selected>" + daftar_pura[j]['name'] + "</option>";
                    } else {
                        htmlEditModal += "<option value='" + daftar_pura[j]['id'] + "'>" + daftar_pura[j]['name'] + "</option>";
                    }
                }
                htmlEditModal += "</select>";
                htmlEditModal += "<div class='text-success' id='valid-pura_id'></div>";
                htmlEditModal += "<div class='text-danger' id='invalid-pura_id'></div>";
                htmlEditModal += "</div>";
                htmlEditModal += "<label for='user_id' class='form-label'>Penanggungjawab</label>";
                htmlEditModal += "<div class='input-group input-group-outline mb-3'>";
                htmlEditModal += "<select class='form-select' id='user_id' name='user_id' required>";
                htmlEditModal += "<option value=''>Pilih Penanggungjawab</option>";
                for (var j = 0; j < daftar_user.length; j++) {
                    if (daftar_user[j]['id'] == pura_user[i]['user_id']) {
                        htmlEditModal += "<option value='" + daftar_user[j]['id'] + "' selected>" + daftar_user[j]['name'] + "</option>";
                    } else {
                        htmlEditModal += "<option value='" + daftar_user[j]['id'] + "'>" + daftar_user[j]['name'] + "</option>";
                    }
                }
                htmlEditModal += "</select>";
                htmlEditModal += "<div class='text-success' id='valid-user_id'></div>";
                htmlEditModal += "<div class='text-danger' id='invalid-user_id'></div>";
                htmlEditModal += "</div>";
                htmlEditModal += "<div class='modal-footer'>";
                htmlEditModal += "<button type='button' class='btn btn-secondary waves-effect' data-bs-dismiss='modal'>Close</button>";
                htmlEditModal += "<button type='submit' class='btn btn-primary waves-effect waves-light' id='btn_submit_form'>Simpan</button>";
                htmlEditModal += "</div>";
                htmlEditModal += "</form>";
                htmlEditModal += "</div>";
                htmlEditModal += "</div>";
                htmlEditModal += "</div>";

                $("#editModal").html(htmlEditModal);
                $("#editModal").modal("show");

                $('#editModal').on('shown.bs.modal', function() {
                    $('#pura_id').select2({
                        dropdownParent: $('#editModal')
                    });
                    $('#user_id').select2({
                        dropdownParent: $('#editModal')
                    });
                });

                applyValidation();
            }
        }
    }

    function deletePuraUser(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#34c38f',
            cancelButtonColor: '#f46a6a',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('delete_pura_user') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        Swal.fire(
                            'Terhapus!',
                            'Data telah dihapus.',
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
    }

    function applyValidation() {
        $error_appear = [];
        console.log('error appear', $error_appear);
        // pura
        $('#pura_id').on('input', function() {
            var pura_id = $('#pura_id').val();
            if (pura_id.length <= 0 || pura_id == 'Pilih Pura') {
                $('#pura_id').addClass('is-invalid');
                $('#pura_id').removeClass('is-valid');
                $('#invalid-pura_id').html('Pura harus dipilih');
                $('#valid-pura_id').html('');
                $error_appear.push('pura_id');
            } else {
                $('#pura_id').addClass('is-valid');
                $('#pura_id').removeClass('is-invalid');
                $('#invalid-pura_id').html('');
                $('#valid-pura_id').html('Ok!');
                $error_appear = $error_appear.filter(item => item !== 'pura_id');
            }
        });

        // user
        $('#user_id').on('input', function() {
            var user_id = $('#user_id').val();
            if (user_id.length <= 0 || user_id == 'Pilih Penanggungjawab') {
                $('#user_id').addClass('is-invalid');
                $('#user_id').removeClass('is-valid');
                $('#invalid-user_id').html('Penanggungjawab harus dipilih');
                $('#valid-user_id').html('');
                $error_appear.push('user_id');
            } else {
                $('#user_id').addClass('is-valid');
                $('#user_id').removeClass('is-invalid');
                $('#invalid-user_id').html('');
                $('#valid-user_id').html('Ok!');
                $error_appear = $error_appear.filter(item => item !== 'user_id');
            }
        });

        $('#btn_submit_form').on('click', function() {
            var pura_id = $('#pura_id').val();
            var user_id = $('#user_id').val();
            var check = $error_appear.includes('pura_id') || $error_appear.includes('user_id');

            if (pura_id.length <= 0 || user_id.length <= 0 || check == true) {
                // ubah type button submit ke button agar tidak submit form
                $('#btn_submit_form').attr('type', 'button');
            } else {
                // ubah type button submit ke submit agar bisa submit form
                $('#btn_submit_form').attr('type', 'submit');
            }
        });
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
    @endif

</script>

</body>

</html>