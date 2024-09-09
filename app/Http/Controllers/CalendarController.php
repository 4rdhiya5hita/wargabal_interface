<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CalendarController extends Controller
{
    public function calendar()
    {
        $bulan_sekarang = Carbon::now()->format('m');
        $tanggal_sekarang = Carbon::now()->format('Y-m-d');
        $tanggal_mulai = date('Y-m-01');
        $tanggal_selesai = date('Y-m-t');

        $layanan = new LayananController();
        $keterangan = $layanan->callKeteranganElemenKalenderBali();

        $layanan = new LayananController();
        $keterangan_hari_raya = $layanan->keteranganHariRaya();

        $layanan = new LayananController();
        $keterangan_ala_ayuning_dewasa = $layanan->keteranganAlaAyuningDewasa();

        return view('wargabal.calendar', compact('keterangan', 'keterangan_hari_raya', 'keterangan_ala_ayuning_dewasa', 'bulan_sekarang', 'tanggal_sekarang'));
    }

    public function fetchHariRaya(Request $request)
    {
        $events = array();
        $tanggal_mulai = $request->input('start');
        $tanggal_selesai = $request->input('end');

        $events = array();
        // Cache::forget('info_hari_raya_calendar_' . $tanggal_mulai . '_' . $tanggal_selesai);
        $info_hari_raya_calendar = Cache::remember('info_hari_raya_calendar_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(31), function () use ($tanggal_mulai, $tanggal_selesai) {
            $layanan = new LayananController();
            $hari_raya = $layanan->callHariRaya($tanggal_mulai, $tanggal_selesai);
            return $hari_raya;
        });

        foreach ($info_hari_raya_calendar as $key => $item) {
            foreach ($item['hari_raya'] as $key => $hari_raya) {
                if ($hari_raya != '-') {
                    $events[] = [
                        'title' => $hari_raya['simbol'],
                        'start' => $item['tanggal'],
                        'end' => $item['tanggal'],
                        'extendedProps' => [
                            'name' => $hari_raya['nama']
                        ]
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

        $events = Cache::remember('event_ala_ayuning_dewasa_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(31), function () use ($layanan, $tanggal_mulai, $tanggal_selesai) {
            $ala_ayuning_dewasa = $layanan->callAlaAyuningDewasa($tanggal_mulai, $tanggal_selesai);
            return $ala_ayuning_dewasa;
        });

        return response()->json($events);
    }

    public function fetchElemenKalenderBali(Request $request)
    {
        $tanggal_mulai = $request->input('start');
        $tanggal_selesai = $request->input('end');
        // dd($tanggal_mulai, $tanggal_selesai);

        // ambil salah satu fungsi di layanan controller
        $layanan = new LayananController();

        $events = Cache::remember('event_elemen_kalender_bali_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(31), function () use ($layanan, $tanggal_mulai, $tanggal_selesai) {
            $elemen_kalender_bali = $layanan->callElemenKalenderBali($tanggal_mulai, $tanggal_selesai);
            return $elemen_kalender_bali;
        });

        return response()->json($events);
    }

    public function fetchPiodalan(Request $request)
    {
        $tanggal_mulai = $request->input('start');
        $tanggal_selesai = $request->input('end');
        // dd($tanggal_mulai, $tanggal_selesai);

        // ambil salah satu fungsi di layanan controller
        $layanan = new LayananController();

        $events = Cache::remember('event_piodalan_' . $tanggal_mulai . '_' . $tanggal_selesai, now()->addDays(31), function () use ($layanan, $tanggal_mulai, $tanggal_selesai) {
            $piodalan = $layanan->callPiodalan($tanggal_mulai, $tanggal_selesai);
            return $piodalan;
        });

        return response()->json($events);
    }

    public function fetchKeterangan(Request $request)
    {
        $tanggal_mulai = $request->input('start');
        $tanggal_selesai = $request->input('end');

        $layanan = new LayananController();
        $keterangan = $layanan->callKeteranganElemenKalenderBali();

        return $keterangan;
    }

    public function warigaCalendar()
    {
        return view('wargabal.layanan.wariga_calendar');
    }

    public function fetchZodiak(Request $request)
    {
        $bulan = $request->input('month');
        $zodiak = array();

        $layanan = new LayananController();
        $result = $layanan->callZodiak();
        foreach ($result as $key => $value) {
            if ($value['id'] == $bulan) {
                $zodiak[] = $value;
            }
        }

        return response()->json($zodiak);
    }
}
