<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $layananController = new LayananController();
        $tanggal_mulai = date('Y-m-01');
        $tanggal_selesai = date('Y-m-t');

        $tanggal_sekarang = date('Y-m-d');

        Cache::remember('info_hari_raya_dashboard_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function () use ($tanggal_sekarang, $tanggal_mulai, $layananController) {
            $tanggal_selesai = date('Y-m-d', strtotime('+2 months', strtotime($tanggal_mulai)));
            $hari_raya = $layananController->callHariRaya($tanggal_sekarang, $tanggal_selesai);
            return $hari_raya;
        });

        Cache::remember('info_hari_raya_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function () use ($tanggal_mulai, $tanggal_selesai, $layananController) {
            $hari_raya = $layananController->callHariRaya($tanggal_mulai, $tanggal_selesai);
            return $hari_raya;
        });

        Cache::remember('info_ala_ayuning_dewasa_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function () use ($tanggal_mulai, $tanggal_selesai, $layananController) {
            $ala_ayuning_dewasa = $layananController->callAlaAyuningDewasa($tanggal_mulai, $tanggal_selesai);
            return $ala_ayuning_dewasa;
        });

        Cache::remember('info_piodalan_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function () use ($tanggal_mulai, $tanggal_selesai, $layananController) {
            $piodalan = $layananController->callPiodalan($tanggal_mulai, $tanggal_selesai);
            return $piodalan;
        });
        // dd($info_piodalan);
        // dd($info_hari_raya);


        $info_hari_raya = Cache::get('info_hari_raya_dashboard_' . $tanggal_mulai . '_' . $tanggal_selesai);
        $info_ala_ayuning_dewasa = Cache::get('info_ala_ayuning_dewasa_' . $tanggal_mulai . '_' . $tanggal_selesai);
        $info_piodalan = Cache::get('info_piodalan_' . $tanggal_mulai . '_' . $tanggal_selesai);

        foreach ($info_hari_raya as $key => $item) {
            if ($item['tanggal'] == $tanggal_sekarang) {
                $hari_raya_sekarang = $item['hari_raya'];
            } else {
                $hari_raya_sekarang = '-';   
            }
        }
        return view('wargabal.index', compact('tanggal_sekarang',  'hari_raya_sekarang', 'info_hari_raya', 'info_ala_ayuning_dewasa', 'info_piodalan'));
    }
}
