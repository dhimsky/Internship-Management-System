<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Laporan Absen {{ $date ? $date : "Semua Riwayat" }}</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Waktu Masuk</th>
                <th>IP Masuk</th>
                <th>Lokasi Masuk</th>
                <th>Waktu Keluar</th>
                <th>Validasi IP/Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $index => $attendance)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $attendance->employee->name }}</td>
                <td>{{ $attendance->created_at }}</td>
                <td>{{ $attendance->entry_ip }}</td>
                <td>{{ $attendance->entry_location }}</td>
                <td>{{ $attendance->entry_status }}</td>
                <td>{{ $attendance->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
