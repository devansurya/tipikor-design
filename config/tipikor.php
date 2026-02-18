<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tipikor External API Configuration
    |--------------------------------------------------------------------------
    |
    | Credentials and base URL for the Tipikor reporting API.
    |
    */

    'api' => [
        'base_url'  => env('TIPIKOR_API_BASE_URL', 'https://api.example.com'),
        'email'     => env('TIPIKOR_API_EMAIL'),
        'password'  => env('TIPIKOR_API_PASSWORD'),
        'site_id'   => env('TIPIKOR_API_SITE_ID'),
    ],

];
