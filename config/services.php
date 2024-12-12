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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'theguardian' => [
        'key' => env('THEGUARDIAN_API_KEY', ''),
        'source' => 'The Guardian',
        'url' => 'https://content.guardianapis.com',
    ],

    'newsapi' => [
        'key' => env('NEWSAPI_API_KEY', ''),
        'source' => 'NewsAPI',
        'url' => 'https://newsapi.org/v2',
    ],

    'nytimes' => [
        'key' => env('NYTIMES_API_KEY', ''),
        'source' => 'NY Times',
        'url' => 'https://api.nytimes.com/svc/search/v2'
    ],
];
