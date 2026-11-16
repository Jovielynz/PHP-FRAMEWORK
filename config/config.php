<?php
/**
 * config/config.php
 * Central application settings. Change these values to match your setup.
 */
return [
    'app' => [
        'name'     => 'NeonLoot',
        'base_url' => '/neonloot/public',            // leave empty when using "php -S localhost:8000 -t public"
        'debug'    => true,          // show error details while developing
    ],

    'database' => [
        'driver'   => 'mysql',       // mysql (or sqlite for quick local testing)
        'host'     => '127.0.0.1',
        'name'     => 'neonloot',
        'user'     => 'root',
        'password' => '',
        'sqlite_path' => __DIR__ . '/../database/neonloot.sqlite',
    ],

    // External API: free currency exchange rates (no API key needed)
    'api' => [
        'currency_url' => 'https://open.er-api.com/v6/latest/PHP',
        'timeout'      => 5,          // seconds
    ],
];
