<?php

return [
    'default' => [
        'driver' => 'mysql',

        'port' => 3306,
        'host' => '10.1.11.166',
        'database' => 'putao_mall',
        'username' => 'root',
        'password' => '123456',

        'prefix' => 'mall_',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ],
    'postgresql' => [
        'order' => [
//            'host' => 'localhost',

            'host' => '10.1.11.166',

            'dbname' => 'putao_store',
            'port' => 5432,
            'username' => 'postgres',
            'password' => '1',
            'prefix' => 'mall_',
        ],

    ],
    'booking' => [
        'host' => '10.1.11.15',
        'dbname' => 'putao_booking',
        'port' => 3306,
        'username' => 'putao_booking',
        'password' => 'mqXNGJ3aREiDI',
        'prefix' => 'pt_',
        'charset' => 'utf8'

    ],
];
