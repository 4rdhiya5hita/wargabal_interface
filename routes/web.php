<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ComponentsLexaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtrasLexaController;
use App\Http\Controllers\KeteranganController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\MainLexaController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

// Auth
Route::get('/login_page', [AuthenticationController::class, 'login_page'])->name('login_page');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
Route::get('/register_page', [AuthenticationController::class, 'register_page'])->name('register_page');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
Route::get('/konfirmasi_email', [AuthenticationController::class, 'konfirmasi_email'])->name('konfirmasi_email');
Route::get('/verifikasi_email', [AuthenticationController::class, 'verifikasi_email'])->name('verifikasi_email');
Route::post('/verifikasi_ulang_email', [AuthenticationController::class, 'verifikasi_ulang_email'])->name('verifikasi_ulang_email');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

// Fetch
Route::get('/fetch_contribution', [AdminController::class, 'fetch_contribution'])->name('fetch_contribution');

// Admin
Route::post('/ajukan_kontribusi', [AdminController::class, 'ajukan_kontribusi'])->name('ajukan_kontribusi');
Route::post('/edit_permission', [AdminController::class, 'edit_permission'])->name('edit_permission');
Route::post('/edit_contribution_status', [AdminController::class, 'edit_contribution_status'])->name('edit_contribution_status');

// Info Kita
Route::get('/info_kita_page', [AdminController::class, 'info_kita_page'])->name('info_kita_page');
Route::get('/info_kita_detail_page/{id}', [AdminController::class, 'info_kita_detail_page'])->name('info_kita_detail_page');

Route::get('/fetch_info_kita', [AdminController::class, 'fetch_info_kita'])->name('fetch_info_kita');
Route::post('/create_info_kita', [AdminController::class, 'create_info_kita'])->name('create_info_kita');
Route::post('/detail_info_kita', [AdminController::class, 'detail_info_kita'])->name('detail_info_kita');
Route::post('/edit_info_kita', [AdminController::class, 'edit_info_kita'])->name('edit_info_kita');
Route::post('/delete_info_kita', [AdminController::class, 'delete_info_kita'])->name('delete_info_kita');

// // jika session token tidak ada, maka redirect ke route login_page
// Route::group(['middleware' => 'auth'], function () {
//     // Route contoh
//     Route::get('/calendar', [CalendarController::class, 'calendar'])->name('calendar');
// });

Route::get('/', [DashboardController::class, 'index'])->name('index');
Route::get('/calendar', [CalendarController::class, 'calendar'])->name('calendar');
Route::post('/calendarPDF', [PDFController::class, 'generateCalendarPDF'])->name('calendarPDF');
Route::get('/calendarTemplate', [PDFController::class, 'calendarTemplate'])->name('calendarTemplate');
Route::get('/download', [PDFController::class, 'download'])->name('download');

Route::get('/fetchHariRaya', [CalendarController::class, 'fetchHariRaya'])->name('fetchHariRaya');
Route::get('/fetchAlaAyuningDewasa', [CalendarController::class, 'fetchAlaAyuningDewasa'])->name('fetchAlaAyuningDewasa');
Route::get('/fetchElemenKalenderBali', [CalendarController::class, 'fetchElemenKalenderBali'])->name('fetchElemenKalenderBali');
Route::get('/fetchKeterangan', [CalendarController::class, 'fetchKeterangan'])->name('fetchKeterangan');
Route::get('/fetchPiodalan', [CalendarController::class, 'fetchPiodalan'])->name('fetchPiodalan');
Route::get('/fetchZodiak', [CalendarController::class, 'fetchZodiak'])->name('fetchZodiak');

Route::get('/kalender_bali_page', [DashboardController::class, 'kalender_bali_page'])->name('kalender_bali_page');
Route::get('/hari_raya_page', [LayananController::class, 'hari_raya_page'])->name('hari_raya_page');
Route::get('/ala_ayuning_dewasa_page', [LayananController::class, 'ala_ayuning_dewasa_page'])->name('ala_ayuning_dewasa_page');
Route::get('/piodalan_page', [LayananController::class, 'piodalan_page'])->name('piodalan_page');
Route::get('/otonan_page', [LayananController::class, 'otonan_page'])->name('otonan_page');
Route::get('/ramalan_sifat_page', [LayananController::class, 'ramalan_sifat_page'])->name('ramalan_sifat_page');

