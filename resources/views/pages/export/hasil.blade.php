<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Analisa</title>
    <style>
        /* CSS untuk styling */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            padding-top: 20px;
            padding-bottom: 20px;
            border: 2px solid black;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .header p {
            font-size: 18px;
            margin: 0;
        }

        .content {
            text-align: center;
            border: 2px solid black;
            border-top: none;
        }

        .content h3 {
            margin: 0;
        }

        .content .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .content .table th,
        .content .table td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        .content .table th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .jumlah {
            text-align: end;
        }

        .content .ttd {
            width: 100%;
            border: none;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .content .ttd th {
            font-weight: normal;
        }

        .content .ttd td {
            text-align: center;
            padding-top: 60px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1 style="text-transform: uppercase">HASIL ANALISA METODE ELECTRE STRATEGI {{ $gameplay->nama }}</h1>
    </div>

    <div class="content">
        <h3>REKOMENDASI HERO GOLD LANE</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Laning</th>
                    <th>Nilai</th>
                    <th>Rangking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rowDataGoldLane as $index => $row)
                    <tr>
                        <td>
                            @if ($row['foto'] !== '')
                                <img src="{{ $row['foto'] }}" width="50" />
                            @else
                                <img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" width="50" />
                            @endif
                        </td>
                        <td>{{ $row['nama'] }}</td>
                        <td>{{ $row['role'] }}</td>
                        <td>{{ $row['laning'] }}</td>
                        <td>{{ $row['nilai'] }}</td>
                        <td>{{ $row['rangking'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="page-break"></div>

    <div class="header">
        <h1 style="text-transform: uppercase">HASIL ANALISA METODE ELECTRE STRATEGI {{ $gameplay->nama }}</h1>
    </div>

    <div class="content">
        <h3>REKOMENDASI HERO MID LANE</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Laning</th>
                    <th>Nilai</th>
                    <th>Rangking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rowDataMidLane as $index => $row)
                    <tr>
                        <td>
                            @if ($row['foto'] != '')
                                <img src="{{ $row['foto'] }}" width="50" />
                            @else
                                <img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" width="50" />
                            @endif
                        </td>
                        <td>{{ $row['nama'] }}</td>
                        <td>{{ $row['role'] }}</td>
                        <td>{{ $row['laning'] }}</td>
                        <td>{{ $row['nilai'] }}</td>
                        <td>{{ $row['rangking'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="page-break"></div>

    <div class="header">
        <h1 style="text-transform: uppercase">HASIL ANALISA METODE ELECTRE STRATEGI {{ $gameplay->nama }}</h1>
    </div>

    <div class="content">
        <h3>REKOMENDASI HERO EXP LANE</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Laning</th>
                    <th>Nilai</th>
                    <th>Rangking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rowDataEXPLane as $index => $row)
                    <tr>
                        <td>
                            @if ($row['foto'] != '')
                                <img src="{{ $row['foto'] }}" width="50" />
                            @else
                                <img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" width="50" />
                            @endif
                        </td>
                        <td>{{ $row['nama'] }}</td>
                        <td>{{ $row['role'] }}</td>
                        <td>{{ $row['laning'] }}</td>
                        <td>{{ $row['nilai'] }}</td>
                        <td>{{ $row['rangking'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="page-break"></div>

    <div class="header">
        <h1 style="text-transform: uppercase">HASIL ANALISA METODE ELECTRE STRATEGI {{ $gameplay->nama }}</h1>
    </div>

    <div class="content">
        <h3>REKOMENDASI HERO ROAM</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Laning</th>
                    <th>Nilai</th>
                    <th>Rangking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rowDataRoam as $index => $row)
                    <tr>
                        <td>
                            @if ($row['foto'] != '')
                                <img src="{{ $row['foto'] }}" width="50" />
                            @else
                                <img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" width="50" />
                            @endif
                        </td>
                        <td>{{ $row['nama'] }}</td>
                        <td>{{ $row['role'] }}</td>
                        <td>{{ $row['laning'] }}</td>
                        <td>{{ $row['nilai'] }}</td>
                        <td>{{ $row['rangking'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="page-break"></div>

    <div class="header">
        <h1 style="text-transform: uppercase">HASIL ANALISA METODE ELECTRE STRATEGI {{ $gameplay->nama }}</h1>
    </div>

    <div class="content">
        <h3>REKOMENDASI HERO JUNGLE</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Laning</th>
                    <th>Nilai</th>
                    <th>Rangking</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rowDataJungle as $index => $row)
                    <tr>
                        <td>
                            @if ($row['foto'] != '')
                                <img src="{{ $row['foto'] }}" width="50" />
                            @else
                                <img src="{{ asset('dist/img/LOGO POLITEKNIK NEGERI  JEMBER.png') }}" width="50" />
                            @endif
                        </td>
                        <td>{{ $row['nama'] }}</td>
                        <td>{{ $row['role'] }}</td>
                        <td>{{ $row['laning'] }}</td>
                        <td>{{ $row['nilai'] }}</td>
                        <td>{{ $row['rangking'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
