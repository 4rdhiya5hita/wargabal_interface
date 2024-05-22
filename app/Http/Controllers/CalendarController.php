<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function calendar()
    {
        return view('wargabal.calendar');
    }

    public function fetchHariRaya(Request $request)
    {
        $tanggal_mulai = $request->input('start');
        $tanggal_selesai = $request->input('end');
        // dd($tanggal_mulai, $tanggal_selesai);
        
        // ambil salah satu fungsi di layanan controller
        $layanan = new LayananController();

        $events = array();
        $info_hari_raya = $layanan->callHariRaya($tanggal_mulai, $tanggal_selesai);
        foreach ($info_hari_raya as $key => $item) {
            foreach ($item['hari_raya'] as $key => $hari_raya) {
                if ($hari_raya != '-') {
                    $events[] = [
                        'title' => $hari_raya['nama'],
                        'start' => $item['tanggal'],
                        'end' => $item['tanggal'],
                    ];
                }
            }
        }
        // dd($events);

        return response()->json($events);
    }

    public function fetchAlaAyuningDewasa(Request $request)
    {
        $tanggal_mulai = $request->input('start');
        $tanggal_selesai = $request->input('end');
        // dd($tanggal_mulai, $tanggal_selesai);
        
        // ambil salah satu fungsi di layanan controller
        $layanan = new LayananController();
        $events = $layanan->callAlaAyuningDewasa($tanggal_mulai, $tanggal_selesai);

        return response()->json($events);
    }

    public function fetchElemenKalenderBali(Request $request)
    {
        $tanggal_mulai = $request->input('start');
        $tanggal_selesai = $request->input('end');
        // dd($tanggal_mulai, $tanggal_selesai);
        
        // ambil salah satu fungsi di layanan controller
        $layanan = new LayananController();
        $events = $layanan->callElemenKalenderBali($tanggal_mulai, $tanggal_selesai);

        return response()->json($events);
    }

    public function warigaCalendar()
    {
        return view('wargabal.layanan.wariga_calendar');
    }


}
