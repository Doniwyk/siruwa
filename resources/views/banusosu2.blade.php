<!DOCTYPE html>
<html>
<head>
    <title>Daftar Penerima Bansos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Bansosnya kak 🥺</h1>
        <img src="{{ 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSaGZTEJThND4y1d1xUfGPriO9LrD8sGxoZUpcBoRJ1NQ&s' }}">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Skor</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{ $result['name'] }}</td>
                        <td>{{ $result['score'] }}</td>
                        <td>{{ $result['category'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>