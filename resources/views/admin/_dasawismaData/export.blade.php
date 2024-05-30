<!DOCTYPE html>
<html>
<head>
    <title>Data Kependudukan RW 2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Data Kependudukan RW 2</h1>
    <table>
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nomor KK</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
            </tr>
        </thead>         
        <tbody>
        @foreach ($users as $resident)
            <tr>
                <td>{{ $resident->nik }}</td>
                <td>{{ $resident->nomor_kk }}</td>
                <td>{{ $resident->nama }}</td>
                <td>{{ $resident->tgl_lahir }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
