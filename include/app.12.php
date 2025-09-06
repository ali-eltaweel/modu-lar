<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return function(string $basePath) {

    $app = Application::configure(basePath: $basePath)
                      ->withMiddleware(function (Middleware $middleware): void {})
                      ->withExceptions(function (Exceptions $exceptions): void {})
                      ->create();

    $app->singleton(
        Illuminate\Contracts\Console\Kernel::class,
        Modular\Console\Kernel::class
    );

    $app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Modular\Exceptions\Handler::class
);

    return $app;
};
