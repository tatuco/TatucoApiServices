<?php
/**
 * Created by PhpStorm.
 * User: zippyttech
 * Date: 12/01/18
 * Time: 03:10 PM
 */

namespace App\Http\Middleware;


use Closure;
class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request
     * @param \Closure
    $request
    $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->get('access_token')) {
          $token = $request->get('access_token');
            header('Authorization: Bearer ' . $token);
        }

        $trusted_domains = ["http://localhost:4200", "http://localhost:8000"];
        if(isset($request->server()['HTTP_ORIGIN'])) {
            $origin = $request->server()['HTTP_ORIGIN'];
            if (in_array($origin, $trusted_domains)) {

                header('Access-Control-Allow-Origin: ' . $origin);
                // header('Access-Control-Allow-Headers: Origin, Content-Type, Content-Type, X-XSRF-TOKEN');
                header('Access-Control-Allow-Headers: *');



            }
        }
        return $next($request);
    }
}
