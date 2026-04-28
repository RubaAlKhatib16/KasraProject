<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Http\Requests\StoreRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class StoreController extends Controller
{
    public function index()
    {
        return Store::all();
    }

    public function create()
    {
        // إذا كان المستخدم تاجراً بالفعل، نعيده إلى لوحة التحكم
        if (Auth::user()->role === 'seller') {
            return redirect()->route('seller.dashboard')->with('info', 'لديك متجر بالفعل.');
        }
        return view('store.create');
    }

    public function store(StoreRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // إنشاء المتجر (تأكد من أن العلاقة `store()` موجودة في `User` model)
        $store = $user->store()->create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'active', // أو 'pending' حسب رغبتك
        ]);

        // تحويل المستخدم من customer إلى seller
        $user->role = 'seller';
        $user->save();

        return redirect()->route('seller.dashboard')
            ->with('success', 'تم إنشاء متجرك وترقيتك إلى تاجر بنجاح!');
    }

    public function show($id)
    {
        $store = Store::findOrFail($id);
        $products = Product::where('store_id', $store->id)
            ->where('is_active', true)
            ->paginate(12);
        return view('client.stores.show', compact('store', 'products'));
    }
}