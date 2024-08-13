<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $url_web = "https://api.kalenderbali.web.id/api/";
    protected $url_api = 'https://api2.kalenderbali.web.id/api/';
    // protected $url_api = "http://localhost:8000/api/";


    public function profile()
    {
        $user = session('user');
        $keterangan_controller = new KeteranganController();
        $list_pengajuan_keterangan = $keterangan_controller->callListPengajuanKeterangan();
        $info_pengajuan_keterangan = [];

        foreach ($list_pengajuan_keterangan as $key => $pengajuan_keterangan) {
            if ($pengajuan_keterangan['user_web_id'] == $user['id']) {
                $info_pengajuan_keterangan[] = $pengajuan_keterangan;
            }
        }
        $info_pengajuan_keterangan = array_reverse($info_pengajuan_keterangan);
        
        return view('wargabal.auth.profile', compact('user', 'info_pengajuan_keterangan'));
    }

    public function callListUser()
    {
        $client = new Client();
        $auth_controller = new AuthenticationController();
        $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');

        $daftar_user = [];
        $permission = ['Guest', 'Member'];
        foreach ($permission as $per) {
            $get_all_user = $client->request('GET', $this->url_web . 'users?permission=' . $per, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $login_token['data']['token'],
                    'Accept' => 'application/json',
                ],
            ]);

            $data_user = json_decode($get_all_user->getBody()->getContents(), true);
            foreach ($data_user['data']['users'] as $user) {
                $daftar_user[] = $user;
            }
        }

        return $daftar_user;
    }

    public function manajemen_user_page()
    {
        $daftar_user = $this->callListUser();

        return view('wargabal.admin.manajemen_user', compact('daftar_user'));
    }

    public function edit_permission(Request $request)
    {
        $client = new Client();
        $auth_controller = new AuthenticationController();
        $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');

        $edit_permission = $client->request('POST', $this->url_web . 'users/change-permission/' . $request['id'], [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['data']['token'],
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'permission' => $request['permission'],
            ]
        ]);

        $result = json_decode($edit_permission->getBody()->getContents(), true);
        if ($result['success'] == true) {
            return redirect()->back()->with('success', 'Hak akses berhasil diubah!');
        } else {
            return redirect()->back()->with('error', 'Gagal mengubah hak akses!')->withInput();
        }
    }

    public function edit_contribution_status(Request $request)
    {
        $client = new Client();
        $auth_controller = new AuthenticationController();
        $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');

        $edit_contribution_status = $client->request('POST', $this->url_web . 'users/change-contribution-status/' . $request['id'], [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['data']['token'],
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'contribution_status' => $request['contribution_status'],
            ]
        ]);

        $result = json_decode($edit_contribution_status->getBody()->getContents(), true);
        if ($result['success'] == true) {
            return redirect()->back()->with('success', 'Status kontribusi berhasil diubah!');
        } else {
            return redirect()->back()->with('error', 'Gagal mengubah status kontribusi!')->withInput();
        }
    }

    public function pengajuan_kontribusi_page()
    {
        $client = new Client();
        $auth_controller = new AuthenticationController();
        $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');

        $daftar_pengajuan_kontribusi = [];
        $permission = ['Guest', 'Member'];
        foreach ($permission as $per) {
            $get_all_user = $client->request('GET', $this->url_web . 'users?permission=' . $per, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $login_token['data']['token'],
                    'Accept' => 'application/json',
                ],
            ]);

            $data_user = json_decode($get_all_user->getBody()->getContents(), true);
            foreach ($data_user['data']['users'] as $user) {
                if ($user['contribution_desc'] != null) {
                    $daftar_pengajuan_kontribusi[] = $user;
                }
            }
        }

        return view('wargabal.admin.pengajuan_kontribusi_page', compact('daftar_pengajuan_kontribusi'));
    }

    public function ajukan_kontribusi(Request $request)
    {
        $client = new Client();
        $login_token = session('user');
        $add_contribution_desc = $client->request('POST', $this->url_web . 'users/add-contribution-desc', [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['token'],
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'contribution_desc' => $request['kontribusi'],
            ]
        ]);
        
        $result = json_decode($add_contribution_desc->getBody()->getContents(), true);
        if ($result['success'] == true) {
            return redirect()->back()->with('success', 'Kontribusi berhasil diajukan! Silahkan lihat status kontribusi pada halaman Profile.');
        } else {
            return redirect()->back()->with('error', 'Gagal mengajukan kontribusi!')->withInput();
        }
    }
    
    public function pengajuan_edit_keterangan_page()
    {
        $keterangan_controller = new KeteranganController();
        $daftar_pengajuan_keterangan = $keterangan_controller->callListPengajuanKeterangan();
        $daftar_user = $this->callListUser();
        $list_keterangan = $keterangan_controller->callListKeterangan();

        return view('wargabal.admin.pengajuan_edit_keterangan_page', compact('daftar_pengajuan_keterangan', 'daftar_user', 'list_keterangan'));
    }

    public function edit_pengajuan_keterangan(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'key_id' => 'required',
            'item_id' => 'required',
            'status_pengajuan' => 'required',
            'status_keterangan' => 'required'
        ]);
        $tanggal_validasi = date('Y-m-d H:i:s');
        $request['tanggal_validasi'] = $tanggal_validasi;

        if ($validated) {
            $keterangan_controller = new KeteranganController();
            $edit_pengajuan_keterangan = $keterangan_controller->editPengajuanKeterangan($request);
            $request['nama'] = $edit_pengajuan_keterangan['data']['key_name'];
            $request['keterangan'] = $edit_pengajuan_keterangan['data']['keterangan'];
            
            if ($edit_pengajuan_keterangan['status_keterangan_berubah'] == true) {
                $edit_keterangan = $this->edit_keterangan_berubah($request);

                if ($edit_keterangan['pesan'] == 'Sukses') {
                    return redirect()->back()->with('success', 'Status pengajuan berhasil diubah! Keterangan elemen berhasil diperbarui!');
                } else {
                    return redirect()->back()->with('error', 'Gagal mengubah status pengajuan dan keterangan!')->withInput();
                }

            } else {
                if ($edit_pengajuan_keterangan['pesan'] == 'Sukses') {
                    return redirect()->back()->with('success', 'Status pengajuan berhasil diubah!');
                } else {
                    return redirect()->back()->with('error', 'Gagal mengubah status pengajuan!')->withInput();
                }
            }
        }
    }

    public function edit_keterangan_berubah($request)
    {
        $keterangan_controller = new KeteranganController();
        
        if ($request['key_id'] == 1) {
            $edit_keterangan = $keterangan_controller->editHariRaya($request, $request['item_id']);
        } elseif ($request['key_id'] == 2) {
            $edit_keterangan = $keterangan_controller->editAlaAyuningDewasa($request, $request['item_id']);
        } elseif ($request['key_id'] == 3) {
            $edit_keterangan = $keterangan_controller->editIngkel($request, $request['item_id']);
        } elseif ($request['key_id'] == 4) {
            $edit_keterangan = $keterangan_controller->editJejepan($request, $request['item_id']);
        } elseif ($request['key_id'] == 5) {
            $edit_keterangan = $keterangan_controller->editLintang($request, $request['item_id']);
        } elseif ($request['key_id'] == 6) {
            $edit_keterangan = $keterangan_controller->editPancaSudha($request, $request['item_id']);
        } elseif ($request['key_id'] == 7) {
            $edit_keterangan = $keterangan_controller->editPangarasan($request, $request['item_id']);
        } elseif ($request['key_id'] == 8) {
            $edit_keterangan = $keterangan_controller->editRakam($request, $request['item_id']);
        } elseif ($request['key_id'] == 9) {
            $edit_keterangan = $keterangan_controller->editWatekMadya($request, $request['item_id']);
        } elseif ($request['key_id'] == 10) {
            $edit_keterangan = $keterangan_controller->editWatekAlit($request, $request['item_id']);
        } elseif ($request['key_id'] == 11) {
            $edit_keterangan = $keterangan_controller->editNeptu($request, $request['item_id']);
        } elseif ($request['key_id'] == 12) {
            $edit_keterangan = $keterangan_controller->editEkajalarsi($request, $request['item_id']);
        } elseif ($request['key_id'] == 13) {
            $edit_keterangan = $keterangan_controller->editZodiak($request, $request['item_id']);
        } elseif ($request['key_id'] == 14) {
            $edit_keterangan = $keterangan_controller->editPratiti($request, $request['item_id']);
        } elseif ($request['key_id'] == 15) {
            $edit_keterangan = $keterangan_controller->editEkawara($request, $request['item_id']);
        } elseif ($request['key_id'] == 16) {
            $edit_keterangan = $keterangan_controller->editDwiwara($request, $request['item_id']);
        } elseif ($request['key_id'] == 17) {
            $edit_keterangan = $keterangan_controller->editTriwara($request, $request['item_id']);
        } elseif ($request['key_id'] == 18) {
            $edit_keterangan = $keterangan_controller->editCaturwara($request, $request['item_id']);
        } elseif ($request['key_id'] == 19) {
            $edit_keterangan = $keterangan_controller->editPancawara($request, $request['item_id']);
        } elseif ($request['key_id'] == 20) {
            $edit_keterangan = $keterangan_controller->editSadwara($request, $request['item_id']);
        } elseif ($request['key_id'] == 21) {
            $edit_keterangan = $keterangan_controller->editSaptawara($request, $request['item_id']);
        } elseif ($request['key_id'] == 22) {
            $edit_keterangan = $keterangan_controller->editAstawara($request, $request['item_id']);
        } elseif ($request['key_id'] == 23) {
            $edit_keterangan = $keterangan_controller->editSangawara($request, $request['item_id']);
        } elseif ($request['key_id'] == 24) {
            $edit_keterangan = $keterangan_controller->editDasawara($request, $request['item_id']);
        } elseif ($request['key_id'] == 25) {
            $edit_keterangan = $keterangan_controller->editWuku($request, $request['item_id']);
        }

        return $edit_keterangan;
    }

    public function fetch_contribution()
    {
        $client = new Client();
        $user = session('user');
        $get_contribution = $client->request('GET', $this->url_web . 'my-user', [
            'headers' => [
                'Authorization' => 'Bearer ' . $user['token'],
                'Accept' => 'application/json',
            ],
        ]);

        $result = json_decode($get_contribution->getBody()->getContents(), true);
        return response()->json($result);
    }

    public function manajemen_pura_user_page()
    {
        $daftar_pura_user = $this->callListPuraUser();
        $daftar_user = $this->callListUser();
        $layananController = new LayananController();
        $daftar_pura = $layananController->callPura();

        return view('wargabal.admin.manajemen_pura_user', compact('daftar_pura_user', 'daftar_user', 'daftar_pura'));
    }

    public function callListPuraUser()
    {
        $client = new Client();
        $auth_controller = new AuthenticationController();
        $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');

        $get_all_user = $client->request('GET', $this->url_web . 'pura-users', [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['data']['token'],
                'Accept' => 'application/json',
            ],
        ]);
        
        $data_user = json_decode($get_all_user->getBody()->getContents(), true);
        $daftar_user = $data_user['data'];

        return $daftar_user;
    }

    public function fetch_pura_user()
    {
        $get_pura_user = $this->callListPuraUser();
        $get_user = $this->callListUser();
        $daftar_pura_user = [];

        foreach ($get_pura_user as $pura_user) {
            foreach ($get_user as $user) {
                if ($pura_user['user_id'] == $user['id']) {
                    $pura_user['user'] = $user;
                    $daftar_pura_user[] = $pura_user;
                }
            }
        }

        return response()->json($daftar_pura_user);
    }

    public function create_pura_user(Request $request)
    {
        $client = new Client();
        $user = session('user');
        $create_pura_user = $client->request('POST', $this->url_web . 'pura-users', [
            'headers' => [
                'Authorization' => 'Bearer ' . $user['token'],
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'user_id' => $request['user_id'],
                'pura_id' => $request['pura_id'],
            ]
        ]);

        $result = json_decode($create_pura_user->getBody()->getContents(), true);
        if ($result['success'] == true) {
            return redirect()->back()->with('success', 'Pura user berhasil dibuat!');
        } else {
            return redirect()->back()->with('error', 'Gagal dibuat pura user!')->withInput();
        }
    }

    public function edit_pura_user(Request $request)
    {
        $client = new Client();
        $user = session('user');
        $edit_pura_user = $client->request('POST', $this->url_web . 'pura-users/' . $request['id'] . '?_method=PUT', [
            'headers' => [
                'Authorization' => 'Bearer ' . $user['token'],
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'user_id' => $request['user_id'],
                'pura_id' => $request['pura_id'],
            ]
        ]);

        $result = json_decode($edit_pura_user->getBody()->getContents(), true);
        if ($result['success'] == true) {
            return redirect()->back()->with('success', 'Pura user berhasil diubah!');
        } else {
            return redirect()->back()->with('error', 'Gagal mengubah pura user!')->withInput();
        }
    }

    public function delete_pura_user(Request $request)
    {
        $client = new Client();
        $user = session('user');
        $delete_pura_user = $client->request('DELETE', $this->url_web . 'pura-users/' . $request['id'], [
            'headers' => [
                'Authorization' => 'Bearer ' . $user['token'],
                'Accept' => 'application/json',
            ],
        ]);

        $result = json_decode($delete_pura_user->getBody()->getContents(), true);
        if ($result['success'] == true) {
            return redirect()->back()->with('success', 'Pura user berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus pura user!')->withInput();
        }
        return;
    }

    public function manajemen_info_kita_page()
    {
        return view('wargabal.admin.manajemen_info_kita');
    }

    public function info_kita_page()
    {
        $get_info_kita = $this->fetch_info_kita();
        $info_kita = json_decode($get_info_kita->getContent(), true);

        $today = date('Y-m-d');
        foreach ($info_kita as $key => $info) {
            if ($today < $info['show_at_home_page_from'] || $today > $info['show_at_home_page_until']) {
                unset($info_kita[$key]); // hapus array yang tidak ditampilkan
            }
        }
        $info_kita = array_values($info_kita);
        $info_kita = array_reverse($info_kita);

        // zodiak
        $month = date('n');
        $fakeRequest = Request::create('/fetch-zodiak', 'GET', ['month' => $month]);

        $calendarController = new CalendarController();
        $response = $calendarController->fetchZodiak($fakeRequest);
        $get_info_zodiak = json_decode($response->getContent(), true);
        $info_zodiak = $get_info_zodiak[0];        

        // ramalah sifat
        $today = date('Y-m-d');
        // ubah $today menjadi Selasa, 1 Juni 2021
        $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $hari_ini = $hari[date('w', strtotime($today))] . ', ' . date('j', strtotime($today)) . ' ' . $bulan[date('n', strtotime($today)) - 1] . ' ' . date('Y', strtotime($today));

        $layananController = new LayananController();
        $info_ramalan_sifat = $layananController->callRamalanSifat($today);

        return view('wargabal.info_kita.info_kita', compact('info_kita', 'info_zodiak', 'month', 'info_ramalan_sifat', 'hari_ini'));
    }

    public function info_kita_detail_page($id)
    {
        $get_info_kita = $this->fetch_info_kita();
        $info_kita = json_decode($get_info_kita->getContent(), true);

        foreach ($info_kita as $info) {
            if ($info['id'] == $id) {
                $info_kita_detail = $info;
            }
        }
        // dd($info_kita_detail);

        return view('wargabal.info_kita.info_kita_detail', compact('info_kita_detail', 'info_kita'));
    }

    public function fetch_info_kita()
    {
        $client = new Client();
        $result = $client->request('GET', $this->url_web . 'infos');
        $get_info_kita = json_decode($result->getBody()->getContents(), true);
        $info_kita = $get_info_kita['data'];

        return response()->json($info_kita);
    }

    public function create_info_kita(Request $request)
    {
        $client = new Client();
        $user = session('user');

        $multipart = [
            [
                'name'     => 'title',
                'contents' => $request->input('title')
            ],
            [
                'name'     => 'content',
                'contents' => $request->input('content')
            ],
            [
                'name'     => 'show_at_home_page_from',
                'contents' => $request->input('show_at_home_page_from')
            ],
            [
                'name'     => 'show_at_home_page_until',
                'contents' => $request->input('show_at_home_page_until')
            ]
        ];

        // Check if image is not null
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $multipart[] = [
                'name'     => 'image',
                'contents' => fopen($request->file('image')->getPathname(), 'r'),
                'filename' => $request->file('image')->getClientOriginalName()
            ];
        }

        $create_info_kita = $client->request('POST', $this->url_web . 'infos', [
            'headers' => [
                'Authorization' => 'Bearer ' . $user['token'],
                'Accept' => 'application/json',
            ],
            'multipart' => $multipart
        ]);

        $result = json_decode($create_info_kita->getBody()->getContents(), true);
        if ($result['success'] == true) {
            return redirect()->back()->with('success', 'Info berhasil dibuat!');
        } else {
            return redirect()->back()->with('error', 'Gagal dibuat info!')->withInput();
        }
    }

    public function detail_info_kita($id)
    {
        $client = new Client();
        $result = $client->request('GET', $this->url_web . 'infos/');
        $get_info_kita = json_decode($result->getBody()->getContents(), true);
        $info_kita = $get_info_kita['data'];

        return view('wargabal.info_kita.detail_info_kita', compact('info_kita'));
    }

    public function edit_info_kita(Request $request)
    {
        $client = new Client();
        $user = session('user');

        $multipart = [
            [
                'name'     => 'title',
                'contents' => $request->input('title')
            ],
            [
                'name'     => 'content',
                'contents' => $request->input('content')
            ],
            [
                'name'     => 'show_at_home_page_from',
                'contents' => $request->input('show_at_home_page_from')
            ],
            [
                'name'     => 'show_at_home_page_until',
                'contents' => $request->input('show_at_home_page_until')
            ]
        ];
        
        // Check if image is not null
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $multipart[] = [
                'name'     => 'image',
                'contents' => fopen($request->file('image')->getPathname(), 'r'),
                'filename' => $request->file('image')->getClientOriginalName()
            ];
        }

        $edit_info_kita = $client->request('POST', $this->url_web . 'infos/' . $request['id'] . '?_method=PUT', [
            'headers' => [
                'Authorization' => 'Bearer ' . $user['token'],
                'Accept' => 'application/json',
            ],
            'multipart' => $multipart
        ]);

        $result = json_decode($edit_info_kita->getBody()->getContents(), true);
        if ($result['success'] == true) {
            return redirect()->back()->with('success', 'Info berhasil diubah!');
        } else {
            return redirect()->back()->with('error', 'Gagal mengubah info!')->withInput();
        }
    }

    public function delete_info_kita(Request $request)
    {
        $client = new Client();
        $user = session('user');
        $delete_info_kita = $client->request('DELETE', $this->url_web . 'infos/' . $request['id'], [
            'headers' => [
                'Authorization' => 'Bearer ' . $user['token'],
                'Accept' => 'application/json',
            ],
        ]);

        $result = json_decode($delete_info_kita->getBody()->getContents(), true);
        if ($result['success'] == true) {
            return redirect()->back()->with('success', 'Info berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus info!')->withInput();
        }
        return;
    }

    public function transaksi_user_page()
    {
        $client = new Client();
        $auth_controller = new AuthenticationController();
        $login_token = $auth_controller->login_api('super@gmail.com', 'strKtJn:*7');

        $get_all_user = $client->request('GET', $this->url_web . 'purchases', [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['data']['token'],
                'Accept' => 'application/json',
            ],
        ]);

        $data_transaksi_user = json_decode($get_all_user->getBody()->getContents(), true);
        $daftar_transaksi_user = $data_transaksi_user['data'];
        $daftar_transaksi_user = array_reverse($daftar_transaksi_user);

        return view('wargabal.admin.transaksi_user', compact('daftar_transaksi_user'));
    }

    public function hasPermission($permission)
    {
        $user = session('user');
        if ($user && isset($user['permission'])) {
            return $user['permission'] == $permission;
        }
        return false;
    }
}
