<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIsAdminRoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Kalau user bukan admin
        if (!$user->isadmin) {
            // Larang akses ke route /admin/*
            if ($request->is('admin') || $request->is('admin/*')) {
                abort(403, 'Forbidden');
            }

            // Kalau bukan admin dan aksesnya bukan /admin, tetap jalan
            return $next($request);
        }

        // Kalau user adalah admin
        if ($user->isadmin) {
            // Larang akses ke route /student/*
            if ($request->is('student') || $request->is('student/*')) {
                abort(403, 'Forbidden');
            }
        }

        return $next($request);
    }
}
