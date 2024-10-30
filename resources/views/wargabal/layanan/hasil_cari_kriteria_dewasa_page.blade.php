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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Layanan", "title" => "Mengatur Dewasa"])

                <div class="row">
                    <div class="col-md-12 mt-4 mb-2">
                        <div class="card z-index-2">
                            <div class="card-body">

                                <h5 class="mb-4">Hasil Ala Ayuning Dewasa Berdasarkan Kriteria</h5>
                                @if ($info_mengatur_dewasa != null)
                                    @foreach ($info_mengatur_dewasa as $key => $item)
                                    @if ($item['ala_ayuning_dewasa'] != null)
                                    @foreach ($info_elemen_kalender_bali as $key => $elemen)
                                    @if ($elemen['tanggal'] == $item['tanggal'])

                                    <div class="card bg-transparent shadow-none mb-0">
                                        <div class="card mini-stat bg-primary">
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
                                                        <div class="directory-overlay" style="background-color: rgba(var(--bs-primary-rgb), 0.7);">
                                                            <h4>
                                                                <span class="text-white font-weight-bold">Detail Elemen Kalender</span>
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
                                                                @foreach ($elemen['kalender'] as $key => $elemen_kalender_bali)
                                                                @if ($loop->first)
                                                                <tr class="table-primary">
                                                                    <th scope="row">Tahun Saka dan Sasih</th>
                                                                    <td> </td>
                                                                </tr>
                                                                @elseif ($loop->iteration == 3)
                                                                <tr class="table-primary">
                                                                    <th scope="row"> Pengalantaka </th>
                                                                    <td> </td>
                                                                </tr>
                                                                @elseif ($loop->iteration == 5)
                                                                <tr class="table-primary">
                                                                    <th scope="row"> Wewaran </th>
                                                                    <td> </td>
                                                                </tr>
                                                                @elseif ($loop->iteration == 15)
                                                                <tr class="table-primary">
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
                                                                        <div class="row">
                                                                            <div class="col d-flex align-items-center">
                                                                                <span class="text-secondary text-xs mt-1 mb-0">{{ $elemen_kalender_bali }}</span>
                                                                            </div>
                                                                            <div class="col d-flex align-items-center justify-content-end">
                                                                                <a href="#" class="text-primary" data-loop-iteration="{{ $elemen['tanggal'] }}_{{ $key }}">
                                                                                    @foreach($keterangan as $k => $ket)
                                                                                    @if($k == $key && $ket != null)
                                                                                    @foreach($ket as $value)
                                                                                    @if(strtolower($value['nama']) == strtolower($elemen_kalender_bali) && $value['keterangan'] != null)
                                                                                        <i class="mdi mdi-arrow-right"></i>
                                                                                    @endif
                                                                                    @endforeach
                                                                                    @endif
                                                                                    @endforeach
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <div class="modal fade" id="detail-{{ $elemen['tanggal'] }}_{{ $key }}" tabindex="-1">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body directory-card">
                                                                                <div class="directory-bg text-center">
                                                                                    <div class="p-2" style="background-color: rgba(var(--bs-primary-rgb), 0.7);">
                                                                                        <h4 class="mt-2">
                                                                                            <span class="text-white font-weight-bold">{{ $elemen_kalender_bali }}</span>
                                                                                            <a href="#" class="text-white close float-end icon-close-detail" data-bs-dismiss="modal" aria-hidden="true">
                                                                                                <i class="mdi mdi-close"></i>
                                                                                            </a>
                                                                                        </h4>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body pt-0">
                                                                                <div class="shadow p-4">
                                                                                    <div class="table-responsive">
                                                                                        <h5>Penjelasan:</h5>
                                                                                    @foreach($keterangan as $k => $ket)
                                                                                    @if($k == $key && $ket != null)
                                                                                    @foreach($ket as $value)
                                                                                    @if(strtolower($value['nama']) == strtolower($elemen_kalender_bali))
                                                                                        <span class="text-secondary font-size-14 mt-1 mb-0">{{ $value['keterangan'] }}</span>
                                                                                    @endif
                                                                                    @endforeach
                                                                                    @endif
                                                                                    @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
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
                                                                        <img src="../assets/images/services/servis-vector-primary-02.svg">
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

                                @else
                                    <div class="card bg-transparent shadow-none mb-0">
                                        <div class="card mini-stat bg-primary">
                                            <div class="card-body mini-stat-img" style="background: url(assets/images/bg-1.png); background-size: cover;">
                                                <div class="row">
                                                    <div class="text-white">
                                                        <h4 class="mt-1 mb-2">Tidak Menemukan Ala Ayuning Dewasa Berdasarkan Filter yang Dicari</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start">
                        <a onclick="history.back()" class="btn btn-primary mb-2">Kembali</a>
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
    $info_mengatur_dewasa = @json($info_mengatur_dewasa);
    console.log($info_mengatur_dewasa);
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

    var openKalendar = ''; // array untuk menyimpan id kalender yang sedang terbuka
    $(document).ready(function() {
        @foreach($info_mengatur_dewasa as $key => $item)
        $('#detail-{{ $item['tanggal'] }}').click(function() {
            $('#elemen_{{ $item['tanggal'] }}').modal('show');
            openKalendar = 'elemen_{{ $item['tanggal'] }}';
        });
        @endforeach
    });

    var openModal = []; // array untuk menyimpan id modal yang sedang terbuka
    $(document).ready(function() {
        $('a[data-loop-iteration]').click(function(event) {
            event.preventDefault(); // Mencegah tindakan default dari anchor link
            var loopIteration = $(this).data('loop-iteration');
            var modalId = 'detail-' + loopIteration;
            openModal.push(modalId); // tambahkan openModal baru ke array

            if (openModal.length > 1) {
                // jika ada lebih dari 1 modal yang terbuka, maka sembunyikan modal yang pertama
                $('#' + openModal[0]).modal('hide');
                openModal.shift(); // hapus openModal pertama dari array
            }
            $('#' + modalId).modal('show');
            
            // modal pada openKalendar dibuat agar mengecil dengan mengubah style heightnya
            $('#' + openKalendar).css('height', 0);

            // $('.icon-close-modal').hide();
        });

        $('.icon-close-detail').click(function() {
            $('#' + openKalendar).css('height', '100%');
            // $('.icon-close-modal').show();
        });

        // $('.close-all-modal').click(function() {
        //     for (var i = 0; i < openModal.length; i++) {
        //         $('#' + openModal[i]).modal('hide');
        //     }
        //     openModal = [];
        //     $('.icon-close-modal').show();
        // });
    });
</script>

</body>

</html>