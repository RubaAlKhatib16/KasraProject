<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Installment;
use App\Models\Store;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // إحصائيات البطاقات
        $totalStores = Store::count();
        $pendingStores = Store::where('status', 'pending')->count(); // إذا كان لديك عمود status
        $totalUsers = User::count();
        $totalTransactionsThisMonth = Order::whereMonth('created_at', now()->month)->count(); // عمليات هذا الشهر
        $overdueInstallments = Installment::where('status', 'overdue')->count();

        // آخر طلبات تسجيل المتاجر (آخر 5 متاجر)
        $recentStoreRequests = Store::with('user')->latest()->take(5)->get();

        // آخر المستخدمين المسجلين
        $recentUsers = User::latest()->take(5)->get();

        // بيانات الرسم البياني (آخر 6 أشهر)
        $months = [];
        $transactionsData = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $months[] = $month->translatedFormat('F'); // أكتوبر, نوفمبر, ...
            $count = Order::whereMonth('created_at', $month->month)
                          ->whereYear('created_at', $month->year)
                          ->count();
            $transactionsData[] = $count;
        }

        return view('admin.dashboard', compact(
            'totalStores', 'pendingStores', 'totalUsers', 'totalTransactionsThisMonth',
            'overdueInstallments', 'recentStoreRequests', 'recentUsers', 'months', 'transactionsData'
        ));
    }
}