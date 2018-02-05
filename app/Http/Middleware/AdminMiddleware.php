<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        $user = Auth::user();
        // Log::info($user);
        if($user->level() == 2 || $user->level() ==1){
            return $next($request);
            //   Log::info("sysadmin logeado");
        }else
            return response()->json([
                'msj' => "Permiso Denegado.",
                'description' => "No tienes Acceso de Admin"
            ], 401);
    }
}
