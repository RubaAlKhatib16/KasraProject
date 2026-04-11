<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // عرض السلة
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('client.cart.index', compact('cart', 'total'));
    }

    // إضافة منتج إلى السلة
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'installment_plan' => 'required|integer|min:0|max:' . $product->installments_count,
        ]);

        $cart = session()->get('cart', []);

        $key = $product->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $request->quantity;
            $cart[$key]['installment_plan'] = $request->installment_plan; // قد نسمح بتغيير الخطة
        } else {
            $cart[$key] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'installment_plan' => $request->installment_plan,
                'featured_image' => $product->featured_image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'تمت إضافة المنتج إلى السلة');
    }

    // تحديث الكمية أو خطة التقسيط
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            $cart[$id]['installment_plan'] = $request->installment_plan;
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index');
    }

    // إزالة منتج من السلة
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }

    // الحصول على عدد العناصر في السلة (لـ AJAX)
    public function count()
    {
        $cart = session()->get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));
        return response()->json(['count' => $count]);
    }
}
