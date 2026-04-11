<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Http\Requests\StoreRequest;
use Illuminate\Support\Facades\Auth; // إضافة الـ Facade
use App\Models\Product;

class StoreController extends Controller
{
    public function index()
    {
        return Store::all();
    }

    public function create()
    {
        return view('store.create');
    }

    public function store(StoreRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // استخدم Auth::user() بدلاً من auth()

        // إنشاء المتجر
        $store = $user->store()->create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        // تحويل المستخدم من customer إلى seller
        $user->role = 'seller';
        $user->save();

        return redirect()->route('seller.dashboard')
            ->with('success', 'تم إنشاء متجرك بنجاح!');
    

    $products = Product::where('store_id', $store->id)->where('is_active', true)->paginate(12);
    return view('client.stores.show', compact('store', 'products'));

}
}