<!DOCTYPE html>
<html>
<head>
    <title>Rekap Penilaian</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h2>Rekap Penilaian Karyawan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Tanggal Penilaian</th>
                <th>Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penilaians as $i => $nilai)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $nilai->qaryawan->nama_lengkap }}</td>
                <td>{{ $nilai->tanggal_penilaian }}</td>
                <td>{{ $nilai->skor }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
