<?php

/*
 * ImageManagement.php
 * Interface for managing images in the application.
 * Author: Juan Avendaño
*/

namespace App\Interfaces;

use Illuminate\Http\UploadedFile;

// This interface defines the contract for resource image management classes.

interface ImageManagement
{
    // Methods to be implemented by image management classes
    public function store(UploadedFile $image, $id): string|false;

    public function deleteDirectory($id): bool;
}
