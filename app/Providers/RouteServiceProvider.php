<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    // هذا هو الثابت الذي يحتاجه الكود لتحديد مسار إعادة التوجيه
    public const HOME = '/';

    // ... (يمكن إضافة باقي الكود الخاص بتحميل routes/api.php و routes/web.php إن احتجت إليه)
}