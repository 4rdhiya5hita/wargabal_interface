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
                            <div class="card mini-stat bg-info">
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
                            <div class="card mini-stat bg-info">
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
                                    <div class="row mb-2">
                                        <label class="form-label">Pilihan bulan dan tahun: {{ $bulan_dicari }} {{ $tahun_dicari }} </label>
                                    </div>
                                    <hr class="horizontal light mt-0">
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col">
                                                    <h5>Kriteria Dicari</h5>
                                                    <div id="input_form"></div>
                                                </div>
                                                <div class="col d-flex justify-content-end">
                                                    <a id="hapus_dicari" class="btn btn-danger">hapus kriteria dicari</a>
                                                </div>
                                            </div>
                                            <div id="simpan_dicari">
                                                <h6>-</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col">
                                                    <h5>Kriteria Dihindari</h5>
                                                </div>
                                                <div class="col d-flex justify-content-end">
                                                    <a id="hapus_dihindari" class="btn btn-danger">hapus kriteria dihindari</a>
                                                </div>
                                            </div>
                                            <div id="simpan_dihindari">
                                                <h6>-</h6>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a id="cari_dewasa" class="btn btn-info w-100 mb-3" style="display: none;">Cari Dewasa</a>
                            </div>
                            <div class="row mb-4" id="konfirmasi" style="display: none;">
                                <div class="col-md-12">
                                    <div class="card z-index-2 ">
                                        <div class="card-body">
                                        <h6>Apakah Anda sudah yakin dengan kriteria yang dipilih? </h6>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="submit" id="ya" class="btn btn-success w-100 mb-3">Ya</button>
                                                </div>
                                                <div class="col-md-6">
                                                    <a type="button" id="tidak" class="btn btn-danger w-100 mb-3">Tidak</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="card z-index-2 ">
                            <div class="card-body">
                                <h5>Pilih kriteria</h5>
                                <div class="row">
                                    <div class="col-md-6" id="pilihan_kriteria">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="pilihan_kriteria" id="dicari" value="dicari" checked>
                                            <label class="form-check label" for="dicari">Dicari</label>
                                            <input class="form-check-input" type="radio" name="pilihan_kriteria" id="dihindari" value="dihindari">
                                            <label class="form-check label" for="dihindari">Dihindari</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-4" id="form-dicari">
                            <div class="card z-index-2 ">
                                <div class="card-body">
                                    <h5>Kriteria dicari</h5>
                                    <div class="row mt-3" id="kriteria_dicari_container">
                                    </div>
                                    <a type="button" class="btn btn-info mb-0" id="tambah_dropdown_dicari">Tambah Kriteria Dicari</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-4" id="form-dihindari" style="display: none;">
                            <div class="card z-index-2 ">
                                <div class="card-body">
                                    <h5>Kriteria dihindari</h5>
                                    <div class="row" id="kriteria_dihindari_container">
                                    </div>
                                    <a type="button" class="btn btn-info mb-0" id="tambah_dropdown_dihindari">Tambah Kriteria Dihindari</a>
                                </div>
                            </div>
                        </div>

                        <!-- <input type="hidden" name="cari_dengan" value="{{ $cari_dengan }}"> -->
                        <!-- <input type="hidden" name="dewasa_ayu" value="{{ $dewasa_ayu }}"> -->
                        <input type="hidden" name="bulan_dicari" value="{{ $bulan_dicari }}">
                        <input type="hidden" name="tahun_dicari" value="{{ $tahun_dicari}}">

                        <div class="text-center">
                            <a type="button" id="simpan" class="btn btn-info btn-soft w-100 mb-0" style="display: none;">Simpan</a>
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
<script src="assets/libs/morris.js/morris.min.js"></script>
<script src="assets/libs/raphael/raphael.min.js"></script>

<script src="assets/js/pages/dashboard.init.js"></script>

<script src="assets/js/app.js"></script>

