<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Installment;
use App\Models\Product;
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
            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }

        // ===== Validation =====
        $rules = [
            'name'             => 'required|string|max:255',
            'email'            => 'required|email',
            'shipping_address' => 'required|string',
            'phone'            => 'required|string',
            'national_id'      => 'required|string',
            'payment_method'   => 'required|in:cash,card,installment',
            'notes'            => 'nullable|string',
            'id_card_image'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        // حقول الفيزا مطلوبة فقط لو الدفع بالبطاقة أو التقسيط
        if (in_array($request->payment_method, ['card', 'installment'])) {
            $rules['card_number'] = 'required|string';
            $rules['card_holder'] = 'required|string|max:100';
            $rules['card_expiry'] = 'required|string';
            $rules['card_cvv']    = 'required|string|min:3|max:4';
        }

        $request->validate($rules, [
            'card_number.required' => 'رقم البطاقة مطلوب',
            'card_holder.required' => 'اسم حامل البطاقة مطلوب',
            'card_expiry.required' => 'تاريخ الانتهاء مطلوب',
            'card_cvv.required'    => 'رمز CVV مطلوب',
        ]);

        $user = Auth::user();

        // حساب إجمالي السلة
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // رفع صورة البطاقة الشخصية
        $idCardPath = null;
        if ($request->hasFile('id_card_image')) {
            $idCardPath = $request->file('id_card_image')->store('id_cards', 'public');
        }

        $firstItem       = reset($cart);
        $installmentPlan = $firstItem['installment_plan'] ?? 0;

        // ===== تحديد حالة الطلب حسب طريقة الدفع =====
        // cash       → pending  (ينتظر التوصيل)
        // card       → processing (محاكاة: اعتبرنا الدفع نجح فوراً)
        // installment→ processing (محاكاة: القسط الأول دُفع)
        $status = match($request->payment_method) {
            'card', 'installment' => 'processing',
            default               => 'pending',
        };

        // ===== إنشاء الطلب =====
        $order = Order::create([
            'user_id'             => $user->id,
            'order_number'        => 'ORD-' . strtoupper(Str::random(10)),
            'total_amount'        => $total,
            'status'              => $status,
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

        // ===== عناصر الطلب + خصم المخزون =====
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $id,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);

            Product::where('id', $id)
                ->where('stock', '>', 0)
                ->decrement('stock', $item['quantity']);
        }

        // ===== معالجة الأقساط (لو الدفع تقسيط) =====
        if ($installmentPlan > 0 && $request->payment_method === 'installment') {
            $installmentAmount = $total / $installmentPlan;

            // القسط الأول — محاكاة: مدفوع فوراً بالبطاقة
            Installment::create([
                'order_id' => $order->id,
                'user_id'  => $user->id,
                'amount'   => $installmentAmount,
                'due_date' => now(),
                'status'   => 'paid',
                'paid_at'  => now(),
            ]);

            // باقي الأقساط
            for ($i = 2; $i <= $installmentPlan; $i++) {
                Installment::create([
                    'order_id' => $order->id,
                    'user_id'  => $user->id,
                    'amount'   => $installmentAmount,
                    'due_date' => now()->addMonths($i - 1),
                    'status'   => 'pending',
                ]);
            }

            $order->installment_amount     = $installmentAmount;
            $order->first_installment_date = now()->addMonth();
            $order->save();
        }

        // تفريغ السلة
        session()->forget('cart');

        // ===== رسالة النجاح حسب طريقة الدفع =====
        $successMessage = match($request->payment_method) {
            'card'        => 'تم الدفع بالبطاقة بنجاح! طلبك قيد المعالجة.',
            'installment' => 'تم تأكيد التقسيط! دُفع القسط الأول بالبطاقة، وسيُخصم باقي الأقساط شهرياً.',
            default       => 'تم تأكيد طلبك! سيُجمع المبلغ عند التوصيل.',
        };

        return redirect()->route('customer.orders.show', $order->id)
            ->with('success', $successMessage);
    }
}