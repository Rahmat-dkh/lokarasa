<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        // Log visit if not already logged today
        if (!\App\Models\Visit::where('ip_address', $ip)->whereDate('created_at', now()->today())->exists()) {
            \App\Models\Visit::create([
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
            ]);
        }

        return $next($request);
    }
}
