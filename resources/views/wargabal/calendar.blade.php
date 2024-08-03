@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Kalender"])

    <link href="assets/libs/@fullcalendar/core/main.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/@fullcalendar/daygrid/main.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/@fullcalendar/bootstrap/main.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/@fullcalendar/timegrid/main.min.css" rel="stylesheet" type="text/css" />

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

                @include("partials/page-title", ["pagetitle" =>"Wargabal", "subtitle" =>"Kalender","title" =>"Kalender"])

                <div class="row mb-4">
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <div id="zodiakList"></div>
                                
                                <hr class="horizontal light my-3">
                                <h5>Piodalan bulan ini :</h5>
                                <p class="fst-italic">Selengkapnya dapat dilihat pada tombol di atas</p>
                                <div id="piodalanList"></div>

                                <hr class="horizontal light my-3">
                                <h5 class="mb-4">Hari Raya bulan ini :</h5>
                                <ul class="list-unstyled activity-feed ms-1" id="hariRayaList">
                                </ul>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-xl-9">
                        <div class="card mt-4 mt-xl-0 mb-0">
                            <div class="card-body">
                                <div id="calendar">
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                

                <!-- chooseEventForm -->
                <div class="modal fade" id="chooseEventForm" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-title">Mau cari tau apa hari ini?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4 text-center">
                                <div class="row">
                                    <div class="col">
                                        <button type="button" id="elemenKalenderBalibtn" class="btn btn-lg btn-info" data-bs-dismiss="modal">Elemen Kalender Bali</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" id="alaAyuningDewasabtn" class="btn btn-lg btn-info" data-bs-dismiss="modal">Ala Ayuning Dewasa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="modalHariRaya"></div>
                <div id="modalSelengkapnya"></div>

            </div>
            <!-- end modal-->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    @include("partials/footer")
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->

@include("partials/right-sidebar")

@include("partials/vendor-scripts")

<!-- Validation -->
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

<!-- plugin js -->
<script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/libs/@fullcalendar/core/main.min.js') }}"></script>
<script src="{{ asset('assets/libs/@fullcalendar/bootstrap/main.min.js') }}"></script>
<script src="{{ asset('assets/libs/@fullcalendar/daygrid/main.min.js') }}"></script>
<script src="{{ asset('assets/libs/@fullcalendar/timegrid/main.min.js') }}"></script>
<script src="{{ asset('assets/libs/@fullcalendar/interaction/main.min.js') }}"></script>

