<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminOrPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        $user = Auth::user();

        // If user is super-admin, allow access to everything
        if ($user && $user->hasRole('super-admin')) {
            return $next($request);
        }

        // Otherwise, check for the required permission
        if ($user && $user->can($permission)) {
            return $next($request);
        }

        // If neither super-admin nor has permission, deny access
        abort(403, 'Unauthorized');
    }
}
