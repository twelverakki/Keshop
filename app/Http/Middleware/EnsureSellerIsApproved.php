<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureSellerIsApproved
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->role === 'seller') {
            if (is_null($user->email_verified_at)) {
                if (!$request->routeIs('seller.pending') && !$request->routeIs('logout') && !$request->routeIs('profile.destroy')) {
                    return redirect()->route('seller.pending');
                }
            }
        }

        return $next($request);
    }
}