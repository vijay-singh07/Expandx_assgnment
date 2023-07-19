<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>expandx</title>
</head>
<body>
<div class="container">
        <h1>Upload CSV File</h1>
        <form action="{{ route('csv.upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="csv_file">CSV File</label>
                <input type="file" class="form-control" id="csv_file" name="csv_file">
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</body>
</html>