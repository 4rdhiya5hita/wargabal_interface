@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Calendar"])

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

                @include("partials/page-title", ["pagetitle" =>"Wargabal", "subtitle" =>"Calendar","title" =>"Calendar"])

                <div class="row mb-4">
                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="font-size-14 mb-2">Tanggal Lahir:</h5>
                                <div class="card directory-card">
                                    <div class="directory-bg text-center">
                                        <div class="directory-overlay p-2" style="background-color: rgba(var(--bs-primary-rgb), 0.7);">
                                            <h4 id="tanggal_lahir_dicari" class="text-white"></h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button id="elemenTanggalLahirbtn" class="btn btn-dark" id="btn-new-event mb-2" data-bs-dismiss="modal"><i class="mdi mdi-circle-outline"></i> Elemen Tanggal Lahir</button>
                                </div>
                                <div class="d-grid mt-2">
                                    <button id="dewasaTanggalLahirbtn" class="btn btn-dark" id="btn-new-event" data-bs-dismiss="modal"><i class="mdi mdi-circle-outline"></i> Dewasa Tanggal Lahir</button>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div id="filter-container">
                                    <h5 class="font-size-14 mb-2">Filter Kategori:</h5>
                                    <div class="input-group input-group-outline mb-3">
                                        <select class="form-control" id="category-filter">
                                            <option value="">Semua</option>
                                            <option value="guru">Guru</option>
                                            <option value="ratu">Ratu</option>
                                            <option value="lara">Lara</option>
                                            <option value="pati">Pati</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                            <h5 class="font-size-14 mb-3">Keterangan Wariga:</h5>
                                <span class="badge bg-info font-size-14">Guru</span>
                                <p>Guru (hari baik) diwakili oleh angka 1</p>
                                <span class="badge bg-success font-size-14">Ratu</span>
                                <p>Ratu (hari baik) diwakili oleh angka 2</p>
                                <span class="badge bg-warning font-size-14">Lara</span>
                                <p>Lara (hari buruk) diwakili oleh angka 3</p>
                                <span class="badge bg-danger font-size-14">Pati</span>
                                <p>Pati (hari buruk) diwakili oleh angka 4</p>
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

                <div class="modal fade" id="elemenTanggalLahirform" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body directory-card">
                                <div class="directory-bg text-center">
                                    <div class="directory-overlay" style="background-color: rgba(var(--bs-info-rgb), 0.7);">
                                        <h4>
                                            <span class="text-white font-weight-bold">Elemen Tanggal Lahir</span>
                                            <span class="text-white close float-end" data-bs-dismiss="modal" aria-hidden="true">&times;</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body p-4">
                                @foreach ($info_elemen_tanggal_lahir as $key => $elemen)
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
                                @endforeach
                            </div>
                            <div class="modal-body directory-card">
                                <div class="row mt-2">
                                    <button type="button" class="btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="dewasaTanggalLahirform" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered container">
                        <div class="modal-content">
                            <div class="modal-body directory-card">
                                <div class="directory-bg text-center">
                                    <div class="directory-overlay" style="background-color: rgba(var(--bs-info-rgb), 0.7);">
                                        <h4>
                                            <span class="text-white font-weight-bold">Dewasa Tanggal Lahir</span>
                                            <span class="text-white close float-end" data-bs-dismiss="modal" aria-hidden="true">&times;</span>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-body p-4">
                                <div class="row">
                                @foreach ($info_dewasa_tanggal_lahir as $key => $dewasa)
                                    @foreach ($dewasa['ala_ayuning_dewasa'] as $key => $ala_ayuning_dewasa)
                                    <div class="col-md-4">
                                        <div class="card bg-transparent shadow-none mb-0">
                                            <div class="card mini-stat bg-white">
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
                                @endforeach
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

<!-- plugin js -->
<script src="assets/libs/moment/min/moment.min.js"></script>
<script src="assets/libs/jquery-ui-dist/jquery-ui.min.js"></script>
<script src="assets/libs/@fullcalendar/core/main.min.js"></script>
<script src="assets/libs/@fullcalendar/bootstrap/main.min.js"></script>
<script src="assets/libs/@fullcalendar/daygrid/main.min.js"></script>
<script src="assets/libs/@fullcalendar/timegrid/main.min.js"></script>
<script src="assets/libs/@fullcalendar/interaction/main.min.js"></script>

