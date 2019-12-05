<?php
return [
    //...
    'default' => env('DB_CONNECTION', 'sqlite'),
    //...
    'connections' => [
        'testing_sqlite' => [
            'driver'   => 'sqlite',
            'host'      => env('DB_TEST_HOST', 'localhost'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'username'  => env('DB_TEST_USERNAME', '1h'),
            'password'  => env('DB_TEST_PASSWORD', '1h'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'   => '',
        ]
    ]
    //...
];