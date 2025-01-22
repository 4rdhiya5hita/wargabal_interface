<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use mPDF;

class PDFController extends Controller
{
    public function generateCalendarPDF(Request $request)
    {
        $year = $request->year;
        $info_hari_raya = Cache::remember('info_hari_raya_' . $year . '_01_01_' . $year . '_12_31', now()->addDays(365), function () use ($year) {
            $layanan = new LayananController();
            return $layanan->callHariRaya($year . '-01-01', $year . '-12-31');
        });

        $data = collect($info_hari_raya)->groupBy(function($item) {
            return \Carbon\Carbon::parse($item['tanggal'])->format('F Y'); // Kelompokkan berdasarkan nama bulan dan tahun
        });

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML(view('wargabal.pdf.calendar_pdf', compact('data', 'year')));
        $mpdf->Output('Kalender_Bali_' .$year. '.pdf', 'D');

        // return view('wargabal.pdf.calendar_pdf', compact('data', 'year'));

        // $pdf = Pdf::loadView('wargabal.pdf.calendar_pdf', compact('data', 'year'))
        //     ->setOption('no-outline', true)
        //     ->setPaper('A4', 'portrait');
        //     return $pdf->download('invoice.pdf');

    }

    public function download()
    {
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML('<h1>Hello world!</h1>');
        $mpdf->Output();
    }

    public function calendarTemplate()
    {
        $year = 2025;
        $info_hari_raya = Cache::remember('info_hari_raya_' . $year . '_01_01_' . $year . '_12_31', now()->addDays(365), function () use ($year) {
            $layanan = new LayananController();
            return $layanan->callHariRaya($year . '-01-01', $year . '-12-31');
        });

        $data = collect($info_hari_raya)->groupBy(function($item) {
            return \Carbon\Carbon::parse($item['tanggal'])->format('F Y'); // Kelompokkan berdasarkan nama bulan dan tahun
        });

        return view('wargabal.pdf.calendar_template', compact('data', 'year'));
    }
}
