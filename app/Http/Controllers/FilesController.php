<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\File;

class FilesController extends Controller
{
  public function index()
  {
    // Логика для отображения файлов
    $files = File::latest()->get();
    return view('files.index', compact('files'));
  }

  public function upload()
  {
    // Логика обработки загрузки файлов

    // Validate the uploaded file
    $request->validate([
        'file' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
    ]);

    // Store the file in the 'public' disk
    $path = $request->file('file')->store('files', 'public');

    // Save the file path to the database
    $file = new File();
    $file->path = $path;
    $file->save();

    // Redirect back with a success message
    return redirect()->route('files.index')->with('success', 'File uploaded successfully!');
}

}