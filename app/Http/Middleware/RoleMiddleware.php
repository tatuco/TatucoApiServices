<?php

namespace App\Http\Middleware;

use App\Models\Tatuco\User;
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
       // $user = JWTAuth::parseToken()->authenticate();
        if (!JWTAuth::parseToken()->authenticate()->isRole($role)) {

              //if ($request->ajax()) {
                  return response()->json([
                      "msj" => "Permiso Denegado",
                      "description" => "necesitas rol de: ".$role
                  ],401);
              //}


          /*  return response()->json([
                "msj" => "Permiso Denegado",
                "description" => "necesitas rol de: ".$role
            ],401);*/
        }

        return $next($request);
       // Log::info($user);
      /*  echo $user->isRole($role);
        if($user->isRole($role)){
            return $next($request);
            Log::info("Usuario con rol ".$role." Accediendo...");
        }else
        return response()->json([
                'message' => "Permiso Denegado.",
                'description' => "No tienes Acceso de ".$role
            ], 401);*/
    }
}
