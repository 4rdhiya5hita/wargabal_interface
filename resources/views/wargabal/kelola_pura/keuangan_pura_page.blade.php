@include("partials/main")

<head>
    <base href="/">

    @include("partials/title-meta", ["title" => "Keuangan Pura"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Kelola Pura", "title" => "Keuangan Pura"])

                <div class="row">
                    <div class="col-md-10">
                        <div class="card bg-transparent shadow-none mb-0">
                            <div class="card mini-stat bg-primary">
                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                    <div class="text-white">
                                        <div class="pt-4 pb-3">
                                            <h4 class="text-white ps-3">Halaman Pencarian Pura</h4>
                                            <p class="text-white text-xs px-3">Halaman pencarian ini membantu Anda mencari Pura Hindu dengan pengaturan yang mudah.</p>
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
                    <div class="col-md-12 mb-4">
                        <div class="card z-index-2 ">
                            <div class="card-body">
                                <div id="pura_form">
                                    <label class="form-label">Pura</label>
                                    <div class="input-group input-group-outline mb-3">
                                        <select class="form-control" aria-label="Default select example" name="pura_dicari" id="pura_dicari">
                                            @foreach($info_pura as $key => $pura)
                                            <option value="{{ $pura['id'] }}">{{ $pura['name'] }} di {{ $pura['address'] }}</option>
                                            @endforeach
                                        </select>
                                        <button id="cari_pura" class="btn btn-primary">
                                            <i class="mdi mdi-search me-1"></i> Cari
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="pura-container"></div>

                <!-- modal detail pura -->
                <div class="modal fade" id="detailPuraModal" tabindex="-1" role="dialog" aria-labelledby="detailPuraModalLabel" aria-hidden="true">
                </div>

                <!-- Custom Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination" id="pagination">
                        <!-- Pagination items will be dynamically inserted here -->
                    </ul>
                </nav>

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
        $('#pura_dicari').select2();
    });

    $('#cari_pura').click(function() {
        const puraId = $('#pura_dicari').val();
        $('[id^=info_pura_]').hide();
        $(`#info_pura_${puraId}`).show();
    });

    // $('[id^=buttonPura_]').click(function() {
    //     var id_pura = $(this).attr('id').split('_')[1];
    //     $('#detailPuraModal_' + id_pura).modal('show');
    // });
</script>

<script>
    const infoPura = @json($info_pura);
    const perPage = 20;
    let currentPage = 1;

    function renderPura(page) {
        currentPage = page;
        const start = (page - 1) * perPage;
        const end = start + perPage;
        const paginatedItems = infoPura.slice(start, end);

        const container = document.getElementById('pura-container');
        container.innerHTML = '';
        paginatedItems.forEach(pura => {
            const puraDiv = document.createElement('div');
            puraDiv.className = 'row';
            puraDiv.id = `info_pura_${pura.id}`;
            puraDiv.innerHTML = `
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="ps-3">${pura.name}</h5>
                            <p class="text-xs ps-3 mb-0">${pura.address}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 mb-4">
                    <a type="button" class="btn btn-primary w-100 h-100 d-flex justify-content-center align-items-center font-size-14" onclick="detailPuraModal(${pura.id})">Detail</a>
                </div>
            `;
            container.appendChild(puraDiv);
            renderPagination();
        });
    }

    function detailPuraModal(puraId) {
        const pura = infoPura.find(pura => pura.id === puraId);
        const modal = document.getElementById('detailPuraModal');
        modal.innerHTML = `
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body directory-card">
                        <div class="directory-bg text-center">
                            <div class="directory-overlay" style="background-color: rgba(var(--bs-primary-rgb), 0.7);">
                                <h4>
                                    <span class="text-white font-weight-bold">Detail Pura</span>
                                    <a href="#" class="text-white close float-end icon-close-modal" data-bs-dismiss="modal" aria-hidden="true">
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body p-4">
                        <div class="shadow">
                            <div class="table-responsive">
                                <table class="table align-items-center justify-content-center mb-0">
                                    ${Object.entries(pura).map(([key, value]) => {
                                        if (key === 'id' || key === 'benchmark' || key === 'city_id' || key === 'province_id' || key === 'country_id' || key === 'location_url' || key === 'latitude' || key === 'longitude' || key === 'created_at' || key === 'updated_at') {
                                            return '';
                                        }
                                        return `
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <p class="text-secondary text-xs mt-1 mb-0"><b>${key}</b></p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col d-flex align-items-center">
                                                            <span class="text-secondary text-xs mt-1 mb-0">${value}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        `;
                                    }).join('')}
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body directory-card">
                        <div class="row mt-2">
                            <button type="button" class="close-all-modal btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        const modalInstance = new bootstrap.Modal(modal, {
            keyboard: false
        });
        modalInstance.show();
        
    }
    

    function renderPagination() {
        const totalPages = Math.ceil(infoPura.length / perPage);
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        if (currentPage > 1) {
            const prev = document.createElement('li');
            prev.className = 'page-item';
            prev.innerHTML = `<a class="page-link" onclick="renderPura(${currentPage - 1})">Sebelumnya</a>`;
            pagination.appendChild(prev);
        }

        for (let page = 1; page <= totalPages; page++) {
            const li = document.createElement('li');
            li.className = `page-item ${page === currentPage ? 'active' : ''}`;
            li.innerHTML = `<a class="page-link" onclick="renderPura(${page})">${page}</a>`;
            pagination.appendChild(li);
        }

        if (currentPage < totalPages) {
            const next = document.createElement('li');
            next.className = 'page-item';
            next.innerHTML = `<a class="page-link" onclick="renderPura(${currentPage + 1})">Selanjutnya</a>`;
            pagination.appendChild(next);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderPura(currentPage);
        renderPagination();
    });
</script>

</body>

</html>