<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Session expired or user never logged in
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'No autenticado. Sesión expirada.'], 401);
            }

            return redirect()->route('admin.login')
                ->with('error', 'Tu sesión ha expirado. Por favor inicia sesión nuevamente.');
        }

        // Logged in but not an admin
        if (!auth()->user()->is_admin) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Acceso denegado.'], 403);
            }

            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('error', 'No tienes permisos para acceder al panel de administración.');
        }

        return $next($request);
    }
}