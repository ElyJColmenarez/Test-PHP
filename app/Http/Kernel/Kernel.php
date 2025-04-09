<?php
namespace App\Http\Kernel;

use App\Http\Middleware\JwtAuthenticationMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Middlewares globales (se aplican a todas las rutas).
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\HandleCors::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Grupos de middlewares para rutas web y API.
     */
    protected $middlewareGroups = [
        'api' => [
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Middlewares individuales (se aplican por nombre).
     */
    protected $routeMiddleware = [
        'jwt.auth' => JwtAuthenticationMiddleware::class,
    ];
}
