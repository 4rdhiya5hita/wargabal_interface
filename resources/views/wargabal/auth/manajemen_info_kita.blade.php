@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Manajemen Info Kita"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Manajemen Info Kita", "title" => "Manajemen Info Kita"])

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Manajemen Info Kita</h4>
                                <p class="card-title-desc">Halaman ini digunakan untuk mengelola info kita.</p>
                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="createInfoKita()">
                                    <i class="mdi mdi-plus"></i> Tambah Info Kita
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
                                            <th>Judul</th>
                                            <th>Konten</th>
                                            <th>Tanggal Tampil</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody id="tableInfoKita">
                                    </tbody>
                                </table>

                                <!-- modal create info kita -->
                                <div id="addModal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered container">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah Info Kita</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <form action="{{ route('create_info_kita') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="title" class="form-label">Judul</label>
                                                        <input type="text" class="form-control" id="title" name="title" required>
                                                        <div class="text-success" id="valid-title"></div>
                                                        <div class="text-danger" id="invalid-title"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="content" class="form-label">Konten</label>
                                                        <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
                                                        <div class="text-success" id="valid-content"></div>
                                                        <div class="text-danger" id="invalid-content"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="show_at_home_page_from" class="form-label">Tanggal Tampil</label>
                                                        <input type="date" class="form-control" id="show_at_home_page_from" name="show_at_home_page_from" required>
                                                        <div class="text-success" id="valid-show_at_home_page_from"></div>
                                                        <div class="text-danger" id="invalid-show_at_home_page_from"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="show_at_home_page_until" class="form-label">Sampai dengan</label>
                                                        <input type="date" class="form-control" id="show_at_home_page_until" name="show_at_home_page_until" required>
                                                        <div class="text-success" id="valid-show_at_home_page_until"></div>
                                                        <div class="text-danger" id="invalid-show_at_home_page_until"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="image" class="form-label">Gambar</label>
                                                        <input type="file" class="form-control" id="image" name="image">
                                                        <div class="text-success" id="valid-image"></div>
                                                        <div class="text-danger" id="invalid-image"></div>
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

                                <div id="detailModal" class='modal fade bs-example-modal-center' tabindex='-1' role='dialog' aria-labelledby='myCenterModalLabel' aria-hidden='true'></div>
                                <div id="editModal" class='modal fade bs-example-modal-center' tabindex='-1' role='dialog' aria-labelledby='myCenterModalLabel' aria-hidden='true'></div>

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

<!--tinymce js-->
<!-- <script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script> -->

