<!DOCTYPE html>
<html>

<head>
    <title>Data Pembayaran RW 2</title>
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

        th,
        td {
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
    <h1>Data Pembayaran RW 2</h1>
    <table>
        <thead>
            <tr>
                <th>Nomor KK</th>
                <th>Tanggal Permintaan</th>
                <th>Nama Pembayar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payment as $data)
            <tr>
                <td>{{ $data->nomor_kk }}</td>
                <td>{{ $data->created_at }}</td>
                <td>{{ $data-resident->nama }}</td>
                <td>{{ $data->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>