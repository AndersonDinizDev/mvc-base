<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(ROOT_DIR);
$dotenv->load();


$environment = $_ENV['APP_ENV'] ?? 'development';
$displayErroDetails = $environment === 'development';

$definitions = require ROOT_DIR . '/config/app.php';

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions($definitions);

if ($environment === 'production') {
    $containerBuilder->enableCompilation(ROOT_DIR . '/storage/cache');
}

$container = $containerBuilder->build();

AppFactory::setContainer($container);
$app = AppFactory::create();


$middleware = require ROOT_DIR . '/config/middleware.php';
$middleware($app);

$routes = require ROOT_DIR . '/routes/api.php';
$routes($app);

return $app;
