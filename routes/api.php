<?php

declare(strict_types=1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->group('/api/v1', function (RouteCollectorProxy $group) {
        //
    });

    $app->get('/health', function ($request, $response) {
        $data = [
            'status' => 'success',
            'message' => 'API is running',
            'timestamp' => time()
        ];

        $response->getBody()->write(json_encode($data));
        return $response;
    });
};
