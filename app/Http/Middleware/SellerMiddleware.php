<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            abort(403, 'يجب تسجيل الدخول أولاً.');
        }

        if (Auth::user()->role !== 'seller') {
            abort(403, 'غير مصرح لك بالدخول. هذه الصفحة مخصصة للتجار فقط.');
        }

        return $next($request);
    }
}