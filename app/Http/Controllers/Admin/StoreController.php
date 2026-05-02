<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::with('user')->orderBy('created_at', 'desc')->paginate(10);
        
        $totalStores = Store::count();
        $pendingStores = Store::where('status', 'pending')->count(); // إذا كان لديك عمود status
        $approvedStores = Store::where('status', 'active')->count(); // أو 'approved'
        $rejectedStores = Store::where('status', 'rejected')->count();
        
        return view('admin.stores.index', compact('stores', 'totalStores', 'pendingStores', 'approvedStores', 'rejectedStores'));
    }
    
    public function show($id)
    {
        $store = Store::with('user')->findOrFail($id);
        return view('admin.stores.show', compact('store'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $store = Store::findOrFail($id);
        $request->validate(['status' => 'required|in:pending,active,rejected']);
        $store->status = $request->status;
        $store->save();
        
        // إذا تم قبول المتجر، يمكن ترقية المستخدم إلى تاجر إذا لم يكن كذلك
        if ($request->status === 'active' && $store->user->role !== 'seller') {
            $store->user->role = 'seller';
            $store->user->save();
        }
        
        return back()->with('success', 'تم تحديث حالة المتجر');
    }
    
    public function destroy($id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
        return redirect()->route('admin.stores.index')->with('success', 'تم حذف المتجر');
    }
}