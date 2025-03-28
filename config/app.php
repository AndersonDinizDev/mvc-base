<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\UidProcessor;
use Psr\Log\LoggerInterface;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

return [
    // Configurações da aplicação
    'settings' => [
        'displayErrorDetails' => $_ENV['APP_ENV'] === 'development',
        'logErrors' => true,
        'logErrorDetails' => true,
        'logger' => [
            'name' => 'app',
            'path' => ROOT_DIR . '/storage/logs/app.log',
            'level' => \Psr\Log\LogLevel::DEBUG,
        ],
    ],

    LoggerInterface::class => function (ContainerInterface $c) {
        $settings = $c->get('settings')['logger'];

        $logger = new Logger($settings['name']);
        $logger->pushProcessor(new UidProcessor());
        $logger->pushHandler(new StreamHandler(
            $settings['path'],
            $settings['level']
        ));

        return $logger;
    },

    EntityManager::class => function (ContainerInterface $c) {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [ROOT_DIR . '/app/Models'],
            $_ENV['APP_ENV'] === 'development',
            ROOT_DIR . '/storage/cache/proxies',
            null
        );

        $connectionParams = [
            'dbname' => $_ENV['DB_DATABASE'],
            'user' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'host' => $_ENV['DB_HOST'],
            'driver' => $_ENV['DB_DRIVER'] ?? 'pdo_mysql',
        ];

        $connection = DriverManager::getConnection($connectionParams);

        return new EntityManager($connection, $config);
    },
];
