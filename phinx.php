<?php

declare(strict_types=1);

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/src/Database/Migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/src/Database/Seeders'
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_environment' => 'development',
        'production' => [
			'adapter' => 'sqlite',
			'name' => './src/Database'
        ],
        'development' => [
			'adapter' => 'sqlite',
			'name' => './src/Database'
        ],
        'testing' => [
			'adapter' => 'sqlite',
			'name' => './src/Database',
			'mode' => 'memory'
        ]
    ],
    'version_order' => 'creation'
];
