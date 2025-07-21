<?php
// app/Http/Middleware/AdminRole.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRole
{
    public function handle(Request $request, Closure $next)
{
    
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the user has the 'delivery' role
            if ($user->role === 'delivery') {
                // Redirect to the 'new.orders' route if the user is a delivery person
                return redirect()->route('orders.new');
            }
        }

        // Check if the authenticated user has the role of 'admin'
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }

        // Redirect or abort if not authorized
        abort(403, 'Unauthorized action.');
    }
}
