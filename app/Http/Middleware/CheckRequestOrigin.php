<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRequestOrigin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $allowedOrigin = 'yumiis.soltriks.com';

        // Check if the Origin header matches the allowed origin
        if ($request->headers->get('origin') !== "https://$allowedOrigin") {
            return response()->json(['message' => 'Unauthorized origin'], 403);
        }

        return $next($request);
    }
}
