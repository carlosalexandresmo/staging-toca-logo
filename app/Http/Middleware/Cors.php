<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
        header('Access-Control-Allow-Origin: "http://localhost:4200"');
        //header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        //header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization');
        return $next($request);
    }
}
