<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function showForm()
    {
        return view('upload');
    }

    public function showResult()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        $uploadPath = public_path('upload');
        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0755, true)) {
                return back()->with('error', 'Не удалось создать папку upload');
            }
        }
        

        $validated = $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,md|max:51200',
        ]);

       
        
        try {
            $file = $request->file('file');
            $filename = time().'.'.$file->extension();

            // Сохраняем файл с правильным путем для Windows
            $file->move($uploadPath, $filename);
        
            
            // Перенаправляем на GET /upload с флеш-сообщениями
            return redirect()->route('upload.form')
            ->with('success', 'Файл успешно загружен!')
            ->with('file_url', $fileUrl)
            ->with('file_name', $filename);

            // return back()->with('success', 'Файл успешно загружен: ' . uploadPath);
                
        } catch (\Exception $e) {
            \Log::error("Upload error: " . $e->getMessage());
            return redirect()->route('upload.result')
                ->with('error', 'Ошибка при загрузке файла: ' . $e->getMessage());
        }
    }
}