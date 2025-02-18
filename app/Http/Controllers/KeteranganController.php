<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KeteranganController extends Controller
{
    protected $url_api = 'https://api2.kalenderbali.web.id/api/';
    // protected $url_api = 'http://localhost:8000/api/';

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

    public function callListPengajuanKeterangan()
    {
        $client = new Client();
        $headers = env('X_API_KEY');
        $pengajuan_keterangan = $client->request('GET', $this->url_api . 'listPengajuanKeterangans', [
            'headers' => [
                'x-api-key' => $headers
            ],
        ]);
        $result = json_decode($pengajuan_keterangan->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function callListPengajuanKeteranganById($id)
    {
        $client = new Client();
        $headers = env('X_API_KEY');
        $pengajuan_keterangan = $client->request('GET', $this->url_api . 'listPengajuanKeterangans/' . $id, [
            'headers' => [
                'x-api-key' => $headers
            ],
        ]);
        $result = json_decode($pengajuan_keterangan->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function editPengajuanKeterangan($request)
    {
        $client = new Client();
        $headers = env('X_API_KEY');
        $edit_pengajuan_keterangan = $client->request('POST', $this->url_api . 'editPengajuanKeterangans', [
            'headers' => [
                'x-api-key' => $headers
            ],
            'form_params' => [
                'id' => $request->id,
                'status_pengajuan' => $request->status_pengajuan,
                'status_keterangan' => $request->status_keterangan,
                'tanggal_validasi' => $request->tanggal_validasi
            ]
        ]);
        
        $result = json_decode($edit_pengajuan_keterangan->getBody()->getContents(), true);
        return $result;
    }

    public function ajukan_edit(Request $request, $id)
    {
        $client = new Client();
        $login_token = session('user');
        $user_id = $login_token['id'];
        $ajukan_edit_keterangan = $client->request('POST', $this->url_api . 'pengajuanKeterangans', [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['token'],
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'user_web_id' => $user_id,
                'key_id' => $request->key_id,
                'key_name' => $request->key_name,
                'item_id' => $request->item_id,
                'item_name' => $request->item_name,
                'keterangan' => $request->keterangan
            ]
        ]);
        
        $result = json_decode($ajukan_edit_keterangan->getBody()->getContents(), true);
        if ($result['pesan'] == 'Sukses') {
            return redirect()->back()->with('success', 'Data keterangan berhasil diajukan! Silahkan lihat status pengajuan edit pada halaman Profile.');
        } else {
            return redirect()->back()->with('error', 'Gagal mengajukan data keterangan!')->withInput();
        }
    }

    public function callKeyKeterangan($param)
    {
        $list_keterangan = $this->callListKeterangan();
        foreach ($list_keterangan as $key => $item) {
            if ($key == $param) {
                return $item;
            }
        }
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
        $info_keterangan = Cache::remember('info_keterangan_ekawara', 60, function () use ($layanan) {
            return $layanan->keteranganEkawara();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_dwiwara', 60, function () use ($layanan) {
            return $layanan->keteranganDwiwara();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_triwara', 60, function () use ($layanan) {
            return $layanan->keteranganTriwara();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_caturwara', 60, function () use ($layanan) {
            return $layanan->keteranganCaturwara();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_pancawara', 60, function () use ($layanan) {
            return $layanan->keteranganPancawara();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_sadwara', 60, function () use ($layanan) {
            return $layanan->keteranganSadwara();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_saptawara', 60, function () use ($layanan) {
            return $layanan->keteranganSaptawara();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_astawara', 60, function () use ($layanan) {
            return $layanan->keteranganAstawara();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_sangawara', 60, function () use ($layanan) {
            return $layanan->keteranganSangawara();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_dasawara', 60, function () use ($layanan) {
            return $layanan->keteranganDasawara();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_ingkel', 60, function () use ($layanan) {
            return $layanan->keteranganIngkel();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_jejepan', 60, function () use ($layanan) {
            return $layanan->keteranganJejepan();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_lintang', 60, function () use ($layanan) {
            return $layanan->keteranganLintang();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_rakam', 60, function () use ($layanan) {
            return $layanan->keteranganRakam();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_watek_madya', 60, function () use ($layanan) {
            return $layanan->keteranganWatekMadya();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_watek_alit', 60, function () use ($layanan) {
            return $layanan->keteranganWatekAlit();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_neptu', 60, function () use ($layanan) {
            return $layanan->keteranganNeptu();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_ekajalarsi', 60, function () use ($layanan) {
            return $layanan->keteranganEkaJalaRsi();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_panca_sudha', 60, function () use ($layanan) {
            return $layanan->keteranganPancaSudha();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_pangarasan', 60, function () use ($layanan) {
            return $layanan->keteranganPangarasan();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_pratiti', 60, function () use ($layanan) {
            return $layanan->keteranganPratiti();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_zodiak', 60, function () use ($layanan) {
            return $layanan->keteranganZodiak();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_wuku', 60, function () use ($layanan) {
            return $layanan->keteranganWuku();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_hari_raya', 60, function () use ($layanan) {
            return $layanan->keteranganHariRaya();
        });

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
        $info_keterangan = Cache::remember('info_keterangan_ala_ayuning_dewasa', 60, function () use ($layanan) {
            return $layanan->keteranganAlaAyuningDewasa();
        });

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
        $admin_controller = new AdminController();
        $key_id = 2;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editAlaAyuningDewasa($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_ala_ayuning_dewasa_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_ala_ayuning_dewasa_page')->with('error', $response['pesan']);
        }
    }

    public function edit_hari_raya(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 1;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editHariRaya($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_hari_raya_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_hari_raya_page')->with('error', $response['pesan']);
        }
    }

    public function edit_ekawara(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 15;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editEkawara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_ekawara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_ekawara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_dwiwara(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 16;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editDwiwara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_dwiwara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_dwiwara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_triwara(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 17;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editTriwara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_triwara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_triwara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_caturwara(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 18;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editCaturwara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_caturwara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_caturwara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_pancawara(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 19;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editPancawara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_pancawara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_pancawara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_sadwara(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 20;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editSadwara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_sadwara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_sadwara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_saptawara(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 21;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editSaptawara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_saptawara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_saptawara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_astawara(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 22;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editAstawara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_astawara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_astawara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_sangawara(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 23;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editSangawara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_sangawara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_sangawara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_dasawara(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 24;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editDasawara($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_dasawara_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_dasawara_page')->with('error', $response['pesan']);
        }
    }

    public function edit_ingkel(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 3;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);

        $response = $this->editIngkel($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_ingkel_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_ingkel_page')->with('error', $response['pesan']);
        }
    }

    public function edit_jejepan(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 4;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editJejepan($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_jejepan_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_jejepan_page')->with('error', $response['pesan']);
        }
    }

    public function edit_lintang(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 5;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editLintang($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_lintang_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_lintang_page')->with('error', $response['pesan']);
        }
    }

    public function edit_rakam(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 8;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editRakam($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_rakam_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_rakam_page')->with('error', $response['pesan']);
        }
    }

    public function edit_watek_madya(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 9;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editWatekMadya($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_watek_madya_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_watek_madya_page')->with('error', $response['pesan']);
        }
    }

    public function edit_watek_alit(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 10;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editWatekAlit($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_watek_alit_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_watek_alit_page')->with('error', $response['pesan']);
        }
    }

    public function edit_neptu(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 11;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editNeptu($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_neptu_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_neptu_page')->with('error', $response['pesan']);
        }
    }

    public function edit_ekajalarsi(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 12;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editEkajalarsi($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_ekajalarsi_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_ekajalarsi_page')->with('error', $response['pesan']);
        }
    }

    public function edit_panca_sudha(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 6;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editPancaSudha($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_panca_sudha_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_panca_sudha_page')->with('error', $response['pesan']);
        }
    }

    public function edit_pangarasan(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 7;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editPangarasan($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_pangarasan_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_pangarasan_page')->with('error', $response['pesan']);
        }
    }

    public function edit_pratiti(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 14;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editPratiti($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_pratiti_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_pratiti_page')->with('error', $response['pesan']);
        }
    }

    public function edit_zodiak(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 13;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
        $response = $this->editZodiak($request, $id);

        if ($response['pesan'] == 'Sukses') {
            return redirect()->route('keterangan_zodiak_page')->with('success', $response['pesan']);
        } else {
            return redirect()->route('keterangan_zodiak_page')->with('error', $response['pesan']);
        }
    }

    public function edit_wuku(Request $request, $id)
    {
        $admin_controller = new AdminController();
        $key_id = 25;
        $admin_controller->edit_pengajuan_by_admin($request, $key_id);
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
        Cache::forget('info_keterangan_ala_ayuning_dewasa');

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
        Cache::forget('info_keterangan_hari_raya');

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
        Cache::forget('info_keterangan_ekawara');

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
        Cache::forget('info_keterangan_dwiwara');

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
        Cache::forget('info_keterangan_triwara');

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
        Cache::forget('info_keterangan_caturwara');

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
        Cache::forget('info_keterangan_pancawara');

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
        Cache::forget('info_keterangan_sadwara');

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
        Cache::forget('info_keterangan_saptawara');

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
        Cache::forget('info_keterangan_astawara');

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
        Cache::forget('info_keterangan_sangawara');

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
        Cache::forget('info_keterangan_dasawara');

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
        Cache::forget('info_keterangan_ingkel');

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
        Cache::forget('info_keterangan_jejepan');

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
        Cache::forget('info_keterangan_lintang');

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
        Cache::forget('info_keterangan_rakam');

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
        Cache::forget('info_keterangan_watek_madya');

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
        Cache::forget('info_keterangan_watek_alit');

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
        Cache::forget('info_keterangan_neptu');

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
        Cache::forget('info_keterangan_ekajalarsi');

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
        Cache::forget('info_keterangan_panca_sudha');

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
        Cache::forget('info_keterangan_pangarasan');

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
        Cache::forget('info_keterangan_pratiti');

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
        Cache::forget('info_keterangan_zodiak');

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
        Cache::forget('info_keterangan_wuku');

        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }
    
}
