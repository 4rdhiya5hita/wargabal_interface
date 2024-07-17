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

                <div id="dicari-container"></div>
                <div id="dihindari-container"></div>

            </div>
        </div>
        @include("partials/footer")
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

@include("partials/right-sidebar")

@include("partials/vendor-scripts")

<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

<!--Morris Chart-->
<script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
<script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>

<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
    var template_kriteria_dicari = @json($kriteriaDicari);
    var template_kriteria_dihindari = @json($kriteriaDihindari);
    var keys = @json($keys);

    function foundNameItem(key, item) {
        console.log(keysItems[key]);
        
        const found = keysItems.find(keysItem => keysItem.key === key);
        console.log(found);
        if (found) {
            return found.item[item];
        }
        return item;
    }


    // Fungsi untuk membuat elemen input disabled
    function createDisabledInputsDicari(template) {
        return template.map((group, index) => {
            // ajax
            return `
            <div class="row">
                <div class="col">
                    <label class="form-label kriteria-index">Template dicari ke-${index + 1}</label>
                </div>
                <div class="col">
                    ${group.map(item => 
                    `<div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="keys" value="${item.key}" disabled>
                    </div>
                    `).join('')}
                </div>

                <div class="col">
                    ${group.map(item =>
                    {
                        return `<div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" name="values" value="${foundNameItem(item.key, item.item)}" disabled>
                        </div>`;
                    }).join('')}

                </div>

                <div class="col input-group input-group-outline mb-3">
                    <button type="button" class="btn btn-danger btn_kriteria_dicari" onclick="hapusDropdownDicariTemplate(${index})">Hapus</button>
                </div>
            </div>
    `;
        }).join('');
    }

    function createDisabledInputsDihindari(template) {
        return template.map((group, index) => {
            // ajax
            return `
            <div class="row">
                <div class="col">
                    <label class="form-label kriteria-index">Template dihindari ke-${index + 1}</label>
                </div>
                <div class="col">
                    ${group.map(item => 
                    `<div class="input-group input-group-outline mb-3">
                        <input type="text" class="form-control" name="keys" value="${item.key}" disabled>
                    </div>
                    `).join('')}
                </div>

                <div class="col">
                    ${group.map(item =>
                    {
                        return `<div class="input-group input-group-outline mb-3">
                            <input type="text" class="form-control" name="values" value="${foundNameItem(item.key, item.item)}" disabled>
                        </div>`;
                    }).join('')}

                </div>

                <div class="col input-group input-group-outline mb-3">
                    <button type="button" class="btn btn-danger btn_kriteria_dihindari" onclick="hapusDropdownDihindariTemplate(${index})">Hapus</button>
                </div>
            </div>
    `;
        }).join('');
    }

    // Menampilkan hasil di HTML
    document.getElementById('dicari-container').innerHTML = createDisabledInputs(template_kriteria_dicari);
    document.getElementById('dihindari-container').innerHTML = createDisabledInputs(template_kriteria_dihindari);
</script>

</body>

</html>