Route::get('/mengatur_kriteria_awal_page', [LayananController::class, 'mengatur_kriteria_awal_page'])->name('mengatur_kriteria_awal_page');
Route::post('/mengatur_kriteria_parameter_page', [LayananController::class, 'mengatur_kriteria_parameter_page'])->name('mengatur_kriteria_parameter_page');
Route::get('/wariga_personal_page', [LayananController::class, 'wariga_personal_page'])->name('wariga_personal_page');

Route::post('/cari_hari_raya', [LayananController::class, 'cari_hari_raya'])->name('cari_hari_raya');
Route::post('/cari_ala_ayuning_dewasa', [LayananController::class, 'cari_ala_ayuning_dewasa'])->name('cari_ala_ayuning_dewasa');
Route::post('/cari_piodalan', [LayananController::class, 'cari_piodalan'])->name('cari_piodalan');
Route::post('/cari_otonan', [LayananController::class, 'cari_otonan'])->name('cari_otonan');
Route::post('/cari_kriteria_dewasa', [LayananController::class, 'cari_kriteria_dewasa'])->name('cari_kriteria_dewasa');
Route::post('/cari_wariga_personal', [LayananController::class, 'cari_wariga_personal'])->name('cari_wariga_personal');
Route::post('/cari_ramalan_sifat', [LayananController::class, 'cari_ramalan_sifat'])->name('cari_ramalan_sifat');

Route::get('/fetchKeys', [LayananController::class, 'fetchKeys'])->name('fetchKeys');
Route::get('/fetchItems', [LayananController::class, 'fetchItems'])->name('fetchItems');

Route::get('/jadi_member_premium', [PurchaseController::class, 'jadi_member_premium'])->name('jadi_member_premium');
Route::get('/pembelian_anda', [PurchaseController::class, 'pembelian_anda'])->name('pembelian_anda');
Route::post('/purchase', [PurchaseController::class, 'purchase'])->name('purchase');

Route::middleware(['permission:Admin'])->group(function () {
    Route::get('/admin_profile', [AdminController::class, 'profile'])->name('profile');
    
    // Admin Page
    Route::get('/transaksi_user_page', [AdminController::class, 'transaksi_user_page'])->name('transaksi_user_page');
    Route::get('/manajemen_user_page', [AdminController::class, 'manajemen_user_page'])->name('manajemen_user_page');
    Route::get('/manajemen_info_kita_page', [AdminController::class, 'manajemen_info_kita_page'])->name('manajemen_info_kita_page');
    Route::get('/pengajuan_kontribusi_page', [AdminController::class, 'pengajuan_kontribusi_page'])->name('pengajuan_kontribusi_page');
    Route::get('/pengajuan_edit_page', [AdminController::class, 'pengajuan_edit_page'])->name('pengajuan_edit_page');
});

