<?php

/*
 * ImageStorageInterface.php
 * Interface for managing images in the application.
 * Author: Juan Avendaño & Juan José Gómez
*/

namespace App\Interfaces;

// Laravel / framework
use Illuminate\Http\UploadedFile;

interface ImageStorageInterface
{
    public function store(UploadedFile $file, string $folder = ''): string;

    public function delete(string $pathOrUrl): bool; 
}
