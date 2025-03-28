<?php

declare(strict_types=1);

use App\Middleware\CorsMiddleware;
use App\Middleware\JsonResponseMiddleware;
use Slim\App;

return function (App $app) {
    $app->addBodyParsingMiddleware();

    $app->add(CorsMiddleware::class);

    $app->add(JsonResponseMiddleware::class);

    $errorMiddleware = $app->addErrorMiddleware(
        $_ENV['APP_ENV'] === 'development',
        true,
        true
    );

    $errorHandler = $errorMiddleware->getDefaultErrorHandler();
    $errorHandler->forceContentType('application/json');

    return $app;
};
