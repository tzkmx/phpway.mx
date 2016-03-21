<?php

require __DIR__ . '/prod.php';

if(!defined('APPLICATION_ENV')) {
    $app['debug'] = true;
}

