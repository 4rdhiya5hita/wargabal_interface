@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Ala Ayuning Dewasa"])

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

                @include("partials/page-title", ["pagetitle" => "Wargabal", "subtitle" => "Layanan", "title" => "Ala Ayuning Dewasa"])

                @if ($cari_dengan == 'nama')
                <div class="row">
                    <div class="col-lg-6 col-md-6 mt-4 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body">
                                <h5>Hasil Pencarian: {{ $nama_ala_ayuning_dewasa_dicari }}</h5>
                                @foreach ($tanggal_dewasa as $key => $item)
                                <div class="card bg-transparent shadow-none mb-0">
                                    <div class="card mini-stat bg-primary">
                                        <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                            <div class="text-white">
                                                <div class="row">
                                                    <div class="col">
                                                        <h5 class="mt-1 mb-0">{{ $item }}</h5>
                                                        <p class="mb-0 font-weight-bold">{{ $nama_ala_ayuning_dewasa_dicari }}</p>
                                                    </div>
                                                    <div class="col">
                                                        <div id="detail-{{ $item }}" class="btn text-white d-flex justify-content-end">
                                                            <p class="text-xs mt-1 mb-0">klik detail</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="elemen_{{ $item }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body directory-card">
                                                <div class="directory-bg text-center">
                                                    <div class="directory-overlay" style="background-color: rgba(var(--bs-primary-rgb), 0.7);">
                                                        <h4>
                                                            <span class="text-white font-weight-bold">Detail Wariga</span>
                                                            <a href="#" class="text-white close float-end icon-close-modal" data-bs-dismiss="modal" aria-hidden="true">
                                                                <i class="mdi mdi-close"></i>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body p-4">
                                                @foreach ($info_elemen_kalender_bali as $key => $elemen)
                                                @if ($elemen['tanggal'] == $item)
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
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-body directory-card">
                                                <div class="row mt-2">
                                                    <button type="button" class="close-all-modal btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-start mt-3">
                            <a href="{{ route('ala_ayuning_dewasa_page') }}" type="button" class="btn btn-primary mb-2">Kembali</a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 mt-4 mb-4">
                        <div class="card z-index-2 ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h4>Informasi Ala Ayuning Dewasa</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <p class="text-secondary text-uppercase text-xs mt-1 mb-3">Tahun {{ $tahun_dicari }}</p>
                                    </div>
                                </div>
                                <hr class="horizontal light mt-0 mb-2">
                                <div class="card bg-transparent shadow-none mb-0">
                                    <div class="card mini-stat bg-primary">
                                        <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                            <div class="mini-stat-icon">
                                                <img src="../assets/images/services/servis-vector-white-02.svg" class="float-end" width="70" height="70">
                                            </div>
                                            <div class="text-white">
                                                <div class="pt-4 pb-3">
                                                    <h4 class="text-white ps-3">{{ $nama_ala_ayuning_dewasa_dicari }}</h4>
                                                    @if (strlen($keterangan_dewasa) > 200)
                                                    <p class="text-white ps-3">
                                                        {{ substr($keterangan_dewasa, 0, 200) }}
                                                        <span id="detail_keterangan" style="display:none">{{ substr($keterangan_dewasa, 200) }}</span>
                                                        <a href="#" class="text-white" onclick="document.getElementById('detail_keterangan').style.display = 'inline'; this.style.display = 'none';">...</a>
                                                    </p>
                                                    @else
                                                    <p class="text-white ps-3">{{ $keterangan_dewasa }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @else
                <div class="row">
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="card z-index-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5>Hasil Pencarian: Tanggal {{ $tanggal_dicari }}</h5>
                                    </div>
                                    <div class="col">
                                        <div id="detail-tanggal" class="btn text-dark d-flex justify-content-end">
                                            <p class="text-xs">klik disini untuk informasi tanggal</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="elemen_tanggal" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body directory-card">
                                                <div class="directory-bg text-center">
                                                    <div class="directory-overlay" style="background-color: rgba(var(--bs-primary-rgb), 0.7);">
                                                        <h4>
                                                            <span class="text-white font-weight-bold">Detail Wariga</span>
                                                            <a href="#" class="text-white close float-end icon-close-modal" data-bs-dismiss="modal" aria-hidden="true">
                                                                <i class="mdi mdi-close"></i>
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body p-4">
                                                @foreach ($info_elemen_kalender_bali as $key => $elemen)
                                                @if ($elemen['tanggal'] == $tanggal_dicari)
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
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="modal-body directory-card">
                                                <div class="row mt-2">
                                                    <button type="button" class="close-all-modal btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container p-0 m-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            @foreach ($info_ala_ayuning_dewasa as $key => $item)
                                            @foreach ($item['ala_ayuning_dewasa'] as $key => $ala_ayuning_dewasa)
                                            <div class="card bg-transparent shadow-none mb-0">
                                                <div class="card mini-stat bg-primary">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-0.png); background-size: cover;">
                                                        <div class="mini-stat-icon">
                                                            <img src="../assets/images/services/servis-vector-white-02.svg" class="float-end" width="60" height="60">
                                                        </div>
                                                        <div class="text-white">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h5 class="mt-1 mb-0">{{ $ala_ayuning_dewasa['nama'] }}</h5>
                                                                    <p class="mb-0 font-weight-bold">{{ $ala_ayuning_dewasa['keterangan'] }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mt-3">
                        <a href="{{ route('ala_ayuning_dewasa_page') }}" type="button" class="btn btn-primary mb-2">Kembali</a>
                    </div>
                </div>
                @endif

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
    function showElement(tanggal) {
        var elemen = document.getElementById('elemen_' + tanggal);
        if (elemen) {
            if (elemen.hidden) {
                elemen.hidden = false;
            } else {
                elemen.hidden = true;
            }
        }
    }

    function showDetailKeterangan() {
        var detail_keterangan = document.getElementById('detail_keterangan');
        if (detail_keterangan) {
            if (detail_keterangan.hidden) {
                detail_keterangan.hidden = false;
            } else {
                detail_keterangan.hidden = true;
            }
        }
    }

    var openKalendar = ''; // array untuk menyimpan id kalender yang sedang terbuka
    $(document).ready(function() {
        @foreach($info_ala_ayuning_dewasa as $key => $item)
        $('#detail-{{$item['tanggal']}}').click(function() {
            $('#elemen_{{$item['tanggal']}}').modal('show');
            openKalendar = 'elemen_{{$item['tanggal']}}';
        });
        @endforeach

        // show detail tanggal dicari
        $('#detail-tanggal').click(function() {
            $('#elemen_tanggal').modal('show');
            openKalendar = 'elemen_tanggal';
        });
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
            // console.log(openKalendar);
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