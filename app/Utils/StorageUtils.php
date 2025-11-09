<?php

namespace App\Utils;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageUtils
{
    public static function store(UploadedFile $file, string $directory, string $disk = 'public'): string
    {
        $path = Storage::disk($disk)->putFile($directory, $file);

        return $disk.'/'.$path;
    }

    public static function deleteDirectory(string $directory, string $disk = 'public'): bool
    {
        return Storage::disk($disk)->deleteDirectory($directory);
    }

    public static function deleteFile(string $path, string $disk = 'public'): bool
    {
        return Storage::disk($disk)->exists($path) ? Storage::disk($disk)->delete($path) : false;
    }
}
