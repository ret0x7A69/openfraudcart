<?php

    return [

        'reset' => [
            'password' => [
                'subject' => 'Reset Password',
                'line' => 'You received this email because we received a password reset request for your account.',
                'button' => 'Reset',
                'warning' => 'If you did not request a password reset, no further action is required.',
            ],
        ],

        'footer' => [
            'all_rights_reserved' => 'All rights reserved.',
        ],

        'account_created' => [
            'subject' => 'Your registration',
            'text' => 'Thank you for registering with :appname!',
            'button' => 'My Account',
            'panel' => 'Name: :name (@:username)',
        ],

        'whoops' => 'Ooops!',
        'hello' => 'Hello',
        'hello_name' => 'Hello, :name',

        'regards' => 'Yours sincerely,',
        'action_text' => 'If you have problems click the button: ":actionText". Copy the URL below and paste it into your web browser: [:actionURL](:actionURL)',

    ];
