<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    // public function handle($request, Closure $next, $guard = null)
    // {
    //     // dd($request->all(), $next, $guard, Auth::guard($guard)->check());
    //     if (Auth::guard($guard)->guest()) 
    //     {
    //         return redirect()->route('login');
    //         $this->redirectTo($request);
    //     }

    //     return $next($request);
    // }


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // dd($request->expectsJson());
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
