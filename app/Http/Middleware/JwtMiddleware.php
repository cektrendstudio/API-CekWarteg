<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware extends BaseMiddleware
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


        if(empty($request->header('Authorization'))){
            return response()->json([
                'isSuccess' => false,
                'messages'  => "Please input token!"
            ],403);
        }
        if(!auth('api')->check()){
            return response()->json([
                'isSuccess' => false,
                'messages'  => "Please Login!"
            ],403);
        }
        return $next($request);
    }
}
