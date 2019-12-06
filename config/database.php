<?php
return [
    //...
    'default' => env('DB_CONNECTION', 'pgsql'),
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
        ],

        'pgsql' => [
            'driver'   => 'pgsql',
            'host'      => env('DB_HOST', 'ec2-174-129-255-39.compute-1.amazonaws.com'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'd45kvutj881cij'),
            'username'  => env('DB_USERNAME', 'woxwuwmassmidl'),
            'password'  => env('DB_PASSWORD', '5940ed635ea30d5b2ebfb1b004c2c41333e84a8e84be76c9678d550d9d524f41'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'   => '',
        ]
    ]
    //...
];