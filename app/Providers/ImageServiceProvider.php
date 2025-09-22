<?php

namespace App\Providers;

use App\Interfaces\ImageManagement;
use App\Utils\ProductImageManagement;
use Illuminate\Support\ServiceProvider;

// use App\Utils\UserImageManagement;
// use App\Utils\CategoryImageManagement;

class ImageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind the ImageManagement interface to specific implementations based on resource type
        $this->app->bind(ImageManagement::class, function ($app, $params) {

            // Gather resource type from parameters
            $resource = $params['resource'] ?? null;

            // Return the appropriate image management instance based on resource type
            if ($resource === 'products') {
                return new ProductImageManagement;
            }
        });
    }

    public function boot(): void
    {
        //
    }
}
