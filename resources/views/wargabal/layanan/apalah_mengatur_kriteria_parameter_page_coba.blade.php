@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Mengatur Dewasa"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Mengatur Dewasa", "title" => "Mengatur Dewasa"])

                <div class="row">
                    <div class="col-md-10">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-primary">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                    <div class="text-white">
                                        <div class="pt-4 pb-3">
                                            <h4 class="text-white ps-3">Halaman Mengatur Dewasa</h4>
                                            <p class="text-white text-xs px-3">Halaman pencarian ini membantu Anda mengatur dewasa yang ingin dicari, Anda dapat menambahkan kriteria dewasa yang diinginkan.</p>
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
                                        <img src="../assets/images/services/servis-vector-white-05.svg" class="float-end" width="110" height="110">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('cari_kriteria_dewasa') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card z-index-2 ">
                                <div class="card-body">
                                    <div class="row">
                                        <label class="form-label">Pilihan bulan dan tahun: {{ $bulan_dicari }} {{ $tahun_dicari }} </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card z-index-2 ">
                                <div class="card-body">
                                    <h5>Kriteria dicari</h5>
                                    <div class="row mt-3" id="kriteria_dicari_container">
                                    </div>
                                    <a type="button" class="btn btn-primary mt-4 mb-0" id="tambah_dropdown_dicari">Tambah Kriteria Dicari</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card z-index-2 ">
                                <div class="card-body">
                                    <h5>Kriteria dihindari</h5>
                                    <div class="row mt-3" id="kriteria_dihindari_container">
                                    </div>
                                    <a type="button" class="btn btn-primary mt-4 mb-0" id="tambah_dropdown_dihindari">Tambah Kriteria Dihindari</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-soft w-100 mb-0" style="display: none;">Cari Dewasa</button>
                    </div>
                </form>
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

<!--Morris Chart-->
<script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
    let total_dicari = 0;
    let total_dihindari = 0;
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener for adding new dropdowns
        document.getElementById('tambah_dropdown_dicari').addEventListener('click', tambahDropdownDicari);
        document.getElementById('tambah_dropdown_dihindari').addEventListener('click', tambahDropdownDihindari);
    });

    function tambahDropdownDicari() {
        hapusDropdownCariDewasa(1, 'left_row')
        var index = document.querySelectorAll('.kriteria_dicari_key').length + 1;
        var row = document.createElement('div');
        row.className = 'row'; // Berikan kelas 'row' pada row baru
        row.innerHTML = `
        <div class="col-md-3">
            <label class="form-label">Kriteria Dicari ke-${index}</label>
        </div>
        <div class="col">
            <div class="input-group input-group-outline mb-3">
                <select class="form-control kriteria_dicari_key" aria-label="Default select example" name="kriteria_key_dicari[]" onchange="populateItemsDicari(this, ${index})">
                    <option value="">Select Key</option>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="input-group input-group-outline mb-3">
                <select class="form-control kriteria_dicari_item" aria-label="Default select example" name="kriteria_item_dicari[]">
                    <option value="">Select Item</option>
                </select>
            </div>
        </div>
        <div class="col">
            <button type="button" class="btn btn-danger" onclick="hapusDropdownDicari(this)">Hapus</button>
        </div>
    `;
        document.getElementById('kriteria_dicari_container').appendChild(row);

        // Populate keys for the dropdown
        fetch('/fetchKeys')
            .then(response => response.json())
            .then(data => {
                // gunakan untuk mengisi dropdown
                var keyDropdown = row.querySelector('select[name="kriteria_key_dicari[]"]');
                keyDropdown.innerHTML = '<option value="">Select Key</option>';
                data.forEach(key => {
                    keyDropdown.appendChild(new Option(key, key));
                });
            });
    }

    function hapusDropdownDicari(button) {
        var row = button.closest('.row');
        row.remove();
        hapusDropdownCariDewasa(-1, 'left_row');
    }

    function populateItemsDicari(dropdown, index) {
        var row = dropdown.closest('.row'); // Temukan baris terdekat
        var itemDropdown = row.querySelector('.kriteria_dicari_item'); // Temukan dropdown item di dalam baris tersebut
        itemDropdown.innerHTML = '<option value="">Select Item</option>';

        fetch(`/fetchItems?key=${dropdown.value}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    itemDropdown.appendChild(new Option(item, item));
                });
            });
    }


    function tambahDropdownDihindari() {
        hapusDropdownCariDewasa(1, 'right_row')
        var index = document.querySelectorAll('.kriteria_dihindari_key').length + 1;
        var row = document.createElement('div');
        row.className = 'row'; // Berikan kelas 'row' pada row baru
        row.innerHTML = `
        <div class="col-md-3">
            <label class="form-label">Kriteria Dihindari ke-${index}</label>
        </div>
        <div class="col">
            <div class="input-group input-group-outline mb-3">
                <select class="form-control kriteria_dihindari_key" aria-label="Default select example" name="kriteria_key_dihindari[]" onchange="populateItemsDihindari(this, ${index})">
                    <option value="">Select Key</option>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="input-group input-group-outline mb-3">
                <select class="form-control kriteria_dihindari_item" aria-label="Default select example" name="kriteria_item_dihindari[]">
                    <option value="">Select Item</option>
                </select>
            </div>
        </div>
        <div class="col">
            <button type="button" class="btn btn-danger" onclick="hapusDropdownDihindari(this)">Hapus</button>
        </div>
    `;
        document.getElementById('kriteria_dihindari_container').appendChild(row);

        // Populate keys for the dropdown
        fetch('/fetchKeys')
            .then(response => response.json())
            .then(data => {
                // gunakan untuk mengisi dropdown
                var keyDropdown = row.querySelector('select[name="kriteria_key_dihindari[]"]');
                keyDropdown.innerHTML = '<option value="">Select Key</option>';
                data.forEach(key => {
                    keyDropdown.appendChild(new Option(key, key));
                });
            });
    }

    function hapusDropdownDihindari(button) {
        var row = button.closest('.row');
        row.remove();
        hapusDropdownCariDewasa(-1, 'right_row');
    }

    function populateItemsDihindari(dropdown, index) {
        var row = dropdown.closest('.row'); // Temukan baris terdekat
        var itemDropdown = row.querySelector('.kriteria_dihindari_item'); // Temukan dropdown item di dalam baris tersebut
        itemDropdown.innerHTML = '<option value="">Select Item</option>';

        fetch(`/fetchItems?key=${dropdown.value}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(item => {
                    itemDropdown.appendChild(new Option(item, item));
                });
            });
    }

    // buat agar button mengatur parameter muncul ketika menekan tombol tambah dropdown
    document.getElementById('tambah_dropdown_dicari').addEventListener('click', function() {
        document.querySelector('.btn-soft').style.display = 'block';
    });
    document.getElementById('tambah_dropdown_dihindari').addEventListener('click', function() {
        document.querySelector('.btn-soft').style.display = 'block';
    });

    function hapusDropdownCariDewasa(lenght_row, what_row) {
        if (what_row === 'left_row') {
            total_dicari += lenght_row;
        } else if (what_row === 'right_row') {
            total_dihindari += lenght_row;
        }

        var total_fix = total_dicari + total_dihindari;

        if (total_fix <= 0) {
            document.querySelector('.btn-soft').style.display = 'none';
        } else {
            document.querySelector('.btn-soft').style.display = 'block';
        }
    }
</script>

</body>

</html>