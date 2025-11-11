<?php

namespace App\Utils;

use App\Utils\LocalImageStorage;
use App\Utils\GcpImageStorage;
use App\Interfaces\ImageStorageInterface;

class StorageUtils
{
    public static function getDriverInstance(string $driver): ImageStorageInterface
    {
        return match ($driver) {
            'gcp' => new GcpImageStorage(),
            default => new LocalImageStorage(),
        };
    }

    /**
     * Intenta eliminar una ruta/proveedor probando primero local, luego gcp.
     * Devuelve true si alguno la borró.
     */
    public static function deleteAny(string $pathOrUrl): bool
    {
        try {
            $local = new LocalImageStorage();
            if ($local->delete($pathOrUrl)) {
                return true;
            }
        } catch (\Throwable $e) {
            
        }

        try {
            $gcp = new GcpImageStorage();
            if ($gcp->delete($pathOrUrl)) {
                return true;
            }
        } catch (\Throwable $e) {

        }

        return false;
    }
}