Route::middleware(['permission:Guest,Member,Admin'])->group(function () {
    // User Page
    Route::get('/member_profile', [AdminController::class, 'profile'])->name('profile');
    Route::get('/kelola_pura_page', [LayananController::class, 'kelola_pura_page'])->name('kelola_pura_page');

    Route::get('/manajemen_pura_user_page', [AdminController::class, 'manajemen_pura_user_page'])->name('manajemen_pura_user_page');
    Route::get('/fetch_pura_user', [AdminController::class, 'fetch_pura_user'])->name('fetch_pura_user');
    Route::post('/create_pura_user', [AdminController::class, 'create_pura_user'])->name('create_pura_user');
    Route::post('/edit_pura_user', [AdminController::class, 'edit_pura_user'])->name('edit_pura_user');
    Route::post('/delete_pura_user', [AdminController::class, 'delete_pura_user'])->name('delete_pura_user');

    Route::get('piodalan_pura_page/{id}', [LayananController::class, 'piodalan_pura_page'])->name('piodalan_pura_page');
    Route::post('create_piodalan_pura/{id}', [LayananController::class, 'create_piodalan_pura'])->name('create_piodalan_pura');
    Route::post('edit_piodalan_pura/{id}', [LayananController::class, 'edit_piodalan_pura'])->name('edit_piodalan_pura');
    Route::post('hapus_piodalan_pura/{id}', [LayananController::class, 'hapus_piodalan_pura'])->name('hapus_piodalan_pura');

    Route::get('acara_piodalan_pura/{piodalan_id}/{pura_id}', [LayananController::class, 'acara_piodalan_pura'])->name('acara_piodalan_pura');
    Route::post('create_acara_piodalan_pura/{id}', [LayananController::class, 'create_acara_piodalan_pura'])->name('create_acara_piodalan_pura');
    Route::post('edit_acara_piodalan_pura/{id}', [LayananController::class, 'edit_acara_piodalan_pura'])->name('edit_acara_piodalan_pura');
    Route::post('hapus_acara_piodalan_pura/{id}', [LayananController::class, 'hapus_acara_piodalan_pura'])->name('hapus_acara_piodalan_pura');

    Route::get('keuangan_pura_page/{id}', [LayananController::class, 'keuangan_pura_page'])->name('keuangan_pura_page');
    Route::post('create_keuangan_pura/{id}', [LayananController::class, 'create_keuangan_pura'])->name('create_keuangan_pura');
    Route::post('edit_keuangan_pura/{id}', [LayananController::class, 'edit_keuangan_pura'])->name('edit_keuangan_pura');
    Route::post('hapus_keuangan_pura/{id}', [LayananController::class, 'hapus_keuangan_pura'])->name('hapus_keuangan_pura');

    Route::get('/keterangan_page', [KeteranganController::class, 'keterangan_page'])->name('keterangan_page');
    Route::post('/ajukan_edit/{id}', [KeteranganController::class, 'ajukan_edit'])->name('ajukan_edit');
    Route::get('/pengajuan_edit_keterangan_page', [AdminController::class, 'pengajuan_edit_keterangan_page'])->name('pengajuan_edit_keterangan_page');
    Route::post('/edit_pengajuan_keterangan', [AdminController::class, 'edit_pengajuan_keterangan'])->name('edit_pengajuan_keterangan');
    
    Route::get('/keterangan_ekawara_page', [KeteranganController::class, 'keterangan_ekawara_page'])->name('keterangan_ekawara_page');
    Route::get('/keterangan_dwiwara_page', [KeteranganController::class, 'keterangan_dwiwara_page'])->name('keterangan_dwiwara_page');
    Route::get('/keterangan_triwara_page', [KeteranganController::class, 'keterangan_triwara_page'])->name('keterangan_triwara_page');
    Route::get('/keterangan_caturwara_page', [KeteranganController::class, 'keterangan_caturwara_page'])->name('keterangan_caturwara_page');
    Route::get('/keterangan_pancawara_page', [KeteranganController::class, 'keterangan_pancawara_page'])->name('keterangan_pancawara_page');
    Route::get('/keterangan_sadwara_page', [KeteranganController::class, 'keterangan_sadwara_page'])->name('keterangan_sadwara_page');
    Route::get('/keterangan_saptawara_page', [KeteranganController::class, 'keterangan_saptawara_page'])->name('keterangan_saptawara_page');
    Route::get('/keterangan_astawara_page', [KeteranganController::class, 'keterangan_astawara_page'])->name('keterangan_astawara_page');
    Route::get('/keterangan_sangawara_page', [KeteranganController::class, 'keterangan_sangawara_page'])->name('keterangan_sangawara_page');
    Route::get('/keterangan_dasawara_page', [KeteranganController::class, 'keterangan_dasawara_page'])->name('keterangan_dasawara_page');
    
    Route::get('/keterangan_ingkel_page', [KeteranganController::class, 'keterangan_ingkel_page'])->name('keterangan_ingkel_page');
    Route::get('/keterangan_jejepan_page', [KeteranganController::class, 'keterangan_jejepan_page'])->name('keterangan_jejepan_page');
    Route::get('/keterangan_lintang_page', [KeteranganController::class, 'keterangan_lintang_page'])->name('keterangan_lintang_page');
    Route::get('/keterangan_rakam_page', [KeteranganController::class, 'keterangan_rakam_page'])->name('keterangan_rakam_page');
    Route::get('/keterangan_watek_madya_page', [KeteranganController::class, 'keterangan_watek_madya_page'])->name('keterangan_watek_madya_page');
    Route::get('/keterangan_watek_alit_page', [KeteranganController::class, 'keterangan_watek_alit_page'])->name('keterangan_watek_alit_page');
    Route::get('/keterangan_neptu_page', [KeteranganController::class, 'keterangan_neptu_page'])->name('keterangan_neptu_page');
    Route::get('/keterangan_ekajalarsi_page', [KeteranganController::class, 'keterangan_ekajalarsi_page'])->name('keterangan_ekajalarsi_page');
    Route::get('/keterangan_panca_sudha_page', [KeteranganController::class, 'keterangan_panca_sudha_page'])->name('keterangan_panca_sudha_page');
    Route::get('/keterangan_pangarasan_page', [KeteranganController::class, 'keterangan_pangarasan_page'])->name('keterangan_pangarasan_page');
    Route::get('/keterangan_pratiti_page', [KeteranganController::class, 'keterangan_pratiti_page'])->name('keterangan_pratiti_page');
    Route::get('/keterangan_zodiak_page', [KeteranganController::class, 'keterangan_zodiak_page'])->name('keterangan_zodiak_page');
    Route::get('/keterangan_wuku_page', [KeteranganController::class, 'keterangan_wuku_page'])->name('keterangan_wuku_page');
    
    Route::get('/keterangan_hari_raya_page', [KeteranganController::class, 'keterangan_hari_raya_page'])->name('keterangan_hari_raya_page');
    Route::get('/keterangan_ala_ayuning_dewasa_page', [KeteranganController::class, 'keterangan_ala_ayuning_dewasa_page'])->name('keterangan_ala_ayuning_dewasa_page');
    
    Route::post('/edit_ala_ayuning_dewasa/{id}', [KeteranganController::class, 'edit_ala_ayuning_dewasa'])->name('edit_ala_ayuning_dewasa');
    Route::post('/edit_hari_raya/{id}', [KeteranganController::class, 'edit_hari_raya'])->name('edit_hari_raya');
    
    Route::post('/edit_ekawara/{id}', [KeteranganController::class, 'edit_ekawara'])->name('edit_ekawara');
    Route::post('/edit_dwiwara/{id}', [KeteranganController::class, 'edit_dwiwara'])->name('edit_dwiwara');
    Route::post('/edit_triwara/{id}', [KeteranganController::class, 'edit_triwara'])->name('edit_triwara');
    Route::post('/edit_caturwara/{id}', [KeteranganController::class, 'edit_caturwara'])->name('edit_caturwara');
    Route::post('/edit_pancawara/{id}', [KeteranganController::class, 'edit_pancawara'])->name('edit_pancawara');
    Route::post('/edit_sadwara/{id}', [KeteranganController::class, 'edit_sadwara'])->name('edit_sadwara');
    Route::post('/edit_saptawara/{id}', [KeteranganController::class, 'edit_saptawara'])->name('edit_saptawara');
    Route::post('/edit_astawara/{id}', [KeteranganController::class, 'edit_astawara'])->name('edit_astawara');
    Route::post('/edit_sangawara/{id}', [KeteranganController::class, 'edit_sangawara'])->name('edit_sangawara');
    Route::post('/edit_dasawara/{id}', [KeteranganController::class, 'edit_dasawara'])->name('edit_dasawara');
    
    Route::post('/edit_ingkel/{id}', [KeteranganController::class, 'edit_ingkel'])->name('edit_ingkel');
    Route::post('/edit_jejepan/{id}', [KeteranganController::class, 'edit_jejepan'])->name('edit_jejepan');
    Route::post('/edit_lintang/{id}', [KeteranganController::class, 'edit_lintang'])->name('edit_lintang');
    Route::post('/edit_rakam/{id}', [KeteranganController::class, 'edit_rakam'])->name('edit_rakam');
    Route::post('/edit_watek_madya/{id}', [KeteranganController::class, 'edit_watek_madya'])->name('edit_watek_madya');
    Route::post('/edit_watek_alit/{id}', [KeteranganController::class, 'edit_watek_alit'])->name('edit_watek_alit');
    Route::post('/edit_neptu/{id}', [KeteranganController::class, 'edit_neptu'])->name('edit_neptu');
    Route::post('/edit_ekajalarsi/{id}', [KeteranganController::class, 'edit_ekajalarsi'])->name('edit_ekajalarsi');
    Route::post('/edit_panca_sudha/{id}', [KeteranganController::class, 'edit_panca_sudha'])->name('edit_panca_sudha');
    Route::post('/edit_pangarasan/{id}', [KeteranganController::class, 'edit_pangarasan'])->name('edit_pangarasan');
    Route::post('/edit_pratiti/{id}', [KeteranganController::class, 'edit_pratiti'])->name('edit_pratiti');
    Route::post('/edit_zodiak/{id}', [KeteranganController::class, 'edit_zodiak'])->name('edit_zodiak');
    Route::post('/edit_wuku/{id}', [KeteranganController::class, 'edit_wuku'])->name('edit_wuku');
});


