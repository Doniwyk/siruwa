<!DOCTYPE html>
<html>
<head>
    <title>Combined DSS Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="my-4">Combined DSS Results</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>DSS Score</th>
                <th>Fuzzy Score</th>
                <th>Combined Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $result)
            <tr>
                <td>{{ $result['name'] }}</td>
                <td>{{ $result['dss_score'] }}</td>
                <td>{{ $result['fuzzy_score'] }}</td>
                <td>{{ $result['combined_score'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
