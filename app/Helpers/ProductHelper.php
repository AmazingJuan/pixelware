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
use App\Utils\StorageUtils;

class ProductHelper
{
    protected static function storage(): ImageStorageInterface
    {
        return app(ImageStorageInterface::class);
    }

    public static function create(array $data): Product
    {
        $uploadedImage = $data['image'] ?? null;
        $driverChoice = $data['storage_driver'] ?? config('image_storage.driver', env('IMAGE_STORAGE_DRIVER', 'local'));
        unset($data['image'], $data['storage_driver']);

        $product = Product::create($data);

        if ($uploadedImage instanceof UploadedFile) {
            $storage = StorageUtils::getDriverInstance($driverChoice);
            $path = $storage->store($uploadedImage, "products/{$product->id}");
            $product->update(['image_url' => $path]);
        }

        return $product;
    }

    public static function update(array $data, Product $product): Product
    {
        $uploadedImage = $data['image'] ?? null;
        unset($data['image']);

        if ($uploadedImage instanceof UploadedFile) {
            if (!empty($product->image_url)) {
                StorageUtils::deleteAny($product->image_url);
            }

            $storage = self::storage();
            $path = $storage->store($uploadedImage, "products/{$product->id}");
            $data['image_url'] = $path;
        }

        $product->update($data);

        return $product;
    }

    public static function destroy(Product $product): bool
    {
        if ($product->image_url) {
            StorageUtils::deleteAny($product->image_url);
        }

        return $product->delete();
    }
}
