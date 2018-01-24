<?php

namespace App\Http\Middleware;

use Closure;

class SysAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       $user = \JWTAuth::parseToken()->authenticate();
       if ($user->SYSADMIN)
           return $next($request);
       else
           return response()->json([
                'msj' => "Permiso Denegado."
            ], 401);
    }
}
