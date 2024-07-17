<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    protected $url_web = "https://api.kalenderbali.web.id/api/";

    public function register_page()
    {
        return view('wargabal.auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|digits_between:10,13',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password|min:8',
        ]);
        // dd($validator->errors()->all());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // Lakukan login ke API eksternal untuk mendapatkan token
            $client = new Client();
            $login_token = $this->login_api('super@gmail.com', 'strKtJn:*7');

            // Cek apakah email sudah terdaftar
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
                    if ($user['email'] == $request['email']) {
                        return redirect()->back()->with('error', 'Email sudah terdaftar!')->withInput();
                    }
                }
            }

            // Lakukan pendaftaran ke API eksternal
            $register_api = $client->request('POST', $this->url_web . 'register', [
                'form_params' => [
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'phone' => $request['phone'],
                    'password' => $request['password'],
                    'c_password' => $request['password_confirmation'],
                ],
            ]);

            $result = json_decode($register_api->getBody()->getContents(), true);

            // Simpan pengguna dalam sesi
            $user = $result['data'];
            session(['user' => $user]);

            return redirect()->route('konfirmasi_email')->with('success', 'register');
        }
    }

    public function konfirmasi_email()
    {
        if (session('success') == 'register') {
            // dd('register');
            $message = 'Berhasil register!';
            $toast = true;
            return view('wargabal.auth.konfirmasi_email', compact('message', 'toast'));
        } elseif (session('success') == 'verifikasi_email') {
            // dd('verifikasi_email');
            $message = 'Email verifikasi berhasil dikirim ulang!';
            $toast = true;
            return view('wargabal.auth.konfirmasi_email', compact('message', 'toast'));
        } else {
            $message = '';
            $toast = false;
            return view('wargabal.auth.konfirmasi_email', compact('message', 'toast'));
        }
    }

    public function konfirmasi_email_page()
    {
        return view('wargabal.auth.konfirmasi_email');
    }

    public function verifikasi_ulang_email(Request $request)
    {
        // dd($request->all());
        $client = new Client();
        $login_token = $this->login_api($request['email'], $request['password']);

        // Kirim email konfirmasi
        $send_email = $client->request('POST', $this->url_web . 'email/verify/resend', [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['data']['token'],
                'Accept' => 'application/json',
            ],
        ]);

        $result = json_decode($send_email->getBody()->getContents(), true);
        if ($result['success'] == true) {
            return redirect()->route('konfirmasi_email')->with('success', 'verifikasi_email');
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim email konfirmasi!')->withInput();
        }
    }

    public function login_page()
    {
        // dd(session()->all());
        return view('wargabal.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            // session()->flush();
            // dd(session()->all());

            try {
                $client = new Client();
                $result = $this->login_api($request['email'], $request['password']);

                if ($result['data']['permission'] == 'Admin') {
                    $login_token = $result['data'];
                    $get_my_user = $client->request('GET', $this->url_web . 'my-user', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $login_token['token'],
                            'Accept' => 'application/json',
                        ],
                    ]);

                    $user = json_decode($get_my_user->getBody()->getContents(), true);
                    // tambahkan $result['data']['token'] ke dalam $user
                    $user['token'] = $login_token['token'];
                    session(['user' => $user]);

                    return redirect()->route('index')->with('success', 'login');
                } else {
                    if ($result['data']['email_verified_at'] == null) {
                        return redirect()->back()->with('error', 'Email belum terverifikasi!')->withInput();
                    } else {
                        $login_token = $result['data'];
                        $get_my_user = $client->request('GET', $this->url_web . 'my-user', [
                            'headers' => [
                                'Authorization' => 'Bearer ' . $login_token['token'],
                                'Accept' => 'application/json',
                            ],
                        ]);

                        $user = json_decode($get_my_user->getBody()->getContents(), true);
                        // tambahkan $result['data']['token'] ke dalam $user
                        $user['token'] = $login_token['token'];
                        session(['user' => $user]);

                        return redirect()->route('index')->with('success', 'login');
                    }
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Email atau password salah!')->withInput();
            }
        }
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('index')->with('success', 'logout');
    }

    public function hasAnyPermission(array $permissions)
    {
        $user = session('user');
        if ($user && isset($user['permission'])) {
            return in_array($user['permission'], $permissions);
        }
        return false;
    }

    public function login_api($email, $password)
    {
        $client = new Client();
        $response = $client->request('POST', $this->url_web . 'login', [
            'form_params' => [
                'email' => $email,
                'password' => $password,
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(), true);

        return $result;
    }
}
