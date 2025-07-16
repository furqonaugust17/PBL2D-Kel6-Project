<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    public function uploadMany(array $images, string $directory = 'uploads/gallery'): array
    {
        $paths = [];

        foreach ($images as $image) {
            $extension = $image->getClientOriginalExtension();

            $filename = Str::uuid()->toString() . '.' . $extension;

            $path = $image->storeAs($directory, $filename, 'public');

            $paths[] = ['file' => $path];
        }

        return $paths;
    }

    public function storeSingle($image, string $directory = 'gallery'): string
    {
        $extension = $image->getClientOriginalExtension();

        $filename = Str::uuid()->toString() . '.' . $extension;

        return $image->storeAs('uploads/' . $directory, $filename, 'public');
    }

    public function deleteImages($images)
    {
        foreach ($images as $image) {
            Storage::disk('public')->delete($image->file);
            $image->delete();
        }
    }

    public function deleteSingleImage($image)
    {
        Storage::disk('public')->delete($image);
    }
}
