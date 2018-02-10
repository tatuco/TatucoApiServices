<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = JWTAuth::parseToken()->authenticate();

       // Log::info($user);
        if($user->isRole($role)){
            return $next($request);
            Log::info("Usuario con rol ".$role." Accediendo...");
        }else
        return response()->json([
                'msj' => "Permiso Denegado.",
                'description' => "No tienes Acceso de ".$role
            ], 401);
    }
}
