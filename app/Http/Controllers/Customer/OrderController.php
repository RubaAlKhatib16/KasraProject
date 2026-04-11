<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with(['items.product.store'])
            ->latest()
            ->paginate(10);
        return view('customer.orders.index', compact('orders'));
    }

    public function show(Order $order)
{
    if ($order->user_id !== auth()->id()) abort(403);
    
    $order->load(['items.product.store', 'installments']);
    
    return view('customer.orders.show', compact('order'));
}
}