Route::get('/fetchKeteranganHariRaya', [LayananController::class, 'keteranganHariRaya'])->name('fetchKeteranganHariRaya');
Route::get('/fetchKeteranganAlaAyuningDewasa', [LayananController::class, 'keteranganAlaAyuningDewasa'])->name('fetchKeteranganAlaAyuningDewasa');

Route::get('/fetchEkawara', [LayananController::class, 'keteranganEkawara'])->name('fetchEkawara');
Route::get('/fetchDwiwara', [LayananController::class, 'keteranganDwiwara'])->name('fetchDwiwara');
Route::get('/fetchTriwara', [LayananController::class, 'keteranganTriwara'])->name('fetchTriwara');
Route::get('/fetchCaturwara', [LayananController::class, 'keteranganCaturwara'])->name('fetchCaturwara');
Route::get('/fetchPancawara', [LayananController::class, 'keteranganPancawara'])->name('fetchPancawara');
Route::get('/fetchSadwara', [LayananController::class, 'keteranganSadwara'])->name('fetchSadwara');
Route::get('/fetchSaptawara', [LayananController::class, 'keteranganSaptawara'])->name('fetchSaptawara');
Route::get('/fetchAstawara', [LayananController::class, 'keteranganAstawara'])->name('fetchAstawara');
Route::get('/fetchSangawara', [LayananController::class, 'keteranganSangawara'])->name('fetchSangawara');
Route::get('/fetchDasawara', [LayananController::class, 'keteranganDasawara'])->name('fetchDasawara');

