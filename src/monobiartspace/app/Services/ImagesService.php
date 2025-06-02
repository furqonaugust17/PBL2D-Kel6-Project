<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImagesService
{
    // Simpan Sampul Foto
    public function uploadImages($file,$folder)
    {
        $randomName = Str::uuid()->toString();
        $fileExtension = 'jpg';
        $fileName = $randomName . '.' . $fileExtension;

        // Simpan file foto ke folder public/images
        // $file->move(public_path('storage/images/' .$folder), $fileName);
        $path = $file->storeAs('uploads/'.$folder, $fileName, 'public');
        return $path;
    }

    // Hapus Sampul Foto
    public function deleteImages($filename)
    {
        $filePath = public_path('images/' . $filename);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }
}