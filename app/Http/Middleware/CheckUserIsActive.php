<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckUserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->isActive()) {
            return $next($request);
        }

        Auth::logout();

        return $request->expectsJson()
            ? response()->json('User Inactive.', 401)
            : redirect('login');
    }
}
