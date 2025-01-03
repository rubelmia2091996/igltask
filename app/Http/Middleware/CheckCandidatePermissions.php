<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCandidatePermissions
{
    public function handle(Request $request, Closure $next)
    {
        // Get the route name
        $routeName = $request->route()->getName();

        // Check if the user has the required permission for this route
        if (!auth()->user()->can($routeName)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
