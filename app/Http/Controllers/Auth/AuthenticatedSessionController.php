<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Providers\RouteServiceProvider;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // app/Http/Controllers/Auth/AuthenticatedSessionController.php

   public function store(Request $request)
{
    // التحقق من صحة البيانات يدوياً
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // محاولة تسجيل الدخول
    if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    // إذا فشلت المصادقة
    return back()->withErrors([
        'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة.',
    ])->onlyInput('email');
}
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
