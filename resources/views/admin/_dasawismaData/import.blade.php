<!-- resources/views/admin/_dasawismaData/import.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif
    <form action="{{ route('admin.data-penduduk.importFile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="file">Upload CSV file:</label>
        <input type="file" name="file" id="file" required>
        <button type="submit">Import</button>
    </form>
</body>
</html>
