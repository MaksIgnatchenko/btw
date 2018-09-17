<?php

return [
    'gcm' => [
        'priority' => 'normal',
        'dry_run'  => env('GCM_SANDBOX', false),
        'apiKey'   => env('GCM_API_KEY'),
    ],
    'fcm' => [
        'priority' => 'normal',
        'dry_run'  => env('FCM_SANDBOX', false),
        'apiKey'   => env('FCM_API_KEY'),
    ],
    'apn' => [
        'certificate' => env('APN_CERTIFICATE_PATH'),
        'passPhrase'  => '',
        'passFile'    => env('APN_KEY_PATH'),
        'dry_run'     => env('APN_SANDBOX', false),
    ]
];