<?php

/*
 * ProductImageManagement.php
 * Class for managing product images.
 * Author: Juan Avendaño
*/

namespace App\Utils;

// Laravel / Illuminate classes
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

// App
use App\Interfaces\ImageManagement;

class ProductImageManagement implements ImageManagement
{
    /**
     * Store an image for a product.
     */
    public function store(UploadedFile $image, $id): string|false
    {
        $path = Storage::disk('images')->putFile("products/{$id}", $image);

        return 'images/'.$path;
    }

    /**
     * Delete the image directory for a product.
     */
    public function deleteDirectory($id): bool
    {
        return Storage::disk('images')->deleteDirectory("products/{$id}");
    }
}
