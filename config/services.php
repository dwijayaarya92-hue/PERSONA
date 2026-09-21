<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | Here you may configure the credentials for third party services
    | such as Mailgun, Postmark, AWS and social login providers.
    |
    */


    // =====================================================
    // GOOGLE
    // =====================================================

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
    ],


    // =====================================================
    // TWITTER / X
    // =====================================================

    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID'),
        'client_secret' => env('TWITTER_CLIENT_SECRET'),
        'redirect' => env('TWITTER_REDIRECT_URI'),
    ],


    // =====================================================
    // FACEBOOK
    // =====================================================

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('FACEBOOK_REDIRECT_URI'),
    ],


    // =====================================================
    // POSTMARK
    // =====================================================

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],


    // =====================================================
    // RESEND
    // =====================================================

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],


    // =====================================================
    // AMAZON SES
    // =====================================================

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],


    // =====================================================
    // SLACK
    // =====================================================

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];