<?php
define('APP_ROOT', __DIR__);

$connection = include APP_ROOT . '/../database/connection.php';

return [
    'settings' => [
        'displayErrorDetails' => getenv('APP_ENV') == 'development' ? true : false,
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        'doctrine' => [
            // if true, metadata caching is forcefully disabled
            'dev_mode' => getenv('APP_ENV') == 'development' ? true : false,

            // path where the compiled metadata info will be cached
            // make sure the path exists and it is writable
            'cache_dir' => APP_ROOT . '/../cache/var/doctrine',

            // you should add any other path containing annotated entity classes
            'metadata_dirs' => [APP_ROOT . '/../src/Entities'],

            'connection' => $connection,
        ]
    ],
];