<!-- Calendar init -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var openKalendar = [];
        var addEvent = $("#event-modal");
        var addEventMore = $("#event-more-modal");
        var modalTitle = $("#modal-title");
        var formEvent = $("#form-event");
        var chooseEvent = $("#chooseEventForm");
        var selectedEvent = null;
        var newEventData = null;
        var forms = document.getElementsByClassName('needs-validation');
        var selectedEvent = null;
        var newEventData = null;
        var eventObject = null;
        var modalHariRaya = document.getElementById('modalHariRaya');
        var modalSelengkapnya = document.getElementById('modalSelengkapnya');
        var widthKalender = `<div class="modal-dialog modal-dialog-centered">`;
        var widthDewasa = `<div class="modal-dialog modal-dialog-centered">`;
        var modalHeader = `
                <div class="modal-content">
                    <div class="modal-body directory-card">
                        <div class="directory-bg text-center">
                            <div class="directory-overlay" style="background-color: rgba(var(--bs-info-rgb), 0.7);">
                                <h4>
                                    <span class="text-white font-weight-bold">Wargabal Kalender Bali</span>
                                    <a href="#" class="text-white close float-end icon-close-modal" data-bs-dismiss="modal" aria-hidden="true">
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        `;

        var modalFooter = `
        
                        </div>
                    </div>
                    <div class="modal-body directory-card">
                        <div class="row mt-2">
                            <button type="button" class="close-all-modal btn btn-dark me-1 close-all-modal" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        /* initialize the calendar */

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        // var Draggable = FullCalendarInteraction.Draggable;
        // var externalEventContainerEl = document.getElementById('external-events');
        // init dragable
        // new Draggable(externalEventContainerEl, {
        //     itemSelector: '.external-event',
        //     eventData: function(eventEl) {
        //         return {
        //             title: eventEl.innerText,
        //             className: $(eventEl).data('class')
        //         };
        //     }
        // });
        var defaultEvents = [
            // {
            //     title: 'All Day Event',
            //     start: new Date(y, m, 1)
            // },
            // {
            //     title: 'Long Event',
            //     start: new Date(y, m, d - 5),
            //     end: new Date(y, m, d - 2),
            //     className: 'bg-warning'
            // },
            // {
            //     id: 999,
            //     title: 'Repeating Event',
            //     start: new Date(y, m, d - 3, 16, 0),
            //     allDay: false,
            //     className: 'bg-info'
            // },
            // {
            //     id: 999,
            //     title: 'Repeating Event',
            //     start: new Date(y, m, d + 4, 16, 0),
            //     allDay: false,
            //     className: 'bg-primary'
            // },
            // {
            //     title: 'Meeting',
            //     start: new Date(y, m, d, 10, 30),
            //     allDay: false,
            //     className: 'bg-success'
            // },
            // {
            //     title: 'Lunch',
            //     start: new Date(y, m, d, 12, 0),
            //     end: new Date(y, m, d, 14, 0),
            //     allDay: false,
            //     className: 'bg-danger'
            // },
            // {
            //     title: 'Birthday Party',
            //     start: new Date(y, m, d + 1, 19, 0),
            //     end: new Date(y, m, d + 1, 22, 30),
            //     allDay: false,
            //     className: 'bg-success'
            // },
            // {
            //     title: 'Click for Google',
            //     start: new Date(y, m, 28),
            //     end: new Date(y, m, 29),
            //     url: 'http://google.com/',
            //     className: 'bg-dark'
            // }
        ];

        var draggableEl = document.getElementById('external-events');
        var calendarEl = document.getElementById('calendar');
        var info_ala_ayuning_dewasa = [];
        var info_elemen_kalender_bali = [];

        // function addNewEvent(info) {
        //     addEvent.modal('show');
        //     formEvent.removeClass("was-validated");
        //     formEvent[0].reset();

        //     $("#event-title").val();
        //     $('#event-category').val();
        //     modalTitle.text('Add Event');
        //     newEventData = info;
        // }
        function formatDateIndonesia(dateString) {
            // Pisahkan tahun, bulan, dan tanggal dari string tanggal
            const [year, month, day] = dateString.split('-');

            // Daftar nama bulan dalam bahasa Indonesia
            const monthNames = [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];

            // Daftar nama hari dalam bahasa Indonesia
            const dayNames = [
                'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
            ];

            // Bentuk objek tanggal dari string tanggal
            const dateObj = new Date(year, month - 1, day);

            // Dapatkan nama hari dari objek tanggal
            const dayName = dayNames[dateObj.getDay()];

            // Bentuk tanggal baru dengan format 'DD MMMM YYYY, nama_hari'
            const formattedDate = `${dayName}, ${parseInt(day, 10)} ${monthNames[parseInt(month, 10) - 1]} ${year}`;

            return formattedDate;
        }

        function fetchElemenKalenderBali(start, end, keterangan) {
            console.log('fetchElemenKalenderBali', start, end);
            fetch('/fetchElemenKalenderBali?start=' + start + '&end=' + end)
                .then(response => response.json())
                .then(data => {
                    var elemenKalenderInnerHTML = '';

                    data.forEach(elemen => {
                        if (elemen['tanggal'] == start) {
                        elemenKalenderInnerHTML += `
                            <div class="modal fade" id="elemen_${elemen['tanggal']}" tabindex="-1">
                            `;
                        openKalendar.push(elemen['tanggal']);
                        elemenKalenderInnerHTML += widthKalender;
                        elemenKalenderInnerHTML += modalHeader;
                        elemenKalenderInnerHTML += `
                                                <div class="modal-body py-4 pr-2 pl-4" name="event-form">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <div class="shadow">
                                                                    <div class="table-responsive">
                                                                        <table class="table align-items-center justify-content-center mb-0">
                        `;

                        // Periksa apakah elemen['kalender'] adalah objek sebelum melakukan iterasi
                        if (typeof elemen['kalender'] === 'object' && elemen['kalender'] !== null) {
                            let index = 0;

                            for (let key in elemen['kalender']) {
                                if (elemen['kalender'].hasOwnProperty(key)) {
                                    if (index === 0) {
                                        elemenKalenderInnerHTML += `
                                            <tr class="table-info">
                                                <th scope="row">Tahun Saka dan Sasih</th>
                                                <td> </td>
                                            </tr>
                                        `;
                                    } else if (index === 2) {
                                        elemenKalenderInnerHTML += `
                                            <tr class="table-info">
                                                <th scope="row"> Pengalantaka </th>
                                                <td> </td>
                                            </tr>
                                        `;
                                    } else if (index === 4) {
                                        elemenKalenderInnerHTML += `
                                            <tr class="table-info">
                                                <th scope="row"> Wewaran </th>
                                                <td> </td>
                                            </tr>
                                        `;
                                    } else if (index === 14) {
                                        elemenKalenderInnerHTML += `
                                            <tr class="table-info">
                                                <th scope="row"> Elemen Lainnya </th>
                                                <td> </td>
                                            </tr>
                                        `;
                                    }

                                    let formattedKey = key.replace(/_/g, ' ').replace(/\b\w/g, char => char.toUpperCase());
                                    elemenKalenderInnerHTML += `
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <p class="text-secondary text-xs mt-1 mb-0">${formattedKey}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col d-flex align-items-center">
                                                        <span class="text-secondary text-xs mt-1 mb-0">${elemen['kalender'][key]}</span>
                                                    </div>
                                                    <div class="col d-flex align-items-center justify-content-end">
                                                        <a href="#" class="text-primary" data-loop-iteration="${elemen['tanggal']}_${key}">
                                                        `;
                                                            for (let k in keterangan) {
                                                                if (k == key && keterangan[k] != null) {
                                                                    for (let value in keterangan[k]) {
                                                                        if (keterangan[k][value]['nama'] == elemen['kalender'][key] && keterangan[k][value]['keterangan'] != null) {
                                                                            elemenKalenderInnerHTML += `<i class="mdi mdi-arrow-right"></i>`;
                                                                        }   
                                                                    }
                                                                }
                                                            }

                                    elemenKalenderInnerHTML += `
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="detail-${elemen['tanggal']}_${key}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body directory-card">
                                                        <div class="directory-bg text-center">
                                                            <div class="p-2" style="background-color: rgba(var(--bs-info-rgb), 0.7);">
                                                                <h4 class="mt-2">
                                                                    <span class="text-white font-weight-bold">${elemen['kalender'][key]}</span>
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
                                                                `;

                                                                for (let k in keterangan) {
                                                                    if (k == key && keterangan[k] != null) {
                                                                        for (let value in keterangan[k]) {
                                                                            if (keterangan[k][value]['nama'] == elemen['kalender'][key]) {
                                                                                elemenKalenderInnerHTML += `<span class="text-secondary font-size-14 mt-1 mb-0">${keterangan[k][value]['keterangan']}</span>`;
                                                                            }   
                                                                        }
                                                                    }
                                                                }
                                    elemenKalenderInnerHTML += `
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                }

                                index++;
                            }
                        } else {
                            console.error('Data kalender tidak valid:', elemen['kalender']);
                        }

                        elemenKalenderInnerHTML += `
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        `;
                        elemenKalenderInnerHTML += modalFooter;
                        elemenKalenderInnerHTML += `
                        </div>
                        `;
                        }
                    });

                    // console.log(elemenKalenderInnerHTML);

                    // Tambahkan elemen ke dalam elemen HTML yang diinginkan
                    modalHariRaya.innerHTML = elemenKalenderInnerHTML;

                    // Buat objek modal baru
                    var modal = new bootstrap.Modal(document.getElementById('elemen_' + start), {
                        keyboard: false
                    });

                    // Tampilkan modal
                    modal.show();
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        var dataAlaAyuningDewasa = [];
        var dataZodiak = [];
        var dataPiodalan = [];
        var keteranganAlaAyuningDewasa = @json($keterangan_ala_ayuning_dewasa);
        function fetchAlaAyuningDewasa(start, end, fungsi) {
            fetch('/fetchAlaAyuningDewasa?start=' + start + '&end=' + end)
                .then(response => response.json())
                .then(data => {
                    if (fungsi == null || fungsi == false) {
                        console.log('klik');
                        var alaAyuningDewasaInnerHTML = '';
                        var strToday = formatDateIndonesia(start);
    
                        data.forEach(item => {
                            if (item['tanggal'] == start) {
                            alaAyuningDewasaInnerHTML += `
                                <div class="modal fade" id="dewasa_${item['tanggal']}" tabindex="-1">
                                `;
                            alaAyuningDewasaInnerHTML += widthDewasa;
                            alaAyuningDewasaInnerHTML += modalHeader;
                            alaAyuningDewasaInnerHTML += `
                                                <div class="modal-body pb-4 pr-4 pl-2" name="event-form">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="card px-2 pt-2 text-center bg-info">
                                                                <h5>
                                                                    <span class="text-white font-weight-bold">Ala Ayuning Dewasa - ${strToday}</span>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                        `;
                                                        for (let key in item['ala_ayuning_dewasa']) {
                                                            alaAyuningDewasaInnerHTML += `
                                                            <div class="col-md-12">
                                                                <div class="card bg-transparent shadow-none mb-0">
                                                                    <div class="card mini-stat bg-white">
                                                                        <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                                                            <div class="mini-stat-icon">
                                                                                <img src="../assets/images/services/servis-vector-info-02.svg" class="float-end" width="70" height="70">
                                                                            </div>
                                                                            <h5 class="mt-1 mb-2">${item['ala_ayuning_dewasa'][key]['nama']}</h5>
                                                                            <p>${item['ala_ayuning_dewasa'][key]['keterangan']}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            `;
                                                        }
    
                            alaAyuningDewasaInnerHTML += `
                                                        </div>
                                                    </div>
                                                </div>
                                            `;
                            alaAyuningDewasaInnerHTML += modalFooter;
                            alaAyuningDewasaInnerHTML += `
                            </div>
                            `;
                            }
                        });
    
                        // console.log(alaAyuningDewasaInnerHTML);
    
                        // Tambahkan elemen ke dalam elemen HTML yang diinginkan
                        modalHariRaya.innerHTML = alaAyuningDewasaInnerHTML;
    
                        // Buat objek modal baru
                        var modal = new bootstrap.Modal(document.getElementById('dewasa_' + start), {
                            keyboard: false
                        });
    
                        // Tampilkan modal
                        modal.show();
                    }

                    else {
                        console.log('render');
                        dataAlaAyuningDewasa = [];
                        const groupedData = {};

                        // Iterasi data utama
                        data.forEach(item => {
                            const strTanggal = formatDateIndonesia(item['tanggal']); // 'Minggu, 1 Agustus 2021'
                            const tanpaHari = strTanggal.split(', ')[1]; // '1 Agustus 2021'
                            const tanggal = tanpaHari.split(' ').slice(0, 2).join(' '); // '1 Agustus'

                            // Iterasi setiap ala_ayuning_dewasa dalam item
                            item.ala_ayuning_dewasa.forEach(ayuning => {
                                const nama = ayuning['nama'];
                                const keterangan = ayuning['keterangan'];

                                // Inisialisasi array tanggal jika belum ada
                                if (!groupedData[nama]) {
                                    groupedData[nama] = {
                                        nama: nama,
                                        tanggal: [],
                                        keterangan: keterangan // Tambahkan keterangan di sini jika diperlukan
                                    };
                                }
                                groupedData[nama].tanggal.push(tanggal);
                            });
                        });

                        const formattedData = Object.values(groupedData).map(item => {
                            return {
                                nama: item.nama,
                                tanggal: item.tanggal.join(', '),
                                keterangan: item.keterangan
                            };
                        });

                        dataAlaAyuningDewasa.push(...formattedData);

                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function fetchKeterangan(start, end) {
            return fetch('/fetchKeterangan?start=' + start + '&end=' + end)
                .then(response => response.json())
                .catch(error => {
                    console.error('Error fetching data:', error);
                    throw error; // Re-throw the error to handle it in the calling function
                });
        }

        const keterangan = @json($keterangan);
        const user = @json(session('user'));
        document.getElementById('elemenKalenderBalibtn').addEventListener('click', function() {
            if (user && user.permission == 'Member') {
                var startISOString = newEventData.date.toISOString(); // Mendapatkan string ISO
                var startDate = new Date(startISOString); // Mengonversi ke objek Date
                startDate.setDate(startDate.getDate() + 1); // Menambahkan satu hari
    
                var strDate = startDate.toISOString().split('T')[0];
                fetchElemenKalenderBali(strDate, strDate, keterangan);
            } else {
                // sweet alert untuk member premium
                Swal.fire({
                    title: 'Error!',
                    html: 'Anda belum menjadi <b>Member Premium</b>',
                    icon: 'error',
                    confirmButtonText: 'Cancel'
                });
            }
        });

        document.getElementById('alaAyuningDewasabtn').addEventListener('click', function() {
            if (user && user.permission == 'Member') {
                var startISOString = newEventData.date.toISOString();
                var startDate = new Date(startISOString); 
                startDate.setDate(startDate.getDate() + 1); 

                var strDate = startDate.toISOString().split('T')[0];
                fetchAlaAyuningDewasa(strDate, strDate, false);
            } else {
                // sweet alert untuk member premium
                Swal.fire({
                    title: 'Error!',
                    html: 'Anda belum menjadi <b>Member Premium</b>',
                    icon: 'error',
                    confirmButtonText: 'Cancel'
                });
            }
        });

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'id',
            plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
            editable: true,
            droppable: true,
            selectable: true,
            defaultView: 'dayGridMonth',
            themeSystem: 'bootstrap',
            header: {
                left: 'prev,next',
                center: 'title',
                right: ''
                // right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            eventClick: function(info) {
                var eventTitle = info.event.title;
                fetchKeteranganHariRaya(eventTitle);
            },
            datesRender: function(info) {
                var title = info.view.title; // Mengembalikan bulan dan tahun dalam format string
                var [monthName, year] = title.split(' ');
                var monthIndex = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'].indexOf(monthName) + 1;

                var start = new Date(info.view.activeStart.getTime() + 86400000).toISOString().split('T')[0]; // Menambahkan satu hari dan mengonversi ke string ISO
                var end = info.view.activeEnd.toISOString().split('T')[0];

                // kosongkan data dengan splice
                dataZodiak.splice(0, dataZodiak.length);
                dataPiodalan.splice(0, dataPiodalan.length);
                dataAlaAyuningDewasa.splice(0, dataAlaAyuningDewasa.length);
                fetchZodiak(monthIndex);
                fetchPiodalan(start, end);
                fetchHariRaya(start, end);
                fetchAlaAyuningDewasa(start, end, 'fungsi');
            },
            dateClick: function(info) {
                newEventData = info;
                chooseEvent.modal('show');
            }
        });
        calendar.render();

        function formatDate(date) {
            var year = date.getFullYear();
            var month = String(date.getMonth() + 1).padStart(2, '0'); // Tambahkan 1 karena bulan dimulai dari 0
            var day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

        function fetchKeteranganHariRaya(eventTitle) {
            const hariRaya = @json($keterangan_hari_raya);
            var keteranganHariRaya = '';

            hariRaya.forEach(function(elemen) {
                if (elemen['hari_raya'] === eventTitle) { // Membandingkan dengan judul event
                    keteranganHariRaya += `
                        <div class="modal fade" id="event-modal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body directory-card">
                                        <div class="directory-bg text-center">
                                            <div class="p-2" style="background-color: rgba(var(--bs-primary-rgb), 0.7);">
                                                <h4 class="mt-2">
                                                    <span class="text-white font-weight-bold">${eventTitle}</span>
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
                                                <span class="text-secondary font-size-14 mt-1 mb-0">${elemen['description']}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }
            });

            modalHariRaya.innerHTML = keteranganHariRaya;

            var modal = new bootstrap.Modal(document.getElementById('event-modal'), {
                keyboard: false
            });

            modal.show();
        }

        function fetchHariRaya(start, end) {
            fetch('/fetchHariRaya?start=' + start + '&end=' + end)
                .then(response => response.json())
                .then(data => {
                    calendar.removeAllEvents();
                    calendar.addEventSource(data);

                    document.getElementById('hariRayaList').innerHTML = '';
                    let count = 0;

                    data.forEach(function(item) {
                        // jika sudah loop ke 3, maka tampilkan 'Dan lainnya ...'
                        count++;
                        if (count <= 3) {

                            var listItem = document.createElement('li');
                            listItem.classList.add('feed-item');
    
                            var listItemContent = document.createElement('div');
                            listItemContent.classList.add('feed-item-list');
    
                            var contentDiv = document.createElement('div');
    
                            var dateDiv = document.createElement('div');
                            dateDiv.classList.add('date');
                            dateDiv.textContent = item.start;
    
                            var activityText = document.createElement('p');
                            activityText.classList.add('activity-text', 'mb-0');
                            activityText.textContent = item.title;
    
                            contentDiv.appendChild(dateDiv);
                            contentDiv.appendChild(activityText);
    
                            listItemContent.appendChild(contentDiv);
                            listItem.appendChild(listItemContent);
    
                            document.getElementById('hariRayaList').appendChild(listItem);

                        } else if (count == 4) {
                            
                            var listItem = document.createElement('li');
                            listItem.classList.add('feed-item');
    
                            var listItemContent = document.createElement('div');
                            listItemContent.classList.add('feed-item-list');
    
                            var contentDiv = document.createElement('div');
    
                            var dateDiv = document.createElement('div');
                            dateDiv.classList.add('date');
                            dateDiv.textContent = '';
    
                            var activityText = document.createElement('p');
                            activityText.classList.add('activity-text', 'mb-0');
                            activityText.textContent = 'Dan lainnya ...';
    
                            contentDiv.appendChild(dateDiv);
                            contentDiv.appendChild(activityText);
    
                            listItemContent.appendChild(contentDiv);
                            listItem.appendChild(listItemContent);
    
                            document.getElementById('hariRayaList').appendChild(listItem);
                        } else  {
                            return;
                        }
                    });
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function fetchZodiak(month) {
            fetch('/fetchZodiak?month=' + month)
                .then(response => response.json())
                .then(data => {
                    dataZodiak.push(data[0]);
                    console.log('dataZodiak', dataZodiak);
                    calendar.addEventSource(data);
                    var zodiakInnerHTML = '';

                    // data berupa {id: 7, nama: 'Capricorn', tanggal_mulai: '22 Desember', tanggal_selesai: '19 Januari', keterangan: 'Keterangan}
                    data.forEach(function(item) {
                        zodiakInnerHTML += `
                            <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                <h5 class="d-flex justify-content-center">${item.nama}</h5>
                                <p class="d-flex justify-content-center">${item.tanggal_mulai}-${item.tanggal_selesai}</p>
                                <hr class="horizontal light my-3">
                                <div class="d-flex justify-content-center">
                                    <img src="../assets/images/zodiak/Asset_${month}.svg" height="125" width="125">
                                </div>
                                <hr class="horizontal light my-3">
                                <p class="mb-0">${item.keterangan.substring(0, 100)}...</p>
                                <div class="btn btn-primary w-100 my-3" id="btn-Selengkapnya" value="${month}">Selengkapnya</div>
                            </div>
                        `;
                    });

                    document.getElementById('zodiakList').innerHTML = zodiakInnerHTML;
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        function fetchPiodalan(start, end) {
            fetch('/fetchPiodalan?start=' + start + '&end=' + end)
                .then(response => response.json())
                .then(data => {
                    dataPiodalan.push(data);
                    calendar.addEventSource(data);
                    var piodalanInnerHTML = '';
                    let count = 0;

                    data.forEach(piodalan => {
                        if (piodalan.pura != '-') {
                            count++;
                            if (count <= 3) {
                                piodalanInnerHTML += `
                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                        <h6>${piodalan.hari}</h6>
                                        <div class="text-dark">
                                            <span class="badge bg-primary"></span><span class="mx-2">+${piodalan.pura.length} Pura</span>
                                        </div>
                                    </div>
                                `;
                            } else if (count == 4) {
                                piodalanInnerHTML += `
                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                        <h6>Dan lainnya ...</h6>
                                    </div>
                                `;
                            } else {
                                return;
                            }
                        }
                    });

                    document.getElementById('piodalanList').innerHTML = piodalanInnerHTML;
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        let eventMoreModal = null; // Variabel untuk menyimpan modal

        // Event handler untuk tombol close dengan icon
        $('body').on('click', '.icon-close-penjelasan', function() {
            if (eventMoreModal) {
                eventMoreModal.remove(); // Hapus modal dari DOM
                eventMoreModal = null; // Kosongkan variabel modal
            }
        });

        // Event handler untuk tombol close dengan teks
        $('body').on('click', '.close-modal-penjelasan', function() {
            if (eventMoreModal) {
                eventMoreModal.remove(); // Hapus modal dari DOM
                eventMoreModal = null; // Kosongkan variabel modal
            }
        });

        $('body').on('click', '#btn-Selengkapnya', function() {
            var month = $(this).attr('value');

            openSelengkapnya(month);            
        });

        function openSelengkapnya (month) {
            bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];                    

            dataZodiakList = dataZodiak[0];
            dataPiodalanList = dataPiodalan[0];
            dataAlaAyuningDewasaList = dataAlaAyuningDewasa;
            var selengkapnyaInnerHTML = '';

            selengkapnyaInnerHTML += `
                <div class="modal fade d-flex" id="event-more-modal" tabindex="-1">
                    <div class="modal-dialog container">
                        <div class="modal-content">
                            <div class="modal-body directory-card">
                                <div class="directory-bg text-center">
                                    <div class="p-2" style="background-color: rgba(var(--bs-light-rgb), 0.7);">
                                        <h4 class="mt-2">
                                            <span class="text-dark font-weight-bold">Bulan ${bulan[month - 1]}</span>
                                            <a href="#" class="text-dark close float-end icon-close-penjelasan" data-bs-dismiss="modal" aria-hidden="true">
                                                <i class="mdi mdi-close"></i>
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body directory-card">
                                <div class="row">
                                    <div class="card task-box">
                                        <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                            <h5 class="d-flex justify-content-center">${dataZodiakList.nama}</h5>
                                            <p class="d-flex justify-content-center">${dataZodiakList.tanggal_mulai}-${dataZodiakList.tanggal_selesai}</p>
                                            <hr class="horizontal light my-3">
                                            <p class="d-flex justify-content-center mb-0">${dataZodiakList.keterangan}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card task-box">
                                            <div class="card-body pb-0">
                                                <h5 class="d-flex justify-content-center">Ala Ayuning Dewasa bulan ini</h5>
                                                <hr class="horizontal light mt-3">
                                            </div>
                                        </div>
                                        <div data-simplebar class="tasklist-content py-3" style="max-height: calc(100vh - 155px);">
                                        `;
                                        for (let dataAlaAyuningDewasa of dataAlaAyuningDewasaList) {
                                            const idTanpaSpasi = dataAlaAyuningDewasa.nama.toLowerCase().replace(/\s/g, '');
                                            selengkapnyaInnerHTML += `
                                                <div class="card task-box">
                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                                        <h6 class="text-uppercase font-size-16">${dataAlaAyuningDewasa.nama}</h6>
                                                        <div class="text-dark">
                                                            <span class="mx-2">${dataAlaAyuningDewasa.tanggal}</span>
                                                        </div>
                                                        <div class="text-dark mt-2" style="display: none;" id="penjelasan-${idTanpaSpasi}">
                                                            <h6 class="font-weight-bold mb-0">Keterangan:</h6>
                                                            <p>${dataAlaAyuningDewasa.keterangan}</p>
                                                        </div>
                                                        <div class="btn btn-primary mt-2 btn-Penjelasan" value="${idTanpaSpasi}">lihat penjelasan</div>
                                                    </div>
                                                </div>
                                            `;
                                        }

                    selengkapnyaInnerHTML += `
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card task-box">
                                            <div class="card-body pb-0">
                                                <h5 class="d-flex justify-content-center">Piodalan bulan ini</h5>
                                                <hr class="horizontal light mt-3">
                                            </div>
                                        </div>
                                        <div data-simplebar class="tasklist-content py-3" style="max-height: calc(100vh - 155px);">
                                `;
                                    for (let dataPiodalan of dataPiodalanList) {
                                        if (dataPiodalan.pura != '-') {
                                            selengkapnyaInnerHTML += `
                                            <div class="card task-box">
                                                <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                                    <div class="mini-stat-icon">
                                                        <img src="../assets/images/services/servis-vector-danger-03.svg" class="float-end" width="70" height="70">
                                                    </div>
                                                    <h6 class="text-uppercase font-size-16">${dataPiodalan.hari}</h6>
                                                    <p class="mb-3s">${dataPiodalan.tanggal}</p>
                                                    `;
                                                    for (let piodalan of dataPiodalan.pura) {
                                                        selengkapnyaInnerHTML += `
                                                        <div class="text-dark">
                                                            <span>- </span><span class="mx-2">${piodalan.nama_pura}</span>
                                                        </div>
                                                        `;
                                                    }
                                                    selengkapnyaInnerHTML += `
                                                        <span class="badge bg-warning">
                                                    `;
                                                    var tanggal_sekarang = new Date();
                                                    var tanggal_piodalan = new Date(dataPiodalan.tanggal);
                                                    var timeDiff = Math.abs(tanggal_piodalan - tanggal_sekarang);
                                                    var hari = Math.ceil(timeDiff / (1000 * 3600 * 24));
                                                    selengkapnyaInnerHTML += 
                                                            `${hari} hari lagi</span>
                                                        </span>
                                                </div>
                                            </div>
                                            `;
                                        }
                                    }
                selengkapnyaInnerHTML += `
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body directory-card">
                                <div class="row mt-2">
                                    <button type="button" class="close-all-modal btn btn-dark me-1 close-modal-penjelasan" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;

            if (eventMoreModal) {
                eventMoreModal.remove(); // Hapus modal yang ada sebelumnya dari DOM jika ada
            }
            $('body').append(selengkapnyaInnerHTML); // Tambahkan modal ke dalam body
            eventMoreModal = $('#event-more-modal'); // Simpan modal dalam variabel

            var modal = new bootstrap.Modal(document.getElementById('event-more-modal'), {
                keyboard: false
            });

            modal.show();
        }

        var openModal = []; // array untuk menyimpan id modal yang sedang terbuka
        $('body').on('click', 'a[data-loop-iteration]', function(event) {
            event.preventDefault(); // Mencegah tindakan default dari anchor link
            var loopIteration = $(this).data('loop-iteration');
            console.log(loopIteration);
            var modalId = 'detail-' + loopIteration;
            openModal.push(modalId); // tambahkan openModal baru ke array

            if (openModal.length > 1) {
                // jika ada lebih dari 1 modal yang terbuka, maka sembunyikan modal yang pertama
                $('#' + openModal[0]).modal('hide');
                openModal.shift(); // hapus openModal pertama dari array
            }
            $('#' + modalId).modal('show');
            $('#elemen_' + openKalendar).css('height', 0);

            // $('.icon-close-modal').hide();
        });

        $('body').on('click', '.icon-close-detail', function() {
            $('#elemen_' + openKalendar).css('height', '100%');
            // $('.icon-close-modal').show();
        });

       
        $('body').on('click', '.btn-Penjelasan', function() {
            var nama = $(this).attr('value');
            
            if ($('#penjelasan-' + nama).css('display') == 'none') {
                $(this).text('sembunyikan penjelasan');
                $('#penjelasan-' + nama).css('display', 'block');
            } else {
                $(this).text('lihat penjelasan');
                $('#penjelasan-' + nama).css('display', 'none');
            }
        });

        // $('body').on('click', '.close-all-modal', function() {
        //     for (var i = 0; i < openModal.length; i++) {
        //         $('#' + openModal[i]).modal('hide');
        //     }
        //     openModal = [];
        //     $('.icon-close-modal').show();
        //     console.log(openModal);
        // });

              

        /*Add new event*/
        // Form to add new event

        // $(formEvent).on('submit', function(ev) {
        //     ev.preventDefault();
        //     var inputs = $('#form-event :input');
        //     var updatedTitle = $("#event-title").val();
        //     var updatedCategory = $('#event-category').val();

        //     // validation
        //     if (forms[0].checkValidity() === false) {
        //         event.preventDefault();
        //         event.stopPropagation();
        //         forms[0].classList.add('was-validated');
        //     } else {
        //         if (selectedEvent) {
        //             selectedEvent.setProp("title", updatedTitle);
        //             selectedEvent.setProp("classNames", [updatedCategory]);
        //         } else {
        //             var newEvent = {
        //                 title: updatedTitle,
        //                 start: newEventData.date,
        //                 allDay: newEventData.allDay,
        //                 className: updatedCategory
        //             }
        //             calendar.addEvent(newEvent);
        //         }
        //         addEvent.modal('hide');
        //     }
        // });

        // $("#btn-delete-event").on('click', function(e) {
        //     if (selectedEvent) {
        //         selectedEvent.remove();
        //         selectedEvent = null;
        //         addEvent.modal('hide');
        //     }
        // });

        // $("#btn-new-event").on('click', function(e) {
        //     addNewEvent({
        //         date: new Date(),
        //         allDay: true
        //     });
        // });
    });

    
</script>

</body>

</html>