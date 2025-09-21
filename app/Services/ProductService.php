<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function createProduct(array $data): Product
    {
        $uploadedImage = $data['images'];
        $data['images'] = '{}';
        $product = Product::create($data);
        $paths = [];

        if (! empty($tempImages)) {
            foreach ($tempImages as $image) {
                $paths[] = $this->storeImage($image, $product->id);
            }
        }
        $product->images = json_encode($paths);
        $product->save();

        return $product;
    }

    private function storeImage(UploadedFile $image, int $productId): string
    {
        return $image->store('images/products/'.$productId, 'public');
    }

    public function destroyProduct(Product $product): bool
    {
        $this->deleteImages($product->id);

        return $product->delete();
    }

    private function deleteImages(int $productId): void
    {
        Storage::disk('public')->deleteDirectory("images/products/{$productId}");
    }
}
