<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChcekRoles
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (auth()->user()->role !== $role) {
            // Redirect if the role doesn't match
            return redirect('/dashboard'); // Or wherever you'd like
        }

        return $next($request);
    }
}
