<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ComponentsLexaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtrasLexaController;
use App\Http\Controllers\KeteranganController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\MainLexaController;
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

Route::get('/', [DashboardController::class, 'index'])->name('index');
Route::get('/calendar', [CalendarController::class, 'calendar'])->name('calendar');
Route::get('/fetchHariRaya', [CalendarController::class, 'fetchHariRaya'])->name('fetchHariRaya');
Route::get('/fetchAlaAyuningDewasa', [CalendarController::class, 'fetchAlaAyuningDewasa'])->name('fetchAlaAyuningDewasa');
Route::get('/fetchElemenKalenderBali', [CalendarController::class, 'fetchElemenKalenderBali'])->name('fetchElemenKalenderBali');
Route::get('/fetchKeterangan', [CalendarController::class, 'fetchKeterangan'])->name('fetchKeterangan');
Route::get('/fetchPiodalan', [CalendarController::class, 'fetchPiodalan'])->name('fetchPiodalan');
Route::get('/fetchZodiak', [CalendarController::class, 'fetchZodiak'])->name('fetchZodiak');

Route::get('/login', [AuthenticationController::class, 'login'])->name('login');

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

Route::get('/keterangan_pancawara_page', [KeteranganController::class, 'keterangan_pancawara_page'])->name('keterangan_pancawara_page');


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
