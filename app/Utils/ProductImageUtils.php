<?php

namespace App\Utils;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductImageUtils
{
    public static function publicUrl(?string $path): string
    {
        if (empty($path)) {
            return asset('images/default-product.png');
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Storage::disk('public')->exists(ltrim($path, '/'))) {
            return asset('storage/'.ltrim($path, '/'));
        }

        $bucket = env('GCP_BUCKET', null);
        if ($bucket) {
            return 'https://storage.googleapis.com/'.$bucket.'/'.ltrim($path, '/');
        }

        return asset('storage/'.ltrim($path, '/'));
    }
}
