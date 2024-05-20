<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Cache\RateLimiter;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        // Rate Limiting Implementation
        $maxAttempts = 5; // Maximum number of attempts
        $decayMinutes = 1; // Lockout time in minutes

        $throttleKey = $request->ip();
        $limiter = app(RateLimiter::class);

        if ($limiter->tooManyAttempts($throttleKey, $maxAttempts)) {
            return response()->json(['message' => 'Too many login attempts. Please try again later.'], 429);
        }

        $limiter->hit($throttleKey, $decayMinutes * 60);

        // Cache Authenticated User
        $user = Cache::remember('auth_user_' . $guard . '_' . $request->ip(), 60, function () use ($guard) {
            return Auth::guard($guard)->user();
        });

        if ($user && Auth::guard('admin')->check()) {
            return redirect(RouteServiceProvider::ADMIN_DASHBOARD);
        }

        if ($user) {
            return redirect(RouteServiceProvider::HOME);
        }
        // Add logging
        if ($user) {
            Log::info('User authenticated', ['user_id' => $user->id, 'guard' => $guard, 'ip' => $request->ip()]);
        }

        return $next($request);
    }
}
