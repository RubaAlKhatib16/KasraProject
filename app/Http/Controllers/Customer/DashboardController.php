<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Store;
use App\Models\Installment; // سننشئه لاحقاً
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    // إجمالي المشتريات
    $totalSpent = Order::where('user_id', $user->id)->sum('total_amount');

    // الأقساط النشطة
    $activeInstallments = Order::where('user_id', $user->id)
        ->where('installment_plan', '>', 0)
        ->whereIn('status', ['pending', 'processing'])
        ->count();

    // آخر الطلبات
    $recentOrders = Order::where('user_id', $user->id)
        ->latest()
        ->take(5)
        ->get();

    // المتاجر
    $stores = Store::with('user')->take(8)->get();

    // ✅ الأقساط القادمة (لازم قبل return)
    $upcomingInstallments = Order::where('user_id', $user->id)
        ->where('installment_plan', '>', 0)
        ->where('first_installment_date', '>', now())
        ->orderBy('first_installment_date')
        ->take(5)
        ->get();

    // ✅ return واحد فقط
    return view('customer.dashboard', compact(
        'user',
        'totalSpent',
        'activeInstallments',
        'stores',
        'recentOrders',
        'upcomingInstallments'
    ));
}
}
