<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        // Para APIs, no redirigir (retornar null)
        return $request->expectsJson() ? null : response()->json(['error' => 'Unauthorized'], 401);
    }
}
