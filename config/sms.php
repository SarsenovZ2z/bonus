<?php

return [

    'default_driver' => 'smsc',

    'drivers' => [
        'smsc' => [
            'class'         => App\Services\Sms\Drivers\Smsc\Smsc::class,

            'url'           => 'https://smsc.kz/sys/send.php',

            'login'         => env('SMSC_LOGIN'),
            'password'      => env('SMSC_PASSWORD'),

            // Optional
            'from'          => env('SMSC_FROM'),
            'time'          => 0,
        ],
    ],

];