Route::get('/fetchIngkel', [LayananController::class, 'keteranganIngkel'])->name('fetchIngkel');
Route::get('/fetchJejepan', [LayananController::class, 'keteranganJejepan'])->name('fetchJejepan');
Route::get('/fetchLintang', [LayananController::class, 'keteranganLintang'])->name('fetchLintang');
Route::get('/fetchRakam', [LayananController::class, 'keteranganRakam'])->name('fetchRakam');
Route::get('/fetchWatekMadya', [LayananController::class, 'keteranganWatekMadya'])->name('fetchWatekMadya');
Route::get('/fetchWatekAlit', [LayananController::class, 'keteranganWatekAlit'])->name('fetchWatekAlit');
Route::get('/fetchNeptu', [LayananController::class, 'keteranganNeptu'])->name('fetchNeptu');
Route::get('/fetchEkajalarsi', [LayananController::class, 'keteranganEkajalarsi'])->name('fetchEkajalarsi');
Route::get('/fetchPancaSudha', [LayananController::class, 'keteranganPancaSudha'])->name('fetchPancaSudha');
Route::get('/fetchPangarasan', [LayananController::class, 'keteranganPangarasan'])->name('fetchPangarasan');
Route::get('/fetchPratiti', [LayananController::class, 'keteranganPratiti'])->name('fetchPratiti');
Route::get('/fetchKeteranganZodiak', [LayananController::class, 'keteranganZodiak'])->name('fetchKeteranganZodiak');
Route::get('/fetchWuku', [LayananController::class, 'keteranganWuku'])->name('fetchWuku');


// LEXA TEMPLATE

Route::get('/dashboard', [MainLexaController::class, 'dashboard'])->name('dashboard');
// Route::get('/calendar-lexa', [MainLexaController::class, 'calendar'])->name('calendar');

