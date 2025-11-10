<?php

return [
    'driver' => env('IMAGE_STORAGE_DRIVER', 'local'),

    // Config almacenamiento local
    'local_disk' => env('LOCAL_DISK', 'public'),
    'local_path' => env('LOCAL_IMAGE_PATH', 'products'),

    // Config GCP
    'gcp' => [
        'project_id' => env('GCP_PROJECT_ID', null),
        'key_file' => env('GCP_KEY_FILE', storage_path('app/gcp-key.json')),
        'bucket' => env('GCP_BUCKET', null),
    ],
];
