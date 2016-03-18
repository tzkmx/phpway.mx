<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../src/app.php';
require __DIR__  . '/../app/config/dev.php';
require_once __DIR__ . '/../src/controller.php';

$app->run();