Route::get('/email-inbox', [MainLexaController::class, 'emailInbox'])->name('email-inbox');
Route::get('/email-read', [MainLexaController::class, 'emailRead'])->name('email-read');
Route::get('/email-compose', [MainLexaController::class, 'emailCompose'])->name('email-compose');
Route::get('/chat', [MainLexaController::class, 'chat'])->name('chat');
Route::get('/kanbanboard', [MainLexaController::class, 'kanbanboard'])->name('kanbanboard');

Route::get('/ui-alerts', [ComponentsLexaController::class, 'uiAlerts'])->name('ui-alerts');
Route::get('/ui-buttons', [ComponentsLexaController::class, 'uiButtons'])->name('ui-buttons');
Route::get('/ui-badge', [ComponentsLexaController::class, 'uiBadge'])->name('ui-badge');
Route::get('/ui-cards', [ComponentsLexaController::class, 'uiCards'])->name('ui-cards');
Route::get('/ui-carousel', [ComponentsLexaController::class, 'uiCarousel'])->name('ui-carousel');
Route::get('/ui-dropdowns', [ComponentsLexaController::class, 'uiDropdowns'])->name('ui-dropdowns');
Route::get('/ui-utilities', [ComponentsLexaController::class, 'uiUtilities'])->name('ui-utilities');
Route::get('/ui-grid', [ComponentsLexaController::class, 'uiGrid'])->name('ui-grid');
Route::get('/ui-images', [ComponentsLexaController::class, 'uiImages'])->name('ui-images');
Route::get('/ui-lightbox', [ComponentsLexaController::class, 'uiLightbox'])->name('ui-lightbox');
Route::get('/ui-modals', [ComponentsLexaController::class, 'uiModals'])->name('ui-modals');
Route::get('/ui-colors', [ComponentsLexaController::class, 'uiColors'])->name('ui-colors');
Route::get('/ui-offcanvas', [ComponentsLexaController::class, 'uiOffcanvas'])->name('ui-offcanvas');
Route::get('/ui-pagination', [ComponentsLexaController::class, 'uiPagination'])->name('ui-pagination');
Route::get('/ui-popover-tooltips', [ComponentsLexaController::class, 'uiPopoverTooltips'])->name('ui-popover-tooltips');
Route::get('/ui-rangeslider', [ComponentsLexaController::class, 'uiRangeslider'])->name('ui-rangeslider');
Route::get('/ui-session-timeout', [ComponentsLexaController::class, 'uiSessionTimeout'])->name('ui-session-timeout');
Route::get('/ui-progressbars', [ComponentsLexaController::class, 'uiProgressbars'])->name('ui-progressbars');
Route::get('/ui-sweet-alert', [ComponentsLexaController::class, 'uiSweetAlert'])->name('ui-sweet-alert');
Route::get('/ui-tabs-accordions', [ComponentsLexaController::class, 'uiTabsAccordions'])->name('ui-tabs-accordions');
Route::get('/ui-typography', [ComponentsLexaController::class, 'uiTypography'])->name('ui-typography');
Route::get('/ui-video', [ComponentsLexaController::class, 'uiVideo'])->name('ui-video');

Route::get('/form-elements', [ComponentsLexaController::class, 'formElements'])->name('form-elements');
Route::get('/form-validation', [ComponentsLexaController::class, 'formValidation'])->name('form-validation');
Route::get('/form-advanced', [ComponentsLexaController::class, 'formAdvanced'])->name('form-advanced');
Route::get('/form-editors', [ComponentsLexaController::class, 'formEditors'])->name('form-editors');
Route::get('/form-uploads', [ComponentsLexaController::class, 'formUploads'])->name('form-uploads');
Route::get('/form-xeditable', [ComponentsLexaController::class, 'formXeditable'])->name('form-xeditable');

Route::get('/charts-morris', [ComponentsLexaController::class, 'chartsMorris'])->name('charts-morris');
Route::get('/charts-chartist', [ComponentsLexaController::class, 'chartsChartist'])->name('charts-chartist');
Route::get('/charts-chartjs', [ComponentsLexaController::class, 'chartsChartjs'])->name('charts-chartjs');
Route::get('/charts-flot', [ComponentsLexaController::class, 'chartsFlot'])->name('charts-flot');
Route::get('/charts-c3', [ComponentsLexaController::class, 'chartsC3'])->name('charts-c3');
Route::get('/charts-other', [ComponentsLexaController::class, 'chartsOther'])->name('charts-other');

