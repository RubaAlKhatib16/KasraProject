<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Installment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'سلة التسوق فارغة');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('client.checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $request->validate([
            'shipping_address' => 'required|string',
            'phone' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $user = auth()->user();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // خطة التقسيط: نأخذ خطة أول منتج في السلة (يمكن تعديلها لتناسب منتجات متعددة)
        $firstItem = reset($cart);
        $installmentPlan = $firstItem['installment_plan'] ?? 0;

        // إنشاء الطلب
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . strtoupper(Str::random(10)),
            'total_amount' => $total,
            'status' => 'pending',
            'shipping_address' => $request->shipping_address,
            'phone' => $request->phone,
            'notes' => $request->notes,
            'installment_plan' => $installmentPlan,
        ]);

        // حساب قيمة القسط الشهري إذا كان هناك تقسيط
        if ($installmentPlan > 0) {
            $installmentAmount = $total / $installmentPlan;
            $order->installment_amount = $installmentAmount;
            $order->first_installment_date = now()->addMonth();
            $order->save();

            // إنشاء سجلات الأقساط
            for ($i = 1; $i <= $installmentPlan; $i++) {
                Installment::create([
                    'order_id' => $order->id,
                    'user_id' => $user->id,
                    'amount' => $installmentAmount,
                    'due_date' => now()->addMonths($i),
                    'status' => 'pending',
                ]);
            }
        }

        // إضافة عناصر الطلب
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // تفريغ السلة
        session()->forget('cart');

        return redirect()->route('customer.orders.show', $order)
            ->with('success', 'تم إتمام الطلب بنجاح');
    }
}