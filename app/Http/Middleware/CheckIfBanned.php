<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckIfBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check() && Auth::user()->banned) {
            // Optionally, you can log out the user or redirect to a specific page
Auth::guard('web')->logout();
            
            // Redirect the user to the 'banned' page or any route you choose
            return redirect()->route('login')->with('message',"You do not have access");
        }

        return $next($request);

    }
}
