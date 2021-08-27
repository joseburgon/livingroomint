<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'payu' => [
        'url' => env('PAYU_URL'),
        'key' => env('PAYU_API_KEY'),
        'merchant' => env('PAYU_MERCHANT_ID'),
        'account' => env('PAYU_ACCOUNT_ID'),
        'login' => env('PAYU_LOGIN_ID'),
        'response_url' => env('PAYU_RESPONSE_URL'),
        'confirmation_url' => env('PAYU_CONFIRMATION_URL'),
    ],

];
