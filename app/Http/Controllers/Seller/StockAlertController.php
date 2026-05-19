<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockAlertController extends Controller
{
    /**
     * GET /seller/stock-alerts
     *
     * يُستدعى كل 30 ثانية من الـ Dashboard عبر fetch()
     * يرجع المنتجات التي وصل مخزونها لحد الإشعار أو أقل
     */
    public function index()
    {
        $store = Auth::user()->store;

        if (!$store) {
            return response()->json(['alerts' => [], 'count' => 0]);
        }

        // جلب المنتجات التي مخزونها <= الحد المحدد
        // نستثني المنتجات التي الحد عندها 0 ومخزونها > 0 (لم ينفد بعد)
        $alerts = $store->products()
            ->where(function ($q) {
                // إما المخزون وصل لـ 0
                $q->where('stock', '<=', 0)
                  // أو المخزون أقل من أو يساوي الحد المحدد (وفي حد محدد)
                  ->orWhere(function ($q2) {
                      $q2->where('low_stock_threshold', '>', 0)
                         ->whereColumn('stock', '<=', 'low_stock_threshold');
                  });
            })
            ->select('id', 'name', 'stock', 'low_stock_threshold')
            ->get()
            ->map(fn($p) => [
                'id'        => $p->id,
                'name'      => $p->name,
                'stock'     => $p->stock,
                'threshold' => $p->low_stock_threshold,
                'is_out'    => $p->stock <= 0,
                'edit_url'  => route('seller.products.edit', $p->id),
            ]);

        return response()->json([
            'alerts' => $alerts,
            'count'  => $alerts->count(),
        ]);
    }
}