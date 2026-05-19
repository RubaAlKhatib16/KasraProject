<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $store = auth()->user()->store;
        $orders = Order::forStore($store->id)
            ->with('user')
            ->latest()
            ->paginate(10);
        return view('seller.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $store = auth()->user()->store;
        // تأكد أن الطلب يحتوي على منتجات من متجر هذا البائع
        $orderItems = $order->items()
            ->whereHas('product', function ($q) use ($store) {
                $q->where('store_id', $store->id);
            })
            ->with('product')
            ->get();

        if ($orderItems->isEmpty() && $order->items()->count() > 0) {
            abort(403, 'هذا الطلب لا يخص متجرك');
        }

        return view('seller.orders.show', compact('order', 'orderItems'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $store = auth()->user()->store;
        // التحقق من أن الطلب يخص متجر البائع
        $belongsToStore = $order->items()
            ->whereHas('product', function ($q) use ($store) {
                $q->where('store_id', $store->id);
            })->exists();

        if (!$belongsToStore) abort(403);

        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب');
    }


    
}