<!-- Calendar init -->
<script src="assets/js/app.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tanggalElement = document.getElementById('tanggal_lahir_dicari');
        var tanggalLahirDicari = "{{ $tanggal_lahir_dicari }}";
        var formattedDate = formatDateIndonesia(tanggalLahirDicari);
        tanggalElement.textContent = formattedDate;

        var elemenTanggalLahir = document.getElementById('elemenTanggalLahirbtn');
        var dewasaTanggalLahir = document.getElementById('dewasaTanggalLahirbtn');

        elemenTanggalLahir.addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('elemenTanggalLahirform'), {
                keyboard: false
            });
            modal.show();
        });

        dewasaTanggalLahir.addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('dewasaTanggalLahirform'), {
                keyboard: false
            });
            modal.show();
        });

        var addEvent = $("#event-modal");
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
        var widthKalender = `<div class="modal-dialog modal-dialog-centered">`;
        var widthDewasa = `<div class="modal-dialog modal-dialog-centered container">`;
        var modalHeader = `
                <div class="modal-content">
                    <div class="modal-body directory-card">
                        <div class="directory-bg text-center">
                            <div class="directory-overlay" style="background-color: rgba(var(--bs-info-rgb), 0.7);">
                                <h4>
                                    <span class="text-white font-weight-bold">Wargabal Kalender Bali</span>
                                    <span class="text-white close float-end" data-bs-dismiss="modal" aria-hidden="true">&times;</span>
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
                            <button type="button" class="btn btn-dark me-1" data-bs-dismiss="modal">Close</button>
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

        var draggableEl = document.getElementById('external-events');
        var calendarEl = document.getElementById('calendar');
        var categoryFilterEl = document.getElementById('category-filter');
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

        function fetchElemenKalenderBali(start, end) {
            fetch('/fetchElemenKalenderBali?start=' + start + '&end=' + end)
                .then(response => response.json())
                .then(data => {
                    var elemenKalenderInnerHTML = '';

                    data.forEach(elemen => {
                        if (elemen['tanggal'] == start) {
                        elemenKalenderInnerHTML += `
                            <div class="modal fade" id="elemen_${elemen['tanggal']}" tabindex="-1">
                            `;
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

                                    elemenKalenderInnerHTML += `
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <p class="text-secondary text-xs mt-1 mb-0">${key}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <p class="text-secondary text-xs mt-1 mb-0">${elemen['kalender'][key]}</p>
                                                </div>
                                            </td>
                                        </tr>
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

        function fetchAlaAyuningDewasa(start, end) {
            fetch('/fetchAlaAyuningDewasa?start=' + start + '&end=' + end)
                .then(response => response.json())
                .then(data => {
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
                                                        <div class="col-md-4">
                                                            <div class="card bg-transparent shadow-none mb-0">
                                                                <div class="card mini-stat bg-white">
                                                                    <div class="card-body mini-stat-img" style="background: url(assets/images/bg-3.png); background-size: cover;">
                                                                        <div class="row">
                                                                            <div class="col-md-2">
                                                                                <div class="mini-stat-icon">
                                                                                    <img src="../assets/images/services/servis-vector-info-02.svg">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-10">
                                                                                <h5 class="mt-1 mb-2">${item['ala_ayuning_dewasa'][key]['nama']}</h5>
                                                                                <p>${item['ala_ayuning_dewasa'][key]['keterangan']}</p>
                                                                            </div>
                                                                        </div>
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
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        document.getElementById('elemenKalenderBalibtn').addEventListener('click', function() {
            strDate = newEventData.date.toISOString().split('T')[0];
            fetchElemenKalenderBali(strDate, strDate);
        });

        document.getElementById('alaAyuningDewasabtn').addEventListener('click', function() {
            strDate = newEventData.date.toISOString().split('T')[0];
            fetchAlaAyuningDewasa(strDate, strDate);
        });

        var events = @json($events);
       
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
            editable: true,
            droppable: true,
            selectable: true,
            defaultView: 'dayGridMonth',
            defaultDate: new Date('{{ $tahun_dicari }}-{{ $bulan_dicari }}-01'),
            themeSystem: 'bootstrap',
            header: {
                left: 'prev,next',
                center: 'title',
                className: 'btn-success',
                right: '',
                // right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth',
            },
            eventClick: function(info) {
                addEvent.modal('show');
                formEvent[0].reset();
                selectedEvent = info.event;
                $("#event-title").val(selectedEvent.title);
                $('#event-category').val(selectedEvent.classNames[0]);
                newEventData = null;
                modalTitle.text('Edit Event');
                newEventData = null;
            },
            dateClick: function(info) {
                newEventData = info;
                chooseEvent.modal('show');
            },
            events: events
        });
        calendar.render();

        // Function to filter events
        function filterEvents() {
            var category = categoryFilterEl.value;
            var filteredEvents = events.filter(function(event) {
                return category === '' || event.category === category;
            });

            calendar.removeAllEvents(); // Remove all existing events
            calendar.addEventSource(filteredEvents); // Add filtered events
        }

        // Add event listener for the filter dropdown
        categoryFilterEl.addEventListener('change', function() {
            filterEvents();
        });

        function formatDate(date) {
            var year = date.getFullYear();
            var month = String(date.getMonth() + 1).padStart(2, '0'); // Tambahkan 1 karena bulan dimulai dari 0
            var day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }

    });
</script>

</body>

</html>