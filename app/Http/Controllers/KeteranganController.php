<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeteranganController extends Controller
{
    public function keterangan_pancawara_page()
    {
        return view('wargabal.keterangan.keterangan_pancawara_page');
    }
}
