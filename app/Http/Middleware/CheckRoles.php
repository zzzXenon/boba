<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoles
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $auth = Auth::user();

        // Redirect unauthenticated users to the login page
        if (!$auth) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melanjutkan.');
        }

        // Convert user role and allowed roles to lowercase for comparison
        $userRole = strtolower($auth->role);
        $allowedRoles = array_map('strtolower', $roles);

        // Check if the user role is allowed
        if (!in_array($userRole, $allowedRoles)) {
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
