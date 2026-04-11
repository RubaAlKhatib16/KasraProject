<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * عرض قائمة المنتجات مع التصفية حسب الفئة
     */
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);

        // تصفية حسب الفئة (اختياري)
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // ترتيب حسب الأحدث أولاً
        $products = $query->with('category')->latest()->paginate(12);

        // جلب جميع الفئات لعرضها في القائمة المنسدلة
        $categories = Category::all();

        return view('client.products.index', compact('products', 'categories'));
    }

    /**
     * عرض تفاصيل منتج معين (سيتم استخدامه لاحقاً)
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('client.products.show', compact('product'));
    }
}