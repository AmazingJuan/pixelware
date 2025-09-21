<?php

/*
 * ProductService.php
 * Service for managing products in the application.
 * Author: Juan Avendaño
*/

namespace App\Services;

use App\Interfaces\ImageManagement;
use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    protected ProductRepository $productRepository;

    protected ImageManagement $imageManagement;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->imageManagement = app(ImageManagement::class, ['resource' => 'products']);
    }

    /**
     * Create a new product with image handling.
     */
    public function create(array $data): Product
    {
        // Handle uploaded image
        $uploadedImage = $data['image'];
        unset($data['image']);

        // Create product and store image
        $product = $this->productRepository->create($data);
        $path = $this->imageManagement->store($uploadedImage, $product->getId());

        // Finally update product with his image path
        $this->productRepository->update(['image_url' => $path], $product);

        return $product;
    }

    /**
     * Delete a product along with its images.
     */
    public function destroy(Product $product): bool
    {
        // Delete product images directory
        $this->imageManagement->deleteDirectory($product->getId());

        // Delete product record
        $deletedProduct = $this->productRepository->delete($product);

        // Return true if deletion was successful
        if (! $deletedProduct) {
            return false;
        }

        return true;
    }

    public function update(array $data, Product $product): Product
    {
        // Handle uploaded image if exists
        if (isset($data['image'])) {
            $uploadedImage = $data['image'];
            unset($data['image']);

            // Delete old image
            $this->imageManagement->deleteDirectory($product->getId());

            // Store new image and update path
            $path = $this->imageManagement->store($uploadedImage, $product->getId());
            $data['image_url'] = $path;
        }

        // Update product record
        $this->productRepository->update($data, $product);

        return $product;
    }
}
