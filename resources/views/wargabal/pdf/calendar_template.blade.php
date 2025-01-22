<!-- resources/views/libur_nasional.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Bali {{$year}}</title>
    @include("partials/head-css")
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .bg-primary-load{
            --bs-bg-opacity: 1;
            background-color: rgba(var(--bs-primary-rgb), var(--bs-bg-opacity)) !important;
        }

        .container {
            width: 100%;
            max-width: 210mm; /* Sesuaikan lebar container dengan lebar A4 */
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
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
            gap: 20px;
        }

        .month {
            border: 2px solid #dcdcdc;
            border-radius: 8px;
            overflow: hidden;
            height: 750px;
            background-color: #fdfdfd;
        }

        .month-header {
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="col-md-12">

            <div class="row" id="height1">
                <div class="card">
                    <div class="card-body">
                        <h2 class="bg-primary-load text-white text-center">Kalender Bali {{$year}}</h2>
                        <p class="text-center m-0">Berikut merupakan rangkuman hari raya pada tahun 2025</p>
                    </div>
                </div>
            </div>
            <div class="row" id="height2">
                <div class="grid">
                    @foreach ($data as $month => $items)
                    <div class="month">
                        <h5 class="p-2 text-center bg-primary-load text-white">
                            {{ $month }}
                        </h5>
                        @foreach ($items as $item)
                        @if (is_array($item['hari_raya']))
                        @foreach ($item['hari_raya'] as $hari)
                        @if ($hari != "-")
                        <div class="p-2">
                            <b><span style="margin-right: 10px;">{{ \Carbon\Carbon::parse($item['tanggal'])->day }}</span></b>
                            {{ is_array($hari) ? $hari['nama'] : $hari }}
                            <hr class="horizontal light m-0">
                        </div>
                        @endif
                        @endforeach
                        @endif
                        @endforeach
                    </div>
                    @endforeach
    
                </div>
            </div>
        </div>
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