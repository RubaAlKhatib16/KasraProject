<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Installment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // عرض صفحة الدفع مع السلة
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

    // معالجة إرسال نموذج الدفع (محاكاة)
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }

        // التحقق من صحة المدخلات
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email',
            'shipping_address' => 'required|string',
            'phone'            => 'required|string',
            'national_id'      => 'required|string',
            'payment_method'   => 'required|in:cash,card,installment',
            'notes'            => 'nullable|string',
            'id_card_image'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        // حساب إجمالي السلة
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // رفع صورة البطاقة (إن وجدت)
        $idCardPath = null;
        if ($request->hasFile('id_card_image')) {
            $idCardPath = $request->file('id_card_image')->store('id_cards', 'public');
        }

        // خطة التقسيط (نأخذها من أول منتج في السلة، أو يمكن تطويرها لتكون موحدة لكل المنتجات)
        $firstItem = reset($cart);
        $installmentPlan = $firstItem['installment_plan'] ?? 0;

        // ----- إنشاء الطلب -----
        $order = Order::create([
            'user_id'             => $user->id,
            'order_number'        => 'ORD-' . strtoupper(Str::random(10)),
            'total_amount'        => $total,
            'status'              => 'pending', // الطلب مؤكد فوراً في المحاكاة
            'shipping_address'    => $request->shipping_address,
            'phone'               => $request->phone,
            'notes'               => $request->notes,
            'installment_plan'    => $installmentPlan,
            'payment_method'      => $request->payment_method,
            'national_id'         => $request->national_id,
            'id_card_image'       => $idCardPath,
            'customer_name'       => $request->name,
            'customer_email'      => $request->email,
        ]);

        // ----- إضافة عناصر الطلب -----
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $id,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        // ----- معالجة الأقساط (محاكاة) -----
        if ($installmentPlan > 0) {
            $installmentAmount = $total / $installmentPlan; // قيمة القسط الواحد

            // ✅ القسط الأول: مدفوع تلقائياً (محاكاة)
            Installment::create([
                'order_id'  => $order->id,
                'user_id'   => $user->id,
                'amount'    => $installmentAmount,
                'due_date'  => now(),               // تاريخ الاستحقاق = اليوم
                'status'    => 'paid',              // تم دفعه
                'paid_at'   => now(),
            ]);

            // ✅ الأقساط المتبقية (pending)
            for ($i = 2; $i <= $installmentPlan; $i++) {
                Installment::create([
                    'order_id'  => $order->id,
                    'user_id'   => $user->id,
                    'amount'    => $installmentAmount,
                    'due_date'  => now()->addMonths($i - 1),
                    'status'    => 'pending',
                ]);
            }

            // تحديث حقل القسط في جدول الطلب (اختياري)
            $order->installment_amount = $installmentAmount;
            $order->first_installment_date = now()->addMonth(); // أول قسط قادم
            $order->save();
        }

        // تفريغ السلة بعد إتمام العملية
        session()->forget('cart');

        return redirect()->route('customer.orders.show', $order->id)
            ->with('success', 'تم تأكيد طلبك بنجاح (تم دفع القسط الأول تلقائياً في نظام المحاكاة).');
    }
}