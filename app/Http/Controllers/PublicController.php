<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;

class PublicController extends Controller
{
    public function home()
    {
        $featuredStores = Store::where('is_active', true)->take(8)->get(); // للمتاجر الشريكة
        $latestProducts = Product::where('is_active', true)->latest()->take(6)->get(); // أحدث المنتجات (للهيرو أو أي مكان)
        // لأغراض العرض، يمكننا أيضاً جلب منتج واحد لعرضه في "الموكاب"
        $featuredProduct = Product::where('is_active', true)->with('store')->first();
        return view('public.home', compact('featuredStores', 'latestProducts', 'featuredProduct'));
    }


    public function stores()
    {
        $stores = Store::where('is_active', true)->get();

        // تحويل البيانات إلى مصفوفة بالحقول المطلوبة في JavaScript
        $storesData = $stores->map(function ($store) {
            // تحديد الفئة بناءً على اسم المتجر (أو يمكنك تعديلها حسب هيكل قاعدة البيانات لديك)
            $category = 'all';
            $categoryAr = 'عام';
            $name = strtolower($store->name);

            if (str_contains($name, 'apple') || str_contains($name, 'samsung') || str_contains($name, 'sony')) {
                $category = 'electronics';
                $categoryAr = 'إلكترونيات';
            } elseif (str_contains($name, 'zara') || str_contains($name, 'nike') || str_contains($name, 'adidas')) {
                $category = 'fashion';
                $categoryAr = 'أزياء';
            } elseif (str_contains($name, 'sephora') || str_contains($name, 'loccitane')) {
                $category = 'beauty';
                $categoryAr = 'جمال';
            } elseif (str_contains($name, 'cashback')) {
                $category = 'cashback';
                $categoryAr = 'استرداد نقدي';
            }

            // طرق الدفع (مثال، يمكنك تعديلها حسب الحاجة)
            $paymentMethods = [];
            if ($store->id % 2 == 0) $paymentMethods[] = 'applepay';
            if ($store->id % 3 == 0) $paymentMethods[] = 'googlepay';

            return [
                'id' => $store->id,
                'name' => $store->name,
                'category' => $category,
                'categoryAr' => $categoryAr,
                'logo' => $store->logo ? asset('storage/' . $store->logo) : 'https://cdn-icons-png.flaticon.com/512/0/747.png',
                'image' => $store->logo ? asset('storage/' . $store->logo) : 'https://images.unsplash.com/photo-1483985988355-763728e1935b?w=600&h=400&fit=crop',
                'description' => $store->description ?? 'تسوق مع كسرة وقسط مشترياتك',
                'paymentMethods' => $paymentMethods,
            ];
        });

        return view('public.stores', compact('storesData'));
    }

    public function storePage($id)
    {
        $store = Store::findOrFail($id);
        $products = Product::where('store_id', $id)->where('is_active', true)->paginate(12);
        return view('public.store-page', compact('store', 'products'));
    }

    public function howItWorks()
    {
        return view('public.how-it-works');
    }

    public function business()
    {
        return view('public.business');
    }

    public function user()
    {
        return view('public.user');
    }

    public function help()
{
    return view('public.help');
}
}
