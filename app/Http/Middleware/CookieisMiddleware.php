<?php

namespace App\Http\Middleware;

use Closure;

class CookieisMiddleware
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
        //var_dump($request->input('nickname'));die;
        if(!$request->input('nickname')){
            $check_request = '请登录';
            $request->attributes->add(compact('check_request'));
        }
        return $next($request);
    }
}
