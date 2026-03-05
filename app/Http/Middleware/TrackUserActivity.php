<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Only update if last_active is null or older than 5 minutes
            if ($user->last_active === null || $user->last_active->diffInMinutes(now()) >= 5) {
                $user->update(['last_active' => now()]);
            }
        }

        return $next($request);
    }
}
