<?php

namespace App\Http\Middleware;

use App\Models\User;
use Caffeinated\Shinobi\Models\Role;
use Closure;
use Illuminate\Support\Facades\Auth;
use DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions)
    {
        if (1==1) {
            if (!JWTAuth::parseToken()->authenticate()->can($permissions)) {
             //   if ($request->ajax()) {
                    return response()->json([
                        'status'=> false,
                        'message' => 'no tienes permiso para => '.$permissions
                    ],403);
               // }
            }
        } else {
            $guest = Role::whereSlug('guest')->first();

            if ($guest) {
                if (!$guest->can($permissions)) {
                    if ($request->ajax()) {
                        return response('Unauthorized.', 403);
                    }

                    abort(403, 'Unauthorized action.');
                }
            }
        }

        return $next($request);
        /*
       echo $user = JWTAuth::parseToken()->authenticate();

        $roles = DB::table('roles as r')
            ->join('role_user as ru','r.id','=','ru.role_id')
            ->select('r.slug','r.id')
            ->where('ru.user_id','=', $user->id)->get();
        //$user = User::find(1);

        echo "query".$roles;
       //echo $user = User::find(1)->roles();
        if ($user) {
            if($roles){
                foreach ($roles as $role) {
                    $r = Role::whereSlug($role->slug);
                    echo $role;
                        if(!$r->can($permissions)){
                            return response()->json([
                                "msj" => "No autorizado",
                                "description" => "No tienes permiso para ".$permissions
                            ],403);
                        }else
                            return $next($request);
                }
            }
       /*     if (!$user->user()->can($permissions)) {
                if ($request->ajax()) {
                    return response('Unauthorized.', 403);
                }

                abort(403, 'Unauthorized action.');
            }*/
       /* } else {
            $guest = Role::whereSlug('guest')->first();

            if ($guest) {
                if (!$guest->can($permissions)) {
                    if ($request->ajax()) {
                        return response('Unauthorized.', 403);
                    }

                    abort(403, 'Unauthorized action.');
                }
            }
        }
*/
    }
}
