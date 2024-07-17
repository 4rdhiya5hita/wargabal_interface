<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $url_web = "https://api.kalenderbali.web.id/api/";

    public function profile()
    {
        $user = session('user');
        return view('wargabal.auth.profile', compact('user'));
    }

    public function manajemen_user_page()
    {
        // dd(session('user'));
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
        // dd($daftar_user);

        return view('wargabal.auth.manajemen_user', compact('daftar_user'));
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

        return view('wargabal.auth.pengajuan_kontribusi_page', compact('daftar_pengajuan_kontribusi'));
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
            return redirect()->back()->with('success', 'Kontribusi berhasil diajukan!');
        } else {
            return redirect()->back()->with('error', 'Gagal mengajukan kontribusi!')->withInput();
        }
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

    public function manajemen_info_kita_page()
    {
        return view('wargabal.auth.manajemen_info_kita');
    }

    public function info_kita_page()
    {
        $get_info_kita = $this->fetch_info_kita();
        $info_kita = json_decode($get_info_kita->getContent(), true);

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

        return view('wargabal.auth.info_kita', compact('info_kita', 'info_zodiak', 'month', 'info_ramalan_sifat', 'hari_ini'));
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

        return view('wargabal.auth.info_kita_detail', compact('info_kita_detail', 'info_kita'));
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

        return view('wargabal.auth.detail_info_kita', compact('info_kita'));
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

    public function hasPermission($permission)
    {
        $user = session('user');
        if ($user && isset($user['permission'])) {
            return $user['permission'] == $permission;
        }
        return false;
    }
}
