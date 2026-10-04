<?php

$vercel = getenv('VERCEL') || isset($_SERVER['VERCEL']) || isset($_ENV['VERCEL']);

if ($vercel) {
    $storagePath = '/tmp/storage';
    $bootstrapPath = '/tmp/bootstrap';

    if (!is_dir($storagePath)) {
        mkdir($storagePath, 0777, true);
    }

    if (!is_dir($bootstrapPath)) {
        mkdir($bootstrapPath, 0777, true);
    }

    if (!is_dir($storagePath . '/logs')) {
        mkdir($storagePath . '/logs', 0777, true);
    }

    if (!is_dir($storagePath . '/framework/views')) {
        mkdir($storagePath . '/framework/views', 0777, true);
    }

    if (!is_dir($storagePath . '/framework/cache')) {
        mkdir($storagePath . '/framework/cache', 0777, true);
    }

    putenv('APP_CONFIG_CACHE=' . $bootstrapPath . '/config.php');
    putenv('APP_EVENTS_CACHE=' . $bootstrapPath . '/events.php');
    putenv('APP_PACKAGES_CACHE=' . $bootstrapPath . '/packages.php');
    putenv('APP_ROUTES_CACHE=' . $bootstrapPath . '/routes.php');
    putenv('APP_SERVICES_CACHE=' . $bootstrapPath . '/services.php');
    putenv('VIEW_COMPILED_PATH=' . $storagePath . '/framework/views');
    putenv('LOG_CHANNEL=stderr');
    putenv('CACHE_STORE=array');
    putenv('SESSION_DRIVER=cookie');
}

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

if ($vercel) {
    $app->useStoragePath('/tmp/storage');
    $app->useBootstrapPath('/tmp/bootstrap');
}

try {
    $app->handleRequest(
        Illuminate\Http\Request::capture()
    );
} catch (\Throwable $e) {
    error_log($e->__toString());
    throw $e;
}