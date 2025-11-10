<?php

/*
 * ProductHelper.php
 * Handles product creation, update, and deletion logic including image management.
 * Author: Juan Avendaño
 */

namespace App\Helpers;

// Laravel / Illuminate classes
use Illuminate\Http\UploadedFile;

// Models
use App\Models\Product;

// Utils / Helpers
use App\Utils\StorageUtils;

class ProductHelper
{
    public static function create(array $data): Product
    {
        $uploadedImage = $data['image'] ?? null;
        unset($data['image']);

        $product = new Product($data);
        $product->save();

        if ($uploadedImage instanceof UploadedFile) {
            $path = StorageUtils::store($uploadedImage, "products/{$product->id}", 'images');
            $product->image_url = $path;
            $product->save();
        }

        return $product;
    }

    public static function update(array $data, Product $product): Product
    {
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $uploadedImage = $data['image'];
            unset($data['image']);

            if ($product->image_url) {
                StorageUtils::deleteDirectory("products/{$product->id}", 'images');
            }

            $path = StorageUtils::store($uploadedImage, "products/{$product->id}", 'images');
            $data['image_url'] = $path;
        }

        $product->update($data);

        return $product;
    }

    public static function destroy(Product $product): bool
    {
        if ($product->image_url) {
            StorageUtils::deleteDirectory("products/{$product->id}", 'images');
        }

        return $product->delete();
    }
}
