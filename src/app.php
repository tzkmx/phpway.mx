<?php

use Silex\Application;

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;

$app = new Application();

$app->register(new TwigServiceProvider());
$app->register(new MonologServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new HttpCacheServiceProvider());
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());

return $app;

