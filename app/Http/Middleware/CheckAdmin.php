<?php

/*
 * CheckAdmin.php
 * Middleware for checking if the user is an admin.
 * Author: Santiago Manco
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (! auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}
