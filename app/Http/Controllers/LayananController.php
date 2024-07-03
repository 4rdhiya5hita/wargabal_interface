<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LayananController extends Controller
{
    protected $url_api = 'https://api2.kalenderbali.web.id/api/';
    protected $url_api_local = 'http://localhost:8000/api/';

    public function hari_raya_page()
    {
        $data = Cache::remember('data_hari_raya', now()->addDays(365), function() {
            return $this->keteranganHariRaya();
        });
        $hari_raya = collect($data)->where('type', 'hari raya')->sortBy('nama');
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $tanggal_sekarang = date('Y-m-d');
        $tanggal_mulai = date('Y-m-01');
        $tanggal_selesai = date('Y-m-t');
        $info_hari_raya = Cache::get('info_hari_raya_'. $tanggal_mulai . '_' . $tanggal_selesai);

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
        $info_hari_raya = Cache::remember('info_hari_raya_'. $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function() use ($tanggal_mulai, $tanggal_selesai) {
            $layanan = new LayananController();
            $hari_raya = $layanan->callHariRaya($tanggal_mulai, $tanggal_selesai);
            return $hari_raya;
        });

        // $info_elemen_kalender_bali = $this->callElemenKalenderBali($tanggal_mulai, $tanggal_selesai);
        // cache
        $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_'. $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function() use ($tanggal_mulai, $tanggal_selesai) {
            $layanan = new LayananController();
            $elemen_kalender_bali = $layanan->callElemenKalenderBali($tanggal_mulai, $tanggal_selesai);
            return $elemen_kalender_bali;
        });

        $keterangan = $this->callKeteranganElemenKalenderBali($tanggal_mulai, $tanggal_selesai);
        // dd($keterangan);
    // foreach($keterangan as $k => $ket){
    //     if ($k == 'pancasudha') {
    //         foreach($ket as $value) {
    //             dd($value);
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

    public function callZodiak(){
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
        $info_eka_jala_sri = Cache::remember('info_eka_jala_sri', now()->addDays(365), function() {
            $layanan = new LayananController();
            $eka_jala_sri = $layanan->keteranganEkaJalaSri();
            return $eka_jala_sri;
        });

        $info_panca_sudha = Cache::remember('info_panca_sudha', now()->addDays(365), function() {
            $layanan = new LayananController();
            $panca_sudha = $layanan->keteranganPancaSudha();
            return $panca_sudha;
        });

        $info_pangarasan = Cache::remember('info_pangarasan', now()->addDays(365), function() {
            $layanan = new LayananController();
            $pangarasan = $layanan->keteranganPangarasan();
            return $pangarasan;
        });

        $info_pratiti = Cache::remember('info_pratiti', now()->addDays(365), function() {
            $layanan = new LayananController();
            $pratiti = $layanan->keteranganPratiti();
            return $pratiti;
        });

        $info_zodiak = Cache::remember('info_zodiak', now()->addDays(365), function() {
            $layanan = new LayananController();
            $zodiak = $layanan->keteranganZodiak();
            return $zodiak;
        });

        $info_pancawara = Cache::remember('info_pancawara', now()->addDays(365), function() {
            $layanan = new LayananController();
            $pancawara = $layanan->keteranganPancawara();
            return $pancawara;
        });

        $info_saptawara = Cache::remember('info_saptawara', now()->addDays(365), function() {
            $layanan = new LayananController();
            $saptawara = $layanan->keteranganSaptawara();
            return $saptawara;
        });

        $info_wuku = Cache::remember('info_wuku', now()->addDays(365), function() {
            $layanan = new LayananController();
            $wuku = $layanan->keteranganWuku();
            return $wuku;
        });

        $keterangan = 
        [
            'ekajalasri' => $info_eka_jala_sri,
            'pancasudha' => $info_panca_sudha,
            'pangarasan' => $info_pangarasan,
            'pratiti' => $info_pratiti,
            'zodiak' => $info_zodiak,
            'pancawara' => $info_pancawara,
            'saptawara' => $info_saptawara,
            'wuku' => $info_wuku
        ];

        return $keterangan;
    }

    public function keteranganEkaJalaSri()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'keteranganEkaJalaSri', [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }
    
    public function keteranganPancaSudha()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'keteranganPancaSudha', [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganPangarasan()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'keteranganPangarasan', [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganPratiti()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'keteranganPratiti', [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganZodiak()
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

    public function keteranganPancawara()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'keteranganPancawara', [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganSaptawara()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'keteranganSaptawara', [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function keteranganWuku()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'keteranganWuku', [
            'headers' => $headers
        ]);
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
        $info_ala_ayuning_dewasa = Cache::remember('info_ala_ayuning_dewasa_'. $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function() use ($tanggal_mulai, $tanggal_selesai) {
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
                $info_ala_ayuning_dewasa = Cache::remember('info_ala_ayuning_dewasa_'. $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function() use ($tanggal_mulai, $tanggal_selesai) {
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
                $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_'. $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function() use ($tanggal_mulai, $tanggal_selesai) {
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
                $info_ala_ayuning_dewasa = Cache::remember('info_ala_ayuning_dewasa_'. $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function() use ($tanggal_mulai, $tanggal_selesai) {
                    $layanan = new LayananController();
                    $ala_ayuning_dewasa = $layanan->callAlaAyuningDewasa($tanggal_mulai, $tanggal_selesai);
                    return $ala_ayuning_dewasa;
                });

                // $info_elemen_kalender_bali = $this->callElemenKalenderBali($tanggal_mulai, $tanggal_selesai);
                // cache
                $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_'. $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(365), function() use ($tanggal_mulai, $tanggal_selesai) {
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
        $option_dewasa = ['a', 'b', 'c'];

        return view('wargabal.layanan.mengatur_kriteria_awal_page', compact('bulan', 'option_dewasa'));
    }

    public function mengatur_kriteria_parameter_page(Request $request)
    {
        $cari_dengan = $request->cari_dengan;
        $dewasa_ayu = $request->dewasa_ayu;
        $bulan_dicari = $request->bulan_dicari;
        $tahun_dicari = $request->tahun_dicari;


        return view('wargabal.layanan.mengatur_kriteria_parameter_page', compact(
            'cari_dengan',
            'dewasa_ayu',
            'bulan_dicari',
            'tahun_dicari',
        ));
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
            $logicANDdicari[] = implode('%26%26', $tempANDdicari);
        }

        $logicORdicari[] = implode('||', $logicANDdicari);
        // dd($logicORdicari[0]);
        // dd($logicORdicari[0] != null);

        // Konversi kriteria yang dihindari menjadi logika AND
        foreach ($kriteriaDihindari as $kriteria) {
            $tempANDdihindari = [];
            $tempORdihindari = [];
            // dd($kriteria);
            foreach ($kriteria as $item) {
                if ($item['key'] == 'Penanggal' || $item['key'] == 'Pangelong') {
                    $tempANDdihindari[] = "$" . "pengalantaka=='{$item['key']}'";
                    $tempANDdihindari[] = "$" . "sasihDay1=={$item['item']}";
                } else {
                    $tempANDdihindari[] = "$" . "{$item['key']}=={$item['item']}";
                }
            }
            $logicANDdihindari[] = implode('%26%26', $tempANDdihindari);
        }

        // dd($logicORdihindari);
        $logicORdihindari[] = implode('||', $logicANDdihindari);

        if ($logicORdicari[0] != null && $logicORdihindari[0] != null) {
            $finalLogicAND[] = '(' . $logicORdicari[0] . ')' . '%26%26' . '(' . $logicORdihindari[0] . ')';
        } elseif ($logicORdicari[0] != null && $logicORdihindari[0] == null) {
            if ($logicANDdihindari != null) {
                $finalLogicAND[] = '(' . $logicORdicari[0] . ')' . '%26%26' . '(' . $logicANDdihindari[0] . ')';
            } else {
                $finalLogicAND[] = $logicORdicari[0];
            }
        } elseif ($logicORdicari[0] == null && $logicORdihindari[0] != null) {
            if ($logicANDdicari != null) {
                $finalLogicAND[] = '(' . $logicANDdicari[0] . ')' . '%26%26' . '(' . $logicORdihindari[0] . ')';
            } else {
                $finalLogicAND[] = $logicORdihindari[0];
            }
        } elseif ($logicORdicari[0] == null && $logicORdihindari[0] == null) {
            if ($logicANDdicari != null && $logicANDdihindari != null) {
                $finalLogicAND[] = '(' . $logicANDdicari[0] . ')' . '%26%26' . '(' . $logicANDdihindari[0] . ')';
            } elseif ($logicANDdicari != null && $logicANDdihindari == null) {
                $finalLogicAND[] = $logicANDdicari;
            } elseif ($logicANDdicari == null && $logicANDdihindari != null) {
                $finalLogicAND[] = $logicANDdihindari;
            }
        }

        // dd($finalLogicAND[0]);
        if ($bulan_dicari == "Semua Bulan") {
            // $info_mengatur_dewasa = $this->callMengaturDewasa($tahun_dicari . '-01-01', $tahun_dicari . '-12-31', $finalLogicAND[0]);
            // cache
            $info_mengatur_dewasa = Cache::remember('info_mengatur_dewasa_'. $tahun_dicari . '_01_01_'. $tahun_dicari . '_12_31_'. $finalLogicAND[0], now()->addDays(365), function() use ($tahun_dicari, $finalLogicAND) {
                $layanan = new LayananController();
                $mengatur_dewasa = $layanan->callMengaturDewasa($tahun_dicari . '-01-01', $tahun_dicari . '-12-31', $finalLogicAND[0]);
                return $mengatur_dewasa;
            });

            // $info_elemen_kalender_bali = $this->callElemenKalenderBali($tahun_dicari . '-01-01', $tahun_dicari . '-12-31');
            // cache
            $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_'. $tahun_dicari . '_01_01_'. $tahun_dicari . '_12_31', now()->addDays(365), function() use ($tahun_dicari) {
                $layanan = new LayananController();
                $elemen_kalender_bali = $layanan->callElemenKalenderBali($tahun_dicari . '-01-01', $tahun_dicari . '-12-31');
                return $elemen_kalender_bali;
            });
        } else {
            // $info_mengatur_dewasa = $this->callMengaturDewasa($tahun_dicari . $bulan_dicari . '-01', $tahun_dicari . $bulan_dicari . '-' . date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')), $finalLogicAND[0]);
            // cache
            $info_mengatur_dewasa = Cache::remember('info_mengatur_dewasa_'. $tahun_dicari . '_' . $bulan_dicari . '_01_'. $tahun_dicari .'_'. $bulan_dicari . '_'. date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')) . '_'. $finalLogicAND[0], now()->addDays(365), function() use ($tahun_dicari, $bulan_dicari, $finalLogicAND) {
                $layanan = new LayananController();
                $mengatur_dewasa = $layanan->callMengaturDewasa($tahun_dicari . '-' . $bulan_dicari . '-01', $tahun_dicari . '-' . $bulan_dicari . '-' . date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')), $finalLogicAND[0]);
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
            $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_'. $tahun_dicari . '_' . $bulan_dicari . '_01_'. $tahun_dicari . '_'. $bulan_dicari . '_'. date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')), now()->addDays(365), function() use ($tahun_dicari, $bulan_dicari) {
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
        $response = $client->request('GET', $this->url_api . 'mengaturDewasa?tanggal_mulai=' . $tanggal_mulai . '&tanggal_selesai=' . $tanggal_selesai . '&kriteria=' . $kriteria, [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        // dd($result);
        $data = $result['data'];

        return $data;
    }

    public function fetchKeys()
    {
        $keys = ['ekawara', 'dwiwara', 'triwara', 'caturwara', 'pancawara', 'sadwara', 'saptawara', 'astawara', 'sangawara', 'dasawara', 'Penanggal', 'Pangelong', 'wuku', 'sasih', 'purnama_tilem'];
        return response()->json($keys);
    }

    public function fetchItems(Request $request)
    {
        $key = $request->query('key');
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
                $items = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
                break;
            case 'Pangelong':
                $items = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
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
                // case 'pancasudha':
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
                // case 'ekajalasri':
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
                $info_piodalan = Cache::remember('info_piodalan_' . $tahun_dicari . '_01_01_' . $tahun_dicari . '_12_31', now()->addDays(365), function() use ($tahun_dicari) {
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
                                $item_piodalan[] = $item;
                                $item_kalender[] = $this->callElemenKalenderBali($item['tanggal'], $item['tanggal']);
                            }
                        }
                    }
                }
                // dd($item_kalender);
                return view('wargabal.layanan.pencarian_piodalan_page', compact('item_piodalan', 'item_kalender', 'pura_dicari', 'bulan_dicari', 'tahun_dicari', 'cari_dengan', 'keterangan'));
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
                $info_piodalan = Cache::remember('info_piodalan_' . $tahun_dicari . '_01_01_' . $tahun_dicari . '_12_31', now()->addDays(365), function() use ($tahun_dicari) {
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
                        $item_kalender[] = Cache::remember('info_elemen_kalender_bali_' . $item['tanggal'] . '_' . $item['tanggal'], now()->addDays(365), function() use ($item) {
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
                $info_piodalan = Cache::remember('info_piodalan_' . $tahun_dicari . '_' . $bulan_dicari . '_01_' . $tahun_dicari . '_' . $bulan_dicari . '_' . date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')), now()->addDays(365), function() use ($tahun_dicari, $bulan_dicari) {
                    return $this->callPiodalan($tahun_dicari . '-' . $bulan_dicari . '-01', $tahun_dicari . '-' . $bulan_dicari . '-' . date('t', strtotime($tahun_dicari . $bulan_dicari . '-01')));
                });

                $item_piodalan = [];
                $item_kalender = [];
                foreach ($info_piodalan as $item) {
                    if ($item['pura'] != "-") {
                        $item_piodalan[] = $item;
                        // $item_kalender[] = $this->callElemenKalenderBali($item['tanggal'], $item['tanggal']);
                        // cache
                        $item_kalender[] = Cache::remember('info_elemen_kalender_bali_' . $item['tanggal'] . '_' . $item['tanggal'], now()->addDays(365), function() use ($item) {
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

    public function callPura()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'lihatPura', [
            'headers' => $headers
        ]);
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
        // dd($request->all());
        $cari_dengan = $request->cari_dengan;
        $keterangan = $this->callKeteranganElemenKalenderBali();

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
                $info_otonan = Cache::remember('info_otonan_' . $tanggal_lahir_dicari . '_' . $tahun_dicari, now()->addDays(365), function() use ($tanggal_lahir_dicari, $tahun_dicari) {
                    return $this->callOtonan($tanggal_lahir_dicari, $tahun_dicari);
                });
                // $info_elemen_kalender_bali = $this->callElemenKalenderBali($tanggal_lahir_dicari, $tanggal_lahir_dicari);
                // cache info_elemen_kalender_bali
                $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_' . $tanggal_lahir_dicari . '_' . $tanggal_lahir_dicari, now()->addDays(365), function() use ($tanggal_lahir_dicari) {
                    return $this->callElemenKalenderBali($tanggal_lahir_dicari, $tanggal_lahir_dicari);
                });

                // $info_otonan_pertama = $this->callElemenKalenderBali($info_otonan['otonan_terdekat_pertama'], $info_otonan['otonan_terdekat_pertama']);
                // cache
                $info_otonan_pertama = Cache::remember('info_elemen_kalender_bali_' . $info_otonan['otonan_terdekat_pertama'] . '_' . $info_otonan['otonan_terdekat_pertama'], now()->addDays(365), function() use ($info_otonan) {
                    return $this->callElemenKalenderBali($info_otonan['otonan_terdekat_pertama'], $info_otonan['otonan_terdekat_pertama']);
                });
                // $info_otonan_kedua = $this->callElemenKalenderBali($info_otonan['otonan_terdekat_kedua'], $info_otonan['otonan_terdekat_kedua']);
                // cache
                $info_otonan_kedua = Cache::remember('info_elemen_kalender_bali_' . $info_otonan['otonan_terdekat_kedua'] . '_' . $info_otonan['otonan_terdekat_kedua'], now()->addDays(365), function() use ($info_otonan) {
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
                $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_' . $tahun_dicari . '_01_01_' . $tahun_dicari + 1 . '_12_31', now()->addDays(365), function() use ($tahun_dicari) {
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

                if ( $tanggal_otonan == null) {
                    $tanggal_otonan = ['-', '-'];

                    $info_otonan_pertama = '-';
                    $info_otonan_kedua = '-';
                } else {
                    // $info_otonan_pertama = $this->callElemenKalenderBali($tanggal_otonan[0], $tanggal_otonan[0]);
                    // cache
                    $info_otonan_pertama = Cache::remember('info_elemen_kalender_bali_' . $tanggal_otonan[0] . '_' . $tanggal_otonan[0], now()->addDays(365), function() use ($tanggal_otonan) {
                        return $this->callElemenKalenderBali($tanggal_otonan[0], $tanggal_otonan[0]);
                    });
                    // $info_otonan_kedua = $this->callElemenKalenderBali($tanggal_otonan[1], $tanggal_otonan[1]);
                    // cache
                    $info_otonan_kedua = Cache::remember('info_elemen_kalender_bali_' . $tanggal_otonan[1] . '_' . $tanggal_otonan[1], now()->addDays(365), function() use ($tanggal_otonan) {
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
            $info_ramalan_sifat = Cache::remember('info_ramalan_sifat_' . $tanggal_lahir_dicari, now()->addDays(365), function() use ($tanggal_lahir_dicari) {
                return $this->callRamalanSifat($tanggal_lahir_dicari);
            });
            // $info_elemen_kalender_bali = $this->callElemenKalenderBali($tanggal_lahir_dicari, $tanggal_lahir_dicari);
            // cache info_elemen_kalender_bali
            $info_elemen_kalender_bali = Cache::remember('info_elemen_kalender_bali_' . $tanggal_lahir_dicari . '_' . $tanggal_lahir_dicari, now()->addDays(365), function() use ($tanggal_lahir_dicari) {
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
        // dd($request->all());
        $keterangan = Cache::remember('keterangan_elemen_kalender_bali', now()->addDays(365), function () {
            $layanan = new LayananController();
            $keterangan = $layanan->callKeteranganElemenKalenderBali();
            return $keterangan;
        });
        
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

            $tanggal_mulai = date('Y-m-01', strtotime($tahun_dicari . '-' . $bulan_dicari . '-01'));
            $tanggal_selesai = date('Y-m-t', strtotime($tahun_dicari . '-' . $bulan_dicari . '-01'));

            $events = array();

            // $info_wariga_personal = $this->callWarigaPersonal($tanggal_mulai, $tanggal_selesai, $tanggal_lahir_dicari);
            // cache info_wariga_personal
            $info_wariga_personal = Cache::remember('info_wariga_personal_' . $tanggal_mulai . '_' . $tanggal_selesai . '_' . $tanggal_lahir_dicari, now()->addDays(365), function() use ($tanggal_mulai, $tanggal_selesai, $tanggal_lahir_dicari) {
                return $this->callWarigaPersonal($tanggal_mulai, $tanggal_selesai, $tanggal_lahir_dicari);
            });
            // $info_elemen_tanggal_lahir = $this->callElemenKalenderBali($tanggal_lahir_dicari, $tanggal_lahir_dicari);
            // cache info_elemen_tanggal_lahir
            $info_elemen_tanggal_lahir = Cache::remember('info_elemen_kalender_bali_' . $tanggal_lahir_dicari . '_' . $tanggal_lahir_dicari, now()->addDays(365), function() use ($tanggal_lahir_dicari) {
                return $this->callElemenKalenderBali($tanggal_lahir_dicari, $tanggal_lahir_dicari);
            });
            // $info_dewasa_tanggal_lahir = $this->callAlaAyuningDewasa($tanggal_lahir_dicari, $tanggal_lahir_dicari);
            // cache info_dewasa_tanggal_lahir
            $info_dewasa_tanggal_lahir = Cache::remember('info_ala_ayuning_dewasa_' . $tanggal_lahir_dicari . '_' . $tanggal_lahir_dicari, now()->addDays(365), function() use ($tanggal_lahir_dicari) {
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

            return view('wargabal.layanan.wariga_calendar', compact('events', 'info_wariga_personal', 'info_elemen_tanggal_lahir', 'info_dewasa_tanggal_lahir', 'tanggal_lahir_dicari', 'bulan_dicari', 'tahun_dicari', 'keterangan'));
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
