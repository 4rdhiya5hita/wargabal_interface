<?php

namespace App\Console\Commands;

use App\Http\Controllers\LayananController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheMonthly extends Command
{
    protected $signature = 'cache:monthly';

    protected $description = 'Caches data lama setiap bulan';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tanggal_mulai_bulan_kemarin = date('Y-m-01', strtotime('-1 month'));
        $tanggal_selesai_bulan_kemarin = date('Y-m-t', strtotime('-1 month'));

        $key = [
            'info_hari_raya_dashboard_' . $tanggal_mulai_bulan_kemarin . '_' . $tanggal_selesai_bulan_kemarin,
        ];

        foreach ($key as $k) {
            Cache::forget($k);
        }

        $this->info('Cache berhasil dihapus.');
    }

    // public function handle()
    // {
    //     $layananController = new LayananController();
    //     $tanggal_mulai = date('Y-m-01');
    //     $tanggal_selesai = date('Y-m-t');

    //     $tanggal_sekarang = date('Y-m-d');
    //     Cache::flush();

    //     Cache::remember('info_hari_raya_dashboard', 525600, function () use ($tanggal_sekarang, $tanggal_mulai, $layananController) {
    //         $tanggal_selesai = date('Y-m-d', strtotime('+2 months', strtotime($tanggal_mulai)));
    //         $hari_raya = $layananController->callHariRaya($tanggal_sekarang, $tanggal_selesai);
    //         return $hari_raya;
    //     });

    //     Cache::remember('info_hari_raya' . $tanggal_mulai . '_' . $tanggal_selesai, 525600, function () use ($tanggal_mulai, $tanggal_selesai, $layananController) {
    //         $hari_raya = $layananController->callHariRaya($tanggal_mulai, $tanggal_selesai);
    //         return $hari_raya;
    //     });

    //     Cache::remember('info_ala_ayuning_dewasa' . $tanggal_mulai . '_' . $tanggal_selesai, 525600, function () use ($tanggal_mulai, $tanggal_selesai, $layananController) {
    //         $ala_ayuning_dewasa = $layananController->callAlaAyuningDewasa($tanggal_mulai, $tanggal_selesai);
    //         return $ala_ayuning_dewasa;
    //     });

    //     Cache::remember('info_piodalan' . $tanggal_mulai . '_' . $tanggal_selesai, 525600, function () use ($tanggal_mulai, $tanggal_selesai, $layananController) {
    //         $piodalan = $layananController->callPiodalan($tanggal_mulai, $tanggal_selesai);
    //         return $piodalan;
    //     });

    //     Cache::remember('info_kalender_bali', 525600, function () use ($tanggal_mulai, $tanggal_selesai, $layananController) {
    //         $kalender_bali = $layananController->callElemenKalenderBali($tanggal_mulai, $tanggal_selesai);
    //         return $kalender_bali;
    //     });

    //     $this->info('Cache successfully refreshed.');
    // }
}
