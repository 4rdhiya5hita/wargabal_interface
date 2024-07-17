<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class KeteranganController extends Controller
{
    // protected $url_api = 'https://api2.kalenderbali.web.id/api/';
    protected $url_api = 'http://localhost:8000/api/';


    public function keterangan_page()
    {
        // dd(session()->all());
        // dd(session('user')['permission']);
        // $keteranganElemenKalenderBali = $layanan->callKeteranganElemenKalenderBali();
        // $keteranganHariRaya = $layanan->keteranganHariRaya();
        // $keteranganAlaAyuningDewasa = $layanan->keteranganAlaAyuningDewasa();
        $keterangan = [
            'elemen_kalender_bali' => [
                'ingkel', 'jejepan', 'lintang', 'rakam', 'watek_madya', 'watek_alit',
                'ekajalarsi', 'panca_sudha', 'pangarasan', 'pratiti', 'zodiak', 'wuku'
            ],
            'wewaran' => [
                'ekawara', 'dwiwara', 'triwara', 'caturwara', 'pancawara', 'sadwara',
                'saptawara', 'astawara', 'sangawara', 'dasawara'
            ],
            'hari_raya' => [
                'hari_raya'
            ],
            'ala_ayuning_dewasa' => [
                'ala_ayuning_dewasa'
            ]
        ];

        return view('wargabal.keterangan.keterangan_page', compact('keterangan'));
    }

    public function keterangan_ekawara_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Ekawara') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganEkawara();

        return view('wargabal.keterangan.keterangan_ekawara_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_dwiwara_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Dwiwara') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganDwiwara();

        return view('wargabal.keterangan.keterangan_dwiwara_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_triwara_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Triwara') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganTriwara();

        return view('wargabal.keterangan.keterangan_triwara_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_caturwara_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Caturwara') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganCaturwara();

        return view('wargabal.keterangan.keterangan_caturwara_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_pancawara_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Pancawara') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganPancawara();

        return view('wargabal.keterangan.keterangan_pancawara_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_sadwara_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Sadwara') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganSadwara();

        return view('wargabal.keterangan.keterangan_sadwara_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_saptawara_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Saptawara') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganSaptawara();

        return view('wargabal.keterangan.keterangan_saptawara_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_astawara_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Astawara') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganAstawara();

        return view('wargabal.keterangan.keterangan_astawara_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_sangawara_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Sangawara') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganSangawara();

        return view('wargabal.keterangan.keterangan_sangawara_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_dasawara_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Dasawara') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganDasawara();

        return view('wargabal.keterangan.keterangan_dasawara_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_ingkel_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Ingkel') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganIngkel();

        return view('wargabal.keterangan.keterangan_ingkel_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_jejepan_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Jejepan') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganJejepan();

        return view('wargabal.keterangan.keterangan_jejepan_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_lintang_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Lintang') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganLintang();

        return view('wargabal.keterangan.keterangan_lintang_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_rakam_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Rakam') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganRakam();

        return view('wargabal.keterangan.keterangan_rakam_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_watek_madya_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Watek Madya') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganWatekMadya();

        return view('wargabal.keterangan.keterangan_watek_madya_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_watek_alit_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Watek Alit') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganWatekAlit();

        return view('wargabal.keterangan.keterangan_watek_alit_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_neptu_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Neptu') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganNeptu();

        return view('wargabal.keterangan.keterangan_neptu_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_ekajalarsi_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Ekajalarsi') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganEkaJalaRsi();

        return view('wargabal.keterangan.keterangan_ekajalarsi_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_panca_sudha_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Panca Sudha') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganPancaSudha();

        return view('wargabal.keterangan.keterangan_panca_sudha_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_pangarasan_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Pangarasan') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganPangarasan();

        return view('wargabal.keterangan.keterangan_pangarasan_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_pratiti_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Pratiti') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganPratiti();

        return view('wargabal.keterangan.keterangan_pratiti_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_zodiak_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Zodiak') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganZodiak();

        return view('wargabal.keterangan.keterangan_zodiak_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_wuku_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Wuku') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganWuku();

        return view('wargabal.keterangan.keterangan_wuku_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_hari_raya_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Hari Raya') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganHariRaya();

        return view('wargabal.keterangan.keterangan_hari_raya_page', compact('keterangan', 'info_keterangan'));
    }

    public function keterangan_ala_ayuning_dewasa_page()
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($item['nama'] == 'Ala Ayuning Dewasa') {
                $keterangan = $item;
            }
        }

        $layanan = new LayananController();
        $info_keterangan = $layanan->keteranganAlaAyuningDewasa();

        return view('wargabal.keterangan.keterangan_ala_ayuning_dewasa_page', compact('keterangan', 'info_keterangan'));
    }

    public function callListKeterangan()
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('GET', $this->url_api . 'listKeterangan', [
            'headers' => $headers
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }



    // EDIT KETERANGAN
    public function edit_ala_ayuning_dewasa(Request $request, $id)
    {
        $response = $this->editAlaAyuningDewasa($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_ala_ayuning_dewasa_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_ala_ayuning_dewasa_page')->with('error', $response['pesan']);
        }
    }

    public function edit_hari_raya(Request $request, $id)
    {
        $response = $this->editHariRaya($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_hari_raya_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_hari_raya_page')->with('error', $response['pesan']);
        }
    }

    public function edit_ekawara(Request $request, $id)
    {
        $response = $this->editEkawara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_ekawara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_ekawara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_dwiwara(Request $request, $id)
    {
        $response = $this->editDwiwara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_dwiwara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_dwiwara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_triwara(Request $request, $id)
    {
        $response = $this->editTriwara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_triwara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_triwara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_caturwara(Request $request, $id)
    {
        $response = $this->editCaturwara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_caturwara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_caturwara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_pancawara(Request $request, $id)
    {
        $response = $this->editPancawara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_pancawara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_pancawara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_sadwara(Request $request, $id)
    {
        $response = $this->editSadwara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_sadwara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_sadwara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_saptawara(Request $request, $id)
    {
        $response = $this->editSaptawara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_saptawara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_saptawara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_astawara(Request $request, $id)
    {
        $response = $this->editAstawara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_astawara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_astawara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_sangawara(Request $request, $id)
    {
        $response = $this->editSangawara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_sangawara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_sangawara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_dasawara(Request $request, $id)
    {
        $response = $this->editDasawara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_dasawara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_dasawara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_ingkel(Request $request, $id)
    {
        $response = $this->editIngkel($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_ingkel_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_ingkel_page')->with('error', $response['pesan']);
        }
    }

    public function edit_jejepan(Request $request, $id)
    {
        $response = $this->editJejepan($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_jejepan_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_jejepan_page')->with('error', $response['pesan']);
        }
    }

    public function edit_lintang(Request $request, $id)
    {
        $response = $this->editLintang($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_lintang_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_lintang_page')->with('error', $response['pesan']);
        }
    }

    public function edit_rakam(Request $request, $id)
    {
        $response = $this->editRakam($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_rakam_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_rakam_page')->with('error', $response['pesan']);
        }
    }

    public function edit_watek_madya(Request $request, $id)
    {
        $response = $this->editWatekMadya($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_watek_madya_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_watek_madya_page')->with('error', $response['pesan']);
        }
    }

    public function edit_watek_alit(Request $request, $id)
    {
        $response = $this->editWatekAlit($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_watek_alit_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_watek_alit_page')->with('error', $response['pesan']);
        }
    }

    public function edit_neptu(Request $request, $id)
    {
        $response = $this->editNeptu($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_neptu_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_neptu_page')->with('error', $response['pesan']);
        }
    }

    public function edit_ekajalarsi(Request $request, $id)
    {
        $response = $this->editEkajalarsi($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_ekajalarsi_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_ekajalarsi_page')->with('error', $response['pesan']);
        }
    }

    public function edit_panca_sudha(Request $request, $id)
    {
        $response = $this->editPancaSudha($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_panca_sudha_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_panca_sudha_page')->with('error', $response['pesan']);
        }
    }

    public function edit_pangarasan(Request $request, $id)
    {
        $response = $this->editPangarasan($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_pangarasan_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_pangarasan_page')->with('error', $response['pesan']);
        }
    }

    public function edit_pratiti(Request $request, $id)
    {
        $response = $this->editPratiti($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_pratiti_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_pratiti_page')->with('error', $response['pesan']);
        }
    }

    public function edit_zodiak(Request $request, $id)
    {
        $response = $this->editZodiak($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_zodiak_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_zodiak_page')->with('error', $response['pesan']);
        }
    }

    public function edit_wuku(Request $request, $id)
    {
        $response = $this->editWuku($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_wuku_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_wuku_page')->with('error', $response['pesan']);
        }
    }

    public function editAlaAyuningDewasa(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editAlaAyuningDewasa', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editHariRaya(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editHariRaya', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editEkawara(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editEkawara', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editDwiwara(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editDwiwara', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editTriwara(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editTriwara', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editCaturwara(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editCaturwara', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editPancawara(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editPancawara', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editSadwara(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editSadwara', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editSaptawara(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editSaptawara', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editAstawara(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editAstawara', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editSangawara(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editSangawara', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editDasawara(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editDasawara', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editIngkel(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editIngkel', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editJejepan(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editJejepan', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editLintang(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editLintang', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editRakam(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editRakam', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editWatekMadya(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editWatekMadya', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editWatekAlit(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editWatekAlit', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'nama' => $request->nama,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editNeptu(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editNeptu', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'neptu' => $request->neptu,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editEkajalarsi(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editEkajalarsi', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'ekajalarsi' => $request->ekajalarsi,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editPancaSudha(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editPancaSudha', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'panca_sudha' => $request->panca_sudha,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editPangarasan(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editPangarasan', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'pangarasan' => $request->pangarasan,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editPratiti(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editPratiti', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'pratiti' => $request->pratiti,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editZodiak(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editZodiak', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'zodiak' => $request->zodiak,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }

    public function editWuku(Request $request, $id)
    {
        $client = new Client();
        $headers = ['x-api-key' => env('X_API_KEY')];
        $response = $client->request('POST', $this->url_api . 'editWuku', [
            'headers' => $headers,
            'form_params' => [
                'id' => $id,
                'wuku' => $request->wuku,
                'keterangan' => $request->keterangan
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }
    
}
