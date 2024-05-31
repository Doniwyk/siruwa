@section('content')
<div class="container">
    <h1>Hasil Perhitungan Banusosu</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Rangking Prioritas</th>
                <th>Nama</th>
                <th>Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $index => $result)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $result['name'] }}</td>
                    <td>{{ $result['score'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
