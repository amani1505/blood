<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->role == 'HOSPITAL_ADMIN' || auth()->user()->role == 'CENTRAL_ADMIN'  )
            return $next($request);
        return redirect('/');
    }
}
