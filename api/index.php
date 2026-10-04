<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

try {
    $app->handleRequest(
        Illuminate\Http\Request::capture()
    );
} catch (\Throwable $e) {
    error_log($e->__toString());
    throw $e;
}