Route::get('/tables-basic', [ComponentsLexaController::class, 'tablesBasic'])->name('tables-basic');
Route::get('/tables-datatable', [ComponentsLexaController::class, 'tablesDatatable'])->name('tables-datatable');
Route::get('/tables-responsive', [ComponentsLexaController::class, 'tablesResponsive'])->name('tables-responsive');
Route::get('/tables-editable', [ComponentsLexaController::class, 'tablesEditable'])->name('tables-editable');

Route::get('/icons-material', [ComponentsLexaController::class, 'iconsMaterial'])->name('icons-material');
Route::get('/icons-ion', [ComponentsLexaController::class, 'iconsIon'])->name('icons-ion');
Route::get('/icons-fontawesome', [ComponentsLexaController::class, 'iconsFontawesome'])->name('icons-fontawesome');
Route::get('/icons-themify', [ComponentsLexaController::class, 'iconsThemify'])->name('icons-themify');
Route::get('/icons-dripicons', [ComponentsLexaController::class, 'iconsDripicons'])->name('icons-dripicons');
Route::get('/icons-typicons', [ComponentsLexaController::class, 'iconsTypicons'])->name('icons-typicons');

Route::get('/maps-google', [ComponentsLexaController::class, 'mapsGoogle'])->name('maps-google');
Route::get('/maps-vector', [ComponentsLexaController::class, 'mapsVector'])->name('maps-vector');

Route::get('/layouts-light-sidebar', [ExtrasLexaController::class, 'layoutsLightSidebar'])->name('layouts-light-sidebar');
Route::get('/layouts-compact-sidebar', [ExtrasLexaController::class, 'layoutsCompactSidebar'])->name('layouts-compact-sidebar');
Route::get('/layouts-icon-sidebar', [ExtrasLexaController::class, 'layoutsIconSidebar'])->name('layouts-icon-sidebar');
Route::get('/layouts-boxed', [ExtrasLexaController::class, 'layoutsBoxed'])->name('layouts-boxed');
Route::get('/layouts-preloader', [ExtrasLexaController::class, 'layoutsPreloader'])->name('layouts-preloader');
Route::get('/layouts-colored-sidebar', [ExtrasLexaController::class, 'layoutsColoredSidebar'])->name('layouts-colored-sidebar');
Route::get('/layouts-horizontal', [ExtrasLexaController::class, 'layoutsHorizontal'])->name('layouts-horizontal');
Route::get('/layouts-hori-topbar-dark', [ExtrasLexaController::class, 'layoutsHoriTopbarDark'])->name('layouts-hori-topbar-dark');
Route::get('/layouts-hori-preloader', [ExtrasLexaController::class, 'layoutsHoriPreloader'])->name('layouts-hori-preloader');
Route::get('/layouts-hori-boxed-width', [ExtrasLexaController::class, 'layoutsHoriBoxedWidth'])->name('layouts-hori-boxed-width');

Route::get('/pages-login', [ExtrasLexaController::class, 'pagesLogin'])->name('pages-login');
Route::get('/pages-register', [ExtrasLexaController::class, 'pagesRegister'])->name('pages-register');
Route::get('/pages-recoverpw', [ExtrasLexaController::class, 'pagesRecoverpw'])->name('pages-recoverpw');
Route::get('/pages-lock-screen', [ExtrasLexaController::class, 'pagesLockScreen'])->name('pages-lock-screen');
Route::get('/pages-timeline', [ExtrasLexaController::class, 'pagesTimeline'])->name('pages-timeline');
Route::get('/pages-invoice', [ExtrasLexaController::class, 'pagesInvoice'])->name('pages-invoice');
Route::get('/pages-directory', [ExtrasLexaController::class, 'pagesDirectory'])->name('pages-directory');
Route::get('/pages-blank', [ExtrasLexaController::class, 'pagesBlank'])->name('pages-blank');
Route::get('/pages-404', [ExtrasLexaController::class, 'pages404'])->name('pages-404');
Route::get('/pages-500', [ExtrasLexaController::class, 'pages500'])->name('pages-500');
