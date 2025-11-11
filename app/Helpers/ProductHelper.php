<?php

/*
 * ProductHelper.php
 * Handles product creation, update, and deletion logic including image management.
 * Author: Juan Avendaño & Juan José Gómez
 */

namespace App\Helpers;

use App\Interfaces\ImageStorageInterface;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

class ProductHelper
{
    public static function create(array $data): Product
    {
        $uploadedImage = $data['image'] ?? null;
        unset($data['image']);

        $selectedStorageDriver = $data['storage_driver'];
        $storageInterface = app(ImageStorageInterface::class, ['storage_driver' => $selectedStorageDriver]);

        $product = Product::create($data);

        if ($uploadedImage instanceof UploadedFile) {
            $path = $storageInterface->store($uploadedImage, "products/{$product->id}");
            $product->update(['image_url' => $path]);
        }

        return $product;
    }

    public static function update(array $data, Product $product): Product
    {
        $uploadedImage = $data['image'] ?? null;
        unset($data['image']);

        $storageDriver = $product->getStorageDriver();
        $storageInterface = app(ImageStorageInterface::class, ['storage_driver' => $storageDriver]);

        if ($uploadedImage instanceof UploadedFile) {
            if ($product->image_url) {
                $storageInterface->delete($product->image_url);
            }

            $path = $storageInterface->store($uploadedImage, "products/{$product->id}");
            $data['image_url'] = $path;
        }

        $product->update($data);

        return $product;
    }

    public static function destroy(Product $product): bool
    {
        $storageDriver = $product->getStorageDriver();
        $storageInterface = app(ImageStorageInterface::class, ['storage_driver' => $storageDriver]);

        if ($product->image_url) {
            $storageInterface->delete($product->image_url);
        }

        return $product->delete();
    }
}