<!-- init js -->
<!-- <script src="{{ asset('assets/js/pages/form-editor.init.js') }}"></script> -->

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
    var info_kita = [];

    $(document).ready(function() {
        showInfoKita();
    });

    function showInfoKita() {    
        var htmlTabelInfoKita = "";
        $.ajax({
            url: "{{ route('fetch_info_kita') }}",
            type: "GET",
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    info_kita.push(data[i]);
                }
                htmlTabelInfoKita = "";

                data.forEach((value, index) => {
                    htmlTabelInfoKita += "<tr>";
                    htmlTabelInfoKita += "<td>" + (index + 1) + "</td>";
                    htmlTabelInfoKita += "<td>" + value.title + "</td>";

                    var formattedContent = value.content.replace(/\n/g, '<br>');
                    htmlTabelInfoKita += "<td>" + formattedContent.substring(0, 400) + "...</td>";

                    var tanggal_awal_tampil = ubahTanggal(value.show_at_home_page_from);
                    var tanggal_akhir_tampil = ubahTanggal(value.show_at_home_page_until);

                    htmlTabelInfoKita += "<td>" + tanggal_awal_tampil + " - " + tanggal_akhir_tampil + "</td>";
                    htmlTabelInfoKita += "<td>";
                    htmlTabelInfoKita += "<button type='button' class='btn btn-info waves-effect waves-light m-1' value='" + value.id + "' onclick='detailInfoKita(" + value.id + ")'>";
                    htmlTabelInfoKita += "<i class='mdi mdi-information-outline'></i>";
                    htmlTabelInfoKita += "Detail";
                    htmlTabelInfoKita += "</button>";
                    htmlTabelInfoKita += "<button type='button' class='btn btn-primary waves-effect waves-light m-1' value='" + value.id + "' onclick='editInfoKita(" + value.id + ")'>";
                    htmlTabelInfoKita += "<i class='mdi mdi-pencil'></i>";
                    htmlTabelInfoKita += "Edit";
                    htmlTabelInfoKita += "</button>";
                    htmlTabelInfoKita += "<button type='button' class='btn btn-danger waves-effect waves-light m-1' value='" + value.id + "' onclick='deleteInfoKita(" + value.id + ")'>";
                    htmlTabelInfoKita += "<i class='mdi mdi-pencil'></i>";
                    htmlTabelInfoKita += "Delete";
                    htmlTabelInfoKita += "</button>";
                    htmlTabelInfoKita += "</td>";
                    htmlTabelInfoKita += "</tr>";
                });

                $("#tableInfoKita").html(htmlTabelInfoKita);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function createInfoKita() {
        $("#addModal").modal("show");
        applyValidation();
    }

    function detailInfoKita(id) {
        var htmlDetailModal = "";
        for (var i = 0; i < info_kita.length; i++) {
            // console.log(info_kita[i]['image']);
            if (info_kita[i]['id'] == id) {
                var tanggal_awal_tampil = ubahTanggal(info_kita[i]["show_at_home_page_from"]);
                var tanggal_akhir_tampil = ubahTanggal(info_kita[i]["show_at_home_page_until"]);

                htmlDetailModal += "<div class='modal-dialog modal-dialog-centered container'>";
                htmlDetailModal += "<div class='modal-content'>";
                htmlDetailModal += "<div class='modal-header'>";
                htmlDetailModal += "<h5 class='modal-title'>" + info_kita[i]["title"] + "</h5>";
                htmlDetailModal += "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                htmlDetailModal += "</div>";
                if (info_kita[i]["image"] != null) {
                    htmlDetailModal += "<div class='modal-body d-flex justify-content-center'>";
                    htmlDetailModal += "<img class='img-fluid img-thumbnail' src='https://api.kalenderbali.web.id/storage/" + info_kita[i]["image"] + "' width='650'>";
                    htmlDetailModal += "</div>";
                }
                htmlDetailModal += "<div class='modal-body'>";
                htmlDetailModal += "<p class='modal-title-desc mb-3'>Tanggal tampil: " + tanggal_awal_tampil + " - " + tanggal_akhir_tampil + "</p>";
                htmlDetailModal += "<p class='modal-title-desc mb-0'>Konten: </p>";

                var formattedContent = info_kita[i]["content"].replace(/\n/g, '<br>');
                htmlDetailModal += "<p class='modal-title-desc mb-0'>" + formattedContent + "</p>";
                htmlDetailModal += "</div>";
                htmlDetailModal += "<div class='modal-footer'>";
                htmlDetailModal += "<button type='button' class='btn btn-secondary waves-effect' data-bs-dismiss='modal'>Close</button>";
                htmlDetailModal += "</div>";
                htmlDetailModal += "</div>";
                htmlDetailModal += "</div>";

                $("#detailModal").html(htmlDetailModal);
                $("#detailModal").modal("show");
            }
        }  
    }

    function editInfoKita(id) {
        var htmlEditModal = "";

        for (var i = 0; i < info_kita.length; i++) {
            if (info_kita[i]['id'] == id) {
                var tanggal_awal_tampil = info_kita[i]["show_at_home_page_from"].split(" ")[0];
                var tanggal_akhir_tampil = info_kita[i]["show_at_home_page_until"].split(" ")[0];

                htmlEditModal += "<div class='modal-dialog modal-dialog-centered container'>";
                htmlEditModal += "<div class='modal-content'>";
                htmlEditModal += "<div class='modal-header'>";
                htmlEditModal += "<h5 class='modal-title'>Edit Info Kita</h5>";
                htmlEditModal += "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                htmlEditModal += "</div>";
                htmlEditModal += "<div class='modal-body'>";
                htmlEditModal += "<form action='{{ route('edit_info_kita') }}' method='POST' enctype='multipart/form-data'>";
                htmlEditModal += "<input type='hidden' name='_token' value='{{ csrf_token() }}'>";
                htmlEditModal += "<input type='hidden' name='id' value='" + info_kita[i]['id'] + "'>";
                htmlEditModal += "<div class='mb-3'>";
                htmlEditModal += "<label for='title' class='form-label'>Judul</label>";
                htmlEditModal += "<input type='text' class='form-control' id='title' name='title' value='" + info_kita[i]['title'] + "' required>";
                htmlEditModal += "<div class='text-success' id='valid-title'></div>";
                htmlEditModal += "<div class='text-danger' id='invalid-title'></div>";
                htmlEditModal += "</div>";
                htmlEditModal += "<div class='mb-3'>";
                htmlEditModal += "<label for='content' class='form-label'>Konten</label>";
                htmlEditModal += "<textarea class='form-control' id='content' name='content' rows='10' required>" + info_kita[i]['content'] + "</textarea>";
                htmlEditModal += "<div class='text-success' id='valid-content'></div>";
                htmlEditModal += "<div class='text-danger' id='invalid-content'></div>";
                htmlEditModal += "</div>";
                htmlEditModal += "<div class='mb-3'>";
                htmlEditModal += "<label for='show_at_home_page_from' class='form-label'>Tanggal Tampil</label>";
                htmlEditModal += "<input type='date' class='form-control' id='show_at_home_page_from' name='show_at_home_page_from' value='" + tanggal_awal_tampil + "' required>";
                htmlEditModal += "<div class='text-success' id='valid-show_at_home_page_from'></div>";
                htmlEditModal += "<div class='text-danger' id='invalid-show_at_home_page_from'></div>";
                htmlEditModal += "</div>";
                htmlEditModal += "<div class='mb-3'>";
                htmlEditModal += "<label for='show_at_home_page_until' class='form-label'>Sampai dengan</label>";
                htmlEditModal += "<input type='date' class='form-control' id='show_at_home_page_until' name='show_at_home_page_until' value='" + tanggal_akhir_tampil + "' required>";
                htmlEditModal += "<div class='text-success' id='valid-show_at_home_page_until'></div>";
                htmlEditModal += "<div class='text-danger' id='invalid-show_at_home_page_until'></div>";
                htmlEditModal += "</div>";
                htmlEditModal += "<div class='mb-3'>";
                htmlEditModal += "<label for='image' class='form-label'>Gambar</label>";
                htmlEditModal += "<input type='file' class='form-control' id='image' name='image' value='" + info_kita[i]['image'] + "'>";
                htmlEditModal += "<div class='text-success' id='valid-image'></div>";
                htmlEditModal += "<div class='text-danger' id='invalid-image'></div>";
                htmlEditModal += "<small class='form-text text-muted'>Gambar saat ini: " + info_kita[i]['image'] + "</small>"; // Menampilkan nama file
                htmlEditModal += "</div>";
                htmlEditModal += "<div class='modal-footer'>";
                htmlEditModal += "<button type='button' class='btn btn-secondary waves-effect' data-bs-dismiss='modal'>Close</button>";
                htmlEditModal += "<button type='submit' id='btn_submit_form' class='btn btn-primary waves-effect waves-light'>Simpan</button>";
                htmlEditModal += "</div>";
                htmlEditModal += "</form>";
                htmlEditModal += "</div>";
                htmlEditModal += "</div>";
                htmlEditModal += "</div>";

                $("#editModal").html(htmlEditModal);
                $("#editModal").modal("show");
                applyValidation();
            }
        }
    }


    // Inisialisasi Tinymce
    // if($(body).find('#elm2').length > 0) {
    //     tinymce.init({
    //         selector: "textarea#elm2",
    //         height:300,
    //         plugins: [
    //             "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
    //             "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    //             "save table contextmenu directionality emoticons template paste textcolor"
    //         ],
    //         // toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
    //         toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify",
    //         style_formats: [
    //             {title: 'Bold text', inline: 'b'},
    //             {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
    //             {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
    //             {title: 'Example 1', inline: 'span', classes: 'example1'},
    //             {title: 'Example 2', inline: 'span', classes: 'example2'},
    //             {title: 'Table styles'},
    //             {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    //         ]
    //     });
    // }

    
    function deleteInfoKita(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('delete_info_kita') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(data) {
                        Swal.fire(
                            'Terhapus!',
                            'Data berhasil dihapus.',
                            'success'
                        );
                        showInfoKita();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
    }

    function ubahTanggal(tanggal) {
        var tanggal = new Date(tanggal);
        var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        var tanggal = tanggal.getDate() + " " + bulan[tanggal.getMonth()] + " " + tanggal.getFullYear();
        return tanggal;
    }


    function applyValidation() {
        $error_appear = [];
        // name
        $('#title').on('input', function() {
            var title = $('#title').val();
            var title_length = title.length;
            if (title_length <= 0) {
                $('#title').removeClass('is-valid');
                $('#title').addClass('is-invalid');
                $('#invalid-title').html('Judul harus diisi!');
                $('#valid-title').html('');
                $error_appear.push('title');
            } else {
                $('#title').removeClass('is-invalid');
                $('#title').addClass('is-valid');
                $('#valid-title').html('Ok!');
                $('#invalid-title').html('');
                $error_appear = $error_appear.filter(function(item) {
                    return item !== 'title';
                }); // hapus title dari array error
            }
        });

        // content
        $('#content').on('input', function() {
            var content = $('#content').val();
            var content_length = content.length;
            if (content_length <= 0) {
                $('#content').removeClass('is-valid');
                $('#content').addClass('is-invalid');
                $('#invalid-content').html('Konten harus diisi!');
                $('#valid-content').html('');
                $error_appear.push('content');
            } else {
                $('#content').removeClass('is-invalid');
                $('#content').addClass('is-valid');
                $('#valid-content').html('Ok!');
                $('#invalid-content').html('');
                $error_appear = $error_appear.filter(function(item) {
                    return item !== 'content';
                }); // hapus content dari array error
            }
        });

        // show_at_home_page_from
        $('#show_at_home_page_from').on('input', function() {
            var show_at_home_page_from = $('#show_at_home_page_from').val();
            if (show_at_home_page_from == '') {
                $('#show_at_home_page_from').removeClass('is-valid');
                $('#show_at_home_page_from').addClass('is-invalid');
                $('#invalid-show_at_home_page_from').html('Tanggal harus diisi!');
                $('#valid-show_at_home_page_from').html('');
                $error_appear.push('show_at_home_page_from');
            // } else if (show_at_home_page_from < new Date().toISOString().split('T')[0]) {
            //     $('#show_at_home_page_from').removeClass('is-valid');
            //     $('#show_at_home_page_from').addClass('is-invalid');
            //     $('#invalid-show_at_home_page_from').html('Tanggal harus lebih besar dari hari ini!');
            //     $('#valid-show_at_home_page_from').html('');
            //     $error_appear.push('show_at_home_page_from');
            } else if ($('#show_at_home_page_until').val() != '') {
                if (show_at_home_page_from > $('#show_at_home_page_until').val()) {
                    $('#show_at_home_page_from').removeClass('is-valid');
                    $('#show_at_home_page_from').addClass('is-invalid');
                    $('#invalid-show_at_home_page_from').html('Tanggal harus lebih kecil dari tanggal sampai!');
                    $('#valid-show_at_home_page_from').html('');
                    $error_appear.push('show_at_home_page_from');
                }
            } else {
                $('#show_at_home_page_from').removeClass('is-invalid');
                $('#show_at_home_page_from').addClass('is-valid');
                $('#valid-show_at_home_page_from').html('Ok!');
                $('#invalid-show_at_home_page_from').html('');
                $error_appear = $error_appear.filter(function(item) {
                    return item !== 'show_at_home_page_from';
                }); // hapus show_at_home_page_from dari array error
            }
        });

        // show_at_home_page_until
        $('#show_at_home_page_until').on('input', function() {
            var show_at_home_page_until = $('#show_at_home_page_until').val();
            if (show_at_home_page_until == '') {
                $('#show_at_home_page_until').removeClass('is-valid');
                $('#show_at_home_page_until').addClass('is-invalid');
                $('#invalid-show_at_home_page_until').html('Tanggal harus diisi!');
                $('#valid-show_at_home_page_until').html('');
                $error_appear.push('show_at_home_page_until');
            // } else if (show_at_home_page_until < new Date().toISOString().split('T')[0]) {
            //     $('#show_at_home_page_until').removeClass('is-valid');
            //     $('#show_at_home_page_until').addClass('is-invalid');
            //     $('#invalid-show_at_home_page_until').html('Tanggal harus lebih besar dari hari ini!');
            //     $('#valid-show_at_home_page_until').html('');
            //     $error_appear.push('show_at_home_page_until');
            } else if (show_at_home_page_until < $('#show_at_home_page_from').val()) {
                $('#show_at_home_page_until').removeClass('is-valid');
                $('#show_at_home_page_until').addClass('is-invalid');
                $('#invalid-show_at_home_page_until').html('Tanggal harus lebih besar dari tanggal mulai!');
                $('#valid-show_at_home_page_until').html('');
                $error_appear.push('show_at_home_page_until');
            } else {
                $('#show_at_home_page_until').removeClass('is-invalid');
                $('#show_at_home_page_until').addClass('is-valid');
                $('#valid-show_at_home_page_until').html('Ok!');
                $('#invalid-show_at_home_page_until').html('');
                $error_appear = $error_appear.filter(function(item) {
                    return item !== 'show_at_home_page_until';
                }); // hapus show_at_home_page_until dari array error
            }
        });

        // image
        // $('#image').on('input', function() {
        //     var image = $('#image').val();
        //     if (image == '') {
        //         $('#image').removeClass('is-valid');
        //         $('#image').addClass('is-invalid');
        //         $('#invalid-image').html('Gambar harus diisi!');
        //         $('#valid-image').html('');
        //         $error_appear.push('image');
        //     } else {
        //         $('#image').removeClass('is-invalid');
        //         $('#image').addClass('is-valid');
        //         $('#valid-image').html('Ok!');
        //         $('#invalid-image').html('');
        //         $error_appear = $error_appear.filter(function(item) {
        //             return item !== 'image';
        //         }); // hapus image dari array error
        //     }
        // });

        $('#btn_submit_form').on('click', function() {
            var title = $('#title').val();
            var content = $('#content').val();
            var show_at_home_page_from = $('#show_at_home_page_from').val();
            var show_at_home_page_until = $('#show_at_home_page_until').val();
            var image = $('#image').val();
            var check = $error_appear.includes('title') || $error_appear.includes('content') || $error_appear.includes('show_at_home_page_from') || $error_appear.includes('show_at_home_page_until') || $error_appear.includes('image');

            if (title.length <= 0 || content.length <= 0 || show_at_home_page_from.length <= 0 || show_at_home_page_until.length <= 0 || check == true) {
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