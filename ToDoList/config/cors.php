<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default CORS Settings
    |--------------------------------------------------------------------------
    |
    | Here you can configure the default CORS settings for your application.
    | Feel free to adjust these settings based on your requirements.
    |
    */
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
