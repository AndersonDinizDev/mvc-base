<?php

declare(strict_types=1);

define('ROOT_DIR', dirname(__DIR__));

require ROOT_DIR . '/vendor/autoload.php';

$app = require ROOT_DIR . '/bootstrap/app.php';

$app->run();
