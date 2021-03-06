<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PDO Fetch Style
    |--------------------------------------------------------------------------
    |
    | By default, database results will be returned as instances of the PHP
    | stdClass object; however, you may desire to retrieve records in an
    | array format for simplicity. Here you can tweak the fetch style.
    |
    */

    'fetch' => PDO::FETCH_CLASS,

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver'   => 'sqlite',
            'database' => database_path('database.sqlite'),
            'prefix'   => '',
        ],

        'mysql' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', 'localhost'),
            'database'  => env('DB_DATABASE', 'ais_db'),
            'username'  => env('DB_USERNAME', 'root'),
            'password'  => env('DB_PASSWORD', '010535546'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],
        'lportal' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST_PORTAL', 'localhost'),
            'database'  => env('DB_DATABASE_PORTAL', 'portal'),
            'username'  => env('DB_USERNAME_PORTAL', 'root'),
            'password'  => env('DB_PASSWORD_PORTAL', ''),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],
        
        'mysql_ais_47' => [
        'driver'    => 'mysql',
        'host'      => env('DB_HOST_47', '10.249.91.96'),
        'database'  => env('DB_DATABASE_47', 'ais'),
        'username'  => env('DB_USERNAME_47', 'ais'),
        'password'  => env('DB_PASSWORD_47', 'ais413'),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        'strict'    => false,
        ],
        'mysql_ais_813' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST_813', '10.249.91.96'),
            'database'  => env('DB_DATABASE_813', 'ais'),
            'username'  => env('DB_USERNAME_813', 'ais'),
            'password'  => env('DB_PASSWORD_813', 'ais413'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],
        'mysql_ais_fgd813' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST_FGD_813', '10.249.91.96'),
            'database'  => env('DB_DATABASE_FGD_813', 'ais'),
            'username'  => env('DB_USERNAME_FGD_813', 'ais'),
            'password'  => env('DB_PASSWORD_FGD_813', 'ais413'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],
        'mysql_ais_log_47_4' => [
        'driver'    => 'mysql',
        'host'      => env('DB_HOST_LOG_47_4', '10.249.94.232'),
        'database'  => env('DB_DATABASE_LOG_47_4', 'log04'),
        'username'  => env('DB_USERNAME_LOG_47_4', 'root'),
        'password'  => env('DB_PASSWORD_LOG_47_4', 'seven'),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        'strict'    => false,
        ],
        
        'mysql_ais_log_47_5' => [
        'driver'    => 'mysql',
        'host'      => env('DB_HOST_LOG_47_5', '10.249.94.232'),
        'database'  => env('DB_DATABASE_LOG_47_5', 'log05'),
        'username'  => env('DB_USERNAME_LOG_47_5', 'root'),
        'password'  => env('DB_PASSWORD_LOG_47_5', 'seven'),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        'strict'    => false,
        ],
        
        'mysql_ais_log_47_6' => [
        'driver'    => 'mysql',
        'host'      => env('DB_HOST_LOG_47_6', '10.249.94.232'),
        'database'  => env('DB_DATABASE_LOG_47_6', 'log06'),
        'username'  => env('DB_USERNAME_LOG_47_6', 'root'),
        'password'  => env('DB_PASSWORD_LOG_47_6', 'seven'),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        'strict'    => false,
        ],
        
        'mysql_ais_log_47_7' => [
        'driver'    => 'mysql',
        'host'      => env('DB_HOST_LOG_47_7', '10.249.94.232'),
        'database'  => env('DB_DATABASE_LOG_47_7', 'log07'),
        'username'  => env('DB_USERNAME_LOG_47_7', 'root'),
        'password'  => env('DB_PASSWORD_LOG_47_7', 'seven'),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        'strict'    => false,
        ],

        'pgsql' => [
            'driver'   => 'pgsql',
            'host'     => env('DB_HOST', 'localhost'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
        ],

        'sqlsrv' => [
            'driver'   => 'sqlsrv',
            'host'     => env('DB_HOST', 'localhost'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset'  => 'utf8',
            'prefix'   => '',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer set of commands than a typical key-value systems
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'cluster' => false,

        'default' => [
            'host'     => env('REDIS_HOST', 'localhost'),
            'password' => env('REDIS_PASSWORD', null),
            'port'     => env('REDIS_PORT', 6379),
            'database' => 0,
        ],

    ],

];
