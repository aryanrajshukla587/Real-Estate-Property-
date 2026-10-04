<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminAuth::class,
            'agent' => \App\Http\Middleware\AgentAuth::class,
            'owner' => \App\Http\Middleware\OwnerMiddleware::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();

/*
|--------------------------------------------------------------------------
| Vercel writable runtime paths
|--------------------------------------------------------------------------
|
| Vercel's deployed filesystem is read-only except for /tmp.
| Laravel needs writable locations for runtime cache and storage.
|
*/

if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    $app->useStoragePath('/tmp/storage');
    $app->useBootstrapPath('/tmp/bootstrap');
}

return $app;