<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Installment;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    public function pay(Installment $installment)
    {
        // التحقق من أن المستخدم هو صاحب القسط
        if ($installment->user_id !== auth()->id()) {
            abort(403, 'غير مصرح لك بدفع هذا القسط.');
        }

        // التأكد من أن القسط لا يزال pending
        if ($installment->status !== 'pending') {
            return back()->with('error', 'هذا القسط تم دفعه مسبقاً أو ملغي.');
        }

        // تحديث حالة القسط إلى مدفوع
        $installment->update([
            'status'   => 'paid',
            'paid_at'  => now(),
        ]);

        return back()->with('success', 'تم دفع القسط بنجاح (محاكاة).');
    }
}