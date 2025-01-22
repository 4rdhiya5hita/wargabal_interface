<!-- resources/views/libur_nasional.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Bali {{$year}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .text-center {
            text-align: center;
        }

        .text-white {
            color: #fff;
        }

        .bg-primary-load {
            background-color: #7a6fbe;
        }

        .container {
            width: 100%;
            max-width: 210mm;
            /* Sesuaikan lebar container dengan lebar A4 */
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            font-size: 8pt !important;
        }

        .header {
            text-align: center;
            color: red;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .month {
            border: 2px solid #dcdcdc;
            border-radius: 8px;
            overflow: hidden;
            height: 750px;
            background-color: #fdfdfd;
        }

        .month-header {
            text-align: center;
            background-color: #7a6fbe;
            color: white;
            padding: 8px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <table style="width: 100%; border-collapse: collapse;">

            <!-- Header Tabel -->
            <thead>
                <tr>
                    <th colspan="4" style="padding: 10px; text-align: center; font-size:12pt;">
                        Rerahinan Bali Tahun {{$year}}
                    </th>
                </tr>
            </thead>

            <tbody>
                @php
                $selectedMonths = ['April', 'August', 'December'];
                $dynamicMonths = [];
                foreach ($selectedMonths as $month) {
                    $dynamicMonths[] = "$month $year";
                }

                $except = [
                "Hari Penyekeban", "Hari Penyajaan", "Hari Pamaridan Guru",
                "Pujawali Bhatara Wisnu", "Buda Kliwon Matal", "Buda Kliwon Ugu",
                "Persembahan Bhatara Guru", "Hari Bhatara Rambut Sedana",
                "Hari Pegatwakan", "Hari Penegtegan", "Hari Pangredanan"
                ];
                @endphp
                <tr>
                @foreach ($data as $month => $items)
                    <td style="width: 50%; vertical-align: top; padding: 10px; border: 1px solid #ddd;">
                        <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                            <thead>
                                <tr>
                                    <th colspan="2" style="padding: 8px; background-color: #7a6fbe; color: white; text-align: center;">
                                        {{ $month }}
                                    </th>
                                </tr>
                                <tr>
                                    <th style="padding: 8px; text-align: center; border: 1px solid #ddd;">Tanggal</th>
                                    <th style="padding: 8px; text-align: center; border: 1px solid #ddd;">Hari Raya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                @if (is_array($item['hari_raya']))
                                @php
                                // Filter hari_raya untuk menghapus elemen yang ada di $except
                                $filteredHariRaya = array_filter($item['hari_raya'], function ($hari) use ($except) {
                                return $hari != "-" && !in_array(is_array($hari) ? $hari['nama'] : $hari, $except);
                                });
                                $joinedHariRaya = implode(', ', array_map(function ($hari) {
                                return is_array($hari) ? $hari['nama'] : $hari;
                                }, $filteredHariRaya));
                                @endphp

                                @if (!empty($filteredHariRaya))
                                <tr>
                                    <td style="padding: 8px; text-align: center; border: 1px solid #ddd;">
                                        {{ \Carbon\Carbon::parse($item['tanggal'])->day }}
                                    </td>
                                    <td style="padding: 8px; text-align: center; border: 1px solid #ddd;">
                                        {{ $joinedHariRaya }}
                                    </td>
                                </tr>
                                @endif
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                    @if (in_array($month, $dynamicMonths))
                    </tr>
                    <tr>
                    @endif
                    @endforeach
                </tr>
            </tbody>


        </table>

    </div>

    <!-- <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="display-6 bg-primary-load text-white text-center">Kalender Bali {{$year}}</h2>
                        <h5 class="text-center">Berikut merupakan rangkuman hari raya pada tahun 2025</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="grid">
                @foreach ($data as $month => $items)
                <div class="month">
                    <h4 class="p-3 text-center bg-primary-load text-white">
                        {{ $month }}
                    </h4>
                    @foreach ($items as $item)
                    @if (is_array($item['hari_raya']))
                    @foreach ($item['hari_raya'] as $hari)
                    @if ($hari != "-")
                        <div class="row p-2">
                            <div class="col-md-2 text-center">
                                <b><span class="card-title">{{ \Carbon\Carbon::parse($item['tanggal'])->day }}</span></b>
                            </div>
                            <div class="col-md-10">
                                {{ is_array($hari) ? $hari['nama'] : $hari }}
                            </div>
                        </div>
                        <hr class="horizontal light m-0">
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                </div>
                @endforeach

            </div>
        </div>
    </div> -->
</body>

</html>