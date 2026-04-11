<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Installment;

class InstallmentController extends Controller
{
    public function index()
    {
        $installments = Installment::where('user_id', auth()->id())
            ->with(['order.items.product.store']) // لجلب الطلب والمنتجات والمتجر
            ->orderBy('due_date')
            ->paginate(10);
        return view('customer.installments.index', compact('installments'));
    }
}
