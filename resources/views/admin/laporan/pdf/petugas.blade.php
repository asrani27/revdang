<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        @page {
            margin: 10px 50px 10px 50px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .header-logo {
            flex-shrink: 0;
            margin-right: 15px;
        }

        .header-logo img {
            width: 70px;
            height: auto;
        }

        .header-content {
            flex-grow: 1;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 11px;
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-content">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="text-align: right; border:0px;"> <img src="{{ public_path('logo/bjm.png') }}"
                            alt="Logo BJM" width="100">
                    </td>
                    <td style="text-align: center; border:0px;">
                        <h1>PT. Banua Jaya Mandiri Banjarmasin</h1>
                        <p> Jl. Pramuka Km. 6 Gang. Teratai III RT. 07 No. 19
                            Pemurus Luar Kec. Banjarmasin Timur Kota Banjarmasin</p>

                    </td>
                    <td style="border:0px;" width="100">
                    </td>
                </tr>
            </table>
            <hr>
            <h3>{{ $title }}</h3>
            <p>Dicetak pada: {{ $tanggal }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 40px;">No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Telepon</th>
                <th>Status Akun</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($petugas as $index => $p)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $p->nik }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->jabatan }}</td>
                <td>{{ $p->telp ?? '-' }}</td>
                <td>{{ $p->user ? ucfirst($p->user->status_akun) : 'Tidak Ada Akun' }}</td>
                <td>{{ $p->created_at->format('d/m/Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 4px; margin-left:800px; text-align: center;">
        <p>Banjarmasin, {{ date('j') }} {{ ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
            'September', 'Oktober', 'November', 'Desember'][date('n')-1] }} {{ date('Y') }}</p>
        <p><strong>Pimpinan</strong></p>
        <br><br>
        <p><strong>Yahya</strong></p>
    </div>

    <div class="footer">
        <p>Total Data: {{ $petugas->count() }} | Sistem Rev Dang - Laporan {{ $title }}</p>
    </div>
</body>

</html>