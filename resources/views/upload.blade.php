<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка файла</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .upload-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            background-color: #fff;
        }
        .file-info {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 10px;
            margin-top: 15px;
        }
        .file-icon {
            font-size: 24px;
            margin-right: 10px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container upload-container bg-white">
        <h1 class="mb-4 text-center">Загрузка файла</h1>

        @if(session('success'))
        {{-- <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            @if(session('file_url'))
                <div class="file-info mt-3 d-flex align-items-center">
                    <span class="file-icon">📄</span>
                    <div>
                        <div class="fw-bold">{{ session('file_name') }}</div>
                        <a href="{{ session('file_url') }}" 
                           target="_blank" 
                           class="btn btn-sm btn-primary mt-2">
                            <i class="bi bi-download"></i> Скачать файл
                        </a>
                        <button onclick="copyToClipboard('{{ session('file_url') }}')" 
                                class="btn btn-sm btn-outline-secondary mt-2 ms-2">
                            <i class="bi bi-clipboard"></i> Копировать ссылку
                        </button>
                    </div>
                </div>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> --}}
        @endif

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle-fill"></i> При обработке файла возникли ошибки:
            <ul class="mt-2 mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="/upload" method="POST" enctype="multipart/form-data" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="fileInput" class="form-label">Выберите файл:</label>
                <input class="form-control" type="file" id="fileInput" name="file" required>
                <div class="form-text mt-2">
                    Поддерживаемые форматы: JPG, JPEG, PNG, PDF, MD (максимальный размер 50MB)
                </div>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-upload"></i> Загрузить файл
                </button>
            </div>
        </form>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Ссылка скопирована в буфер обмена!');
            }, function(err) {
                console.error('Не удалось скопировать текст: ', err);
            });
        }
        
        // Показываем имя выбранного файла
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Файл не выбран';
            const fileInfo = document.createElement('div');
            fileInfo.className = 'text-muted mt-2';
            fileInfo.textContent = `Выбран файл: ${fileName}`;
            
            const oldInfo = document.querySelector('#fileInfo');
            if (oldInfo) oldInfo.remove();
            
            this.parentNode.appendChild(fileInfo);
            fileInfo.id = 'fileInfo';
        });
    </script>
</body>
</html>