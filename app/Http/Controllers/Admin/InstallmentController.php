<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function index()
    {
        $installments = Installment::with(['order.user', 'order.items.product.store'])
            ->orderBy('due_date')
            ->paginate(15);
        return view('admin.installments.index', compact('installments'));
    }

    public function show($id)
    {
        $installment = Installment::with(['order.user', 'order.items.product.store'])->findOrFail($id);
        return view('admin.installments.show', compact('installment'));
    }

    public function updateStatus(Request $request, $id)
    {
        $installment = Installment::findOrFail($id);
        $request->validate(['status' => 'required|in:paid,unpaid,overdue']);
        $installment->status = $request->status;
        if ($request->status === 'paid') {
            $installment->paid_at = now();
        }
        $installment->save();

        return back()->with('success', 'تم تحديث حالة القسط.');
    }
}