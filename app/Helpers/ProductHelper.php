<?php

/*
 * ProductHelper.php
 * Handles product creation, update, and deletion logic including image management.
 * Author: Juan Avendaño & Juan José Gómez
 */

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use App\Models\Product;
use App\Interfaces\ImageStorageInterface;

class ProductHelper
{
    protected static function storage(): ImageStorageInterface
    {
        // Laravel inyecta automáticamente la implementación configurada (local o gcp)
        return app(ImageStorageInterface::class);
    }

    public static function create(array $data): Product
    {
        $uploadedImage = $data['image'] ?? null;
        unset($data['image']);

        $product = Product::create($data);

        if ($uploadedImage instanceof UploadedFile) {
            $path = self::storage()->store($uploadedImage, "products/{$product->id}");
            $product->update(['image_url' => $path]);
        }

        return $product;
    }

    public static function update(array $data, Product $product): Product
    {
        $uploadedImage = $data['image'] ?? null;
        unset($data['image']);

        if ($uploadedImage instanceof UploadedFile) {
            if ($product->image_url) {
                self::storage()->delete($product->image_url);
            }

            $path = self::storage()->store($uploadedImage, "products/{$product->id}");
            $data['image_url'] = $path;
        }

        $product->update($data);

        return $product;
    }

    public static function destroy(Product $product): bool
    {
        if ($product->image_url) {
            self::storage()->delete($product->image_url);
        }

        return $product->delete();
    }
}
