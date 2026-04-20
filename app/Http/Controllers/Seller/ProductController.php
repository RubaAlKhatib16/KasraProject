<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
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
        $categories = Category::all();
        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'installments_count' => 'nullable|integer|min:0|max:24',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // التحقق من الصور الإضافية
        ]);

        // حفظ الصورة الرئيسية
        $imagePath = $request->file('featured_image')->store('products', 'public');

        // إنشاء المنتج
        $product = Product::create([
            'store_id' => auth()->user()->store->id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock ?? 0,
            'featured_image' => $imagePath,
            'is_active' => $request->has('is_active'),
            'category_id' => $request->category_id,
            'installments_count' => $request->installments_count ?? 0,
        ]);

        // حفظ الصور الإضافية
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $index => $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image_path' => $path,
                    'order' => $index
                ]);
            }
        }

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
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deleted_images' => 'nullable|array', // مصفوفة من IDs الصور المراد حذفها
        ]);

        // تحديث الصورة الرئيسية
        if ($request->hasFile('featured_image')) {
            if ($product->featured_image) {
                Storage::disk('public')->delete($product->featured_image);
            }
            $product->featured_image = $request->file('featured_image')->store('products', 'public');
        }

        // حذف الصور الإضافية المحددة
        if ($request->has('deleted_images')) {
            $imagesToDelete = ProductImage::whereIn('id', $request->deleted_images)
                ->where('product_id', $product->id)
                ->get();
            foreach ($imagesToDelete as $img) {
                Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }
        }

        // إضافة صور إضافية جديدة
        if ($request->hasFile('additional_images')) {
            $currentOrder = $product->images()->max('order') + 1;
            foreach ($request->file('additional_images') as $index => $image) {
                $path = $image->store('products', 'public');
                $product->images()->create([
                    'image_path' => $path,
                    'order' => $currentOrder + $index
                ]);
            }
        }

        // تحديث باقي الحقول
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock ?? 0;
        $product->is_active = $request->has('is_active');
        $product->category_id = $request->category_id;
        $product->installments_count = $request->installments_count ?? 0;
        $product->save();

        return redirect()->route('seller.products.index')->with('success', 'تم تحديث المنتج');
    }

    public function destroy(Product $product)
    {
        if ($product->store_id !== auth()->user()->store->id) abort(403);

        // حذف الصورة الرئيسية
        if ($product->featured_image) {
            Storage::disk('public')->delete($product->featured_image);
        }

        // حذف الصور الإضافية
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $product->delete();
        return redirect()->route('seller.products.index')->with('success', 'تم حذف المنتج');
    }
}