<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateOnceWithBasicAuth
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next, $guard = null, $field = null)
     {
         if ($guard) {
             Auth::shouldUse($guard);
         }

         return Auth::onceBasic($field ?: 'email') ?: $next($request);
     }

}
