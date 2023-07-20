<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload CSV File</title>
</head>
<body>
<div class="container">
        <h1>Upload CSV File</h1>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('csv.upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="csv_file">CSV File</label>
                <input type="file" class="form-control @error('csv_file') is-invalid @enderror" id="csv_file" name="csv_file" required>
                @error('csv_file')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</body>
</html>