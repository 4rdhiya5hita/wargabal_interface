/*
Template Name: Lexa - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Datatables
*/



$(document).ready(function () {
    const dataTablesLanguageSettings = {
        "decimal": "",
        "emptyTable": "Tidak ada data yang tersedia di tabel",
        "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
        "infoFiltered": "(difilter dari _MAX_ total entri)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Tampilkan _MENU_ entri",
        "loadingRecords": "Sedang memuat...",
        "processing": "Sedang memproses...",
        "search": "Cari:",
        "zeroRecords": "Tidak ditemukan catatan yang cocok",
        "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Berikutnya",
            "previous": "Sebelumnya"
        },
        "aria": {
            "sortAscending": ": aktifkan untuk mengurutkan kolom naik",
            "sortDescending": ": aktifkan untuk mengurutkan kolom turun"
        }
    };
    // Expose the configuration to the global scope
    window.dataTablesLanguageSettings = dataTablesLanguageSettings;

    $(document).ready(function () {
        // Inisialisasi DataTable dengan scrollX dan pengaturan bahasa
        var table = $('#datatable').DataTable({
            language: dataTablesLanguageSettings,
            scrollX: true
        });

        // Inisialisasi DataTable dengan tombol
        var tableButtons = $('#datatable-buttons').DataTable({
            language: dataTablesLanguageSettings,
            lengthChange: false,
            scrollX: true, // Tambahkan scrollX untuk tabel dengan tombol
            buttons: ['copy', 'excel', 'pdf', 'colvis']
        });

        // Tempatkan tombol pada container yang benar
        tableButtons.buttons().container()
            .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

        // Tambahkan kelas pada dropdown panjang halaman
        $(".dataTables_length select").addClass('form-select form-select-sm');
    });
}
);


