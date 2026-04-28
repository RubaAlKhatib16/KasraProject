<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Installment;

class Order extends Model
{
    protected $fillable = [
    'user_id',
    'order_number',
    'total_amount',
    'status',
    'shipping_address',
    'phone',
    'notes',
    'installment_plan',
    'installment_amount',
    'first_installment_date',
    'payment_method',
    'national_id',
    'id_card_image',
    'customer_name',
    'customer_email',
];

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
protected $casts = [
    'first_installment_date' => 'datetime',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
];
    // في app/Models/Order.php
    public function installments()
    {
        return $this->hasMany(Installment::class);
    }
}
