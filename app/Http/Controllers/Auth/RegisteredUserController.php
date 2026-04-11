<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'max:20', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
            'dob' => ['nullable', 'date', 'before:today'],
            'gender' => ['nullable', 'in:male,female'],
            'terms' => ['accepted'],
            'marketing' => ['nullable', 'boolean'],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'gender' => $request->gender,
            'marketing' => $request->has('marketing'),
            'role' => 'customer', 
        ]);

        event(new Registered($user));

        // إذا كان الطلب Ajax، أعد JSON بدلاً من redirect

        if ($request->expectsJson()) {
            Auth::login($user);
            return response()->json([
                'success' => true,
                'message' => 'تم إنشاء الحساب بنجاح',
                'redirect' => '/',  // ← تم التعديل هنا
            ]);
        }
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
