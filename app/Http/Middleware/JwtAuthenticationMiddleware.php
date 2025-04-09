<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JwtAuthenticationMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            // Intenta obtener el usuario autenticado
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            // Si no hay token o el token es inválido, devuelve un 401 Unauthorized
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
