<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string $roles
     * @return Response
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if (!Auth::check()) {
            abort(403, 'Unauthorized access');
        }
        
        // Split roles by comma and check if user has at least one
        $allowedRoles = array_map('trim', explode(',', $roles));
        
        $hasRole = false;
        foreach ($allowedRoles as $role) {
            if ($user->hasRole($role)) {
                $hasRole = true;
                break;
            }
        }
        
        if (!$hasRole) {
            abort(403, 'Unauthorized access');
        }
        
        return $next($request);
    }
}

