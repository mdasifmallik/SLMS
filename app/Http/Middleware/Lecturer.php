<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Lecturer
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
        $user= Auth::user();



        if (!$user->lecturer()) {

            return redirect()->intended('/student_dash');
        }

        return $next($request);
    }
}
