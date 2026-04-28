<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\SellerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // عرض صفحة طلب التحول إلى تاجر
    public function create()
    {
        // التحقق اذا كان المستخدم لديه طلب معلق أو مقبول مسبقاً
        $hasPending = SellerRequest::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->exists();

        $alreadySeller = Auth::user()->role === 'seller';

        return view('client.become-seller', compact('hasPending', 'alreadySeller'));
    }

    // حفظ طلب التحول إلى تاجر
    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'nullable|string',
        ]);

        // التأكد من عدم وجود طلب سابق معلق أو مقبول
        $existing = SellerRequest::where('user_id', Auth::id())
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existing) {
            return back()->with('error', 'لديك طلب قيد المراجعة أو تم قبوله بالفعل.');
        }

      
        SellerRequest::create([
            'user_id' => Auth::id(),
            'store_name' => $request->store_name,
            'description' => $request->description,
            'phone' => $request->phone,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'تم إرسال طلبك بنجاح، ستتم مراجعته قريباً.');
    }
}