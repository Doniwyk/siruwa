<!-- resources/views/admin/_dasawismaData/preview.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Data Preview</title>
</head>
<body>
    <h1>Data Preview</h1>
    @if(session('error'))
        <div style="color: red;">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif
    <table border="1">
        <thead>
            <tr>
                @if(!empty($dataPreview))
                    @foreach(array_keys($dataPreview[0]) as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($dataPreview as $row)
                <tr>
                    @foreach($row as $cell)
                        <td>{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('admin.data-penduduk.saveImport') }}" method="POST">
        @csrf
        <button type="submit">Save Imported Data</button>
    </form>
</body>
</html>