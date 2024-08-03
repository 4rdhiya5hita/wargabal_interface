<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    protected $url_web = "https://api.kalenderbali.web.id/api/";
    // protected $url_api = 'https://api2.kalenderbali.web.id/api/';
    protected $url_api = "http://localhost:8000/api/";

    public function jadi_member_premium()
    {
        return view('wargabal.purchase.jadi_member_premium');
    }

    public function pembelian_anda()
    {
        $login_token = session('user');
        $my_purchases = $this->get_my_purchases($login_token);
        $my_purchases = array_reverse($my_purchases);
        $my_active_product = $this->get_my_active_product($login_token);

        return view('wargabal.purchase.pembelian_anda', compact('my_purchases', 'my_active_product'));
    }

    public function get_my_purchases($login_token)
    {
        $client = new Client();
        $get_my_purchases = $client->request('GET', $this->url_web . 'purchases', [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['token'],
                'Accept' => 'application/json',
            ],
        ]);
        $result = json_decode($get_my_purchases->getBody()->getContents(), true);
        $data_all_user = $result['data'];

        $data = [];
        foreach ($data_all_user as $key => $value) {
            if ($value['user_id'] == $login_token['id']) {
                $data[] = $value;
            }
        }

        return $data;
    }

    public function get_my_pending_payment($my_purchases)
    {
        $data = [];
        foreach ($my_purchases as $key => $value) {
            if ($value['status'] == 'pending') {
                $data[] = $value;
            }
        }

        return $data;
    }

    public function get_my_active_product($login_token)
    {
        $client = new Client();
        $get_my_active_product = $client->request('GET', $this->url_web . 'purchases/my-active-product', [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['token'],
                'Accept' => 'application/json',
            ],
        ]);
        $result = json_decode($get_my_active_product->getBody()->getContents(), true);
        $data = $result['data'];

        return $data;
    }

    public function purchase(Request $request)
    {
        $client = new Client();
        $login_token = session('user');
        $add_contribution_desc = $client->request('POST', $this->url_web . 'purchases', [
            'headers' => [
                'Authorization' => 'Bearer ' . $login_token['token'],
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'product_id' => $request->product
            ]
        ]);
        
        $result = json_decode($add_contribution_desc->getBody()->getContents(), true);
        if ($result['success'] == true) {
            $url_payment = $result['data']['redirect_url'];
            return redirect($url_payment);
        } else {
            return redirect()->route('jadi_member_premium')->with('error', 'Pembelian tidak berhasil! Silahkan coba lagi')->withInput();
        }
    }
}
