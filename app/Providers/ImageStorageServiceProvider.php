<?php

namespace App\Providers;

use App\Interfaces\ImageStorageInterface;
use App\Utils\GcpImageStorage;
use App\Utils\LocalImageStorage;
use Illuminate\Support\ServiceProvider;

class ImageStorageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ImageStorageInterface::class, function ($app, $params) {
            $storageDriver = $params['storage_driver'];

            if ($storageDriver == 'gcp') {
                return new GcpImageStorage;
            } else {
                return new LocalImageStorage;
            }
        });
    }

    public function boot()
    {
        //
    }
}
