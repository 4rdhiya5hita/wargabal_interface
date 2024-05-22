<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $layananController = new LayananController();

        $tanggal_sekarang = date('Y-m-d');
        $tanggal_mulai = date('Y-m-01');
        $tanggal_selesai = date('Y-m-d', strtotime('+2 months', strtotime($tanggal_mulai)));
        // dd($tanggal_sekarang, $tanggal_mulai, $tanggal_selesai);
        $info_hari_raya = $layananController->callHariRaya($tanggal_sekarang, $tanggal_selesai);
        $info_ala_ayuning_dewasa = $layananController->callAlaAyuningDewasa($tanggal_mulai, $tanggal_selesai);
        $info_piodalan = $layananController->callPiodalan($tanggal_sekarang, $tanggal_selesai);
        // dd($info_piodalan);
        // dd($info_hari_raya);

        foreach ($info_hari_raya as $key => $item) {
            if ($item['tanggal'] == $tanggal_sekarang) {
                $hari_raya_sekarang = $item['hari_raya'];
                // dd($hari_raya_sekarang);
            }
        }
        return view('wargabal.index', compact('tanggal_sekarang',  'hari_raya_sekarang', 'info_hari_raya', 'info_ala_ayuning_dewasa', 'info_piodalan'));
    }
}
