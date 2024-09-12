<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class LayananController extends Controller
{
    protected $url_web = "https://api.kalenderbali.web.id/api/";
    protected $url_api = 'https://api2.kalenderbali.web.id/api/';
    // protected $url_api = 'http://localhost:8000/api/';

    public function hari_raya_page()
    {
        $data = Cache::remember('data_hari_raya', now()->addDays(365), function () {
            return $this->keteranganHariRaya();
        });
        $hari_raya = collect($data)->where('type', 'hari raya')->sortBy('nama');
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $tanggal_sekarang = date('Y-m-d');
        $tanggal_mulai = date('Y-m-01');
        $tanggal_selesai = date('Y-m-t');
        $info_hari_raya = Cache::get('info_hari_raya_' . $tanggal_mulai . '_' . $tanggal_selesai);

        foreach ($info_hari_raya as $key => $item) {
            if ($item['tanggal'] == $tanggal_sekarang) {
                $hari_raya_sekarang = $item['hari_raya'];
                // dd($hari_raya_sekarang);
            }
        }
        return view('wargabal.layanan.hari_raya_page', compact('tanggal_sekarang',  'hari_raya_sekarang', 'hari_raya', 'bulan', 'info_hari_raya'));
    }

    public function cari_hari_raya(Request $request)
    {
        $validatedData = $request->validate([
            'nama_hari_raya_dicari' => 'required',
            'tahun_dicari' => 'required|numeric'
        ]);

        if ($validatedData) {
            $nama_hari_raya_dicari = $request->nama_hari_raya_dicari;
            $tahun_dicari = $request->tahun_dicari;

            if ($request->cari_dengan == 'tahun') {
                $tanggal_mulai = $tahun_dicari . '-01-01';
                $tanggal_selesai = $tahun_dicari . '-12-31';
            } else {
                $bulan_dicari = $request->bulan_dicari;
                $tanggal_mulai = $tahun_dicari . '-' . str_pad($bulan_dicari + 1, 2, '0', STR_PAD_LEFT) . '-01';
                $tanggal_selesai = $tahun_dicari . '-' . str_pad($bulan_dicari + 1, 2, '0', STR_PAD_LEFT) . '-' . date('t', strtotime($tanggal_mulai));
                $nama_bulan_dicari = $this->ubahNamaBulan($bulan_dicari);
            }
        } else {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }

        // $info_hari_raya = $this->callHariRaya($tanggal_mulai, $tanggal_selesai);
        // cache 
        $info_hari_raya = Cache::remember('info_hari_raya_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function () use ($tanggal_mulai, $tanggal_selesai) {
            $layanan = new LayananController();
            $hari_raya = $layanan->callHariRaya($tanggal_mulai, $tanggal_selesai);
            return $hari_raya;
        });

        // $info_elemen_kalender_bali = $this->callElemenKalenderBali($tanggal_mulai, $tanggal_selesai);
        // cache
        $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function () use ($tanggal_mulai, $tanggal_selesai) {
            $layanan = new LayananController();
            $elemen_kalender_bali = $layanan->callElemenKalenderBali($tanggal_mulai, $tanggal_selesai);
            return $elemen_kalender_bali;
        });

        $keterangan = $this->callKeteranganElemenKalenderBali();

        // foreach($keterangan as $k => $ket){
        //     if ($k == 'ingkel' && $ket != null) {
        //         foreach($ket as $value) {
        //             if($value['nama'] == 'sumur sinaba') {
        //                 dd('done');
        //             }
        //         }
        //     }
        // }


        // foreach ($data as $key => $item) {
        //     foreach ($item['hari_raya'] as $key => $hari_raya) {
        //         if ($hari_raya != '-') {
        //             if ($hari_raya['nama'] == $nama_hari_raya_dicari) {
        //                 $hari_raya = $item;
        //             }
        //         }
        //     }
        // }
        // dd($info_hari_raya);

        return view('wargabal.layanan.pencarian_hari_raya_page', compact('info_hari_raya', 'info_elemen_kalender_bali', 'nama_hari_raya_dicari', 'tahun_dicari', 'keterangan'));
    }

    public function callHariRaya($tanggal_mulai, $tanggal_selesai)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'cariHariRaya?tanggal_mulai=' . $tanggal_mulai . '&tanggal_selesai=' . $tanggal_selesai . '&beserta_keterangan', [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganHariRaya()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'keteranganHariRaya', [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function callElemenKalenderBali($tanggal_mulai, $tanggal_selesai)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'cariElemenKalenderBali?tanggal_mulai=' . $tanggal_mulai . '&tanggal_selesai=' . $tanggal_selesai, [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function callZodiak()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'keteranganZodiak', [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function callKeteranganElemenKalenderBali()
    {
        $layanan = new LayananController();

        $info_ingkel_api = $layanan->keteranganIngkel();
        $info_jejepan_api = $layanan->keteranganJejepan();
        $info_lintang_api = $layanan->keteranganLintang();
        $info_rakam_api = $layanan->keteranganRakam();
        $info_watek_madya_api = $layanan->keteranganWatekMadya();
        $info_watek_alit_api = $layanan->keteranganWatekAlit();
        $info_neptu_api = $layanan->keteranganNeptu();
        $info_eka_jala_rsi_api = $layanan->keteranganEkaJalaRsi();
        $info_panca_sudha_api = $layanan->keteranganPancaSudha();
        $info_pangarasan_api = $layanan->keteranganPangarasan();
        $info_pratiti_api = $layanan->keteranganPratiti();
        $info_zodiak_api = $layanan->keteranganZodiak();
        $info_ekawara_api = $layanan->keteranganEkawara();
        $info_dwiwara_api = $layanan->keteranganDwiwara();
        $info_triwara_api = $layanan->keteranganTriwara();
        $info_caturwara_api = $layanan->keteranganCaturwara();
        $info_pancawara_api = $layanan->keteranganPancawara();
        $info_sadwara_api = $layanan->keteranganSadwara();
        $info_saptawara_api = $layanan->keteranganSaptawara();
        $info_astawara_api = $layanan->keteranganAstawara();
        $info_sangawara_api = $layanan->keteranganSangawara();
        $info_dasawara_api = $layanan->keteranganDasawara();
        $info_wuku_api = $layanan->keteranganWuku();

        // cek apakah pada info_ingkel seluruh keterangan null atau tidak, jika null maka info_ingkel = null
        $info_ingkel = collect($info_ingkel_api)->where('keterangan', '!=', null)->all();
        $info_jejepan = collect($info_jejepan_api)->where('keterangan', '!=', null)->all();
        $info_lintang = collect($info_lintang_api)->where('keterangan', '!=', null)->all();
        $info_rakam = collect($info_rakam_api)->where('keterangan', '!=', null)->all();
        $info_watek_madya = collect($info_watek_madya_api)->where('keterangan', '!=', null)->all();
        $info_watek_alit = collect($info_watek_alit_api)->where('keterangan', '!=', null)->all();
        $info_neptu = collect($info_neptu_api)->where('keterangan', '!=', null)->all();
        $info_eka_jala_rsi = collect($info_eka_jala_rsi_api)->where('keterangan', '!=', null)->all();
        $info_panca_sudha = collect($info_panca_sudha_api)->where('keterangan', '!=', null)->all();
        $info_pangarasan = collect($info_pangarasan_api)->where('keterangan', '!=', null)->all();
        $info_pratiti = collect($info_pratiti_api)->where('keterangan', '!=', null)->all();
        $info_zodiak = collect($info_zodiak_api)->where('keterangan', '!=', null)->all();
        $info_ekawara = collect($info_ekawara_api)->where('keterangan', '!=', null)->all();
        $info_dwiwara = collect($info_dwiwara_api)->where('keterangan', '!=', null)->all();
        $info_triwara = collect($info_triwara_api)->where('keterangan', '!=', null)->all();
        $info_caturwara = collect($info_caturwara_api)->where('keterangan', '!=', null)->all();
        $info_pancawara = collect($info_pancawara_api)->where('keterangan', '!=', null)->all();
        $info_sadwara = collect($info_sadwara_api)->where('keterangan', '!=', null)->all();
        $info_saptawara = collect($info_saptawara_api)->where('keterangan', '!=', null)->all();
        $info_astawara = collect($info_astawara_api)->where('keterangan', '!=', null)->all();
        $info_sangawara = collect($info_sangawara_api)->where('keterangan', '!=', null)->all();
        $info_dasawara = collect($info_dasawara_api)->where('keterangan', '!=', null)->all();
        $info_wuku = collect($info_wuku_api)->where('keterangan', '!=', null)->all();

        $keterangan =
            [
                'ingkel' => $info_ingkel,
                'jejepan' => $info_jejepan,
                'lintang' => $info_lintang,
                'rakam' => $info_rakam,
                'watek_madya' => $info_watek_madya,
                'watek_alit' => $info_watek_alit,
                'neptu' => $info_neptu,
                'ekajalarsi' => $info_eka_jala_rsi,
                'panca_sudha' => $info_panca_sudha,
                'pangarasan' => $info_pangarasan,
                'pratiti' => $info_pratiti,
                'zodiak' => $info_zodiak,
                'wuku' => $info_wuku,

                'ekawara' => $info_ekawara,
                'dwiwara' => $info_dwiwara,
                'triwara' => $info_triwara,
                'caturwara' => $info_caturwara,
                'pancawara' => $info_pancawara,
                'sadwara' => $info_sadwara,
                'saptawara' => $info_saptawara,
                'astawara' => $info_astawara,
                'sangawara' => $info_sangawara,
                'dasawara' => $info_dasawara
            ];

        return $keterangan;
    }

    public function keteranganIngkel()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = Cache::remember('keterangan_ingkel', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganIngkel', [
                'headers' => $headers
            ]);
        });
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganJejepan()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_jejepan', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganJejepan', [
                'headers' => $headers
            ]);
        });
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganLintang()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_lintang', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganLintang', [
                'headers' => $headers
            ]);
        });
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganRakam()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_rakam', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganRakam', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganWatekMadya()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_watek_madya', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganWatekMadya', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganWatekAlit()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_watek_alit', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganWatekAlit', [
                'headers' => $headers
            ]);
        });
        
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganNeptu()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_neptu', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganNeptu', [
                'headers' => $headers
            ]);
        });
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganEkaJalaRsi()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_eka_jala_rsi', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganEkaJalaRsi', [
                'headers' => $headers
            ]);
        });
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganPancaSudha()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_panca_sudha', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganPancaSudha', [
                'headers' => $headers
            ]);
        });
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganPangarasan()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_pangarasan', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganPangarasan', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganPratiti()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_pratiti', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganPratiti', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganZodiak()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_zodiak', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganZodiak', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganEkawara()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_ekawara', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganEkawara', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganDwiwara()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_dwiwara', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganDwiwara', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganTriwara()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_triwara', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganTriwara', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganCaturwara()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_caturwara', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganCaturwara', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganPancawara()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_pancawara', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganPancawara', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganSadwara()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_sadwara', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganSadwara', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganSaptawara()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_saptawara', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganSaptawara', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganAstawara()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_astawara', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganAstawara', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganSangawara()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_sangawara', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganSangawara', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganDasawara()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_dasawara', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganDasawara', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganWuku()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // cache
        $response = Cache::remember('keterangan_wuku', now()->addDays(365), function () use ($client, $headers) {
            return $client->request('GET', $this->url_api . 'keteranganWuku', [
                'headers' => $headers
            ]);
        });

        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function ala_ayuning_dewasa_page()
    {
        $data = Cache::remember('data_dewasa', now()->addDays(365), function () {
            return $this->keteranganAlaAyuningDewasa();
        });
        $ala_ayuning_dewasa = collect($data)->sortBy('ala_ayuning_dewasa');
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $tanggal_sekarang = date('Y-m-d');
        $tanggal_mulai = date('Y-m-01');
        $tanggal_selesai = date('Y-m-t');

        // $info_ala_ayuning_dewasa = Cache::get('info_ala_ayuning_dewasa_'. $tanggal_mulai . '_' . $tanggal_selesai);
        // cache
        $info_ala_ayuning_dewasa = Cache::remember('info_ala_ayuning_dewasa_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function () use ($tanggal_mulai, $tanggal_selesai) {
            $layanan = new LayananController();
            $ala_ayuning_dewasa = $layanan->callAlaAyuningDewasa($tanggal_mulai, $tanggal_selesai);
            return $ala_ayuning_dewasa;
        });
        // dd($info_ala_ayuning_dewasa);

        return view('wargabal.layanan.ala_ayuning_dewasa_page', compact('tanggal_sekarang', 'bulan', 'ala_ayuning_dewasa', 'info_ala_ayuning_dewasa'));
    }

    public function cari_ala_ayuning_dewasa(Request $request)
    {
        $cari_dengan = $request->cari_dengan;
        $keterangan = $this->callKeteranganElemenKalenderBali();

        if ($cari_dengan == 'nama') {
            $validatedData = $request->validate([
                'nama_ala_ayuning_dewasa_dicari' => 'required',
                'tahun_dicari' => 'required|numeric',
                'bulan_dicari' => 'required|numeric'
            ]);

            if ($validatedData) {
                $nama_ala_ayuning_dewasa_dicari = $request->nama_ala_ayuning_dewasa_dicari;
                $tahun_dicari = $request->tahun_dicari;
                $bulan_dicari = $request->bulan_dicari;

                $tanggal_mulai = $tahun_dicari . '-' . str_pad($bulan_dicari + 1, 2, '0', STR_PAD_LEFT) . '-01';
                $tanggal_selesai = $tahun_dicari . '-' . str_pad($bulan_dicari + 1, 2, '0', STR_PAD_LEFT) . '-' . date('t', strtotime($tanggal_mulai));

                // $info_ala_ayuning_dewasa = $this->callAlaAyuningDewasa($tanggal_mulai, $tanggal_selesai);
                // cache
                $info_ala_ayuning_dewasa = Cache::remember('info_ala_ayuning_dewasa_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function () use ($tanggal_mulai, $tanggal_selesai) {
                    $layanan = new LayananController();
                    $ala_ayuning_dewasa = $layanan->callAlaAyuningDewasa($tanggal_mulai, $tanggal_selesai);
                    return $ala_ayuning_dewasa;
                });
                $tanggal_dewasa = [];
                $keterangan_dewasa = '';
                foreach ($info_ala_ayuning_dewasa as $key => $item) {
                    foreach ($item['ala_ayuning_dewasa'] as $key => $ala_ayuning_dewasa) {
                        if ($ala_ayuning_dewasa['nama'] == $nama_ala_ayuning_dewasa_dicari) {
                            $tanggal_dewasa[] = $item['tanggal'];
                            $keterangan_dewasa = $ala_ayuning_dewasa['keterangan'];
                        }
                    }
                }
                // $info_elemen_kalender_bali = $this->callElemenKalenderBali($tanggal_mulai, $tanggal_selesai);
                // cache
                $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function () use ($tanggal_mulai, $tanggal_selesai) {
                    $layanan = new LayananController();
                    $elemen_kalender_bali = $layanan->callElemenKalenderBali($tanggal_mulai, $tanggal_selesai);
                    return $elemen_kalender_bali;
                });
                return view('wargabal.layanan.pencarian_ala_ayuning_dewasa_page', compact('info_ala_ayuning_dewasa', 'info_elemen_kalender_bali', 'tanggal_dewasa', 'keterangan_dewasa', 'nama_ala_ayuning_dewasa_dicari', 'tahun_dicari', 'bulan_dicari', 'cari_dengan', 'keterangan'));
            } else {
                return redirect()->back()->withInput()->withErrors($validatedData);
            }
        } else {
            $validatedData = $request->validate([
                'tanggal_dicari' => 'required|date'
            ]);

            if ($validatedData) {
                $tanggal_dicari = $request->tanggal_dicari;
                $tanggal_mulai = $tanggal_dicari;
                $tanggal_selesai = $tanggal_dicari;

                // $info_ala_ayuning_dewasa = $this->callAlaAyuningDewasa($tanggal_mulai, $tanggal_selesai);
                // cache

                $info_ala_ayuning_dewasa = Cache::remember('info_ala_ayuning_dewasa_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function () use ($tanggal_mulai, $tanggal_selesai) {
                    $layanan = new LayananController();
                    $ala_ayuning_dewasa = $layanan->callAlaAyuningDewasa($tanggal_mulai, $tanggal_selesai);
                    return $ala_ayuning_dewasa;
                });

                // $info_elemen_kalender_bali = $this->callElemenKalenderBali($tanggal_mulai, $tanggal_selesai);
                // cache
                $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function () use ($tanggal_mulai, $tanggal_selesai) {
                    $layanan = new LayananController();
                    $elemen_kalender_bali = $layanan->callElemenKalenderBali($tanggal_mulai, $tanggal_selesai);
                    return $elemen_kalender_bali;
                });
                return view('wargabal.layanan.pencarian_ala_ayuning_dewasa_page', compact('info_ala_ayuning_dewasa', 'info_elemen_kalender_bali', 'tanggal_dicari', 'cari_dengan', 'keterangan'));
            } else {
                return redirect()->back()->withInput()->withErrors($validatedData);
            }
        }
    }

    public function callAlaAyuningDewasa($tanggal_mulai, $tanggal_selesai)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'cariAlaAyuningDewasa?tanggal_mulai=' . $tanggal_mulai . '&tanggal_selesai=' . $tanggal_selesai . '&beserta_keterangan', [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganAlaAyuningDewasa()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'keteranganAlaAyuningDewasa', [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function mengatur_kriteria_awal_page()
    {
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'Semua Bulan'];
        $template_dewasa = ['Purnama Kadasa', 'Purnama Kajeng Kliwon', 'Purnama Anggara Kasih', 'Purnama Ketemu Guru', 'Potong Gigi', 'Bhuta Yadnya', 'Dewa Yadnya', 'Cukur Rambut', 'Membuat Rapat', 'Berhubungan/Bersenggama Suami Istri', 'Nikah/Kawin', 'Menempati Rumah', 'Memulai Upacara/Karya yang Besar'];
        // $template_dewasa = ['Purnama Kadasa', 'Purnama Kajeng Kliwon', 'Purnama Anggara Kasih', 'Purnama Ketemu Guru', 'Potong Gigi', 'Bhuta Yadnya', 'Dewa Yadnya', 'Cukur Rambut', 'Membuat Rapat', 'Berhubungan/Bersenggama Suami Istri', 'Nikah/Kawin', 'Menempati Rumah', 'Memulai Upacara/Karya yang Besar', 'Manusa Yadnya', 'Pitra Yadnya', 'Ngaben/Penguburan/Pembakaran Mayat', 'Berbelanja'];

        return view('wargabal.layanan.mengatur_kriteria_awal_page', compact('bulan', 'template_dewasa'));
    }

    public function mengatur_kriteria_parameter_page(Request $request)
    {
        $cari_dengan = $request->cari_dengan;
        $dewasa_ayu = $request->dewasa_ayu;
        $bulan_dicari = $request->bulan_dicari;
        $tahun_dicari = $request->tahun_dicari;

        if ($cari_dengan == "template") {
            if ($dewasa_ayu == "Purnama Kadasa") {
                $kriteriaDicari = [
                    [
                        ['key' => 'Penanggal', 'item' => 15],
                        ['key' => 'sasih', 'item' => 10]
                    ]
                ];

                $kriteriaDihindari = [];
            } else if ($dewasa_ayu == "Purnama Kajeng Kliwon") {
                $kriteriaDicari = [
                    [
                        ['key' => 'Penanggal', 'item' => 15],
                        ['key' => 'triwara', 'item' => 3],
                        ['key' => 'pancawara', 'item' => 5]
                    ]
                ];

                $kriteriaDihindari = [];
            } else if ($dewasa_ayu == "Purnama Anggara Kasih") {
                $kriteriaDicari = [
                    [
                        ['key' => 'Penanggal', 'item' => 15],
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'pancawara', 'item' => 5]
                    ]
                ];

                $kriteriaDihindari = [];
            } else if ($dewasa_ayu == "Purnama Ketemu Guru") {
                $kriteriaDicari = [
                    [
                        ['key' => 'Penanggal', 'item' => 15],
                        ['key' => 'astawara', 'item' => 3]
                    ]
                ];

                $kriteriaDihindari = [];
            } else if ($dewasa_ayu == "Potong Gigi") {
                $kriteriaDicari = [
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'Penanggal', 'item' => 12],
                        ['key' => 'pancawara', 'item' => 5]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'Penanggal', 'item' => 10],
                        ['key' => 'pancawara', 'item' => 2]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'Penanggal', 'item' => 10],
                        ['key' => 'pancawara', 'item' => 4]
                    ]
                ];

                $kriteriaDihindari = [];
            } else if ($dewasa_ayu == "Bhuta Yadnya") {
                $kriteriaDicari = [
                    [
                        ['key' => 'triwara', 'item' => 3],
                        ['key' => 'pancawara', 'item' => 5]
                    ]
                ];

                $kriteriaDihindari = [];
            } else if ($dewasa_ayu == "Dewa Yadnya") {
                $kriteriaDicari = [
                    [
                        ['key' => 'Penanggal', 'item' => 15],
                        ['key' => 'saptawara', 'item' => 1]
                    ],
                    [
                        ['key' => 'Penanggal', 'item' => 15],
                        ['key' => 'saptawara', 'item' => 2]
                    ],
                    [
                        ['key' => 'Penanggal', 'item' => 15],
                        ['key' => 'saptawara', 'item' => 3]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'triwara', 'item' => 2]
                    ],
                    [
                        ['key' => 'triwara', 'item' => 3],
                        ['key' => 'Penanggal', 'item' => 15]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 1],
                        ['key' => 'Penanggal', 'item' => 6]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 1],
                        ['key' => 'Pangelong', 'item' => 6]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'Penanggal', 'item' => 7]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'Pangelong', 'item' => 7]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'Penanggal', 'item' => 3]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'Pangelong', 'item' => 3]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'Penanggal', 'item' => 2]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'Pangelong', 'item' => 2]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                        ['key' => 'Penanggal', 'item' => 5]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                        ['key' => 'Pangelong', 'item' => 5]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'Penanggal', 'item' => 1]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'Pangelong', 'item' => 1]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'Penanggal', 'item' => 4]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'Pangelong', 'item' => 4]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'Penanggal', 'item' => 15]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'Penanggal', 'item' => 15]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'Penanggal', 'item' => 15]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                        ['key' => 'Penanggal', 'item' => 15]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'pancawara', 'item' => 4],
                        ['key' => 'Penanggal', 'item' => 15]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'Penanggal', 'item' => 3]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'Penanggal', 'item' => 7]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'Penanggal', 'item' => 3]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'Penanggal', 'item' => 13]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 1],
                        ['key' => 'Penanggal', 'item' => 10]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'Penanggal', 'item' => 9]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'Penanggal', 'item' => 6]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'Penanggal', 'item' => 8]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                        ['key' => 'Penanggal', 'item' => 7]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'Penanggal', 'item' => 9]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'Penanggal', 'item' => 10]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'pancawara', 'item' => 4],
                        ['key' => 'Penanggal', 'item' => 10]
                    ]
                ];

                $kriteriaDihindari = [];
            } else if ($dewasa_ayu == "Cukur Rambut") {
                $kriteriaDicari = [
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 25]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 29]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 11]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 9]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 17]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 13]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 21]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 23]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 15]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 1]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 19]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 5]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 3]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 7]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 27]
                    ]
                ];

                $kriteriaDihindari = [
                    [
                        ['key' => 'sadwara', 'item' => 3],
                        ['key' => 'astawara', 'item' => 7]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 20]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 1]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 2]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 6]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 10]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 11]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 16]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 19]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 20]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 24]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 25]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 27]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 30]
                    ]
                ];
            } else if ($dewasa_ayu == "Membuat Rapat") {
                $kriteriaDicari = [
                    [
                        ['key' => 'saptawara', 'item' => 1],
                        ['key' => 'wuku', 'item' => 1]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 1],
                        ['key' => 'wuku', 'item' => 9]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 1],
                        ['key' => 'wuku', 'item' => 15]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'wuku', 'item' => 3]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'wuku', 'item' => 5]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'wuku', 'item' => 17]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'wuku', 'item' => 11]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'wuku', 'item' => 16]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'wuku', 'item' => 19]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'wuku', 'item' => 30]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 13]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 29]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 5]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 7]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                        ['key' => 'wuku', 'item' => 15]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                        ['key' => 'wuku', 'item' => 1]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                        ['key' => 'wuku', 'item' => 9]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'wuku', 'item' => 17]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'wuku', 'item' => 3]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'wuku', 'item' => 16]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'wuku', 'item' => 19]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'wuku', 'item' => 27]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'wuku', 'item' => 5]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'wuku', 'item' => 11]
                    ]
                ];

                $kriteriaDihindari = [
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'wuku', 'item' => 5]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'Penanggal', 'item' => 15]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'Pangelong', 'item' => 15]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'Penanggal', 'item' => 1]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'Penanggal', 'item' => 4]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'Penanggal', 'item' => 7]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'Penanggal', 'item' => 9]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'Penanggal', 'item' => 13]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'Penanggal', 'item' => 11]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                        ['key' => 'Penanggal', 'item' => 8]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                        ['key' => 'Penanggal', 'item' => 11]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'Penanggal', 'item' => 3]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'Penanggal', 'item' => 5]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'Penanggal', 'item' => 10]
                    ]
                ];
            } else if ($dewasa_ayu == "Berhubungan/Bersenggama Suami Istri") {
                $kriteriaDicari = [];

                $kriteriaDihindari = [
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'pancawara', 'item' => 2]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 1],
                        ['key' => 'pancawara', 'item' => 4]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'pancawara', 'item' => 4]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'pancawara', 'item' => 5]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                        ['key' => 'pancawara', 'item' => 2]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'pancawara', 'item' => 5]
                    ],
                    [
                        ['key' => 'Penanggal', 'item' => 15]
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 15]
                    ],
                    [
                        ['key' => 'ekawara', 'item' => 1]
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 15],
                        ['key' => 'saptawara', 'item' => 6]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 1],
                        ['key' => 'wuku', 'item' => 29],
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'wuku', 'item' => 23],
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'wuku', 'item' => 10],
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'wuku', 'item' => 10],
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 1],
                        ['key' => 'wuku', 'item' => 20],
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'wuku', 'item' => 27],
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'wuku', 'item' => 1],
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                        ['key' => 'wuku', 'item' => 5],
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'wuku', 'item' => 15],
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'wuku', 'item' => 14],
                    ]
                ];
            } else if ($dewasa_ayu == "Nikah/Kawin") {
                $kriteriaDicari = [
                    [
                        ['key' => 'Penanggal', 'item' => 5],
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'pancawara', 'item' => 2]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                    ]
                ];

                $kriteriaDihindari = [
                    [
                        ['key' => 'saptawara', 'item' => 1]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7]
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 1],
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 2],
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 3],
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 4],
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 5],
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 6],
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 7],
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 8],
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 9],
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 10],
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 11],
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 12],
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 13],
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 14],
                    ],
                    [
                        ['key' => 'Pangelong', 'item' => 15]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 7]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 8]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 15]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 16]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 23]
                    ],
                    [
                        ['key' => 'wuku', 'item' => 24]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 1],
                        ['key' => 'wuku', 'item' => 5]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 1],
                        ['key' => 'wuku', 'item' => 13]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 1],
                        ['key' => 'wuku', 'item' => 21]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 1],
                        ['key' => 'wuku', 'item' => 29]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'wuku', 'item' => 3]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'wuku', 'item' => 11]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'wuku', 'item' => 19]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 2],
                        ['key' => 'wuku', 'item' => 27]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'wuku', 'item' => 8]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'wuku', 'item' => 16]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 3],
                        ['key' => 'wuku', 'item' => 24]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 1]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 9]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 17]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'wuku', 'item' => 25]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                        ['key' => 'wuku', 'item' => 14]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                        ['key' => 'wuku', 'item' => 22]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 5],
                        ['key' => 'wuku', 'item' => 30]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'wuku', 'item' => 4]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'wuku', 'item' => 12]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'wuku', 'item' => 20]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'wuku', 'item' => 28]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'wuku', 'item' => 7]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'wuku', 'item' => 15]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 7],
                        ['key' => 'wuku', 'item' => 23]
                    ]
                ];
            } else if ($dewasa_ayu == "Menempati Rumah") {
                $kriteriaDicari = [
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'pancawara', 'item' => 5],
                        ['key' => 'astawara', 'item' => 3]
                    ],
                    [
                        ['key' => 'saptawara', 'item' => 4],
                        ['key' => 'pancawara', 'item' => 5],
                        ['key' => 'astawara', 'item' => 8]
                    ]
                ];

                $kriteriaDihindari = [];
            } else if ($dewasa_ayu == "Memulai Upacara/Karya yang Besar") {
                $kriteriaDicari = [
                    [
                        ['key' => 'saptawara', 'item' => 6],
                        ['key' => 'pancawara', 'item' => 1],
                        ['key' => 'Penanggal', 'item' => 15]
                    ],
                ];

                $kriteriaDihindari = [];
            }

            $keys = [];
            foreach ($kriteriaDicari as $kriteria) {
                foreach ($kriteria as $item) {
                    $keys[] = $item['key'];
                }
            }

            foreach ($kriteriaDihindari as $kriteria) {
                foreach ($kriteria as $item) {
                    $keys[] = $item['key'];
                }
            }

            // ambil keys yang unik
            $keys = array_unique($keys);
            $items = [];

            foreach ($keys as $key) {
                $response = $this->fetchItems($request, $key);
                $data = $response->getContent();
                $dataArray = json_decode($data, true);
                $items[$key] = $dataArray;
            }

            return view('wargabal.layanan.mengatur_kriteria_parameter_page', compact(
                'cari_dengan',
                'dewasa_ayu',
                'keys',
                'items',
                'kriteriaDicari',
                'kriteriaDihindari',
                'bulan_dicari',
                'tahun_dicari',
            ));
        } else {
            $keys = [];
            $items = [];
            $kriteriaDicari = [];
            $kriteriaDihindari = [];

            return view('wargabal.layanan.mengatur_kriteria_parameter_page', compact(
                'keys',
                'items',
                'kriteriaDicari',
                'kriteriaDihindari',
                'cari_dengan',
                'bulan_dicari',
                'tahun_dicari',
            ));
        }
    }

    public function cari_kriteria_dewasa(Request $request)
    {
        $bulan = $request->bulan_dicari;
        $keterangan = $this->callKeteranganElemenKalenderBali();

        if ($bulan == 'Semua Bulan') {
            $bulan_dicari = 'Semua Bulan';
        } else {
            $bulan_dicari = $this->ubahAngkaBulan($bulan);
        }
        $tahun_dicari = $request->tahun_dicari;

        // Kriteria yang dicari
        $kriteriaDicari = json_decode($request->input('kriteria_dicari'), true);
        // Kriteria yang dihindari
        $kriteriaDihindari = json_decode($request->input('kriteria_dihindari'), true);

        // Inisialisasi variabel untuk menyimpan logika AND dan OR
        $logicANDdicari = [];
        $logicORdicari = [];
        $logicANDdihindari = [];
        $logicORdihindari = [];
        $finalLogicAND = [];

        // Konversi kriteria yang dicari menjadi logika AND
        $addedPengalantaka = false;
        foreach ($kriteriaDicari as $kriteria) {
            $tempANDdicari = [];
            $tempORdicari = [];
            foreach ($kriteria as $item) {
                if ($item['key'] == 'Penanggal' || $item['key'] == 'Pangelong') {
                    $tempANDdicari[] = "$" . "pengalantaka=='{$item['key']}'";
                    $tempANDdicari[] = "$" . "sasihDay1=={$item['item']}";
                } else {
                    $tempANDdicari[] = "$" . "{$item['key']}=={$item['item']}";
                }
            }
            // tambahkan "()" pada tempANDdicari jika lebih dari satu elemen
            $logicANDdicari[] = implode('%26%26', $tempANDdicari);
        }

        $logicANDdicari = array_filter($logicANDdicari, function ($value) {
            return !empty($value);
        });
        $logicORdicari[] = implode('||', $logicANDdicari);
        // dd($logicORdicari[0]);
        // dd($logicORdicari[0] != null);

        // Konversi kriteria yang dihindari menjadi logika AND
        $addedPengalantaka = false;
        foreach ($kriteriaDihindari as $kriteria) {
            $tempANDdihindari = [];
            $tempORdihindari = [];

            foreach ($kriteria as $item) {
                if ($item['key'] == 'Penanggal' || $item['key'] == 'Pangelong') {
                    $tempANDdihindari[] = "$" . "pengalantaka=='{$item['key']}'";
                    $tempANDdihindari[] = "$" . "sasihDay1=={$item['item']}";
                    // if ($item['item'] >= 1 && $item['item'] <= 15) {
                    //     $tempANDdihindari = array_diff($tempANDdihindari, ["$" . "sasihDay1!={$item['item']}"]);
                    //     $tempANDdihindari = array_diff($tempANDdihindari, ["$" . "pengalantaka!='{$item['key']}'"]);
                    //     if (!$addedPengalantaka) {
                    //         $tempANDdihindari[] = "$" . "pengalantaka!='{$item['key']}'";  // Tambahkan satu pengalantaka
                    //         $addedPengalantaka = true;  // Set flag ke true agar tidak menambahkan lagi
                    //     }
                    // }
                } else {
                    $tempANDdihindari[] = "$" . "{$item['key']}=={$item['item']}";
                }
            }
            // tambahkan "()" pada tempANDdihindari jika lebih dari satu elemen
            // $logicANDdihindari[] = '!(' . implode('%26%26', $tempANDdihindari) . ')';
            $logicANDdihindari[] = implode('%26%26', $tempANDdihindari);
        }

        $logicANDdihindari = array_filter($logicANDdihindari, function ($value) {
            return !empty($value);
        });

        // dd($logicORdihindari);
        $logicORdihindari[] = implode('||', $logicANDdihindari);
        // dd($logicORdihindari[0]);

        if ($logicORdicari[0] != null && $logicORdihindari[0] != null) {
            $finalLogicAND[] = '(' . $logicORdicari[0] . ')' . '%26%26' . '!(' . $logicORdihindari[0] . ')';
        } elseif ($logicORdicari[0] != null && $logicORdihindari[0] == null) {
            if ($logicANDdihindari != null) {
                $finalLogicAND[] = '(' . $logicORdicari[0] . ')' . '%26%26' . '!(' . $logicANDdihindari[0] . ')';
            } else {
                $finalLogicAND[] = $logicORdicari[0];
            }
        } elseif ($logicORdicari[0] == null && $logicORdihindari[0] != null) {
            if ($logicANDdicari != null) {
                $finalLogicAND[] = '(' . $logicANDdicari[0] . ')' . '%26%26' . '!(' . $logicORdihindari[0] . ')';
            } else {
                $finalLogicAND[] = '!' . $logicORdihindari[0];
            }
        } elseif ($logicORdicari[0] == null && $logicORdihindari[0] == null) {
            if ($logicANDdicari != null && $logicANDdihindari != null) {
                $finalLogicAND[] = '(' . $logicANDdicari[0] . ')' . '%26%26' . '!(' . $logicANDdihindari[0] . ')';
            } elseif ($logicANDdicari != null && $logicANDdihindari == null) {
                $finalLogicAND[] = $logicANDdicari;
            } elseif ($logicANDdicari == null && $logicANDdihindari != null) {
                $finalLogicAND[] = '!' . $logicANDdihindari;
            }
        }

        // dd($finalLogicAND[0]);
        // $encodeFinalLogicAND = $finalLogicAND[0];
        if (strlen($finalLogicAND[0]) > 500) {
            $encodeFinalLogicAND = urldecode($finalLogicAND[0]);
        } else {
            $encodeFinalLogicAND = $finalLogicAND[0];
        }

        // dd($encodeFinalLogicAND);
        if ($bulan_dicari == "Semua Bulan") {
            // $info_mengatur_dewasa = $this->callMengaturDewasa($tahun_dicari . '-01-01', $tahun_dicari . '-12-31', $encodeFinalLogicAND);
            // cache
            $info_mengatur_dewasa = Cache::remember('info_mengatur_dewasa_' . $tahun_dicari . '_01_01_' . $tahun_dicari . '_12_31_' . $encodeFinalLogicAND, now()->addDays(365), function () use ($tahun_dicari, $encodeFinalLogicAND) {
                $layanan = new LayananController();
                $mengatur_dewasa = $layanan->callMengaturDewasa($tahun_dicari . '-01-01', $tahun_dicari . '-12-31', $encodeFinalLogicAND);
                return $mengatur_dewasa;
            });

            // $info_elemen_kalender_bali = $this->callElemenKalenderBali($tahun_dicari . '-01-01', $tahun_dicari . '-12-31');
            // cache
            $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_' . $tahun_dicari . '_01_01_' . $tahun_dicari . '_12_31', now()->addDays(365), function () use ($tahun_dicari) {
                $layanan = new LayananController();
                $elemen_kalender_bali = $layanan->callElemenKalenderBali($tahun_dicari . '-01-01', $tahun_dicari . '-12-31');
                return $elemen_kalender_bali;
            });
        } else {
            // $info_mengatur_dewasa = $this->callMengaturDewasa($tahun_dicari . '-' . $bulan_dicari . '-01', $tahun_dicari . '-' . $bulan_dicari . '-' . date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')), $encodeFinalLogicAND);
            // cache
            $info_mengatur_dewasa = Cache::remember('info_mengatur_dewasa_' . $tahun_dicari . '_' . $bulan_dicari . '_01_' . $tahun_dicari . '_' . $bulan_dicari . '_' . date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')) . '_' . $encodeFinalLogicAND, now()->addDays(365), function () use ($tahun_dicari, $bulan_dicari, $encodeFinalLogicAND) {
                $layanan = new LayananController();
                $mengatur_dewasa = $layanan->callMengaturDewasa($tahun_dicari . '-' . $bulan_dicari . '-01', $tahun_dicari . '-' . $bulan_dicari . '-' . date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')), $encodeFinalLogicAND);
                return $mengatur_dewasa;
            });

            // foreach info_mengatur_dewasa['ala_ayuning_dewasa'] apabila kosong maka kosongkan info_mengatur_dewasa
            $count_info_mengatur_dewasa = collect($info_mengatur_dewasa)->filter(function ($value, $key) {
                return count($value['ala_ayuning_dewasa']) > 0;
            });
            if ($count_info_mengatur_dewasa->count() == 0) {
                $info_mengatur_dewasa = [];
            }

            // $info_elemen_kalender_bali = $this->callElemenKalenderBali($tahun_dicari . '-' . $bulan_dicari . '-01', $tahun_dicari . '-' . $bulan_dicari . '-' . date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')));
            // cache
            $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_' . $tahun_dicari . '_' . $bulan_dicari . '_01_' . $tahun_dicari . '_' . $bulan_dicari . '_' . date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')), now()->addDays(365), function () use ($tahun_dicari, $bulan_dicari) {
                $layanan = new LayananController();
                $elemen_kalender_bali = $layanan->callElemenKalenderBali($tahun_dicari . '-' . $bulan_dicari . '-01', $tahun_dicari . '-' . $bulan_dicari . '-' . date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')));
                return $elemen_kalender_bali;
            });
        }

        return view('wargabal.layanan.hasil_cari_kriteria_dewasa_page', compact('info_mengatur_dewasa', 'info_elemen_kalender_bali',  'bulan', 'tahun_dicari', 'keterangan'));
    }

    public function callMengaturDewasa($tanggal_mulai, $tanggal_selesai, $kriteria)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        // jika panjang karakter kriteria lebih dari 500 maka gunakan POST
        if (strlen($kriteria) > 500) {
            $response = $client->request('POST', $this->url_api . 'mengaturDewasaPOST', [
                'headers' => $headers,
                'form_params' => [
                    'tanggal_mulai' => $tanggal_mulai,
                    'tanggal_selesai' => $tanggal_selesai,
                    'kriteria' => $kriteria
                ]
            ]);
        } else {
            $response = $client->request('GET', $this->url_api . 'mengaturDewasa?tanggal_mulai=' . $tanggal_mulai . '&tanggal_selesai=' . $tanggal_selesai . '&kriteria=' . $kriteria, [
                'headers' => $headers
            ]);
        }
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function fetchKeys()
    {
        $keys = ['ekawara', 'dwiwara', 'triwara', 'caturwara', 'pancawara', 'sadwara', 'saptawara', 'astawara', 'sangawara', 'dasawara', 'Penanggal', 'Pangelong', 'wuku', 'sasih', 'purnama_tilem'];
        return response()->json($keys);
    }

    public function fetchItems(Request $request, $kriteria = null)
    {
        // dd($kriteria);
        if ($kriteria == null || $kriteria == '') {
            $key = $request->query('key');
        } else {
            $key = $kriteria;
        }

        // Fetch items based on the key from your array
        // Example:
        $items = [];
        switch ($key) {
            case 'ekawara':
                $items = ['-' => 0, 'Luang' => 1];
                break;
            case 'dwiwara':
                $items = ['Menga' => 1, 'Pepet' => 2];
                break;
            case 'triwara':
                $items = ['Pasah' => 1, 'Beteng' => 2, 'Kajeng' => 3];
                break;
            case 'caturwara':
                $items = ['Sri' => 1, 'Laba' => 2, 'Jaya' => 3, 'Menala' => 4];
                break;
            case 'pancawara':
                $items = ['Umanis' => 1, 'Paing' => 2, 'Pon' => 3, 'Wage' => 4, 'Kliwon' => 5];
                break;
            case 'sadwara':
                $items = ['Tungleh' => 1, 'Aryang' => 2, 'Urukung' => 3, 'Paniron' => 4, 'Was' => 5, 'Maulu' => 6];
                break;
            case 'saptawara':
                $items = ['Redite' => 1, 'Soma' => 2, 'Anggara' => 3, 'Buda' => 4, 'Wraspati' => 5, 'Sukra' => 6, 'Saniscara' => 7];
                break;
            case 'astawara':
                $items = ['Sri' => 1, 'Indra' => 2, 'Guru' => 3, 'Yama' => 4, 'Ludra' => 5, 'Brahma' => 6, 'Kala' => 7, 'Uma' => 8];
                break;
            case 'sangawara':
                $items = ['Dangu' => 1, 'Jangur' => 2, 'Gigis' => 3, 'Nohan' => 4, 'Ogan' => 5, 'Erangan' => 6, 'Urungan' => 7, 'Tulus' => 8, 'Dadi' => 9];
                break;
            case 'dasawara':
                $items = ['Pandita' => 1, 'Pati' => 2, 'Suka' => 3, 'Duka' => 4, 'Sri' => 5, 'Manu' => 6, 'Manusa' => 7, 'Raja' => 8, 'Dewa' => 9, 'Raksasa' => 10];
                break;
            case 'Penanggal':
                $items = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15];
                break;
            case 'Pangelong':
                $items = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15];
                break;
            case 'wuku':
                $items = ['Sinta' => 1, 'Landep' => 2, 'Ukir' => 3, 'Kulantir' => 4, 'Tolu' => 5, 'Gumbreg' => 6, 'Wariga' => 7, 'Warigadean' => 8, 'Julungwangi' => 9, 'Sungsang' => 10, 'Dungulan' => 11, 'Kuningan' => 12, 'Langkir' => 13, 'Medangsia' => 14, 'Pujut' => 15, 'Pahang' => 16, 'Krulut' => 17, 'Merakih' => 18, 'Tambir' => 19, 'Medangkungan' => 20, 'Matal' => 21, 'Uye' => 22, 'Menail' => 23, 'Prangbakat' => 24, 'Bala' => 25, 'Ugu' => 26, 'Wayang' => 27, 'Klawu' => 28, 'Dukut' => 29, 'Watugunung' => 30];
                break;
            case 'sasih':
                $items = ['Kapitu' => 7, 'Kawulu' => 8, 'Kasanga' => 9, 'Kadasa' => 10, 'Jiyestha' => 11, 'Sadha' => 12, 'Kasa' => 1, 'Karo' => 2, 'Katiga' => 3, 'Kapat' => 4, 'Kalima' => 5, 'Kanam' => 6];
                break;
            case 'purnama_tilem':
                $items = ['Purnama' => 0, 'Tilem' => 1];
                break;
                // case 'ingkel':
                //     $items = ['Wong', 'Sato', 'Mina', 'Manuk', 'Taru', 'Buku'];
                //     break;
                // case 'jejepan':
                //     $items = ['Mina', 'Taru', 'Sato', 'Patra', 'Wong', 'Paksi'];
                //     break;
                // case 'lintang':
                //     $items = ['Begong', 'Gajah', 'Kiriman', 'Perahu Sarat', 'Tiwa-tiwa', 'Sangkatikel', 'Bubu Bolong', 'Sungenge', 'Uluku', 'Pedati', 'Kuda', 'Gajah Mina', 'Bade', 'Magelut', 'Rarung Pegelangan', 'Kala Sungsang', 'Dupa', 'Asu', 'Kartika', 'Naga', 'Angsa Angrem', 'Panah', 'Patrem', 'Lembu', 'Depat', 'Tangis', 'Salah Ukur', 'Prahu Pegat', 'Puwuh Atarung', 'Lawean', 'Kelapa', 'Yuyu', 'Lumbung', 'Kumba', 'Udang'];
                //     break;
                // case 'panca_sudha':
                //     $items = ['Wisesa Segara', 'Tunggak Semi', 'Satria Wibawa', 'Sumur Sinaba', 'Bumi Kepetak', 'Satria Wirang', 'Lebu Katiub Angin'];
                //     break;
                // case 'pangarasan':
                //     $items = ['Laku Pandita Sakti', 'Aras Tuding', 'Aras Kembang', 'Laku Bintang', 'Laku Bulan', 'Laku Surya', 'Laku Air/Toya', 'Laku Bumi', 'Laku Api', 'Laku Angin'];
                //     break;
                // case 'rakam':
                //     $items = ['Pati', 'Kala Tinantang', 'Demang Kandhuruwan', 'Sanggar Waringin', 'Mantri Sinaroja', 'Macan Katawan'];
                //     break;
                // case 'watek_alit':
                //     $items = ['Lintah', 'Uler', 'Gajah', 'Lembu'];
                //     break;
                // case 'watek_madya':
                //     $items = ['Wong', 'Gajah', 'Watu', 'Buta', 'Suku'];
                //     break;
                // case 'ekajalarsi':
                //     $items = ['SUKA PINANGGIH', 'BUAT SUKA', 'MANGGIH SUKA', 'BUAT SUKA', 'SUKA PINANGGIH', 'SUKA PINANGGIH', 'MANGGIH SUKA', 'KAMARANAN', 'BUAT SUKA', 'KINASIHANIN JANA', 'WERDHI PUTRA', 'SUKA RAHAYU', 'SUKA PINANGGIH', 'SIDHA KASOBAGIAN', 'KINASIHANIN JANA', 'BUAT SUKA', 'KINASIHANIN JANA', 'TININGGALING SUKA', 'RAHAYU', 'BUAT SEBET', 'BUAT ASTAWA', 'LANGGENG KAYOHANAN', 'WERDHI PUTRA', 'MANGGIH SUKA', 'SIDHA KASOBAGIAN', 'TININGGALING SUKA', 'SUKA PINANGGIH', 'BAGNA MAPASAH', 'KAMERTAAN', 'BUAT SEBET', 'LEWIH BAGIA', 'SUKA PINANGGIH', 'BUAT SUKA', 'BUAT SUKA', 'SUKA PINANGGIH', 'MANGGIH SUKA', 'TININGGALING SUKA', 'BUAT MERANG', 'SUKA PINANGGIH', 'BUAT ASTAWA', 'BUAT ASTAWA', 'BUAT ASTAWA', 'KINASIHANIN AMERTA', 'KINASIHANIN AMERTA', 'BUAT MERANG', 'LANGGENG KAYOHANAN', 'KINASIHANIN AMERTA', 'WERDHI PUTRA', 'WERDHI PUTRA', 'BAHU PUTRA', 'SUKA PINANGGIH', 'SUKA PINANGGIH', 'LEWIH BAGIA', 'TININGGALING SUKA', 'LEWIH BAGIA', 'BUAT SEBET', 'KAMARANAN', 'TININGGALING SUKA', 'PATINING AMERTA', 'TININGGALING SUKA', 'KASOBAGIAN', 'LEWIH BAGIA', 'SUBAGIA', 'TININGGALING SUKA', 'TININGGALING SUKA', 'KINASIHANIN JANA', 'BAGNA MAPASAH', 'MANGGIH SUKA', 'KINASIHANIN JANA', 'BAGNA MAPASAH', 'LEWIH BAGIA', 'SUKA PINANGGIH', 'KINASIHANIN AMERTA', 'BUAT SUKA', 'MANGGIH BAGIA', 'TININGGALING SUKA', 'PATINING AMERTA', 'SUKA RAHAYU', 'KINASIHANIN AMERTA', 'KINASIHANIN AMERTA', 'BUAT SEBET', 'BUAT SUKA', 'BUAT SEBET', 'WERDHI PUTRA', 'BUAT SUKA', 'BUAT SEBET', 'KINASIHANIN AMERTA', 'BUAT SUKA', 'TININGGALING SUKA', 'BUAT ASTAWA', 'DAHAT KINGKING', 'TININGGALING SUKA', 'TININGGALING SUKA', 'LANGGENG KAYOHANAN', 'LEWIH BAGIA', 'WERDHI PUTRA', 'BUAT SUKA', 'KINASIHANIN AMERTA', 'SIDHA KASOBAGIAN', 'BUAT SUKA', 'BUAT SEBET', 'TININGGALING SUKA', 'TININGGALING SUKA', 'BUAT SEBET', 'KINASIHANIN JANA', 'TININGGALING SUKA', 'MANGGIH SUKA', 'KINASIHANIN JANA', 'SUKA PINANGGIH', 'BUAT SEBET', 'WERDHI PUTRA', 'SIDHA KASOBAGIAN', 'TININGGALING SUKA', 'TININGGALING SUKA', 'SUKA PINANGGIH', 'BUAT SUKA', 'PATINING AMERTA', 'PATINING AMERTA', 'MANGGIH SUKA', 'BUAT SUKA', 'MANGGIH SUKA', 'BUAT SUKA', 'BUAT MERANG', 'WERDHI PUTRA', 'MANGGIH SUKA', 'BUAT SUKA', 'KAMARANAN', 'KINASIHANIN AMERTA', 'KINASIHANIN AMERTA', 'KINASIHANIN JANA', 'TININGGALING SUKA', 'PATINING AMERTA', 'PATINING AMERTA', 'BUAT SEBET', 'BUAT ASTAWA', 'TININGGALING SUKA', 'TININGGALING SUKA', 'BUAT ASTAWA', 'TININGGALING SUKA', 'MANGGIH SUKA', 'SIDHA KASOBAGIAN', 'LANGGENG KAYOHANAN', 'WERDHI SARWA MULE', 'SUKA PINANGGIH', 'MANGGIH SUKA', 'DAHAT KINGKING', 'TININGGALING SUKA', 'MANGGIH SUKA', 'BUAT SEBET', 'MANGGIH SUKA', 'BUAT SUKA', 'BUAT KINGKING', 'LEWIH BAGIA', 'PATINING AMERTA', 'TININGGALING SUKA', 'BUAT ASTAWA', 'BUAT SUKA', 'KINASIHANIN JANA', 'TININGGALING SUKA', 'SIDHA KASOBAGIAN', 'BUAT SUKA', 'LEWIH BAGIA', 'LEWIH BAGIA', 'SUKA PINANGGIH', 'BUAT SUKA', 'DAHAT KINGKING', 'SUKA RAHAYU', 'BUAT ASTAWA', 'KINASIHANIN AMERTA', 'KAMARANAN', 'SUKA RAHAYU', 'SUKA RAHAYU', 'MANGGIH SUKA', 'SUKA RAHAYU', 'SIDHA KASOBAGIAN', 'BUAT SUKA', 'KINASIHANIN AMERTA', 'KINASIHANIN AMERTA', 'LANGGENG KAYOHANAN', 'PATINING AMERTA', 'TININGGALING SUKA', 'SIDHA KASOBAGIAN', 'BUAT MERANG', 'PATINING AMERTA', 'BUAT MERANG', 'SIDHA KASOBAGIAN', 'WERDHI PUTRA', 'KINASIHANIN AMERTA', 'SUKA PINANGGIH', 'PATINING AMERTA', 'MANGGIH SUKA', 'MANGGIH SUKA', 'TININGGALING SUKA', 'LEWIH BAGIA', 'BUAT ASTAWA', 'SUKA RAHAYU', 'BUAT LARA', 'BUAT ASTAWA', 'SUKA PINANGGIH', 'TININGGALING SUKA', 'PATINING AMERTA', 'TININGGALING SUKA', 'SIDHA KASOBAGIAN', 'LANGGENG KAYOHANAN', 'BUAT SEBET', 'BUAT ASTAWA', 'TININGGALING SUKA', 'BUAT SUKA', 'TININGGALING SUKA', 'MANGGIH SUKA'];
                //     break;
                // case 'pratiti':
                //     $items = ['Awidya', 'Saskara', 'Widnyana', 'Namarupa', 'Sadayatana', 'Separsa', 'Wedana', 'Tresna', 'Upadana', 'Bhawa', 'Jati', 'Jaramarana'];
                //     break;
        }
        return response()->json($items);
    }



    public function piodalan_page()
    {
        $info_pura = Cache::remember('info_pura', now()->addDays(365), function () {
            return $this->callPura();
        });

        $saptawara = ['Redite', 'Soma', 'Anggara', 'Buda', 'Wraspati', 'Sukra', 'Saniscara'];
        $pancawara = ['Umanis', 'Paing', 'Pon', 'Wage', 'Kliwon'];
        $wuku = ['Sinta', 'Landep', 'Ukir', 'Kulantir', 'Tolu', 'Gumbreg', 'Wariga', 'Warigadean', 'Julungwangi', 'Sungsang', 'Dungulan', 'Kuningan', 'Langkir', 'Medangsia', 'Pujut', 'Pahang', 'Krulut', 'Merakih', 'Tambir', 'Medangkungan', 'Matal', 'Uye', 'Menail', 'Prangbakat', 'Bala', 'Ugu', 'Wayang', 'Kulawu', 'Dukut', 'Watugunung'];
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        return view('wargabal.layanan.piodalan_page', compact('info_pura', 'saptawara', 'pancawara', 'wuku', 'bulan'));
    }

    public function cari_piodalan(Request $request)
    {
        $cari_dengan = $request->cari_dengan;
        $keterangan = $this->callKeteranganElemenKalenderBali();

        if ($cari_dengan == 'pura') {
            $validatedData = $request->validate([
                'tahun_dicari' => 'required',
                'pura_dicari' => 'required',
                'bulan_dicari' => 'required'
            ]);

            if ($validatedData) {
                $tahun_dicari = $request->tahun_dicari;
                $bulan = $request->bulan_dicari;
                $bulan_dicari = $this->ubahAngkaBulan($bulan);

                // $info_piodalan = $this->callPiodalan($tahun_dicari . '-01-01', $tahun_dicari . '-12-31');
                // cache info_piodalan
                $info_piodalan = Cache::remember('info_piodalan_' . $tahun_dicari . '_01_01_' . $tahun_dicari . '_12_31', now()->addDays(365), function () use ($tahun_dicari) {
                    return $this->callPiodalan($tahun_dicari . '-01-01', $tahun_dicari . '-12-31');
                });

                // $info_piodalan = $this->callPiodalan($tahun_dicari . '-' . str_pad($bulan_dicari + 1, 2, '0', STR_PAD_LEFT) . '-01', $tahun_dicari . '-' . str_pad($bulan_dicari + 1, 2, '0', STR_PAD_LEFT) . '-' . date('t', strtotime($tahun_dicari . '-' . str_pad($bulan_dicari + 1, 2, '0', STR_PAD_LEFT) . '-01')));
                // $info_elemen_kalender_bali = $this->callElemenKalenderBali($tahun_dicari . '-' . str_pad($bulan_dicari + 1, 2, '0', STR_PAD_LEFT) . '-01', $tahun_dicari . '-' . str_pad($bulan_dicari + 1, 2, '0', STR_PAD_LEFT) . '-' . date('t', strtotime($tahun_dicari . '-' . str_pad($bulan_dicari + 1, 2, '0', STR_PAD_LEFT) . '-01')));

                $pura_dicari = $request->pura_dicari;
                $item_piodalan = [];
                $item_kalender = [];

                foreach ($info_piodalan as $item) {
                    if ($item['pura'] != "-") {
                        foreach ($item['pura'] as $pura) {
                            if ($pura['nama_pura'] == $pura_dicari) {
                                $pura_id_dicari = $pura['id_pura'];
                                $item_piodalan[] = $item;
                                $item_kalender[] = $this->callElemenKalenderBali($item['tanggal'], $item['tanggal']);
                            }
                        }
                    }
                }
                // dd($item_kalender);
                // dd($item_piodalan);
                return view('wargabal.layanan.pencarian_piodalan_page', compact('item_piodalan', 'item_kalender', 'pura_dicari', 'pura_id_dicari', 'bulan_dicari', 'tahun_dicari', 'cari_dengan', 'keterangan'));
            } else {
                return redirect()->back()->withInput()->withErrors($validatedData);
            }
        } elseif ($cari_dengan == 'wewaran') {
            $validatedData = $request->validate([
                'saptawara_dicari' => 'required',
                'pancawara_dicari' => 'required',
                'wuku_dicari' => 'required',
                'tahun_dicari' => 'required'
            ]);

            if ($validatedData) {
                $saptawara_dicari = $request->saptawara_dicari;
                $pancawara_dicari = $request->pancawara_dicari;
                $wuku_dicari = $request->wuku_dicari;
                $wewaran_dicari = $saptawara_dicari . ' ' . $pancawara_dicari . ' ' . $wuku_dicari;
                $tahun_dicari = $request->tahun_dicari;

                // $info_piodalan = $this->callPiodalan($tahun_dicari . '-01-01', $tahun_dicari . '-12-31');
                // cache info_piodalan
                $info_piodalan = Cache::remember('info_piodalan_' . $tahun_dicari . '_01_01_' . $tahun_dicari . '_12_31', now()->addDays(365), function () use ($tahun_dicari) {
                    return $this->callPiodalan($tahun_dicari . '-01-01', $tahun_dicari . '-12-31');
                });
                // dd($info_piodalan);
                $item_piodalan = [];
                $item_kalender = [];

                foreach ($info_piodalan as $item) {
                    if ($item['hari'] == $wewaran_dicari) {
                        $item_piodalan[] = $item;
                        // $item_kalender[] = $this->callElemenKalenderBali($item['tanggal'], $item['tanggal']);
                        // cache 
                        $item_kalender[] = Cache::remember('info_elemen_kalender_bali_' . $item['tanggal'] . '_' . $item['tanggal'], now()->addDays(365), function () use ($item) {
                            return $this->callElemenKalenderBali($item['tanggal'], $item['tanggal']);
                        });
                    }
                }
                // dd($item_piodalan);
                // dd($item_kalender);

                return view('wargabal.layanan.pencarian_piodalan_page', compact('item_kalender', 'item_piodalan', 'saptawara_dicari', 'pancawara_dicari', 'wuku_dicari', 'wewaran_dicari', 'tahun_dicari', 'cari_dengan', 'keterangan'));
            } else {
                return redirect()->back()->withInput()->withErrors($validatedData);
            }
        } elseif ($cari_dengan == 'bulan') {
            $validatedData = $request->validate([
                'bulan_dicari' => 'required',
                'tahun_dicari' => 'required'
            ]);

            if ($validatedData) {
                $bulan = $request->bulan_dicari;
                $bulan_dicari = $this->ubahAngkaBulan($bulan);
                $tahun_dicari = $request->tahun_dicari;

                // $info_piodalan = $this->callPiodalan($tahun_dicari . '-' . $bulan_dicari . '-01', $tahun_dicari . '-' . $bulan_dicari . '-' . date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')));
                // cache info_piodalan
                $info_piodalan = Cache::remember('info_piodalan_' . $tahun_dicari . '_' . $bulan_dicari . '_01_' . $tahun_dicari . '_' . $bulan_dicari . '_' . date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')), now()->addDays(365), function () use ($tahun_dicari, $bulan_dicari) {
                    return $this->callPiodalan($tahun_dicari . '-' . $bulan_dicari . '-01', $tahun_dicari . '-' . $bulan_dicari . '-' . date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')));
                });

                $item_piodalan = [];
                $item_kalender = [];
                foreach ($info_piodalan as $item) {
                    if ($item['pura'] != "-") {
                        $item_piodalan[] = $item;
                        // $item_kalender[] = $this->callElemenKalenderBali($item['tanggal'], $item['tanggal']);
                        // cache
                        $item_kalender[] = Cache::remember('info_elemen_kalender_bali_' . $item['tanggal'] . '_' . $item['tanggal'], now()->addDays(365), function () use ($item) {
                            return $this->callElemenKalenderBali($item['tanggal'], $item['tanggal']);
                        });
                    }
                }
                // dd($item_kalender);
                return view('wargabal.layanan.pencarian_piodalan_page', compact('item_kalender', 'item_piodalan', 'bulan', 'bulan_dicari', 'tahun_dicari', 'cari_dengan', 'keterangan'));
            } else {
                return redirect()->back()->withInput()->withErrors($validatedData);
            }
        }
    }

    public function kelola_pura_page()
    {
        $info_pura = Cache::remember('info_pura', now()->addDays(1), function () {
            return $this->callPura();
        });

        return view('wargabal.kelola_pura.kelola_pura_page', compact('info_pura'));
    }

    public function piodalan_pura_page($id)
    {
        $info_pura = $this->callPuraById($id);
        $data_piodalan_pura = $this->callPiodalanPura();
        $info_piodalan_pura = [];
        $bulan_ada_piodalan = [];
        $tahun_ada_piodalan = [];

        $adminController = new AdminController();
        $daftar_pura_user = $adminController->callListPuraUser();
        $user = session('user');
        $cek_pura_user = false;
        // $daftar_user = [];
        if (isset(session('user')['permission']) && session('user')['permission'] == 'Admin') {
            $cek_pura_user = true;
        } else if (isset(session('user')['permission'])) {
            foreach ($daftar_pura_user as $item) {
                // $daftar_user[] = $item['user_id'];
                if ($item['pura_id'] == $id) {
                    if ($item['user_id'] == $user['id']) {
                        $cek_pura_user = true;
                    }
                }
            }
        }

        foreach ($data_piodalan_pura as $item) {
            if ($item['pura_id'] == $id) {
                $info_piodalan_pura[] = $item;
                $bulan_ada_piodalan[] = date('m', strtotime($item['date']));
                $tahun_ada_piodalan[] = date('Y', strtotime($item['date']));
            }
        }

        $info_piodalan_pura = array_reverse($info_piodalan_pura);
        $bulan = array_reverse(array_unique($bulan_ada_piodalan));
        $tahun = array_reverse(array_unique($tahun_ada_piodalan));

        return view('wargabal.kelola_pura.piodalan_pura_page', compact('info_piodalan_pura', 'info_pura', 'bulan', 'tahun', 'daftar_pura_user', 'cek_pura_user'));
    }

    public function create_piodalan_pura(Request $request, $pura_id)
    {
        $validatedData = $request->validate([
            'tanggal_piodalan' => 'required',
            'deskripsi_piodalan' => 'required',
            'level_piodalan' => 'required',
        ]);

        if ($validatedData) {
            $client = new Client();
            // $user = session('user');
            // $token = $user['token'];

            $auth_controller = new AuthenticationController();
            $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');
            $token = $login_token['data']['token'];

            $response = $client->request('POST', $this->url_web . 'piodalans', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'date' => $request->tanggal_piodalan,
                    'description' => $request->deskripsi_piodalan,
                    'level' => $request->level_piodalan,
                    'pura_id' => $pura_id
                ]
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            if ($result['success'] == true) {
                return redirect()->back()->with('success', 'Data piodalan berhasil ditambahkan!');
            } else {
                return redirect()->back()->with('error', 'Gagal menambahkan data piodalan!')->withInput();
            }
        } else {
            return redirect()->back()->withErrors($validatedData);
        }
    }

    public function edit_piodalan_pura(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal_piodalan' => 'required',
            'deskripsi_piodalan' => 'required',
            'level_piodalan' => 'required',
            'pura_id' => 'required'
        ]);

        if ($validatedData) {
            $client = new Client();
            $auth_controller = new AuthenticationController();
            $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');
            $response = $client->request('POST', $this->url_web . 'piodalans/' . $id . '?_method=PUT', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $login_token['data']['token'],
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'date' => $request->tanggal_piodalan,
                    'description' => $request->deskripsi_piodalan,
                    'level' => $request->level_piodalan,
                    'pura_id' => $request->pura_id
                ]
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            if ($result['success'] == true) {
                return redirect()->back()->with('success', 'Data piodalan berhasil diubah!');
            } else {
                return redirect()->back()->with('error', 'Gagal mengubah data piodalan!')->withInput();
            }
        } else {
            return redirect()->back()->withErrors($validatedData);
        }
    }

    public function hapus_piodalan_pura($id)
    {
        $data_acara_piodalan_pura = $this->callAcaraPiodalanPura($id);
        if (count($data_acara_piodalan_pura) > 0) {
            return redirect()->back()->with('error', 'Gagal menghapus data piodalan! Susunan acara piodalan masih ada!');
        } else {
            $client = new Client();
            $auth_controller = new AuthenticationController();
            $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');
            $response = $client->request('DELETE', $this->url_web . 'piodalans/' . $id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $login_token['data']['token'],
                    'Accept' => 'application/json',
                ]
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            if ($result['success'] == true) {
                return redirect()->back()->with('success', 'Data piodalan berhasil dihapus!');
            } else {
                return redirect()->back()->with('error', 'Gagal menghapus data piodalan!');
            }
        }
    }

    public function acara_piodalan_pura($piodalan_id, $pura_id)
    {
        $info_pura = $this->callPuraById($pura_id);
        $info_piodalan_pura = $this->callPiodalanPuraById($piodalan_id);

        $data_acara_piodalan_pura = $this->callAcaraPiodalanPura($piodalan_id);
        $info_acara_piodalan_pura = array_reverse($data_acara_piodalan_pura);


        $adminController = new AdminController();
        $daftar_pura_user = $adminController->callListPuraUser();
        $user = session('user');
        $cek_pura_user = false;
        // $daftar_user = [];
        if ($user['permission'] == 'Admin') {
            $cek_pura_user = true;
        } else {
            foreach ($daftar_pura_user as $item) {
                // $daftar_user[] = $item['user_id'];
                if ($item['pura_id'] == $pura_id) {
                    if ($item['user_id'] == $user['id']) {
                        $cek_pura_user = true;
                    }
                }
            }
        }

        return view('wargabal.kelola_pura.acara_piodalan_pura_page', compact('info_acara_piodalan_pura', 'info_piodalan_pura', 'info_pura', 'daftar_pura_user', 'cek_pura_user'));
    }

    public function create_acara_piodalan_pura(Request $request, $piodalan_id)
    {
        $validatedData = $request->validate([
            'acara' => 'required',
            'level' => 'required',
            'pic_name' => 'required',
            'pic_phone' => 'required',
            'date' => 'required',
        ]);

        if ($validatedData) {
            $client = new Client();
            // $user = session('user');
            // $token = $user['token'];
            $auth_controller = new AuthenticationController();
            $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');
            $token = $login_token['data']['token'];

            $response = $client->request('POST', $this->url_web . 'acaras', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'acara' => $request->acara,
                    'level' => $request->level,
                    'pic_name' => $request->pic_name,
                    'pic_phone' => $request->pic_phone,
                    'date' => $request->date,
                    'piodalan_id' => $piodalan_id
                ]
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            if ($result['success'] == true) {
                return redirect()->back()->with('success', 'Data acara piodalan berhasil ditambahkan!');
            } else {
                return redirect()->back()->with('error', 'Gagal menambahkan data acara piodalan!')->withInput();
            }
        } else {
            return redirect()->back()->withErrors($validatedData);
        }
    }

    public function edit_acara_piodalan_pura(Request $request, $id)
    {
        $client = new Client();
        $auth_controller = new AuthenticationController();
        $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');

        $response = $client->request('POST', $this->url_web . 'acaras/' . $id . '?_method=PUT', [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['data']['token'],
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'acara' => $request->acara,
                'level' => $request->level,
                'pic_name' => $request->pic_name,
                'pic_phone' => $request->pic_phone,
                'date' => $request->date,
                'piodalan_id' => $request->piodalan_id
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['success'] == true) {
            return redirect()->back()->with('success', 'Data acara piodalan berhasil diubah!');
        } else {
            return redirect()->back()->with('error', 'Gagal mengubah data acara piodalan!')->withInput();
        }
    }

    public function hapus_acara_piodalan_pura($id)
    {
        $client = new Client();
        $auth_controller = new AuthenticationController();
        $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');
        $response = $client->request('DELETE', $this->url_web . 'acaras/' . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['data']['token'],
                'Accept' => 'application/json',
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['success'] == true) {
            return redirect()->back()->with('success', 'Data acara piodalan berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data acara piodalan!');
        }
    }

    public function keuangan_pura_page($id)
    {
        $info_pura = $this->callPuraById($id);
        $info_keuangan_pura = $this->callKeuanganPura($id);
        // dd($info_keuangan_pura);
        $reverse_info_keuangan_pura = array_reverse($info_keuangan_pura['finances']);
        // dd($reverse_info_keuangan_pura);
        $item_keuangan = ['Banten', 'Sumbangan'];

        $debit_banten = 0;
        $kredit_banten = 0;
        $debit_sumbangan = 0;
        $kredit_sumbangan = 0;

        $presen_debit_banten = 0;
        $presen_kredit_banten = 0;
        $presen_debit_sumbangan = 0;
        $presen_kredit_sumbangan = 0;

        foreach ($info_keuangan_pura['finances'] as $item) {
            if ($item['master_item_id'] == 1) {
                if ($item['debit_kredit'] == 'Debit') {
                    $debit_banten += $item['jumlah'];
                } else {
                    $kredit_banten += $item['jumlah'];
                }
            } else {
                if ($item['debit_kredit'] == 'Debit') {
                    $debit_sumbangan += $item['jumlah'];
                } else {
                    $kredit_sumbangan += $item['jumlah'];
                }
            }
        }

        if ($debit_banten != 0 || $kredit_banten != 0) {

            // Cek agar tidak ada pembagian dengan nol
            if (($debit_banten + $debit_sumbangan) != 0) {
                // 2 angka dibelakang koma
                $presen_debit_banten = number_format(($debit_banten / ($debit_banten + $debit_sumbangan)) * 100, 2);
            } else {
                $presen_debit_banten = 0; // atau atur nilai default lain
            }
        
            if (($kredit_banten + $kredit_sumbangan) != 0) {
                $presen_kredit_banten = number_format(($kredit_banten / ($kredit_banten + $kredit_sumbangan)) * 100, 2);
            } else {
                $presen_kredit_banten = 0; // atau atur nilai default lain
            }
        }
        
        if ($debit_sumbangan != 0 || $kredit_sumbangan != 0) {
        
            if (($debit_sumbangan + $debit_banten) != 0) {
                $presen_debit_sumbangan = number_format(($debit_sumbangan / ($debit_sumbangan + $debit_banten)) * 100, 2);
            } else {
                $presen_debit_sumbangan = 0; // atau atur nilai default lain
            }
        
            if (($kredit_sumbangan + $kredit_banten) != 0) {
                $presen_kredit_sumbangan = number_format(($kredit_sumbangan / ($kredit_sumbangan + $kredit_banten)) * 100, 2);
            } else {
                $presen_kredit_sumbangan = 0; // atau atur nilai default lain
            }
        }


        $adminController = new AdminController();
        $daftar_pura_user = $adminController->callListPuraUser();
        $user = session('user');
        $cek_pura_user = false;
        // $daftar_user = [];
        if (isset(session('user')['permission']) && session('user')['permission'] == 'Admin') {
            $cek_pura_user = true;
        } else if (isset(session('user')['permission'])) {
            foreach ($daftar_pura_user as $item) {
                // $daftar_user[] = $item['user_id'];
                if ($item['pura_id'] == $id) {
                    if ($item['user_id'] == $user['id']) {
                        $cek_pura_user = true;
                    }
                }
            }
        }

        return view('wargabal.kelola_pura.keuangan_pura_page', compact(
            'reverse_info_keuangan_pura',
            'info_keuangan_pura',
            'item_keuangan',
            'debit_banten',
            'kredit_banten',
            'debit_sumbangan',
            'kredit_sumbangan',
            'presen_debit_banten',
            'presen_kredit_banten',
            'presen_debit_sumbangan',
            'presen_kredit_sumbangan',
            'info_pura',
            'daftar_pura_user',
            'cek_pura_user'
        ));
    }

    public function create_keuangan_pura(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal_keuangan' => 'required',
            'item_keuangan' => 'required',
            'debit_kredit' => 'required',
            'jumlah_keuangan' => 'required',
        ]);

        if ($validatedData) {
            $client = new Client();
            $auth_controller = new AuthenticationController();
            $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');

            $response = $client->request('POST', $this->url_web . 'finances', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $login_token['data']['token'],
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'pura_id' => $id,
                    'tanggal' => $request->tanggal_keuangan,
                    'master_item_id' => $request->item_keuangan,
                    'debit_kredit' => $request->debit_kredit,
                    'jumlah' => $request->jumlah_keuangan,
                    'note' => $request->catatan_keuangan
                ]
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            if ($result['success'] == true) {
                return redirect()->back()->with('success', 'Data keuangan berhasil ditambahkan!');
            } else {
                return redirect()->back()->with('error', 'Gagal menambahkan data keuangan!')->withInput();
            }
        } else {
            return redirect()->back()->withErrors($validatedData);
        }
    }

    public function edit_keuangan_pura(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tanggal_keuangan' => 'required',
            'item_keuangan' => 'required',
            'debit_kredit' => 'required',
            'jumlah_keuangan' => 'required',
        ]);

        if ($validatedData) {
            $client = new Client();
            $auth_controller = new AuthenticationController();
            $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');

            $response = $client->request('POST', $this->url_web . 'finances/' . $id . '?_method=PUT', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $login_token['data']['token'],
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'pura_id' => $id,
                    'tanggal' => $request->tanggal_keuangan,
                    'master_item_id' => $request->item_keuangan,
                    'debit_kredit' => $request->debit_kredit,
                    'jumlah' => $request->jumlah_keuangan,
                    'note' => $request->catatan_keuangan
                ]
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            if ($result['success'] == true) {
                return redirect()->back()->with('success', 'Data keuangan berhasil diubah!');
            } else {
                return redirect()->back()->with('error', 'Gagal mengubah data keuangan!')->withInput();
            }
        } else {
            return redirect()->back()->withErrors($validatedData);
        }
    }

    public function hapus_keuangan_pura($id)
    {
        $client = new Client();
        $auth_controller = new AuthenticationController();
        $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');

        $response = $client->request('DELETE', $this->url_web . 'finances/' . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['data']['token'],
                'Accept' => 'application/json',
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        if ($result['success'] == true) {
            return redirect()->back()->with('success', 'Data keuangan berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus data keuangan!');
        }
    }

    public function callPiodalanPura()
    {
        $client = new Client();
        $auth_controller = new AuthenticationController();
        $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');

        $response = $client->request('GET', $this->url_web . 'piodalans', [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['data']['token'],
                'Accept' => 'application/json',
            ],
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function callPiodalanPuraById($id)
    {
        $client = new Client();
        $auth_controller = new AuthenticationController();
        $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');

        $response = $client->request('GET', $this->url_web . 'piodalans/' . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['data']['token'],
                'Accept' => 'application/json',
            ],
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function callAcaraPiodalanPura($id)
    {
        $client = new Client();
        $auth_controller = new AuthenticationController();
        $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');

        $response = $client->request('GET', $this->url_web . 'acaras/by-piodalan/' . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['data']['token'],
                'Accept' => 'application/json',
            ],
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function callKeuanganPura($id)
    {
        $client = new Client();
        $auth_controller = new AuthenticationController();
        $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');
        $year_now = date('Y');

        $response = $client->request('GET', $this->url_web . 'finances?year=' . $year_now . '&pura_id=' . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['data']['token'],
                'Accept' => 'application/json',
            ],
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function callPura()
    {
        $client = new Client();
        $response = $client->request('GET', $this->url_api . 'lihatPura');
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function callPuraById($id)
    {
        $client = new Client();
        $response = $client->request('GET', $this->url_api . 'lihatPura/' . $id);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function callPiodalan($tanggal_mulai, $tanggal_selesai)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'cariPiodalan?tanggal_mulai=' . $tanggal_mulai . '&tanggal_selesai=' . $tanggal_selesai, [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function otonan_page()
    {
        $saptawara = ['Redite', 'Soma', 'Anggara', 'Buda', 'Wraspati', 'Sukra', 'Saniscara'];
        $pancawara = ['Umanis', 'Paing', 'Pon', 'Wage', 'Kliwon'];
        $wuku = ['Sinta', 'Landep', 'Ukir', 'Kulantir', 'Tolu', 'Gumbreg', 'Wariga', 'Warigadean', 'Julungwangi', 'Sungsang', 'Dungulan', 'Kuningan', 'Langkir', 'Medangsia', 'Pujut', 'Pahang', 'Krulut', 'Merakih', 'Tambir', 'Medangkungan', 'Matal', 'Uye', 'Menail', 'Prangbakat', 'Bala', 'Ugu', 'Wayang', 'Kulawu', 'Dukut', 'Watugunung'];

        return view('wargabal.layanan.otonan_page', compact('saptawara', 'pancawara', 'wuku'));
    }

    public function cari_otonan(Request $request)
    {
        $cari_dengan = $request->cari_dengan;
        $keterangan = $this->callKeteranganElemenKalenderBali();
        // dd($keterangan);

        if ($cari_dengan == 'tanggal_lahir') {
            $validatedData = $request->validate([
                'tanggal_lahir_dicari' => 'required|date',
                'tahun_dicari' => 'required|numeric'
            ]);

            if ($validatedData) {
                $tanggal_lahir_dicari = $request->tanggal_lahir_dicari;
                $tahun_dicari = $request->tahun_dicari;
                // $info_otonan = $this->callOtonan($tanggal_lahir_dicari, $tahun_dicari);
                // cache info_otonan
                $info_otonan = Cache::remember('info_otonan_' . $tanggal_lahir_dicari . '_' . $tahun_dicari, now()->addDays(365), function () use ($tanggal_lahir_dicari, $tahun_dicari) {
                    return $this->callOtonan($tanggal_lahir_dicari, $tahun_dicari);
                });
                // $info_elemen_kalender_bali = $this->callElemenKalenderBali($tanggal_lahir_dicari, $tanggal_lahir_dicari);
                // cache info_elemen_kalender_bali
                $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_' . $tanggal_lahir_dicari . '_' . $tanggal_lahir_dicari, now()->addDays(365), function () use ($tanggal_lahir_dicari) {
                    return $this->callElemenKalenderBali($tanggal_lahir_dicari, $tanggal_lahir_dicari);
                });

                // $info_otonan_pertama = $this->callElemenKalenderBali($info_otonan['otonan_terdekat_pertama'], $info_otonan['otonan_terdekat_pertama']);
                // cache
                $info_otonan_pertama = Cache::remember('info_elemen_kalender_bali_' . $info_otonan['otonan_terdekat_pertama'] . '_' . $info_otonan['otonan_terdekat_pertama'], now()->addDays(365), function () use ($info_otonan) {
                    return $this->callElemenKalenderBali($info_otonan['otonan_terdekat_pertama'], $info_otonan['otonan_terdekat_pertama']);
                });
                // $info_otonan_kedua = $this->callElemenKalenderBali($info_otonan['otonan_terdekat_kedua'], $info_otonan['otonan_terdekat_kedua']);
                // cache
                $info_otonan_kedua = Cache::remember('info_elemen_kalender_bali_' . $info_otonan['otonan_terdekat_kedua'] . '_' . $info_otonan['otonan_terdekat_kedua'], now()->addDays(365), function () use ($info_otonan) {
                    return $this->callElemenKalenderBali($info_otonan['otonan_terdekat_kedua'], $info_otonan['otonan_terdekat_kedua']);
                });
                // dd($info_otonan_pertama, $info_otonan_kedua);

                $tanggal_otonan = [0 => '-', 1 => '-'];

                return view('wargabal.layanan.pencarian_otonan_page', compact('info_otonan', 'info_otonan_pertama', 'info_otonan_kedua', 'tanggal_otonan', 'info_elemen_kalender_bali', 'tanggal_lahir_dicari', 'tahun_dicari', 'cari_dengan', 'keterangan'));
            } else {
                return redirect()->back()->withInput()->withErrors($validatedData);
            }
        } else {
            $validatedData = $request->validate([
                'saptawara_dicari' => 'required',
                'pancawara_dicari' => 'required',
                'wuku_dicari' => 'required',
                'tahun_dicari' => 'required|numeric'
            ]);

            if ($validatedData) {
                $saptawara_dicari = $request->saptawara_dicari;
                $pancawara_dicari = $request->pancawara_dicari;
                $wuku_dicari = $request->wuku_dicari;
                $tahun_dicari = $request->tahun_dicari;
                $tanggal_otonan = [];

                // $info_elemen_kalender_bali = $this->callElemenKalenderBali($tahun_dicari . '-01-01', $tahun_dicari + 1 . '-12-31');
                // cache info_elemen_kalender_bali
                $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_' . $tahun_dicari . '_01_01_' . $tahun_dicari + 1 . '_12_31', now()->addDays(365), function () use ($tahun_dicari) {
                    return $this->callElemenKalenderBali($tahun_dicari . '-01-01', $tahun_dicari + 1 . '-12-31');
                });
                foreach ($info_elemen_kalender_bali as $key => $item) {
                    if ($item['kalender']['saptawara'] == $saptawara_dicari && $item['kalender']['pancawara'] == $pancawara_dicari && $item['kalender']['wuku'] == $wuku_dicari) {
                        $tanggal_otonan[] = $item['tanggal'];
                    }
                }
                // apabila tanggal otonan lebih dari 2 maka ambil 2 tanggal terdekat
                if (count($tanggal_otonan) > 2) {
                    $tanggal_otonan = array_slice($tanggal_otonan, 0, 2);
                }

                if ($tanggal_otonan == null) {
                    $tanggal_otonan = ['-', '-'];

                    $info_otonan_pertama = '-';
                    $info_otonan_kedua = '-';
                } else {
                    // $info_otonan_pertama = $this->callElemenKalenderBali($tanggal_otonan[0], $tanggal_otonan[0]);
                    // cache
                    $info_otonan_pertama = Cache::remember('info_elemen_kalender_bali_' . $tanggal_otonan[0] . '_' . $tanggal_otonan[0], now()->addDays(365), function () use ($tanggal_otonan) {
                        return $this->callElemenKalenderBali($tanggal_otonan[0], $tanggal_otonan[0]);
                    });
                    // $info_otonan_kedua = $this->callElemenKalenderBali($tanggal_otonan[1], $tanggal_otonan[1]);
                    // cache
                    $info_otonan_kedua = Cache::remember('info_elemen_kalender_bali_' . $tanggal_otonan[1] . '_' . $tanggal_otonan[1], now()->addDays(365), function () use ($tanggal_otonan) {
                        return $this->callElemenKalenderBali($tanggal_otonan[1], $tanggal_otonan[1]);
                    });
                }


                $tanggal_lahir_dicari = '-';
                $info_otonan = [
                    'otonan_terdekat_pertama' => '-',
                    'otonan_terdekat_kedua' => '-'
                ];

                return view('wargabal.layanan.pencarian_otonan_page', compact('info_otonan', 'info_otonan_pertama', 'info_otonan_kedua', 'tanggal_otonan', 'saptawara_dicari', 'pancawara_dicari', 'wuku_dicari', 'tahun_dicari', 'tanggal_lahir_dicari', 'cari_dengan', 'keterangan'));
            } else {
                return redirect()->back()->withInput()->withErrors($validatedData);
            }
        }
    }

    public function callOtonan($tanggal_lahir, $tahun_dicari)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'cariOtonan?tanggal_lahir=' . $tanggal_lahir . '&tahun_dicari=' . $tahun_dicari, [
            'headers' => $headers
        ]);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data;
    }

    public function ramalan_sifat_page()
    {
        return view('wargabal.layanan.ramalan_sifat_page');
    }

    public function cari_ramalan_sifat(Request $request)
    {
        // dd($request->all());
        $keterangan = $this->callKeteranganElemenKalenderBali();
        $validatedData = $request->validate([
            'tanggal_lahir_dicari' => 'required|date',
        ]);

        if ($validatedData) {
            $tanggal_lahir_dicari = $request->tanggal_lahir_dicari;
            // $info_ramalan_sifat = $this->callRamalanSifat($tanggal_lahir_dicari);
            // cache info_ramalan_sifat
            $info_ramalan_sifat = Cache::remember('info_ramalan_sifat_' . $tanggal_lahir_dicari, now()->addDays(365), function () use ($tanggal_lahir_dicari) {
                return $this->callRamalanSifat($tanggal_lahir_dicari);
            });
            // $info_elemen_kalender_bali = $this->callElemenKalenderBali($tanggal_lahir_dicari, $tanggal_lahir_dicari);
            // cache info_elemen_kalender_bali
            $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_' . $tanggal_lahir_dicari . '_' . $tanggal_lahir_dicari, now()->addDays(365), function () use ($tanggal_lahir_dicari) {
                return $this->callElemenKalenderBali($tanggal_lahir_dicari, $tanggal_lahir_dicari);
            });

            return view('wargabal.layanan.pencarian_ramalan_sifat_page', compact('info_ramalan_sifat', 'info_elemen_kalender_bali', 'tanggal_lahir_dicari', 'keterangan'));
        } else {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }
    }

    public function callRamalanSifat($tanggal_lahir)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'ramalanSifat?tanggal_lahir=' . $tanggal_lahir, [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function ubahNamaBulan($angka_bulan)
    {
        $bulan = [
            0 => 'Januari',
            1 => 'Februari',
            2 => 'Maret',
            3 => 'April',
            4 => 'Mei',
            5 => 'Juni',
            6 => 'Juli',
            7 => 'Agustus',
            8 => 'September',
            9 => 'Oktober',
            10 => 'November',
            11 => 'Desember'
        ];

        return $bulan[$angka_bulan];
    }

    public function ubahAngkaBulan($nama_bulan)
    {
        $bulan = [
            'Januari'  => 1,
            'Februari'  => 2,
            'Maret'  => 3,
            'April'  => 4,
            'Mei'  => 5,
            'Juni'  => 6,
            'Juli'  => 7,
            'Agustus'  => 8,
            'September'  => 9,
            'Oktober'  => 10,
            'November'  => 11,
            'Desember' => 12
        ];

        return $bulan[$nama_bulan];
    }

    public function wariga_personal_page()
    {
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        return view('wargabal.layanan.wariga_personal_page', compact('bulan'));
    }

    public function cari_wariga_personal(Request $request)
    {
        $layanan = new LayananController();
        $keterangan = $layanan->callKeteranganElemenKalenderBali();
        // dd($keterangan);

        $auth_con = new AdminController();

        $validatedData = $request->validate([
            'tanggal_lahir_dicari' => 'required|date',
            'bulan_dicari' => 'required',
            'tahun_dicari' => 'required|numeric'
        ]);

        if ($validatedData) {
            $tanggal_lahir_dicari = $request->tanggal_lahir_dicari;

            $bulan = $request->bulan_dicari;
            $bulan_dicari = $this->ubahAngkaBulan($bulan);
            $tahun_dicari = $request->tahun_dicari;

            if ($auth_con->hasPermission("Admin") || $auth_con->hasPermission("Member")) {
                $tanggal_mulai = date('Y-m-01', strtotime($tahun_dicari . '-' . $bulan_dicari . '-01'));
                $tanggal_selesai = date('Y-m-t', strtotime($tahun_dicari . '-' . $bulan_dicari . '-01'));
            } else {
                $tanggal_mulai = date('Y-m-01', strtotime($tahun_dicari . '-' . $bulan_dicari . '-01'));
                $tanggal_selesai = date('Y-m-07', strtotime($tahun_dicari . '-' . $bulan_dicari . '-01'));
            }

            $events = array();

            // $info_wariga_personal = $this->callWarigaPersonal($tanggal_mulai, $tanggal_selesai, $tanggal_lahir_dicari);
            // cache info_wariga_personal
            $info_wariga_personal = Cache::remember('info_wariga_personal_' . $tanggal_mulai . '_' . $tanggal_selesai . '_' . $tanggal_lahir_dicari, now()->addDays(365), function () use ($tanggal_mulai, $tanggal_selesai, $tanggal_lahir_dicari) {
                return $this->callWarigaPersonal($tanggal_mulai, $tanggal_selesai, $tanggal_lahir_dicari);
            });
            // $info_elemen_tanggal_lahir = $this->callElemenKalenderBali($tanggal_lahir_dicari, $tanggal_lahir_dicari);
            // cache info_elemen_tanggal_lahir
            $info_elemen_tanggal_lahir = Cache::remember('info_elemen_kalender_bali_' . $tanggal_lahir_dicari . '_' . $tanggal_lahir_dicari, now()->addDays(365), function () use ($tanggal_lahir_dicari) {
                return $this->callElemenKalenderBali($tanggal_lahir_dicari, $tanggal_lahir_dicari);
            });
            // $info_dewasa_tanggal_lahir = $this->callAlaAyuningDewasa($tanggal_lahir_dicari, $tanggal_lahir_dicari);
            // cache info_dewasa_tanggal_lahir
            $info_dewasa_tanggal_lahir = Cache::remember('info_ala_ayuning_dewasa_' . $tanggal_lahir_dicari . '_' . $tanggal_lahir_dicari, now()->addDays(365), function () use ($tanggal_lahir_dicari) {
                return $this->callAlaAyuningDewasa($tanggal_lahir_dicari, $tanggal_lahir_dicari);
            });
            foreach ($info_wariga_personal['wariga_personal'] as $key => $wariga_personal) {
                if ($wariga_personal['wariga'] == 'Guru') {
                    $events[] = [
                        'title' => $wariga_personal['wariga'],
                        'start' => $wariga_personal['tanggal'],
                        'end' => $wariga_personal['tanggal'],
                        'category' => 'guru',
                        'className' => 'bg-info'
                    ];
                } elseif ($wariga_personal['wariga'] == 'Ratu') {
                    $events[] = [
                        'title' => $wariga_personal['wariga'],
                        'start' => $wariga_personal['tanggal'],
                        'end' => $wariga_personal['tanggal'],
                        'category' => 'ratu',
                        'className' => 'bg-success'
                    ];
                } elseif ($wariga_personal['wariga'] == 'Lara') {
                    $events[] = [
                        'title' => $wariga_personal['wariga'],
                        'start' => $wariga_personal['tanggal'],
                        'end' => $wariga_personal['tanggal'],
                        'category' => 'lara',
                        'className' => 'bg-warning'
                    ];
                } elseif ($wariga_personal['wariga'] == 'Pati') {
                    $events[] = [
                        'title' => $wariga_personal['wariga'],
                        'start' => $wariga_personal['tanggal'],
                        'end' => $wariga_personal['tanggal'],
                        'category' => 'pati',
                        'className' => 'bg-danger'
                    ];
                }
            }
            // dd($bulan_dicari);
            // dd($events);

            return view('wargabal.layanan.wariga_calendar', compact('events', 'info_wariga_personal', 'info_elemen_tanggal_lahir', 'info_dewasa_tanggal_lahir', 'tanggal_lahir_dicari', 'bulan_dicari', 'tahun_dicari', 'keterangan', 'tanggal_mulai', 'tanggal_selesai'));
        } else {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }
    }

    public function callWarigaPersonal($tanggal_mulai, $tanggal_selesai, $tanggal_lahir)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'cariWarigaPersonal?tanggal_mulai=' . $tanggal_mulai . '&tanggal_selesai=' . $tanggal_selesai . '&tanggal_lahir=' . $tanggal_lahir, [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }
}
