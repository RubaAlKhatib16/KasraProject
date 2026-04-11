<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $store = $user->store;
        return view('seller.profile', compact('user', 'store'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $store = $user->store;

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'store_name' => 'required|string|max:255',
            'store_description' => 'nullable|string',
            'password' => 'nullable|min:8|confirmed',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // تحديث بيانات المستخدم
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // تحديث بيانات المتجر
        $store->name = $request->store_name;
        $store->description = $request->store_description;
        if ($request->hasFile('logo')) {
            if ($store->logo) Storage::disk('public')->delete($store->logo);
            $store->logo = $request->file('logo')->store('stores', 'public');
        }
        $store->save();

        return redirect()->route('seller.profile.edit')->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
}
