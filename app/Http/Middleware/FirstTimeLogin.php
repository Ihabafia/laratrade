<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Route;

class FirstTimeLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (null == auth()->user()->password_change_at) {
            return redirect(route('password.edit'));
        }

        return $next($request);
    }
}
