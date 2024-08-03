<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    protected $url_web = "https://api.kalenderbali.web.id/api/";

    public function index()
    {
        // dd(session()->all());
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
        
        // $client = new Client();
        // $result = $client->request('GET', $this->url_web . 'infos');
        // $get_info_kita = json_decode($result->getBody()->getContents(), true);

        $adminController = new AdminController();
        $get_info_kita = $adminController->fetch_info_kita();
        $info_kita = json_decode($get_info_kita->getContent(), true);
        $info_kita = array_reverse($info_kita);

        foreach ($info_hari_raya as $key => $item) {
            if ($item['tanggal'] == $tanggal_sekarang) {
                $hari_raya_sekarang = $item['hari_raya'];
            } else {
                $hari_raya_sekarang = '-';
            }
        }
        // dd(session()->all());
        // dd(session('user')['email_verified_at']);
        // dd(session('user')['token']);


        // ambil data session success atau failed
        if (session('success') == 'login') {
            // dd('login');
            $message = 'Berhasil login!';
            $toast = true;
            return view('wargabal.index', compact('tanggal_sekarang',  'hari_raya_sekarang', 'info_hari_raya', 'info_ala_ayuning_dewasa', 'info_piodalan', 'info_kita', 'message', 'toast'));
        } elseif (session('success') == 'logout') {
            // dd('logout');
            $message = 'Berhasil logout!';
            $toast = true;
            return view('wargabal.index', compact('tanggal_sekarang',  'hari_raya_sekarang', 'info_hari_raya', 'info_ala_ayuning_dewasa', 'info_piodalan', 'info_kita', 'message', 'toast'));
        } elseif (session('success') == 'register') {
            // dd('register');
            $message = 'Berhasil register!';
            $toast = true;
            return view('wargabal.index', compact('tanggal_sekarang',  'hari_raya_sekarang', 'info_hari_raya', 'info_ala_ayuning_dewasa', 'info_piodalan', 'info_kita', 'message', 'toast'));
        } else {
            // dd('dashboard');
            $message = 'Selamat datang!';
            $toast = false;
            return view('wargabal.index', compact('tanggal_sekarang',  'hari_raya_sekarang', 'info_hari_raya', 'info_ala_ayuning_dewasa', 'info_piodalan', 'info_kita', 'message', 'toast'));
        }
    }
}
