<?php

    return [

        'driver' => env('MAIL_DRIVER', 'smtp'),

        'host' => env('MAIL_HOST', ''),

        'port' => env('MAIL_PORT', 587),

        'from' => [
            'address' => env('MAIL_FROM_ADDRESS', ''),
            'name' => env('MAIL_FROM_NAME', ''),
        ],

        'encryption' => env('MAIL_ENCRYPTION', 'tls'),

        'username' => '',

        'password' => '',

        'sendmail' => '/usr/sbin/sendmail -bs',

        'markdown' => [
            'theme' => 'default',

            'paths' => [
                resource_path('views/vendor/mail'),
            ],
        ],

        'stream' => [
            'ssl' => [
               'allow_self_signed' => true,
               'verify_peer' => false,
               'verify_peer_name' => false,
            ],
         ],

        'log_channel' => env('MAIL_LOG_CHANNEL'),

    ];