<script>
    document.getElementById('dicari').addEventListener('click', function() {
        document.getElementById('form-dicari').style.display = 'block';
        document.getElementById('form-dihindari').style.display = 'none';
        // hapus isi dari dropdown
        document.getElementById('kriteria_dicari_container').innerHTML = '';
    });

    document.getElementById('dihindari').addEventListener('click', function() {
        document.getElementById('form-dicari').style.display = 'none';
        document.getElementById('form-dihindari').style.display = 'block';
        // hapus isi dari dropdown
        document.getElementById('kriteria_dihindari_container').innerHTML = '';
    });

    let total_dicari = 0;
    let total_dihindari = 0;
    document.addEventListener('DOMContentLoaded', function() {
        // Event listener for adding new dropdowns
        document.getElementById('tambah_dropdown_dicari').addEventListener('click', tambahDropdownDicari);
        document.getElementById('tambah_dropdown_dihindari').addEventListener('click', tambahDropdownDihindari);
    });

    function tambahDropdownDicari() {
        // hapusDropdownCariDewasa(1, 'left_row')
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

        if (document.querySelectorAll('.kriteria_dicari_key').length === 0) {
            document.getElementById('simpan').style.display = 'none';
        }
        // hapusDropdownCariDewasa(-1, 'left_row');
    }

    function populateItemsDicari(dropdown, index) {
        var row = dropdown.closest('.row'); // Temukan baris terdekat
        var itemDropdown = row.querySelector('.kriteria_dicari_item'); // Temukan dropdown item di dalam baris tersebut
        itemDropdown.innerHTML = '<option value="">Select Item</option>';

        fetch(`/fetchItems?key=${dropdown.value}`)
            .then(response => response.json())
            .then(data => {
                Object.entries(data).forEach(([text, value]) => {
                    itemDropdown.appendChild(new Option(text, value));
                });
            });
    }

    function tambahDropdownDihindari() {
        // hapusDropdownCariDewasa(1, 'right_row');
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

        if (document.querySelectorAll('.kriteria_dihindari_key').length === 0) {
            document.getElementById('simpan').style.display = 'none';
        }
        // hapusDropdownCariDewasa(-1, 'right_row');
    }

    function populateItemsDihindari(dropdown, index) {
        var row = dropdown.closest('.row'); // Temukan baris terdekat
        var itemDropdown = row.querySelector('.kriteria_dihindari_item'); // Temukan dropdown item di dalam baris tersebut
        itemDropdown.innerHTML = '<option value="">Select Item</option>';

        fetch(`/fetchItems?key=${dropdown.value}`)
            .then(response => response.json())
            .then(data => {
                Object.entries(data).forEach(([text, value]) => {
                    itemDropdown.appendChild(new Option(text, value));
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

    // function hapusDropdownCariDewasa(lenght_row, what_row) {
    //     if (what_row === 'left_row') {
    //         total_dicari += lenght_row;
    //     } else if (what_row === 'right_row') {
    //         total_dihindari += lenght_row;
    //     }

    //     var total_fix = total_dicari + total_dihindari;

    //     if (total_fix <= 0) {
    //         document.querySelector('.btn-soft').style.display = 'none';
    //     } else {
    //         document.querySelector('.btn-soft').style.display = 'block';
    //     }
    // }

    let kriteria_item_dicari_all = [];
    let kriteria_item_dihindari_all = [];

    document.getElementById('simpan').addEventListener('click', function() {
        var pilihan_kriteria = document.querySelector('input[name="pilihan_kriteria"]:checked').value;

        if (pilihan_kriteria === 'dicari') {
            // simpan kriteria dicari
            var kriteria_dicari = document.querySelectorAll('.kriteria_dicari_key');
            // var kriteria_item = document.querySelectorAll('.kriteria_dicari_item');
            // console.log('kriteria_dicari', kriteria_dicari);
            // console.log('kriteria_item', kriteria_item);
            var kriteria_item_dicari = [];

            kriteria_dicari.forEach((kriteria, index) => {
                const selectedItem = document.querySelectorAll('.kriteria_dicari_item')[index];
                const selectedIndex = selectedItem.selectedIndex;
                const selectedText = selectedIndex >= 0 ? selectedItem.options[selectedIndex].text : '';

                kriteria_item_dicari.push({
                    key: kriteria.value,
                    name: selectedText,
                    item: selectedItem.value
                });
            });


            // Menambahkan array kriteria dicari baru ke dalam array yang lebih besar
            kriteria_item_dicari_all.push(kriteria_item_dicari);

            // Mengosongkan input kriteria dicari
            document.querySelectorAll('.kriteria_dicari_key').forEach(input => input.value = '');
            document.querySelectorAll('.kriteria_dicari_item').forEach(input => input.value = '');

            var dicariOptions = kriteria_item_dicari_all.map(kriteria => kriteria.map(item => item.key + ': ' + item.item).join(', '));

            var simpanDicari = document.getElementById('simpan_dicari');
            simpanDicari.innerHTML = '';
            var iterasiDicari = 0;

            if (kriteria_item_dicari_all.filter(arr => arr.length > 0).length > 0) {
                kriteria_item_dicari_all.forEach(kriteriaArr => {
                    var h6 = document.createElement('h6');
                    var atau = document.createElement('h6');

                    var formattedText = kriteriaArr.map(item => item.key + ': ' + item.name).join(', ');
                    h6.textContent = formattedText;

                    if (iterasiDicari === 0) {
                        atau.textContent = '';
                    } else {
                        atau.textContent = 'ATAU';
                    }
                    simpanDicari.appendChild(atau);
                    simpanDicari.appendChild(h6);
                    iterasiDicari++;
                });
            } else {
                console.log('Array dicari kosong');
            }


        } else {
            // simpan kriteria dihindari
            var kriteria_dihindari = document.querySelectorAll('.kriteria_dihindari_key');
            var kriteria_item_dihindari = [];

            kriteria_dihindari.forEach((kriteria, index) => {
                kriteria_item_dihindari.push({
                    key: kriteria.value,
                    name: Object.keys($items).find(key => $items[key] === index),
                    item: document.querySelectorAll('.kriteria_dihindari_item')[index].value
                });
            });

            // Menambahkan array kriteria dihindari baru ke dalam array yang lebih besar
            kriteria_item_dihindari_all.push(kriteria_item_dihindari);

            // Mengosongkan input kriteria dihindari
            document.querySelectorAll('.kriteria_dihindari_key').forEach(input => input.value = '');
            document.querySelectorAll('.kriteria_dihindari_item').forEach(input => input.value = '');

            console.log('dicari', kriteria_item_dicari_all);
            console.log('dihindari', kriteria_item_dihindari_all);

            // Mengubah setiap array kriteria menjadi satu baris dengan 'atau' di antara setiap array
            var dihindariOptions = kriteria_item_dihindari_all.map(kriteria => kriteria.map(item => item.key + ': ' + item.item).join(', '));

            var simpanDihindari = document.getElementById('simpan_dihindari');
            simpanDihindari.innerHTML = '';
            var iterasiDihindari = 0;

            if (kriteria_item_dihindari_all.filter(arr => arr.length > 0).length > 0) {
                kriteria_item_dihindari_all.forEach(kriteriaArr => {
                    var h6 = document.createElement('h6');
                    var atau = document.createElement('h6');

                    var formattedText = kriteriaArr.map(item => item.key + ': ' + item.name).join(', ');
                    h6.textContent = formattedText;

                    if (iterasiDihindari === 0) {
                        atau.textContent = '';
                    } else {
                        atau.textContent = 'ATAU';
                    }
                    simpanDihindari.appendChild(atau);
                    simpanDihindari.appendChild(h6);
                    iterasiDihindari++;
                });
            } else {
                console.log('Array dihindari kosong');
            }
        }

        // hapus isi dari dropdown
        document.getElementById('kriteria_dicari_container').innerHTML = '';
        document.getElementById('kriteria_dihindari_container').innerHTML = '';

        // Munculkan tombol cari dewasa
        document.getElementById('cari_dewasa').style.display = 'block';
        // Sembunyikan tombol simpan
        document.querySelector('.btn-soft').style.display = 'none';
    });

    document.getElementById('hapus_dicari').addEventListener('click', function() {
        kriteria_item_dicari_all = [];
        document.getElementById('simpan_dicari').innerHTML = '-';

        if (kriteria_item_dihindari_all.length === 0) {
            document.getElementById('cari_dewasa').style.display = 'none';
        }
    });

    document.getElementById('hapus_dihindari').addEventListener('click', function() {
        kriteria_item_dihindari_all = [];
        document.getElementById('simpan_dihindari').innerHTML = '-';

        if (kriteria_item_dicari_all.length === 0) {
            document.getElementById('cari_dewasa').style.display = 'none';
        }
    });

    document.getElementById('cari_dewasa').addEventListener('click', function(event) {
        // Menyiapkan data dari kriteria_item_dicari_all
        var kriteriaDicariInput = document.createElement('input');
        kriteriaDicariInput.type = 'hidden'; // Menjadikan input tersembunyi
        kriteriaDicariInput.name = 'kriteria_dicari'; // Nama input
        kriteriaDicariInput.value = JSON.stringify(kriteria_item_dicari_all); // Mengubah array menjadi string JSON
        document.getElementById('input_form').appendChild(kriteriaDicariInput);

        // Menyiapkan data dari kriteria_item_dihindari_all
        var kriteriaDihindariInput = document.createElement('input');
        kriteriaDihindariInput.type = 'hidden'; // Menjadikan input tersembunyi
        kriteriaDihindariInput.name = 'kriteria_dihindari'; // Nama input
        kriteriaDihindariInput.value = JSON.stringify(kriteria_item_dihindari_all); // Mengubah array menjadi string JSON
        document.getElementById('input_form').appendChild(kriteriaDihindariInput);

        // Munculkan tombol ya dan tidak
        document.getElementById('konfirmasi').style.display = 'block';
        console.log('kriteria_dicari_input', kriteriaDicariInput);
        console.log('form', document.querySelector('form'));
    });
</script>

</body>

</html>