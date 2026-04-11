<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;          // ← أضف هذا السطر لاستيراد نموذج الفئة
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('store_id', auth()->user()->store->id)->get();
        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();   // الآن يعرف النموذج
        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',          // ← جديد
            'installments_count' => 'nullable|integer|min:0|max:24',  // ← جديد
        ]);

        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('products', 'public');
        }

        Product::create([
            'store_id' => auth()->user()->store->id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock ?? 0,
            'featured_image' => $imagePath,
            'is_active' => $request->has('is_active'),
            'category_id' => $request->category_id,                 // ← جديد
            'installments_count' => $request->installments_count ?? 0, // ← جديد
        ]);

        return redirect()->route('seller.products.index')->with('success', 'تم إضافة المنتج بنجاح');
    }

    public function edit(Product $product)
    {
        if ($product->store_id !== auth()->user()->store->id) abort(403);
        $categories = Category::all();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->store_id !== auth()->user()->store->id) abort(403);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'installments_count' => 'nullable|integer|min:0|max:24',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($product->featured_image) {
                Storage::disk('public')->delete($product->featured_image);
            }
            $product->featured_image = $request->file('featured_image')->store('products', 'public');
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock ?? 0;
        $product->is_active = $request->has('is_active');
        $product->category_id = $request->category_id;                 // ← جديد
        $product->installments_count = $request->installments_count ?? 0; // ← جديد
        $product->save();

        return redirect()->route('seller.products.index')->with('success', 'تم تحديث المنتج');
    }

    public function destroy(Product $product)
    {
        if ($product->store_id !== auth()->user()->store->id) abort(403);
        if ($product->featured_image) {
            Storage::disk('public')->delete($product->featured_image);
        }
        $product->delete();
        return redirect()->route('seller.products.index')->with('success', 'تم حذف المنتج');
    }
}