<?php

use Illuminate\Support\Str;

return [

    'default' => env('DB_CONNECTION', 'oracle'),

    'connections' => [

        'oracle' => [
            'driver'         => 'oracle',
            'tns'            => env('DB_TNS', ''),
            'host'           => env('DB_HOST', 'mdcolmeia.c2pptmzdfbsb.us-east-1.rds.amazonaws.com'),
            'port'           => env('DB_PORT', '1521'),
            'database'       => env('DB_DATABASE', 'ORCL'),
            'username'       => env('DB_USERNAME', 'lj'),
            'password'       => env('DB_PASSWORD', 'L0j416'),
            'charset'        => env('DB_CHARSET', 'AL32UTF8'),
            'prefix'         => '',
            'prefix_schema'  => env('DB_SCHEMA_PREFIX', ''),
            'edition'        => env('DB_EDITION', 'ora$base'),
            'server_version' => env('DB_SERVER_VERSION', '11g'),
        ],

    ],

    'migrations' => 'migrations',

];
