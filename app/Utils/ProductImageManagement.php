<?php

/*
 * ProductImageManagement.php
 * Class for managing product images.
 * Author: Juan Avendaño
*/

namespace App\Utils;

// Laravel / Illuminate classes
use App\Interfaces\ImageManagement;
use Illuminate\Http\UploadedFile;
// App
use Illuminate\Support\Facades\Storage;

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
