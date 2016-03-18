<?php

$root = __DIR__ . '/../..';

$app['monolog.logfile'] = $root . '/var/logs/silex.log';
$app['http_cache.cache_dir'] = $root . '/var/cache/http';
$app['http_cache.esi'] = null;

$app['twig.path'] = [ $root . '/app/templates'];

