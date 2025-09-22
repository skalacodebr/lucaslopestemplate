<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Agora.io Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Agora.io video calling service
    |
    */

    'app_id' => env('AGORA_APP_ID'),
    'app_certificate' => env('AGORA_APP_CERTIFICATE'),

    // Token expiration time in seconds (default: 1 hour)
    'token_expire_time' => env('AGORA_TOKEN_EXPIRE_TIME', 3600),

    // Channel configurations
    'channel_profile' => 'communication', // communication or live_broadcasting

    // Default user role (1: host, 2: audience)
    'default_role' => 1,

    // Video encoding configuration
    'video_config' => [
        'width' => 640,
        'height' => 480,
        'frame_rate' => 15,
        'bitrate' => 400,
    ],

    // Audio configuration
    'audio_config' => [
        'sample_rate' => 48000,
        'channels' => 1,
        'bitrate' => 48,
    ],
];