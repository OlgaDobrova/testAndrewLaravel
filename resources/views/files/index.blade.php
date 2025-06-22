<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Загрузка файлов</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data" class="mb-5">
            @csrf
            <div class="form-group">
                <label for="file">Загрузите файл</label>
                <input type="file" name="file" id="file" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Загрузить</button>
        </form>
        <h2>Загруженные файлы</h2>
        <div class="row">
            <!-- Files will be displayed here -->
            @foreach($files as $file)
              <div class="col-md-4 mb-3">
                <p>{{ asset('storage/' . $image->path) }}</p>
                {{-- <img src="{{ asset('storage/' . $image->path) }}" alt="Uploaded Image" class="img-fluid"> --}}
              </div>
            @endforeach
        </div>
    </div>
</body>
</html>