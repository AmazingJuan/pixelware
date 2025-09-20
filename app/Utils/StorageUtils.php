<?php

namespace App\Utils;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageUtils
{
    public static function storeResourceImage(string $resource, $id, UploadedFile $image): string
    {
        return Storage::disk('public')->put("images/{$resource}/{$id}", $image);
    }

    public static function deleteResourceDirectory(string $resource, $id): bool
    {
        return Storage::disk('public')->deleteDirectory("images/{$resource}/{$id}");
    }
}
