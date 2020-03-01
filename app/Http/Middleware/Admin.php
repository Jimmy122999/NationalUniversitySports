<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Admin
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
       // return $next($request);

        if(!Auth::check()){
            return redirect()->route('login');
        }
        if (Auth::user()->user_group == 3) {
                   return redirect()->route('player');
               }

        if (Auth::user()->user_group == 2) {
                   return redirect()->route('captain');
               }


        if (Auth::user()->user_group == 1) {
                  return $next($request);
              }
    }
}
