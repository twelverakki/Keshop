<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Seller
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role == 'seller') {
            return $next($request);
        }
        return abort(403);
    }
}