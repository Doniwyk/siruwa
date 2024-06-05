<!-- resources/views/tunggakan/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Data Tunggakan</title>
</head>
<body>
    <h1>Data Tunggakan</h1>

    <h2>Tunggakan Kematian</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nomor KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Total Tunggakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataTunggakan['kematian'] as $tunggakan)
                <tr>
                    <td>{{ $tunggakan->nomor_kk }}</td>
                    <td>{{ $tunggakan->head_of_family }}</td>
                    <td>{{ $tunggakan->total_tunggakan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Tunggakan Sampah</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nomor KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Total Tunggakan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataTunggakan['sampah'] as $tunggakan)
                <tr>
                    <td>{{ $tunggakan->nomor_kk }}</td>
                    <td>{{ $tunggakan->head_of_family }}</td>
                    <td>{{ $tunggakan->total_tunggakan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
