<?php
return [
    'settings' => [
        // comment this line when deploy to production environment
        'displayErrorDetails' => true,
        'debug_mode' => true,
        // View settings
        'view' => [
            'template_path' => __DIR__ . '/templates',
            'twig' => [
                'cache' => __DIR__ . '/../cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        // doctrine settings
        'doctrine' => [
            'meta' => [
                'entity_path' => [
                    __DIR__ . '/src/entities'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' =>  __DIR__.'/../cache/proxies',
                'cache' => null,
            ],
            'connection' => [
                'driver'   => 'pdo_mysql',
                'host'     => '127.0.0.1',
                'port'     => 3306,
                'dbname'   => 'eav_slim3_db',
                'user'     => 'root',
                'password' => 'root',
            ]
        ],

        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../log/app.log',
        ],
    ],
];
