<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\ImageStorageInterface;
use App\Utils\LocalImageStorage;
use App\Utils\GcpImageStorage;

class ImageStorageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ImageStorageInterface::class, function ($app) {
            $driver = config('image_storage.driver', env('IMAGE_STORAGE_DRIVER', 'local'));

            return match ($driver) {
                'gcp' => new GcpImageStorage(),
                default => new LocalImageStorage(),
            };
        });
    }

    public function boot()
    {
        //
    }
}
