<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 15px;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 16px;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 10px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #333;
            padding: 4px 6px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            margin-top: 15px;
            text-align: center;
            font-size: 9px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Dicetak pada: {{ $tanggal }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 30px;">No</th>
                <th>User</th>
                <th>Aktivitas</th>
                <th>Modul</th>
                <th>IP Address</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logAktivitas as $index => $log)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $log->user->name ?? '-' }}</td>
                <td>{{ Str::limit($log->aktivitas, 40) }}</td>
                <td>{{ $log->modul }}</td>
                <td>{{ $log->IP_address ?? '-' }}</td>
                <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Total Data: {{ $logAktivitas->count() }} | Sistem Rev Dang - Laporan {{ $title }}</p>
    </div>
</body>
</html>
