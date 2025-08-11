<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\LogRequestMiddleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // give alis Middleware  to permissions
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);

        //  add Middleware to all orders
        $middleware->append(LogRequestMiddleware::class); //both
        // $middleware->web(LogRequestMiddleware::class);// only web
        // $middleware->api(LogRequestMiddleware::class); // only api
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //    to handle  NotFoundHttpException error
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return \App\Helpers\ApiResponse::error("error", $e->getMessage(), 404);
            }
        });

        // to handle ThrottleRequestsException error
        $exceptions->render(function (ThrottleRequestsException $e, Request $request) {
            if ($request->is('api/*')) {
                return \App\Helpers\ApiResponse::error("error", $e->getMessage(), 429);
            }
        });
    })
    ->create();


