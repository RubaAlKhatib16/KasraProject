<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // جلب جميع المستخدمين مع pagination
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        
        // إحصائيات البطاقات
        $totalUsers = User::count();
        $activeUsers = User::whereNotNull('email_verified_at')->count(); // نشط (مفعل البريد)
        $pendingUsers = User::whereNull('email_verified_at')->where('role', 'customer')->count(); // في انتظار التفعيل
       $blockedUsers = 0;
        
        return view('admin.users.index', compact('users', 'totalUsers', 'activeUsers', 'pendingUsers', 'blockedUsers'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string',
            'role' => 'required|in:customer,seller,admin',
            'is_active' => 'boolean',
        ]);
        
        $user->update($request->only('name', 'email', 'phone', 'role'));
        
        // إذا كان هناك عمود 'is_active' أو 'status'
        if ($request->has('is_active')) {
            $user->is_active = $request->is_active;
            $user->save();
        }
        
        return redirect()->route('admin.users.index')->with('success', 'تم تحديث المستخدم بنجاح');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // منع حذف حساب المشرف الحالي
        if ($user->id === auth()->id()) {
            return back()->with('error', 'لا يمكنك حذف حسابك الخاص');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }
    
    // دالة إضافية لتغيير حالة المستخدم (نشط / معطل)
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active; // إذا كان لديك عمود is_active
        $user->save();
        return back()->with('success', 'تم تغيير حالة المستخدم');
    }
}