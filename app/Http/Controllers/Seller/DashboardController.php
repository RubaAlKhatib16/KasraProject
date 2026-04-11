<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $store = $user->store;

        // عدد المنتجات
        $productsCount = Product::where('store_id', $store->id)->count();

        // عدد الطلبات التي تحتوي على منتجات من هذا المتجر
        $ordersCount = Order::whereHas('items.product', function ($q) use ($store) {
            $q->where('store_id', $store->id);
        })->count();

        // إجمالي المبيعات (مجموع total_amount للطلبات التي تحتوي على منتجات من هذا المتجر)
        $totalSales = Order::whereHas('items.product', function ($q) use ($store) {
            $q->where('store_id', $store->id);
        })->sum('total_amount');

        // الطلبات الجديدة (قيد المعالجة أو معلقة)
        $newOrdersCount = Order::whereIn('status', ['pending', 'processing'])
            ->whereHas('items.product', function ($q) use ($store) {
                $q->where('store_id', $store->id);
            })->count();

        // آخر 5 طلبات
        $recentOrders = Order::with('user')
            ->whereHas('items.product', function ($q) use ($store) {
                $q->where('store_id', $store->id);
            })
            ->latest()
            ->limit(5)
            ->get();

        // المنتجات الأكثر مبيعاً (حسب عدد مرات البيع من order_items)
        $topProducts = Product::where('store_id', $store->id)
            ->withCount(['orderItems as sold_count' => function ($q) {
                $q->select(DB::raw('SUM(quantity)'));
            }])
            ->orderBy('sold_count', 'desc')
            ->limit(4)
            ->get();

        // بيانات الرسم البياني (آخر 7 أيام) - تجميع المبيعات اليومية
        $chartLabels = [];
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $chartLabels[] = now()->subDays($i)->translatedFormat('D'); // الأحد، الاثنين...
            $dailyTotal = Order::whereDate('created_at', $date)
                ->whereHas('items.product', function ($q) use ($store) {
                    $q->where('store_id', $store->id);
                })
                ->sum('total_amount');
            $chartData[] = (float) $dailyTotal;
        }

        return view('seller.dashboard', compact(
            'user',
            'store',
            'productsCount',
            'ordersCount',
            'totalSales',
            'newOrdersCount',
            'recentOrders',
            'topProducts',
            'chartLabels',
            'chartData'
        ));
    }
}
