<!DOCTYPE html>
<html>
<head>
    <title>Daftar Penerima Bansos</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
</head>
<body>
    <div class="container">
        <h1>Bansosnya kak 🥺</h1>
        <img src="{{ 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSaGZTEJThND4y1d1xUfGPriO9LrD8sGxoZUpcBoRJ1NQ&s' }}">
        <form  method="GET" id="myForm">
            @csrf
        <button type="submit">Download PDF</button>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Skor</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                    <tr>
                        <td>{{ $data['name'] }}</td>
                        <td>{{ $data['score'] }}</td>
                        <td>{{ $data['category'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>

    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script>
    $('#myForm').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "{{ route('banusosu2.exportPdf') }}",
            success: function (response) {
                console.log('asu');
            },
            error: function (error) {
                console.log(error);
            }
        });
    });
</script> -->
</html>