<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceVendorPasswordChange
{
    public function handle(Request $request, Closure $next): Response
    {
     $vendor = auth('vendor')->user();

        if ($vendor && $vendor->must_change_password) {
            if ($request->path() !== 'vendor/change-password') {
                return redirect('/vendor/change-password');
            }
        }

        return $next($request);
    }
}
