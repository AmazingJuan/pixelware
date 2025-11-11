<?php

namespace App\Utils;

use App\Interfaces\ImageStorageInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class LocalImageStorage implements ImageStorageInterface
{
    protected string $disk;

    protected string $defaultFolder;

    public function __construct()
    {
        $this->disk = config('image_storage.local_disk', 'public');
        $this->defaultFolder = config('image_storage.local_path', 'products');
    }

    public function store(UploadedFile $file, string $folder = ''): string
    {
        $folder = trim($folder ?: $this->defaultFolder, '/');
        $filename = now()->format('YmdHis').'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
        $path = ($folder ? $folder.'/' : '').$filename;

        $stored = Storage::disk($this->disk)->putFileAs($folder, $file, $filename);

        if (! $stored) {
            throw new RuntimeException(Lang::get('exceptions.image_local_store_failed'));
        }

        return str_replace('public/', '', $path);
    }

    public function delete(string $pathOrUrl): bool
    {
        $disk = Storage::disk($this->disk);
        $baseUrl = $disk->url('');
        $relative = $pathOrUrl;

        if (str_starts_with($pathOrUrl, $baseUrl)) {
            $relative = ltrim(substr($pathOrUrl, strlen($baseUrl)), '/');
        }

        return $disk->delete($relative);
    }
}
