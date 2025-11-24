<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $permission)
    {
        if (!$request->user()->hasPermission($permission) && !$request->user()->hasPermission('Administrator')) {
            abort(403, __('You do not have sufficient privileges'));
        }
        return $next($request);
    }
}
