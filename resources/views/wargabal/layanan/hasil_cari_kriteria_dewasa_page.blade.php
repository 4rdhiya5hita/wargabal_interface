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
                    <div class="col-md-12 mt-4 mb-2">
                        <div class="card z-index-2">
                            <div class="card-body">

                                <h5 class="mb-4">Hasil Ala Ayuning Dewasa Berdasarkan Kriterria</h5>
                                @foreach ($info_mengatur_dewasa as $key => $item)
                                @if ($item['ala_ayuning_dewasa'] != null)
                                @foreach ($info_elemen_kalender_bali as $key => $elemen)
                                @if ($elemen['tanggal'] == $item['tanggal'])

                                <div class="card bg-transparent shadow-none mb-0">
                                    <div class="card mini-stat bg-info">
                                        <div class="card-body mini-stat-img" style="background: url(assets/images/bg-1.png); background-size: cover;">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="#btnDewasa-{{ $item['tanggal'] }}" class="btnDewasa text-white">
                                                        @php
                                                        $tanggal_format_nama = \Carbon\Carbon::createFromFormat('Y-m-d', $item['tanggal'])->locale('id')->isoFormat('DD MMMM YYYY');
                                                        @endphp
                                                        <h4 class="mt-1 mb-2">{{ $tanggal_format_nama }}</h4>
                                                        <p class="mb-0 font-weight-bold">
                                                            @foreach ($elemen['kalender'] as $key => $elemen_kalender_bali)
                                                            @if ($loop->iteration == 11)
                                                            {{ $elemen_kalender_bali }},
                                                            @endif
                                                            @if ($loop->iteration == 7)
                                                            {{ $elemen_kalender_bali }},
                                                            @endif
                                                            @if ($loop->iteration == 9)
                                                            {{ $elemen_kalender_bali }},
                                                            @endif
                                                            @if ($loop->iteration == 15)
                                                            Wuku {{ $elemen_kalender_bali }}
                                                            @endif
                                                            @if ($loop->iteration == 2)
                                                            sasih {{ $elemen_kalender_bali }},
                                                            @endif
                                                            @if ($loop->iteration == 1)
                                                            Tahun saka {{ $elemen_kalender_bali }}
                                                            @endif
                                                            @endforeach
                                                        </p>
                                                    </a>
                                                </div>
                                                <div class="col">
                                                    <div id="detail-{{ $elemen['tanggal'] }}" class="btn text-white d-flex justify-content-end">
                                                        <p class="text-xs mt-1 mb-0">klik detail</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="elemen_{{ $elemen['tanggal'] }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body directory-card">
                                                <div class="directory-bg text-center">
                                                    <div class="directory-overlay" style="background-color: rgba(var(--bs-info-rgb), 0.7);">
                                                        <h4>
                                                            <span class="text-white font-weight-bold">Detail Elemen Kalender</span>
                                                            <span class="text-white close float-end" data-bs-dismiss="modal" aria-hidden="true">&times;</span>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="shadow">
                                                    <div class="table-responsive">
                                                        <table class="table align-items-center justify-content-center mb-0">
                                                            @foreach ($elemen['kalender'] as $key => $elemen_kalender_bali)
                                                            @if ($loop->first)
                                                            <tr class="table-info">
                                                                <th scope="row">Tahun Saka dan Sasih</th>
                                                                <td> </td>
                                                            </tr>
                                                            @elseif ($loop->iteration == 3)
                                                            <tr class="table-info">
                                                                <th scope="row"> Pengalantaka </th>
                                                                <td> </td>
                                                            </tr>
                                                            @elseif ($loop->iteration == 5)
                                                            <tr class="table-info">
                                                                <th scope="row"> Wewaran </th>
                                                                <td> </td>
                                                            </tr>
                                                            @elseif ($loop->iteration == 15)
                                                            <tr class="table-info">
                                                                <th scope="row"> Elemen Lainnya </th>
                                                                <td> </td>
                                                            </tr>
                                                            @endif
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="text-secondary text-xs mt-1 mb-0">{{ ucwords(str_replace('_', ' ', $key)) }}</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <p class="text-secondary text-xs mt-1 mb-0">{{ $elemen_kalender_bali }}</p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body directory-card">
                                                <div class="row mt-2">
                                                    <button type="button" class="btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container p-0 m-0" id="btnDewasa-{{ $item['tanggal'] }}" style="display: none;">
                                    <div class="row d-flex">
                                        @foreach ($item['ala_ayuning_dewasa'] as $ala_ayuning_dewasa)
                                        <div class="col-md-6">
                                            <div class="card bg-transparent shadow-none mb-0">
                                                <div class="card mini-stat bg-light">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <div class="mini-stat-icon">
                                                                    <img src="../assets/images/services/servis-vector-info-02.svg">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <h5 class="mt-1 mb-2">{{ $ala_ayuning_dewasa['nama'] }}</h5>
                                                                <p>{{ $ala_ayuning_dewasa['keterangan'] }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                @endif
                                @endforeach
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start">
                        <a href="{{ route('mengatur_kriteria_awal_page') }}" type="button" class="btn btn-info mb-2">Kembali</a>
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
    // tampilkan detail modal saat btnDewasa diklik
    const btnDewasa = document.querySelectorAll('.btnDewasa');

    // tampilkan detail modal saat btnDewasa diklik
    btnDewasa.forEach(button => {
        button.addEventListener('click', function() {
            const detailID = this.getAttribute('href').substring(1);
            const detailModal = document.getElementById(detailID);
            if (detailModal.style.display === 'block') {
                detailModal.style.display = 'none';
                return;
            } else {
                detailModal.style.display = 'block';
            }

        });
    });

    $(document).ready(function() {
        @foreach($info_mengatur_dewasa as $key => $item)
        $('#detail-{{ $item['tanggal'] }}').click(function() {
            $('#elemen_{{ $item['tanggal'] }}').modal('show');
        });
        @endforeach
    });
</script>

</body>

</html>