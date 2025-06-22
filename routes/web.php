<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilesController;


// Route::get('/', [UploadController::class, 'showForm'])->name('upload.form');
// Route::get('/upload', [UploadController::class, 'showForm'])->name('upload.rez');
// Route::post('/upload', [UploadController::class, 'store'])->name('upload.submit');

// Маршрут GET для отображения формы загрузки и изображений.
Route::get('/', [FilesController::class, 'index'])->name('files.index');
// Маршрут POST для обработки отправки формы и загрузки изображения.
Route::post('/', [FilesController::class, 'upload'])->name('files.upload');