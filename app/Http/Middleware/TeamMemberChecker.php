<?php

namespace App\Http\Middleware;
use Auth;
use App\TeamMember;
use App\Team;
use Closure;

class TeamMemberChecker
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
        if (Auth::user()->member()->team_id == ) {
                   dd('hello');
               }


        else {
                  return $next($request);
              }
    }
}
