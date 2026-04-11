<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'order_number', 'total_amount', 'status', 'shipping_address', 'phone', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // نطاق لجلب الطلبات التي تحتوي على منتجات من متجر معين
    public function scopeForStore($query, $storeId)
    {
        return $query->whereHas('items.product', function ($q) use ($storeId) {
            $q->where('store_id', $storeId);
        });
    }

    // في app/Models/Order.php
    public function installments()
    {
        return $this->hasMany(Installment::class);
    }
}
