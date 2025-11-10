<?php

namespace App\Utils;

use App\Interfaces\ImageStorageInterface;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class GcpImageStorage implements ImageStorageInterface
{
    protected StorageClient $client;

    protected string $bucketName;

    public function __construct()
    {
        $gcp = config('image_storage.gcp', []);
        $options = [];

        if (! empty($gcp['key_file'])) {
            $options['keyFilePath'] = base_path($gcp['key_file']);
        }

        if (! empty($gcp['project_id'])) {
            $options['projectId'] = $gcp['project_id'];
        }

        $this->client = new StorageClient($options);
        $this->bucketName = $gcp['bucket'] ?? env('GCP_BUCKET');
    }

    public function store(UploadedFile $file, string $folder = ''): string
    {
        $folder = trim($folder ?: config('image_storage.local_path', 'products'), '/');
        $filename = now()->format('YmdHis').'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
        $objectName = ($folder ? $folder.'/' : '').$filename;

        $bucket = $this->client->bucket($this->bucketName);
        if (! $bucket->exists()) {
            throw new \RuntimeException("El bucket {$this->bucketName} no existe en GCP.");
        }

        $stream = fopen($file->getPathname(), 'r');
        $object = $bucket->upload($stream, [
            'name' => $objectName,
        ]);

        $publicUrl = sprintf('https://storage.googleapis.com/%s/%s', $this->bucketName, $objectName);

        return $publicUrl;
    }

    public function delete(string $pathOrUrl): bool
    {
        $objectName = $pathOrUrl;

        $pattern = sprintf('/storage\.googleapis\.com\/%s\/(.+)$/', preg_quote($this->bucketName, '/'));
        if (preg_match($pattern, $pathOrUrl, $m)) {
            $objectName = $m[1];
        } else {
            if (str_starts_with($pathOrUrl, 'http')) {
                $parts = parse_url($pathOrUrl);
                $objectName = ltrim($parts['path'] ?? '', '/');

                if (str_starts_with($objectName, $this->bucketName.'/')) {
                    $objectName = substr($objectName, strlen($this->bucketName) + 1);
                }
            }
        }

        $bucket = $this->client->bucket($this->bucketName);
        $object = $bucket->object($objectName);
        if ($object->exists()) {
            $object->delete();

            return true;
        }

        return false;
    }
}
